<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_LienKetNgoai extends Model
{
    protected $table = 'cms_lienketngoai';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'TenLienKet', 'LienKet', 'ThuTuHienThi', 'KichHoat',
	];
}