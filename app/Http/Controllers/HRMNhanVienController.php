<?php

namespace App\Http\Controllers;

use App\Models\HRM_NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Storage;

class HRMNhanVienController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$path = config('app.url') . '/storage/app/files/staffs/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		$hrm_nhanvien = HRM_NhanVien::all();
		return view('admin.danhmuc.nhanvien', compact('hrm_nhanvien', 'path'));
	}
	
	public function postThem(Request $request)
	{
		$rules = array();
		$rules['HoVaTen'] = 'required|max:100|unique:hrm_nhanvien';
		$rules['Email'] = 'required|string|email|max:255|unique:hrm_nhanvien';
		if(!empty($request->MaCanBo)) $rules['MaCanBo'] = 'max:20|unique:hrm_nhanvien';
		if(!empty($request->NamSinh)) $rules['NamSinh'] = 'digits:4|integer|min:1950|max:' . date('Y');
		if(!empty($request->DienThoai)) $rules['DienThoai'] = 'max:50|unique:hrm_nhanvien';
		$this->validate($request, $rules);
		
		$orm = new HRM_NhanVien();
		if(!empty($request->MaCanBo))			$orm->MaCanBo = $request->MaCanBo;
		if(!empty($request->HoVaTen))			$orm->HoVaTen = $request->HoVaTen;
		if(!empty($request->HoVaTen))			$orm->HoVaTenKhongDau = Str::slug($request->HoVaTen, '-');
		if(!empty($request->NamSinh))			$orm->HoVaTen = $request->NamSinh;
		if(!empty($request->NgayVaoLam))		$orm->NgayVaoLam = Carbon::createFromFormat('d/m/Y', $request->NgayVaoLam)->format('Y-m-d');
		if(!empty($request->ChuyenNganh))		$orm->ChuyenNganh = $request->ChuyenNganh;
		if(!empty($request->HocVi))				$orm->HocVi = $request->HocVi;
		if(!empty($request->NamNhanHocVi))		$orm->NamNhanHocVi = $request->NamNhanHocVi;
		if(!empty($request->HocHam))			$orm->HocHam = $request->HocHam;
		if(!empty($request->NamNhanHocHam))		$orm->NamNhanHocHam = $request->NamNhanHocHam;
		if(!empty($request->Email))				$orm->Email = $request->Email;
		if(!empty($request->DienThoai))			$orm->DienThoai = $request->DienThoai;
		if(!empty($request->TrangWeb))			$orm->TrangWeb = $request->TrangWeb;
		if(!empty($request->HinhAnh))			$orm->HinhAnh = $request->HinhAnh;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.nhanvien');
	}
	
	public function postSua(Request $request)
	{
		$rules = array();
		$rules['HoVaTen_edit'] = 'required|max:100|unique:hrm_nhanvien,HoVaTen,' . $request->ID_edit . ',ID';
		$rules['Email_edit'] = 'required|string|email|max:255|unique:hrm_nhanvien,Email,' . $request->ID_edit . ',ID';
		if(!empty($request->MaCanBo_edit)) $rules['MaCanBo_edit'] = 'max:20|unique:hrm_nhanvien,MaCanBo,' . $request->ID_edit . ',ID';
		if(!empty($request->NamSinh_edit)) $rules['NamSinh_edit'] = 'digits:4|integer|min:1950|max:' . date('Y');
		if(!empty($request->DienThoai_edit)) $rules['DienThoai_edit'] = 'max:50|unique:hrm_nhanvien,DienThoai,' . $request->ID_edit . ',ID';
		$this->validate($request, $rules);
		
		$orm = HRM_NhanVien::find($request->ID_edit);
		$orm->MaCanBo = $request->MaCanBo_edit;
		$orm->HoVaTen = $request->HoVaTen_edit;
		$orm->HoVaTenKhongDau = Str::slug($request->HoVaTen_edit, '-');
		$orm->NamSinh = $request->NamSinh_edit;
		$orm->NgayVaoLam = !empty($request->NgayVaoLam_edit) ? Carbon::createFromFormat('d/m/Y', $request->NgayVaoLam_edit)->format('Y-m-d') : null;
		$orm->ChuyenNganh = $request->ChuyenNganh_edit;
		$orm->HocVi = $request->HocVi_edit;
		$orm->NamNhanHocVi = $request->NamNhanHocVi_edit;
		$orm->HocHam = $request->HocHam_edit;
		$orm->NamNhanHocHam = $request->NamNhanHocHam_edit;
		$orm->Email = $request->Email_edit;
		$orm->DienThoai = $request->DienThoai_edit;
		$orm->TrangWeb = $request->TrangWeb_edit;
		$orm->HinhAnh = $request->HinhAnh_edit;
		$orm->save();
		
		return redirect()->route('admin.danhmuc.nhanvien');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_NhanVien::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.danhmuc.nhanvien');
	}
	
	public function getCoBan()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$user_folder = Auth::user()->username;
		if(!file_exists(storage_path() . '/app/files/staffs/' . $user_folder))
			Storage::makeDirectory('files/staffs/' . $user_folder);
		
		$path = config('app.url') . '/storage/app/files/staffs/';
		$user_path = $path . $user_folder . '/';
		if(isset($_SESSION['ckAuth'])) unset($_SESSION['ckAuth']);
		$_SESSION['ckAuth'] = true;
		if(isset($_SESSION['baseUrl'])) unset($_SESSION['baseUrl']);
		$_SESSION['baseUrl'] = $user_path;
		if(isset($_SESSION['resourceType'])) unset($_SESSION['resourceType']);
		$_SESSION['resourceType'] = 'Images';
		
		$hrm_nhanvien = HRM_NhanVien::where('Email', Auth::user()->email)->first();
		return view('admin.hosonhanvien.coban', compact('hrm_nhanvien', 'path', 'user_path'));
	}
	
	public function postCoBan_Sua(Request $request)
	{
		$rules = array();
		$rules['HoVaTen_edit'] = 'required|max:100|unique:hrm_nhanvien,HoVaTen,' . $request->ID_edit . ',ID';
		$rules['Email_edit'] = 'required|string|email|max:255|unique:hrm_nhanvien,Email,' . $request->ID_edit . ',ID';
		if(!empty($request->MaCanBo_edit)) $rules['MaCanBo_edit'] = 'max:20|unique:hrm_nhanvien,MaCanBo,' . $request->ID_edit . ',ID';
		if(!empty($request->NamSinh_edit)) $rules['NamSinh_edit'] = 'digits:4|integer|min:1950|max:' . date('Y');
		if(!empty($request->DienThoai_edit)) $rules['DienThoai_edit'] = 'max:50|unique:hrm_nhanvien,DienThoai,' . $request->ID_edit . ',ID';
		$this->validate($request, $rules);
		
		$orm = HRM_NhanVien::find($request->ID_edit);
		$orm->MaCanBo = $request->MaCanBo_edit;
		$orm->HoVaTen = $request->HoVaTen_edit;
		$orm->HoVaTenKhongDau = Str::slug($request->HoVaTen_edit, '-');
		$orm->NamSinh = $request->NamSinh_edit;
		$orm->NgayVaoLam = !empty($request->NgayVaoLam_edit) ? Carbon::createFromFormat('d/m/Y', $request->NgayVaoLam_edit)->format('Y-m-d') : null;
		$orm->ChuyenNganh = $request->ChuyenNganh_edit;
		$orm->HocVi = $request->HocVi_edit;
		$orm->NamNhanHocVi = $request->NamNhanHocVi_edit;
		$orm->HocHam = $request->HocHam_edit;
		$orm->NamNhanHocHam = $request->NamNhanHocHam_edit;
		$orm->Email = $request->Email_edit;
		$orm->DienThoai = $request->DienThoai_edit;
		$orm->TrangWeb = $request->TrangWeb_edit;
		$orm->HinhAnh = $request->HinhAnh_edit;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.coban');
	}
}