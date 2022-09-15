<?php

namespace App\Http\Controllers;

use App\Models\HRM_HuongDanSauDaiHoc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HRMHuongDanSauDaiHocController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_huongdansaudaihoc = HRM_HuongDanSauDaiHoc::where('MaNhanVien', Auth::user()->id)
			->orderBy('NamHuongDan', 'desc')->get();
		return view('admin.hosonhanvien.huongdansaudaihoc', compact('hrm_huongdansaudaihoc'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'HoTenHocVien' => 'required|max:255',
			'TenDeTai' => 'required|max:255',
			'TrinhDo' => 'required',
			'CoSoDaoTao' => 'required|max:255',
			'NamHuongDan' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = new HRM_HuongDanSauDaiHoc();
		$orm->MaNhanVien = Auth::user()->id;
		$orm->HoTenHocVien = $request->HoTenHocVien;
		$orm->TenDeTai = $request->TenDeTai;
		$orm->TrinhDo = $request->TrinhDo;
		$orm->CoSoDaoTao = $request->CoSoDaoTao;
		$orm->NamHuongDan = $request->NamHuongDan;
		$orm->NamBaoVe = $request->NamBaoVe;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.huongdansaudaihoc');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'HoTenHocVien_edit' => 'required|max:255',
			'TenDeTai_edit' => 'required|max:255',
			'TrinhDo_edit' => 'required',
			'CoSoDaoTao_edit' => 'required|max:255',
			'NamHuongDan_edit' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = HRM_HuongDanSauDaiHoc::find($request->ID_edit);
		$orm->HoTenHocVien = $request->HoTenHocVien_edit;
		$orm->TenDeTai = $request->TenDeTai_edit;
		$orm->TrinhDo = $request->TrinhDo_edit;
		$orm->CoSoDaoTao = $request->CoSoDaoTao_edit;
		$orm->NamHuongDan = $request->NamHuongDan_edit;
		$orm->NamBaoVe = $request->NamBaoVe_edit;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.huongdansaudaihoc');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_HuongDanSauDaiHoc::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.hosonhanvien.huongdansaudaihoc');
	}
}