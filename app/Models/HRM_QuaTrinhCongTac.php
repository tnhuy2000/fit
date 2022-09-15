<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_QuaTrinhCongTac extends Model
{
	protected $table = 'hrm_quatrinhcongtac';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'ThoiGian', 'NoiDungCongViec',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
}