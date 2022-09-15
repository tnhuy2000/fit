<?php

use App\Models\SYS_NguoiDung;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSYSNguoiDungTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_nguoidung', function (Blueprint $table) {
			$table->id();
			$table->string('name', 100);
			$table->string('username', 100)->unique();
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->string('privilege', 25)->default('qlbaiviet');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
		
		SYS_NguoiDung::create([
			'name' => 'Administrator',
			'username' => 'admin',
			'email' => 'kcnttin.agu@gmail.com',
			'password' => '$2y$10$5FjsSCqTOE2lyb7wAWZsUuY6yL4w2yK8vyzqida48gazHabrSiHj.', // password
			'privilege' => 'superadmin',
		]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sys_nguoidung');
	}
}