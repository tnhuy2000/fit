<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSTrinhChieuTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_trinhchieu', function (Blueprint $table) {
			$table->id('ID');
			$table->string('TieuDe')->nullable();
			$table->string('TieuDeNho')->nullable();
			$table->string('HinhAnh');
			$table->string('TenLienKet1')->nullable();
			$table->string('LienKet1')->nullable();
			$table->string('TenLienKet2')->nullable();
			$table->string('LienKet2')->nullable();
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
		Schema::dropIfExists('cms_trinhchieu');
	}
}