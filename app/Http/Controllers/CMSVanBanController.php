<?php

namespace App\Http\Controllers;

use App\Models\CMS_BaiViet;
use App\Models\CMS_VanBan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CMSVanBanController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach($id)
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
		$_SESSION['resourceType'] = 'Files';
		
		$cms_baiviet = CMS_BaiViet::where('ID', $id)->first();
		$cms_vanban = CMS_VanBan::where('MaBaiViet', $id)->get();
		return view('admin.baiviet.vanban', compact('cms_baiviet', 'cms_vanban'));
	}
	
	public function postThem(Request $request)
	{
		$rules = array();
		$rules['TenVanBan'] = 'required|string';
		$rules['DuongDan'] = 'required';
		$this->validate($request, $rules);
		
		$orm = new CMS_VanBan();
		$orm->MaBaiViet = $request->MaBaiViet;
		$orm->TenVanBan = $request->TenVanBan;
		$orm->TenVanBanKhongDau = Str::slug($request->TenVanBan, '-');
		$orm->DuongDan = $request->DuongDan;
		$orm->save();
		
		return redirect()->route('admin.baiviet.vanban', ['id' => $request->MaBaiViet]);
	}
	
	public function postSua(Request $request)
	{
		$rules = array();
		$rules['TenVanBan_edit'] = 'required|string';
		$rules['DuongDan_edit'] = 'required';
		$this->validate($request, $rules);
		
		$orm = CMS_VanBan::find($request->ID_edit);
		$orm->TenVanBan = $request->TenVanBan_edit;
		$orm->TenVanBanKhongDau = Str::slug($request->TenVanBan_edit, '-');
		$orm->DuongDan = $request->DuongDan_edit;
		$orm->save();
		
		return redirect()->route('admin.baiviet.vanban', ['id' => $request->MaBaiViet_edit]);
	}
	
	public function getSuaNhanh()
	{
		$cms_vanban = CMS_VanBan::where('KiemDuyet', 0)
			->orderBy('MaBaiViet', 'desc')
			->limit(10)->get();
		return view('admin.baiviet.suanhanh_vanban', compact('cms_vanban'));
	}
	
	public function postSuaNhanh(Request $request)
	{
		foreach($request->ID as $value)
		{
			$orm = CMS_VanBan::find($value);
			$orm->TenVanBan = $request->TenVanBan[$value];
			$orm->TenVanBanKhongDau = Str::slug($request->TenVanBan[$value], '-');
			$orm->DuongDan = $request->DuongDan[$value];
			$orm->KiemDuyet = 1;
			$orm->save();
		}
		return redirect()->route('admin.home')->with('status', 'Đã cập nhật nhanh các văn bản kèm theo bài viết.');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_VanBan::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.baiviet.vanban', ['id' => $request->MaBaiViet_delete]);
	}
	
	public function getKichHoat($idBaiViet, $id)
	{
		$orm = CMS_VanBan::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.baiviet.vanban', ['id' => $idBaiViet]);
	}
	
	public function postVanBanAjax(Request $request)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/files/posts/' . str_pad($request->id, 7, '0', STR_PAD_LEFT) . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Files';
		
		return 1;
	}
}