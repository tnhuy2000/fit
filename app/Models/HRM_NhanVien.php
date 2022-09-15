<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_NhanVien extends Model
{
	protected $table = 'hrm_nhanvien';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaCanBo', 'HoVaTen', 'NamSinh', 'NgayVaoLam', 'ChuyenNganh', 'HocVi', 'NamNhanHocVi', 'HocHam', 'NamNhanHocHam', 'Email', 'DienThoai', 'TrangWeb', 'HinhAnh', 'ThongTinThem', 'LuotXem',
	];
	
	public function HRM_NhanVien_DonVi()
	{
		return $this->hasMany('App\Models\HRM_NhanVien_DonVi', 'MaNhanVien', 'ID');
	}
	
	public function HRM_BaiBaoKhoaHoc()
	{
		return $this->hasMany('App\Models\HRM_BaiBaoKhoaHoc', 'MaNhanVien', 'ID');
	}
	
	public function HRM_DeTaiKhoaHoc()
	{
		return $this->hasMany('App\Models\HRM_DeTaiKhoaHoc', 'MaNhanVien', 'ID');
	}
	
	public function HRM_HuongDanSauDaiHoc()
	{
		return $this->hasMany('App\Models\HRM_HuongDanSauDaiHoc', 'MaNhanVien', 'ID');
	}
	
	public function HRM_QuaTrinhCongTac()
	{
		return $this->hasMany('App\Models\HRM_QuaTrinhCongTac', 'MaNhanVien', 'ID');
	}
	
	public function HRM_SachGiaoTrinhTaiLieu()
	{
		return $this->hasMany('App\Models\HRM_SachGiaoTrinhTaiLieu', 'MaNhanVien', 'ID');
	}
}