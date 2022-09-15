<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_HinhAnh extends Model
{
	protected $table = 'cms_hinhanh';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaChuDe', 'MaNguoiDung', 'MoTa', 'MoTaKhongDau', 'ThuMuc', 'LuotXem', 'KichHoat',
	];
	
	public function CMS_ChuDe()
	{
		return $this->belongsTo('App\Models\CMS_ChuDe', 'MaChuDe', 'ID');
	}
	
	public function SYS_NguoiDung()
	{
		return $this->belongsTo('App\Models\SYS_NguoiDung', 'MaNguoiDung', 'ID');
	}
}