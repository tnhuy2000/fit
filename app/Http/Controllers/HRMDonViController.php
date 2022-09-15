<?php

namespace App\Http\Controllers;

use App\Models\HRM_DonVi;
use Illuminate\Http\Request;

class HRMDonViController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_donvi = HRM_DonVi::all();
		return view('admin.danhmuc.donvi', compact('hrm_donvi'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenDonVi' => 'required|max:255|unique:hrm_donvi'
		]);
		
		$orm = new HRM_DonVi();
		$orm->TenDonVi = $request->TenDonVi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.donvi');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'TenDonVi_edit' => 'required|max:255|unique:hrm_donvi,TenDonVi,' . $request->ID_edit . ',ID'
		]);
		
		$orm = HRM_DonVi::find($request->ID_edit);
		$orm->TenDonVi = $request->TenDonVi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.donvi');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_DonVi::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.donvi');
	}
}