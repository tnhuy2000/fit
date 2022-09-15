<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRMNhanVienTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hrm_nhanvien', function (Blueprint $table) {
			$table->id('ID');
			$table->string('MaCanBo', 20)->nullable();
			$table->string('HoVaTen', 100);
			$table->string('HoVaTenKhongDau', 100);
			$table->year('NamSinh')->nullable();
			$table->date('NgayVaoLam')->nullable();
			$table->string('ChuyenNganh')->nullable();
			$table->string('HocVi', 50)->nullable();
			$table->year('NamNhanHocVi')->nullable();
			$table->string('HocHam', 50)->nullable();
			$table->year('NamNhanHocHam')->nullable();
			$table->string('Email');
			$table->string('DienThoai', 50)->nullable();
			$table->string('TrangWeb')->nullable();
			$table->string('HinhAnh')->nullable();
			$table->text('ThongTinThem')->nullable();
			$table->unsignedInteger('LuotXem')->default(0);
			$table->unsignedTinyInteger('TrangThai')->default(1);
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
		Schema::dropIfExists('hrm_nhanvien');
	}
}