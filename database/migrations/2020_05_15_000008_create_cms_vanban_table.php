<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSVanBanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_vanban', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaBaiViet')->constrained()->on('cms_baiviet');
			$table->string('TenVanBan');
			$table->string('TenVanBanKhongDau');
			$table->string('DuongDan');
			$table->unsignedInteger('LuotDownload')->default(0);
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
		Schema::dropIfExists('cms_vanban');
	}
}