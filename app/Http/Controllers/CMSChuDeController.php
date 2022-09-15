<?php

namespace App\Http\Controllers;

use App\Models\CMS_ChuDe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CMSChuDeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_chude = CMS_ChuDe::orderBy('ThuTuHienThi', 'asc')
			->get();
		return view('admin.danhmuc.chude', compact('cms_chude'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenChuDe' => 'required|max:255|unique:cms_chude'
		]);
		
		$orm = new CMS_ChuDe();
		$orm->TenChuDe = $request->TenChuDe;
		$orm->TenChuDeKhongDau = Str::slug($request->TenChuDe, '-');
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.chude');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'TenChuDe_edit' => 'required|max:255|unique:cms_chude,TenChuDe,' . $request->ID_edit . ',ID'
		]);
		
		$orm = CMS_ChuDe::find($request->ID_edit);
		$orm->TenChuDe = $request->TenChuDe_edit;
		$orm->TenChuDeKhongDau = Str::slug($request->TenChuDe_edit, '-');
		$orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.chude');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_ChuDe::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.chude');
	}
}