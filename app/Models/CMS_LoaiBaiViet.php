<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_LoaiBaiViet extends Model
{
	protected $table = 'cms_loaibaiviet';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenLoai',
	];
	
	public function CMS_BaiViet()
	{
		return $this->hasMany('App\Models\CMS_BaiViet', 'MaLoai', 'ID');
	}
}