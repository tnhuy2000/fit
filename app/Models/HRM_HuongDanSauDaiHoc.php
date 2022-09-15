<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_HuongDanSauDaiHoc extends Model
{
	protected $table = 'hrm_huongdansaudaihoc';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'HoTenHocVien', 'TenDeTai', 'TrinhDo', 'CoSoDaoTao', 'NamHuongDan', 'NamBaoVe',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
}