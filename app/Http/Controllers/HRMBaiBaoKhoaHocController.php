<?php

namespace App\Http\Controllers;

use App\Models\HRM_BaiBaoKhoaHoc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HRMBaiBaoKhoaHocController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_baibaokhoahoc = HRM_BaiBaoKhoaHoc::where('MaNhanVien', Auth::user()->id)
			->orderBy('NamXuatBan', 'desc')->get();
		return view('admin.hosonhanvien.baibaokhoahoc', compact('hrm_baibaokhoahoc'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'LoaiBaiBao' => 'required',
			'TenBaiBao' => 'required|max:255',
			'TacGiaNhomTacGia' => 'required|max:255',
			'NoiDang' => 'required',
			'So' => 'required|max:50',
			'TuTrangDenTrang' => 'required|max:50',
			'NamXuatBan' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = new HRM_BaiBaoKhoaHoc();
		$orm->MaNhanVien = Auth::user()->id;
		$orm->LoaiBaiBao = $request->LoaiBaiBao;
		$orm->TenBaiBao = $request->TenBaiBao;
		$orm->TacGiaNhomTacGia = $request->TacGiaNhomTacGia;
		$orm->NoiDang = $request->NoiDang;
		$orm->So = $request->So;
		$orm->TuTrangDenTrang = $request->TuTrangDenTrang;
		$orm->NamXuatBan = $request->NamXuatBan;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->HienThiCongKhai)) $orm->HienThiCongKhai = $request->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.baibaokhoahoc');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'LoaiBaiBao_edit' => 'required',
			'TenBaiBao_edit' => 'required|max:255',
			'TacGiaNhomTacGia_edit' => 'required|max:255',
			'NoiDang_edit' => 'required',
			'So_edit' => 'required|max:50',
			'TuTrangDenTrang_edit' => 'required|max:50',
			'NamXuatBan_edit' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = HRM_BaiBaoKhoaHoc::find($request->ID_edit);
		$orm->LoaiBaiBao = $request->LoaiBaiBao_edit;
		$orm->TenBaiBao = $request->TenBaiBao_edit;
		$orm->TacGiaNhomTacGia = $request->TacGiaNhomTacGia_edit;
		$orm->NoiDang = $request->NoiDang_edit;
		$orm->So = $request->So_edit;
		$orm->TuTrangDenTrang = $request->TuTrangDenTrang_edit;
		$orm->NamXuatBan = $request->NamXuatBan_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->HienThiCongKhai = empty($request->HienThiCongKhai_edit) ? 0 : 1;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.baibaokhoahoc');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_BaiBaoKhoaHoc::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.hosonhanvien.baibaokhoahoc');
	}
	
	public function getKichHoat($id)
	{
		$orm = HRM_BaiBaoKhoaHoc::find($id);
		$orm->HienThiCongKhai = 1 - $orm->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.baibaokhoahoc');
	}
}