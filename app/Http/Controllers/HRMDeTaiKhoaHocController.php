<?php

namespace App\Http\Controllers;

use App\Models\HRM_DeTaiKhoaHoc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HRMDeTaiKhoaHocController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_detaikhoahoc = HRM_DeTaiKhoaHoc::where('MaNhanVien', Auth::user()->id)
			->orderBy('NamNghiemThu', 'desc')->get();
		return view('admin.hosonhanvien.detaikhoahoc', compact('hrm_detaikhoahoc'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'CapQuanLy' => 'required',
			'TenCongTrinh' => 'required|max:255',
			'ChuNhiem' => 'required|max:50',
			'NamNghiemThu' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = new HRM_DeTaiKhoaHoc();
		$orm->MaNhanVien = Auth::user()->id;
		$orm->CapQuanLy = $request->CapQuanLy;
		$orm->TenCongTrinh = $request->TenCongTrinh;
		$orm->ChuNhiem = $request->ChuNhiem;
		$orm->ThanhVienThamGia = $request->ThanhVienThamGia;
		$orm->NamNghiemThu = $request->NamNghiemThu;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->HienThiCongKhai)) $orm->HienThiCongKhai = $request->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.detaikhoahoc');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'CapQuanLy_edit' => 'required',
			'TenCongTrinh_edit' => 'required|max:255',
			'ChuNhiem_edit' => 'required|max:50',
			'NamNghiemThu_edit' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = HRM_DeTaiKhoaHoc::find($request->ID_edit);
		$orm->CapQuanLy = $request->CapQuanLy_edit;
		$orm->TenCongTrinh = $request->TenCongTrinh_edit;
		$orm->ChuNhiem = $request->ChuNhiem_edit;
		$orm->ThanhVienThamGia = $request->ThanhVienThamGia_edit;
		$orm->NamNghiemThu = $request->NamNghiemThu_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->HienThiCongKhai = empty($request->HienThiCongKhai_edit) ? 0 : 1;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.detaikhoahoc');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_DeTaiKhoaHoc::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.hosonhanvien.detaikhoahoc');
	}
	
	public function getKichHoat($id)
	{
		$orm = HRM_DeTaiKhoaHoc::find($id);
		$orm->HienThiCongKhai = 1 - $orm->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.detaikhoahoc');
	}
}