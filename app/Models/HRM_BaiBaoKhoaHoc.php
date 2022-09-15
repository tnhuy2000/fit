<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_BaiBaoKhoaHoc extends Model
{
	protected $table = 'hrm_baibaokhoahoc';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'TenBaiBao', 'TacGiaNhomTacGia', 'NoiDang', 'So', 'TuTrangDenTrang', 'NamXuatBan', 'LienKet',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
}