<?php

namespace App\Http\Controllers;

use App\Models\HRM_ChucVu;
use Illuminate\Http\Request;

class HRMChucVuController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_chucvu = HRM_ChucVu::all();
		return view('admin.danhmuc.chucvu', compact('hrm_chucvu'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenChucVu' => 'required|max:255|unique:hrm_chucvu'
		]);
		
		$orm = new HRM_ChucVu();
		$orm->TenChucVu = $request->TenChucVu;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.chucvu');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'TenChucVu_edit' => 'required|max:255|unique:hrm_chucvu,TenChucVu,' . $request->ID_edit . ',ID'
		]);
		
		$orm = HRM_ChucVu::find($request->ID_edit);
		$orm->TenChucVu = $request->TenChucVu_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.chucvu');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_ChucVu::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.chucvu');
	}
}