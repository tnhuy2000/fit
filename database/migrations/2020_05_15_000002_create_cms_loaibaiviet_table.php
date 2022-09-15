<?php

use App\Models\CMS_LoaiBaiViet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSLoaiBaiVietTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_loaibaiviet', function (Blueprint $table) {
			$table->id('ID');
			$table->string('TenLoai')->unique();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
		
		CMS_LoaiBaiViet::create(['TenLoai' => 'Bài viết đơn']);
		CMS_LoaiBaiViet::create(['TenLoai' => 'Bài viết có đính kèm văn bản']);
		CMS_LoaiBaiViet::create(['TenLoai' => 'Bài viết giới thiệu có kèm danh sách nhân sự']);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cms_loaibaiviet');
	}
}