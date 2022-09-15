<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_ChuDe extends Model
{
	protected $table = 'cms_chude';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenChuDe', 'TenChuDeKhongDau', 'ThuTuHienThi',
	];
	
	public function CMS_BaiViet()
	{
		return $this->hasMany('App\Models\CMS_BaiViet', 'MaChuDe', 'ID');
	}
	
	public function CMS_HinhAnh()
	{
		return $this->hasMany('App\Models\CMS_HinhAnh', 'MaChuDe', 'ID');
	}
}