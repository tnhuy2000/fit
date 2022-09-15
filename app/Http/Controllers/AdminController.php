<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getAdminHome()
	{
		return view('admin.index');
	}
	
	public function getDanhMucHome()
	{
		return view('admin.danhmuc.index');
	}
	
	public function getBaiVietHome()
	{
		return view('admin.baiviet.index');
	}
	
	public function getHinhAnhHome()
	{
		return view('admin.hinhanh.index');
	}
	
	public function getHoSoHome()
	{
		return view('admin.hosonhanvien.index');
	}
	
	public function getForbidden()
	{
		return view('errors.403');
	}
}