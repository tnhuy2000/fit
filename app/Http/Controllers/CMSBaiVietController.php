<?php

namespace App\Http\Controllers;

use App\Models\CMS_ChuDe;
use App\Models\CMS_LoaiBaiViet;
use App\Models\CMS_BaiViet;
use App\Models\CMS_VanBan;
use App\Models\HRM_DonVi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CMSBaiVietController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_baiviet = CMS_BaiViet::orderBy('created_at', 'desc')
			->orderBy('QuanTrong', 'desc')->get();
		return view('admin.baiviet.danhsach', compact('cms_baiviet'));
	}
	
	public function getThem()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$baiviet_identity = DB::select("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . config('database.connections.mysql.database') . "' AND TABLE_NAME = 'cms_baiviet'");
		$next_id = $baiviet_identity[0]->AUTO_INCREMENT;
		Storage::makeDirectory('files/posts/' . str_pad($next_id, 7, '0', STR_PAD_LEFT), 0775);
		
		$path = config('app.url') . '/storage/app/files/posts/' . str_pad($next_id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = '*';
		
		$cms_loaibaiviet = CMS_LoaiBaiViet::all();
		$hrm_donvi = HRM_DonVi::all();
		$cms_chude = CMS_ChuDe::all();
		return view('admin.baiviet.them', compact('cms_loaibaiviet', 'hrm_donvi', 'cms_chude'));
	}
	
	public function postThem(Request $request)
	{
		$rules = array();
		$rules['MaLoai'] = 'required';
		$rules['MaChuDe'] = 'required';
		$rules['TieuDe'] = 'required|string|unique:cms_baiviet';
		$rules['NoiDung'] = 'required';
		if($request->MaLoai == 2) $rules['DinhKem'] = 'required';
		
		$this->validate($request, $rules);
		
		$orm = new CMS_BaiViet();
		$orm->MaLoai = $request->MaLoai;
		
		$orm->MaChuDe = $request->MaChuDe;
		$orm->MaNguoiDung = Auth::user()->id;
		$orm->TieuDe = $request->TieuDe;
		$orm->TieuDeKhongDau = Str::slug($request->TieuDe, '-');
		$orm->NoiDung = $request->NoiDung;
		if(!empty($request->MaDonVi)) $orm->MaDonVi = $request->MaDonVi;
		if(!empty($request->TomTat)) $orm->TomTat = $request->TomTat;
		if(!empty($request->QuanTrong)) $orm->QuanTrong = $request->QuanTrong;
		$orm->save();
		
		if($request->MaLoai == 2 && isset($request->DinhKem))
		{
			$maBaiViet = $orm->ID;
			$index = 0;
			foreach($request->DinhKem as $value)
			{
				if(!empty($value))
				{
					$vb = new CMS_VanBan();
					$vb->MaBaiViet = $maBaiViet;
					$vb->TenVanBan = $request->TenVanBan[$index];
					$vb->TenVanBanKhongDau = Str::slug($request->TenVanBan[$index], '-');
					$vb->DuongDan = $value;
					$vb->save();
					$index++;
				}
			}
		}
		
		return redirect()->route('admin.baiviet.danhsach');
	}
	
	public function getSua($id)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/files/posts/' . str_pad($id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = '*';
		
		$cms_baiviet = CMS_BaiViet::where('ID', $id)->first();
		$cms_loaibaiviet = CMS_LoaiBaiViet::all();
		$hrm_donvi = HRM_DonVi::all();
		$cms_chude = CMS_ChuDe::all();
		return view('admin.baiviet.sua', compact('cms_baiviet', 'cms_loaibaiviet', 'hrm_donvi', 'cms_chude'));
	}
	
	public function postSua(Request $request, $id)
	{
		$rules = array();
		$rules['MaLoai'] = 'required';
		$rules['MaChuDe'] = 'required';
		$rules['TieuDe'] = 'required|string|unique:cms_baiviet,TieuDe,' . $request->ID . ',ID';
		$rules['NoiDung'] = 'required';
		if($request->MaLoai == 3) $rules['MaDonVi'] = 'required';
		$this->validate($request, $rules);
		
		$orm = CMS_BaiViet::find($request->ID);
		$orm->MaLoai = $request->MaLoai;
		$orm->MaChuDe = $request->MaChuDe;
		$orm->MaDonVi = $request->MaLoai == 3 ? $request->MaDonVi : null;
		$orm->TieuDe = $request->TieuDe;
		$orm->TieuDeKhongDau = Str::slug($request->TieuDe, '-');
		$orm->TomTat = $request->TomTat;
		$orm->NoiDung = $request->NoiDung;
		$orm->QuanTrong = empty($request->QuanTrong) ? 0 : 1;
		$orm->save();
		
		if($request->MaLoai == 2)
			return redirect()->route('admin.baiviet.vanban', ['id' => $request->ID]);
		else
			return redirect()->route('admin.baiviet.danhsach');
	}
	
	public function getSuaNhanh()
	{
		$cms_baiviet = CMS_BaiViet::where('KiemDuyet', 0)
			->orderBy('created_at', 'desc')
			->limit(10)->get();
		return view('admin.baiviet.suanhanh', compact('cms_baiviet'));
	}
	
	public function postSuaNhanh(Request $request)
	{
		foreach($request->ID as $value)
		{
			$orm = CMS_BaiViet::find($value);
			$orm->TieuDe = $request->TieuDe[$value];
			$orm->TieuDeKhongDau = Str::slug($request->TieuDe[$value], '-');
			$orm->TomTat = $request->TomTat[$value];
			$orm->NoiDung = $request->NoiDung[$value];
			$orm->KiemDuyet = 1;
			$orm->save();
		}
		return redirect()->route('admin.home')->with('status', 'Đã cập nhật nhanh các bài viết.');
	}
	
	public function postXoa(Request $request)
	{
		CMS_VanBan::where('MaBaiViet', $request->ID_delete)->delete();
		CMS_BaiViet::where('ID', $request->ID_delete)->delete();
		Storage::deleteDirectory('files/posts/' . str_pad($request->ID_delete, 7, '0', STR_PAD_LEFT));
		
		return redirect()->route('admin.baiviet.danhsach');
	}
	
	public function getQuanTrong($id)
	{
		$orm = CMS_BaiViet::find($id);
		$orm->QuanTrong = 1 - $orm->QuanTrong;
		$orm->save();
		
		return redirect()->route('admin.baiviet.danhsach');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_BaiViet::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.baiviet.danhsach');
	}
}