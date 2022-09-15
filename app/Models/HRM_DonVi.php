<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_DonVi extends Model
{
	protected $table = 'hrm_donvi';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenDonVi',
	];
	
	public function HRM_NhanVien_DonVi()
	{
		return $this->hasMany('App\Models\HRM_NhanVien_DonVi', 'MaDonVi', 'ID');
	}
}