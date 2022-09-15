<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_BaiViet extends Model
{
	protected $table = 'cms_baiviet';
	protected $primaryKey = 'ID';
	
	protected $fillable = [
		'MaLoai', 'MaDonVi', 'MaChuDe', 'MaNguoiDung', 'TieuDe', 'TieuDeKhongDau', 'TomTat', 'NoiDung', 'LuotXem', 'QuanTrong', 'KichHoat',
	];
	
	public function CMS_LoaiBaiViet()
	{
		return $this->belongsTo('App\Models\CMS_LoaiBaiViet', 'MaLoai', 'ID');
	}
	
	public function CMS_ChuDe()
	{
		return $this->belongsTo('App\Models\CMS_ChuDe', 'MaChuDe', 'ID');
	}
	
	public function SYS_NguoiDung()
	{
		return $this->belongsTo('App\Models\SYS_NguoiDung', 'MaNguoiDung', 'ID');
	}
	
	public function CMS_VanBan()
	{
		return $this->hasMany('App\Models\CMS_VanBan', 'MaBaiViet', 'ID');
	}
}