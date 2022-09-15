<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HRM_SachGiaoTrinhTaiLieu extends Model
{
	protected $table = 'hrm_sachgiaotrinhtailieu';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaNhanVien', 'Ten', 'TacGiaNhomTacGia', 'NhaXuatBan', 'NamXuatBan', 'LienKet',
	];
	
	public function HRM_NhanVien()
	{
		return $this->belongsTo('App\Models\HRM_NhanVien', 'MaNhanVien', 'ID');
	}
}