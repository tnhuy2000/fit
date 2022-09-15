<?php

namespace App\Http\Controllers;

use App\Models\CMS_BangDienTu;
use Illuminate\Http\Request;

class CMSBangDienTuController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_bangdientu = CMS_BangDienTu::all();
		return view('admin.danhmuc.bangdientu', compact('cms_bangdientu'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'NoiDung' => 'required|max:255|unique:cms_bangdientu'
		]);
		
		$orm = new CMS_BangDienTu();
		$orm->NoiDung = $request->NoiDung;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.bangdientu');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'NoiDung_edit' => 'required|max:255|unique:cms_bangdientu,NoiDung,' . $request->ID_edit,
		]);
		
		$orm = CMS_BangDienTu::find($request->ID_edit);
		$orm->NoiDung = $request->NoiDung_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.bangdientu');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_BangDienTu::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.bangdientu');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_BangDienTu::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.bangdientu');
	}
}