<?php

namespace App\Http\Controllers;

use App\Models\CMS_TrinhChieu;
use Illuminate\Http\Request;

class CMSTrinhChieuController extends Controller
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
		
		$cms_trinhchieu = CMS_TrinhChieu::all();
		return view('admin.danhmuc.mainslide', compact('cms_trinhchieu', 'path'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'HinhAnh' => 'required|max:255|unique:cms_trinhchieu'
		]);
		
		$orm = new CMS_TrinhChieu();
		$orm->TieuDe = $request->TieuDe;
		$orm->TieuDeNho = $request->TieuDeNho;
		$orm->HinhAnh = $request->HinhAnh;
		$orm->TenLienKet1 = $request->TenLienKet1;
		$orm->LienKet1 = $request->LienKet1;
		$orm->TenLienKet2 = $request->TenLienKet2;
		$orm->LienKet2 = $request->LienKet2;
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.mainslide');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'HinhAnh_edit' => 'required|max:255|unique:cms_trinhchieu,HinhAnh,' . $request->ID_edit
		]);
		
		$orm = CMS_TrinhChieu::find($request->ID_edit);
		$orm->TieuDe = $request->TieuDe_edit;
		$orm->TieuDeNho = $request->TieuDeNho_edit;
		$orm->HinhAnh = $request->HinhAnh_edit;
		$orm->TenLienKet1 = $request->TenLienKet1_edit;
		$orm->LienKet1 = $request->LienKet1_edit;
		$orm->TenLienKet2 = $request->TenLienKet2_edit;
		$orm->LienKet2 = $request->LienKet2_edit;
		$orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.mainslide');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_TrinhChieu::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.mainslide');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_TrinhChieu::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.mainslide');
	}
}