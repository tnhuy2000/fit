<?php

namespace App\Http\Controllers;

use App\Models\CMS_LienKetNgoai;
use Illuminate\Http\Request;

class CMSLienKetNgoaiController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_lienketngoai = CMS_LienKetNgoai::orderBy('ThuTuHienThi', 'asc')
			->get();
		return view('admin.danhmuc.lienketngoai', compact('cms_lienketngoai'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenLienKet' => 'required|max:255|unique:cms_lienketngoai',
			'LienKet' => 'required|max:255'
		]);
		
		$orm = new CMS_LienKetNgoai();
		$orm->TenLienKet = $request->TenLienKet;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.lienketngoai');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'TenLienKet_edit' => 'required|max:255|unique:cms_lienketngoai,TenLienKet,' . $request->ID_edit,
		]);
		
		$orm = CMS_LienKetNgoai::find($request->ID_edit);
		$orm->TenLienKet = $request->TenLienKet_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.lienketngoai');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_LienKetNgoai::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.lienketngoai');
	}
	
	public function getKichHoat($id)
	{
		$orm = CMS_LienKetNgoai::find($id);
		$orm->KichHoat = 1 - $orm->KichHoat;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.lienketngoai');
	}
}