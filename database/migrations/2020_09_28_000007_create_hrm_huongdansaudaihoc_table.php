<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRMHuongDanSauDaiHocTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hrm_huongdansaudaihoc', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaNhanVien')->constrained()->on('hrm_nhanvien');
			$table->string('HoTenHocVien');
			$table->mediumText('TenDeTai');
			$table->string('TrinhDo', 50);
			$table->string('CoSoDaoTao');
			$table->year('NamHuongDan');
			$table->year('NamBaoVe')->nullable();
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
		Schema::dropIfExists('hrm_huongdansaudaihoc');
	}
}