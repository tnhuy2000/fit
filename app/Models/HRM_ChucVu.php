<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_ChucVu extends Model
{
	protected $table = 'hrm_chucvu';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenChucVu',
	];
	
	public function HRM_NhanVien_DonVi()
	{
		return $this->hasMany('App\Models\HRM_NhanVien_DonVi', 'MaChucVu', 'ID');
	}
}