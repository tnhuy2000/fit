<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRMDeTaiKhoaHocTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hrm_detaikhoahoc', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaNhanVien')->constrained()->on('hrm_nhanvien');
			$table->string('CapQuanLy');
			$table->string('TenCongTrinh');
			$table->string('ChuNhiem');
			$table->string('ThanhVienThamGia')->nullable();
			$table->year('NamNghiemThu');
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
		Schema::dropIfExists('hrm_detaikhoahoc');
	}
}