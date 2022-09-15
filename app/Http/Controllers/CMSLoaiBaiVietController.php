<?php

namespace App\Http\Controllers;

use App\Models\CMS_LoaiBaiViet;
use Illuminate\Http\Request;

class CMSLoaiBaiVietController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$cms_loaibaiviet = CMS_LoaiBaiViet::all();
		return view('admin.danhmuc.loaibaiviet', compact('cms_loaibaiviet'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenLoai' => 'required|max:255|unique:cms_loaibaiviet'
		]);
		
		$orm = new CMS_LoaiBaiViet();
		$orm->TenLoai = $request->TenLoai;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.loaibaiviet');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'TenLoai_edit' => 'required|max:255|unique:cms_loaibaiviet,TenLoai,' . $request->ID_edit . ',ID'
		]);
		
		$orm = CMS_LoaiBaiViet::find($request->ID_edit);
		$orm->TenLoai = $request->TenLoai_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.loaibaiviet');
	}
	
	public function postXoa(Request $request)
	{
		$orm = CMS_LoaiBaiViet::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.loaibaiviet');
	}
}