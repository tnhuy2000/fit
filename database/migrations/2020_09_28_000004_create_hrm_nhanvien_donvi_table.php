<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRMNhanVienDonViTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hrm_nhanvien_donvi', function (Blueprint $table) {
			$table->id('ID');
			$table->foreignId('MaNhanVien')->constrained()->on('hrm_nhanvien');
			$table->foreignId('MaDonVi')->constrained()->on('hrm_donvi');
			$table->foreignId('MaChucVu')->constrained()->on('hrm_chucvu');
			$table->unsignedTinyInteger('ThuTuHienThi')->default(0);
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
		Schema::dropIfExists('hrm_nhanvien_donvi');
	}
}