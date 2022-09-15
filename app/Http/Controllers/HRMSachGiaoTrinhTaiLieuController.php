<?php

namespace App\Http\Controllers;

use App\Models\HRM_SachGiaoTrinhTaiLieu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HRMSachGiaoTrinhTaiLieuController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hrm_sachgiaotrinhtailieu = HRM_SachGiaoTrinhTaiLieu::where('MaNhanVien', Auth::user()->id)
			->orderBy('NamXuatBan', 'desc')->get();
		return view('admin.hosonhanvien.sachgiaotrinhtailieu', compact('hrm_sachgiaotrinhtailieu'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'Ten' => 'required|max:255',
			'PhanLoai' => 'required',
			'TacGiaNhomTacGia' => 'required|max:255',
			'NamXuatBan' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = new HRM_SachGiaoTrinhTaiLieu();
		$orm->MaNhanVien = Auth::user()->id;
		$orm->Ten = $request->Ten;
		$orm->PhanLoai = $request->PhanLoai;
		$orm->TacGiaNhomTacGia = $request->TacGiaNhomTacGia;
		$orm->NhaXuatBan = $request->NhaXuatBan;
		$orm->NamXuatBan = $request->NamXuatBan;
		$orm->ISBN = $request->ISBN;
		$orm->LienKet = $request->LienKet;
		if(!empty($request->HienThiCongKhai)) $orm->HienThiCongKhai = $request->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.sachgiaotrinhtailieu');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'Ten_edit' => 'required|max:255',
			'PhanLoai_edit' => 'required',
			'TacGiaNhomTacGia_edit' => 'required|max:255',
			'NamXuatBan_edit' => 'required|numeric|min:1990|max:2050'
		]);
		
		$orm = HRM_SachGiaoTrinhTaiLieu::find($request->ID_edit);
		$orm->Ten = $request->Ten_edit;
		$orm->PhanLoai = $request->PhanLoai_edit;
		$orm->TacGiaNhomTacGia = $request->TacGiaNhomTacGia_edit;
		$orm->NhaXuatBan = $request->NhaXuatBan_edit;
		$orm->NamXuatBan = $request->NamXuatBan_edit;
		$orm->ISBN = $request->ISBN_edit;
		$orm->LienKet = $request->LienKet_edit;
		$orm->HienThiCongKhai = empty($request->HienThiCongKhai_edit) ? 0 : 1;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.sachgiaotrinhtailieu');
	}
	
	public function postXoa(Request $request)
	{
		$orm = HRM_SachGiaoTrinhTaiLieu::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('admin.hosonhanvien.sachgiaotrinhtailieu');
	}
	
	public function getKichHoat($id)
	{
		$orm = HRM_SachGiaoTrinhTaiLieu::find($id);
		$orm->HienThiCongKhai = 1 - $orm->HienThiCongKhai;
		$orm->save();
		
		return redirect()->route('admin.hosonhanvien.sachgiaotrinhtailieu');
	}
}