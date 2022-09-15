<?php

namespace App\Http\Controllers;

use App\Models\HRM_DonVi;
use App\Models\HRM_ChucVu;
use App\Models\HRM_NhanVien;
use App\Models\HRM_NhanVien_DonVi;
use Illuminate\Http\Request;

class HRMNhanVienDonViController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_donvi = HRM_DonVi::all();
		$hrm_chucvu = HRM_ChucVu::all();
		$hrm_nhanvien = HRM_NhanVien::all();
		$hrm_nhanvien_donvi = HRM_NhanVien_DonVi::orderBy('MaDonVi', 'asc')
			->orderBy('ThuTuHienThi', 'asc')->get();
		return view('admin.danhmuc.nhanvien_donvi', compact('hrm_donvi', 'hrm_chucvu', 'hrm_nhanvien', 'hrm_nhanvien_donvi'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'MaNhanVien' => 'required',
			'MaDonVi' => 'required',
			'MaChucVu' => 'required'
		]);
		
		$orm = new HRM_NhanVien_DonVi();
		$orm->MaNhanVien = $request->MaNhanVien;
		$orm->MaDonVi = $request->MaDonVi;
		$orm->MaChucVu = $request->MaChucVu;
		if(!empty($request->ThuTuHienThi)) $orm->ThuTuHienThi = $request->ThuTuHienThi;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.nhanvien.donvi');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'MaNhanVien_edit' => 'required',
			'MaDonVi_edit' => 'required',
			'MaChucVu_edit' => 'required'
		]);
		
		$orm = HRM_NhanVien_DonVi::find($request->ID_edit);
		$orm->MaNhanVien = $request->MaNhanVien_edit;
		$orm->MaDonVi = $request->MaDonVi_edit;
		$orm->MaChucVu = $request->MaChucVu_edit;
		if(!empty($request->ThuTuHienThi_edit)) $orm->ThuTuHienThi = $request->ThuTuHienThi_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.nhanvien.donvi');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_NhanVien_DonVi::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.nhanvien.donvi');
	}
}