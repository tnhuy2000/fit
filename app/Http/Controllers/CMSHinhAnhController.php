<?php

namespace App\Http\Controllers;

use App\Models\CMS_ChuDe;
use App\Models\CMS_HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CMSHinhAnhController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_hinhanh = CMS_HinhAnh::orderBy('created_at', 'desc')->get();
		return view('admin.hinhanh.danhsach', compact('cms_hinhanh'));
	}
	
	public function getThem()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$hinhanh_identity = DB::select("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . config('database.connections.mysql.database') . "' AND TABLE_NAME = 'cms_hinhanh'");
		$next_id = $hinhanh_identity[0]->AUTO_INCREMENT;
		Storage::makeDirectory('images/' . str_pad($next_id, 7, '0', STR_PAD_LEFT), 0775);
		
		$path = config('app.url') . '/storage/app/images/' . str_pad($next_id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		$folder = 'images/' . str_pad($next_id, 7, '0', STR_PAD_LEFT);
		$cms_chude = CMS_ChuDe::all();
		return view('admin.hinhanh.them', compact('cms_chude', 'folder'));
	}
	
	public function postThem(Request $request)
	{
		$rules = array();
		$rules['MaChuDe'] = 'required';
		$rules['MoTa'] = 'required';
		$this->validate($request, $rules);
		
		$orm = new CMS_HinhAnh();
		$orm->MaChuDe = $request->MaChuDe;
		$orm->MaNguoiDung = Auth::user()->id;
		$orm->MoTa = $request->MoTa;
		$orm->MoTaKhongDau = Str::slug($request->MoTa, '-');
		$orm->ThuMuc = $request->ThuMuc;
		$orm->save();
		
		return redirect()->route('admin.hinhanh.danhsach');
	}
	
	public function getSua($id)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/images/' . str_pad($id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		$folder = 'images/' . str_pad($id, 7, '0', STR_PAD_LEFT);
		$cms_hinhanh = CMS_HinhAnh::where('ID', $id)->first();
		$cms_chude = CMS_ChuDe::all();
		return view('admin.hinhanh.sua', compact('cms_hinhanh', 'cms_chude', 'folder'));
	}
	
	public function postSua(Request $request, $id)
	{
		$rules = array();
		$rules['MaChuDe'] = 'required';
		$rules['MoTa'] = 'required';
		$this->validate($request, $rules);
		
		$orm = CMS_HinhAnh::find($request->ID);
		$orm->MaChuDe = $request->MaChuDe;
		$orm->MoTa = $request->MoTa;
		$orm->MoTaKhongDau = Str::slug($request->MoTa, '-');
		$orm->ThuMuc = $request->ThuMuc;
		$orm->save();
		
		return redirect()->route('admin.hinhanh.danhsach');
	}
	
	public function getSuaNhanh()
	{
		$cms_hinhanh = CMS_HinhAnh::where('KiemDuyet', 0)
			->orderBy('created_at', 'desc')
			->limit(10)->get();
		return view('admin.hinhanh.suanhanh', compact('cms_hinhanh'));
	}
	
	public function postSuaNhanh(Request $request)
	{
		foreach($request->ID as $value)
		{
			$orm = CMS_HinhAnh::find($value);
			$orm->MoTa = $request->MoTa[$value];
			$orm->MoTaKhongDau = Str::slug($request->MoTa[$value], '-');
			$orm->KiemDuyet = 1;
			$orm->save();
		}
		return redirect()->route('admin.home')->with('status', 'Đã cập nhật nhanh các hình ảnh.');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_HinhAnh::find($request->ID_delete);
		$orm->delete();
		Storage::deleteDirectory('images/' . str_pad($request->ID_delete, 7, '0', STR_PAD_LEFT));
		
		return redirect()->route('admin.hinhanh.danhsach');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_HinhAnh::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.hinhanh.danhsach');
	}
	
	public function postHinhAnhAjax(Request $request)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/images/' . str_pad($request->id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		return 1;
	}
}