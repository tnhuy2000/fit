<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_NhanVien_DonVi extends Model
{
	protected $table = 'hrm_nhanvien_donvi';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'MaDonVi', 'MaChucVu', 'ThuTuHienThi',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
	
	public function HRM_DonVi()
	{
		return $this->belongsTo('App\Models\HRM_DonVi', 'MaDonVi', 'ID');
	}
	
	public function HRM_ChucVu()
	{
		return $this->belongsTo('App\Models\HRM_ChucVu', 'MaChucVu', 'ID');
	}
}