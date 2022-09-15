<?php

namespace App\Http\Controllers;

use App\Models\CMS_TrinhChieu_Mini;
use Illuminate\Http\Request;

class CMSTrinhChieuMiniController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/slider/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		$cms_trinhchieu_mini = CMS_TrinhChieu_Mini::all();
		return view('admin.danhmuc.slide', compact('cms_trinhchieu_mini', 'path'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'HinhAnh' => 'required|max:255|unique:cms_trinhchieu_mini'
		]);
		
		$orm = new CMS_TrinhChieu_Mini();
		$orm->TieuDe = $request->TieuDe;
		$orm->HinhAnh = $request->HinhAnh;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.slide');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'HinhAnh_edit' => 'required|max:255|unique:cms_trinhchieu_mini,HinhAnh,' . $request->ID_edit,
		]);
		
		$orm = CMS_TrinhChieu_Mini::find($request->ID_edit);
		$orm->TieuDe = $request->TieuDe_edit;
		$orm->HinhAnh = $request->HinhAnh_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.slide');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_TrinhChieu_Mini::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.slide');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_TrinhChieu_Mini::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.slide');
	}
}