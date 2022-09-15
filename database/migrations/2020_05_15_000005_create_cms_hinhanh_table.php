<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSHinhAnhTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_hinhanh', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaChuDe')->constrained()->on('cms_chude');
			$table->foreignId('MaNguoiDung')->constrained()->on('sys_nguoidung');
			$table->text('MoTa');
			$table->text('MoTaKhongDau');
			$table->string('ThuMuc');
			$table->unsignedInteger('LuotXem')->default(0);
			$table->unsignedTinyInteger('KiemDuyet')->default(0);
			$table->unsignedTinyInteger('KichHoat')->default(1);
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
		Schema::dropIfExists('cms_hinhanh');
	}
}