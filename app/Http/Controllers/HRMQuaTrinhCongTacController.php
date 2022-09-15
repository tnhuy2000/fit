<?php

namespace App\Http\Controllers;

use App\Models\HRM_QuaTrinhCongTac;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HRMQuaTrinhCongTacController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_quatrinhcongtac = HRM_QuaTrinhCongTac::where('MaNhanVien', Auth::user()->id)
			->orderBy('ThoiGian', 'desc')->get();
		return view('admin.hosonhanvien.quatrinhcongtac', compact('hrm_quatrinhcongtac'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'ThoiGian' => 'required|max:255',
			'NoiDungCongViec' => 'required|max:255'
		]);
		
		$orm = new HRM_QuaTrinhCongTac();
		$orm->MaNhanVien = Auth::user()->id;
		$orm->ThoiGian = $request->ThoiGian;
		$orm->NoiDungCongViec = $request->NoiDungCongViec;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.quatrinhcongtac');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'ThoiGian_edit' => 'required|max:255',
			'NoiDungCongViec_edit' => 'required|max:255'
		]);
		
		$orm = HRM_QuaTrinhCongTac::find($request->ID_edit);
		$orm->ThoiGian = $request->ThoiGian_edit;
		$orm->NoiDungCongViec = $request->NoiDungCongViec_edit;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.quatrinhcongtac');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_QuaTrinhCongTac::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.hosonhanvien.quatrinhcongtac');
	}
}