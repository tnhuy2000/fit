<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_BangDienTu extends Model
{
	protected $table = 'cms_bangdientu';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'NoiDung', 'LienKet', 'ThuTuHienThi', 'KichHoat',
	];
}