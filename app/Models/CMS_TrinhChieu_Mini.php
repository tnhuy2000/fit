<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_TrinhChieu_Mini extends Model
{
	protected $table = 'cms_trinhchieu_mini';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TieuDe', 'HinhAnh', 'LienKet', 'ThuTuHienThi', 'KichHoat',
	];
}