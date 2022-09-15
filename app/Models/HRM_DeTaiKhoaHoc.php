<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_DeTaiKhoaHoc extends Model
{
	protected $table = 'hrm_detaikhoahoc';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'TenCongTrinh', 'ChuNhiem', 'ThanhVienThamGia', 'NamNghiemThu', 'LienKet',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
}