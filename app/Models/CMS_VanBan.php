<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_VanBan extends Model
{
	protected $table = 'cms_vanban';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaBaiViet', 'TenVanBan', 'TenVanBanKhongDau', 'DuongDan', 'LuotDownload', 'KichHoat',
	];
	
	public function CMS_BaiViet()
	{
		return $this->belongsTo('App\Models\CMS_BaiViet', 'MaBaiViet', 'ID');
	}
}