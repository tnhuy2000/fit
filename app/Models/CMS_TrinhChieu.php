<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_TrinhChieu extends Model
{
	protected $table = 'cms_trinhchieu';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TieuDe', 'TieuDeNho', 'HinhAnh', 'TenLienKet1', 'LienKet1', 'TenLienKet2', 'LienKet2', 'ThuTuHienThi', 'KichHoat',
	];
}