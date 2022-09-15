<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSTrinhChieuMiniTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_trinhchieu_mini', function (Blueprint $table) {
			$table->id('ID');
			$table->string('TieuDe')->nullable();
			$table->string('HinhAnh');
			$table->string('LienKet')->nullable();
			$table->unsignedTinyInteger('ThuTuHienThi')->default(0);
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
		Schema::dropIfExists('cms_trinhchieu_mini');
	}
}