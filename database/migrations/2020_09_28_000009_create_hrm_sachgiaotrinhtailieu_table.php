<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRMSachGiaoTrinhTaiLieuTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hrm_sachgiaotrinhtailieu', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaNhanVien')->constrained()->on('hrm_nhanvien');
			$table->string('Ten');
			$table->string('PhanLoai');
			$table->string('TacGiaNhomTacGia');
			$table->string('NhaXuatBan')->nullable();
			$table->year('NamXuatBan');
			$table->string('ISBN')->nullable();
			$table->string('LienKet')->nullable();
			$table->unsignedTinyInteger('HienThiCongKhai')->default(0);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('hrm_sachgiaotrinhtailieu');
	}
}