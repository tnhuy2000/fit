<?php

use App\Models\CMS_ChuDe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSChuDeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_chude', function (Blueprint $table) {
			$table->id('ID');
			$table->string('TenChuDe')->unique();
			$table->string('TenChuDeKhongDau');
			$table->unsignedTinyInteger('ThuTuHienThi')->default(0);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
		
		CMS_ChuDe::create(['TenChuDe' => 'Giới thiệu', 'TenChuDeKhongDau' => 'gioi-thieu', 'ThuTuHienThi' => 0]);
		CMS_ChuDe::create(['TenChuDe' => 'Cảnh báo - Xóa tên', 'TenChuDeKhongDau' => 'canh-bao-xoa-ten', 'ThuTuHienThi' => 1]);
		CMS_ChuDe::create(['TenChuDe' => 'Dành cho Cán bộ - Giảng viên', 'TenChuDeKhongDau' => 'danh-cho-can-bo-giang-vien', 'ThuTuHienThi' => 2]);
		CMS_ChuDe::create(['TenChuDe' => 'Hoạt động Đoàn - Hội', 'TenChuDeKhongDau' => 'hoat-dong-doan-hoi', 'ThuTuHienThi' => 3]);
		CMS_ChuDe::create(['TenChuDe' => 'Học bổng - Trợ cấp', 'TenChuDeKhongDau' => 'hoc-bong-tro-cap', 'ThuTuHienThi' => 4]);
		CMS_ChuDe::create(['TenChuDe' => 'Thông tin nội bộ', 'TenChuDeKhongDau' => 'thong-tin-noi-bo', 'ThuTuHienThi' => 5]);
		CMS_ChuDe::create(['TenChuDe' => 'Thực tập - Khóa luận', 'TenChuDeKhongDau' => 'thuc-tap-khoa-luan', 'ThuTuHienThi' => 6]);
		CMS_ChuDe::create(['TenChuDe' => 'Tin giáo vụ khoa', 'TenChuDeKhongDau' => 'tin-giao-vu-khoa', 'ThuTuHienThi' => 7]);
		CMS_ChuDe::create(['TenChuDe' => 'Văn bản - Biểu mẫu', 'TenChuDeKhongDau' => 'van-ban-bieu-mau', 'ThuTuHienThi' => 8]);
		CMS_ChuDe::create(['TenChuDe' => 'Việc làm - Tuyển dụng', 'TenChuDeKhongDau' => 'viec-lam-tuyen-dung', 'ThuTuHienThi' => 9]);
		CMS_ChuDe::create(['TenChuDe' => 'Tin khác - Chưa phân loại', 'TenChuDeKhongDau' => 'tin-khac-chua-phan-loai', 'ThuTuHienThi' => 10]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cms_chude');
	}
}