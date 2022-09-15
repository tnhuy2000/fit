<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Portal
Route::get('/', 'App\Http\Controllers\HomeController@getHome')->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@getHome')->name('home');

Route::get('/vi', 'App\Http\Controllers\HomeController@getVI')->name('language.vi');
Route::get('/en', 'App\Http\Controllers\HomeController@getEN')->name('language.en');
Route::get('/rss', 'App\Http\Controllers\HomeController@getRSS')->name('rss');

// Link cứng (Minh chứng AUN)
Route::get('/DaiHocCongNgheThongTin', 'App\Http\Controllers\HomeController@getBaiVietCNTT')->name('baiviet.cntt');
Route::get('/DaiHocKyThuatPhanMem', 'App\Http\Controllers\HomeController@getBaiVietKTPM')->name('baiviet.ktpm');

Route::get('/bai-viet', 'App\Http\Controllers\HomeController@getBaiViet')->name('baiviet');
Route::get('/bai-viet/{chuDe}', 'App\Http\Controllers\HomeController@getBaiViet')->name('baiviet.chude');
Route::get('/bai-viet/{chuDe}/{titleWithID}', 'App\Http\Controllers\HomeController@getBaiViet_ChiTiet')->name('baiviet.chitiet');

Route::get('/hinh-anh', 'App\Http\Controllers\HomeController@getHinhAnh')->name('hinhanh');
Route::get('/hinh-anh/{chuDe}', 'App\Http\Controllers\HomeController@getHinhAnh')->name('hinhanh.chude');
Route::get('/hinh-anh/{chuDe}/{titleWithID}', 'App\Http\Controllers\HomeController@getHinhAnh_ChiTiet')->name('hinhanh.chitiet');

Route::get('/lien-he', 'App\Http\Controllers\HomeController@getLienHe')->name('lienhe');
Route::get('/so-do-to-chuc', 'App\Http\Controllers\HomeController@getSoDoToChuc')->name('sodotochuc');

// Link cũ
Route::get('/baiviet/{id}/{title}', 'App\Http\Controllers\HomeController@getBaiViet_ChiTiet_OldLink');
Route::get('/hinhanh/{id}/{title}', 'App\Http\Controllers\HomeController@getHinhAnh_ChiTiet_OldLink');
Route::get('/staff/{username}', 'App\Http\Controllers\HomeController@getNhanVien_ChiTiet_OldLink');

// Tải file
Route::post('/van-ban/tai-ve', 'App\Http\Controllers\HomeController@postVanBanTaiVe')->name('vanban.taive');

// Nghiên cứu khoa học
Route::get('/nghien-cuu-khoa-hoc', 'App\Http\Controllers\HomeController@getNghienCuuKhoaHoc')->name('nghiencuukhoahoc');

// Authentication
Auth::routes(['register' => false]);
Route::get('/login/google', 'App\Http\Controllers\HomeController@getGoogleLogin')->name('google.login');
Route::get('/login/google/callback', 'App\Http\Controllers\HomeController@getGoogleCallback')->name('google.callback');

// Nhân sự
Route::get('/nhan-su', 'App\Http\Controllers\HomeController@getNhanVien')->name('nhansu');
Route::get('/{hoVaTenSlug}', 'App\Http\Controllers\HomeController@getNhanVien_ChiTiet')->name('nhansu.chitiet');

// Quản trị
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
	Route::get('/home', 'App\Http\Controllers\AdminController@getAdminHome')->name('home');
	Route::get('/403', 'App\Http\Controllers\AdminController@getForbidden')->name('forbidden');
	
	Route::prefix('danhmuc')->name('danhmuc.')->middleware('qldanhmuc')->group(function() {
		Route::get('', 'App\Http\Controllers\AdminController@getDanhMucHome')->name('home');
		
		Route::get('/bangdientu', 'App\Http\Controllers\CMSBangDienTuController@getDanhSach')->name('bangdientu');
		Route::post('/bangdientu/them', 'App\Http\Controllers\CMSBangDienTuController@postThem')->name('bangdientu.them');
		Route::post('/bangdientu/sua', 'App\Http\Controllers\CMSBangDienTuController@postSua')->name('bangdientu.sua');
		Route::post('/bangdientu/xoa', 'App\Http\Controllers\CMSBangDienTuController@postXoa')->name('bangdientu.xoa');
		Route::get('/bangdientu/kichhoat/{id}', 'App\Http\Controllers\CMSBangDienTuController@getKichHoat')->name('bangdientu.kichhoat');
		
		Route::get('/chude', 'App\Http\Controllers\CMSChuDeController@getDanhSach')->name('chude');
		Route::post('/chude/them', 'App\Http\Controllers\CMSChuDeController@postThem')->name('chude.them');
		Route::post('/chude/sua', 'App\Http\Controllers\CMSChuDeController@postSua')->name('chude.sua');
		Route::post('/chude/xoa', 'App\Http\Controllers\CMSChuDeController@postXoa')->name('chude.xoa');
		
		Route::get('/loaibaiviet', 'App\Http\Controllers\CMSLoaiBaiVietController@getDanhSach')->name('loaibaiviet');
		Route::post('/loaibaiviet/them', 'App\Http\Controllers\CMSLoaiBaiVietController@postThem')->name('loaibaiviet.them');
		Route::post('/loaibaiviet/sua', 'App\Http\Controllers\CMSLoaiBaiVietController@postSua')->name('loaibaiviet.sua');
		Route::post('/loaibaiviet/xoa', 'App\Http\Controllers\CMSLoaiBaiVietController@postXoa')->name('loaibaiviet.xoa');
		
		Route::get('/slide', 'App\Http\Controllers\CMSTrinhChieuMiniController@getDanhSach')->name('slide');
		Route::post('/slide/them', 'App\Http\Controllers\CMSTrinhChieuMiniController@postThem')->name('slide.them');
		Route::post('/slide/sua', 'App\Http\Controllers\CMSTrinhChieuMiniController@postSua')->name('slide.sua');
		Route::post('/slide/xoa', 'App\Http\Controllers\CMSTrinhChieuMiniController@postXoa')->name('slide.xoa');
		Route::get('/slide/kichhoat/{id}', 'App\Http\Controllers\CMSTrinhChieuMiniController@getKichHoat')->name('slide.kichhoat');
		
		Route::get('/mainslide', 'App\Http\Controllers\CMSTrinhChieuController@getDanhSach')->name('mainslide');
		Route::post('/mainslide/them', 'App\Http\Controllers\CMSTrinhChieuController@postThem')->name('mainslide.them');
		Route::post('/mainslide/sua', 'App\Http\Controllers\CMSTrinhChieuController@postSua')->name('mainslide.sua');
		Route::post('/mainslide/xoa', 'App\Http\Controllers\CMSTrinhChieuController@postXoa')->name('mainslide.xoa');
		Route::get('/mainslide/kichhoat/{id}', 'App\Http\Controllers\CMSTrinhChieuController@getKichHoat')->name('mainslide.kichhoat');
		
		Route::get('/lienketngoai', 'App\Http\Controllers\CMSLienKetNgoaiController@getDanhSach')->name('lienketngoai');
		Route::post('/lienketngoai/them', 'App\Http\Controllers\CMSLienKetNgoaiController@postThem')->name('lienketngoai.them');
		Route::post('/lienketngoai/sua', 'App\Http\Controllers\CMSLienKetNgoaiController@postSua')->name('lienketngoai.sua');
		Route::post('/lienketngoai/xoa', 'App\Http\Controllers\CMSLienKetNgoaiController@postXoa')->name('lienketngoai.xoa');
		Route::get('/lienketngoai/kichhoat/{id}', 'App\Http\Controllers\CMSLienKetNgoaiController@getKichHoat')->name('lienketngoai.kichhoat');
		
		Route::get('/chucvu', 'App\Http\Controllers\HRMChucVuController@getDanhSach')->name('chucvu');
		Route::post('/chucvu/them', 'App\Http\Controllers\HRMChucVuController@postThem')->name('chucvu.them');
		Route::post('/chucvu/sua', 'App\Http\Controllers\HRMChucVuController@postSua')->name('chucvu.sua');
		Route::post('/chucvu/xoa', 'App\Http\Controllers\HRMChucVuController@postXoa')->name('chucvu.xoa');
		
		Route::get('/donvi', 'App\Http\Controllers\HRMDonViController@getDanhSach')->name('donvi');
		Route::post('/donvi/them', 'App\Http\Controllers\HRMDonViController@postThem')->name('donvi.them');
		Route::post('/donvi/sua', 'App\Http\Controllers\HRMDonViController@postSua')->name('donvi.sua');
		Route::post('/donvi/xoa', 'App\Http\Controllers\HRMDonViController@postXoa')->name('donvi.xoa');
		
		Route::get('/nhanvien', 'App\Http\Controllers\HRMNhanVienController@getDanhSach')->name('nhanvien');
		Route::post('/nhanvien/them', 'App\Http\Controllers\HRMNhanVienController@postThem')->name('nhanvien.them');
		Route::post('/nhanvien/sua', 'App\Http\Controllers\HRMNhanVienController@postSua')->name('nhanvien.sua');
		Route::post('/nhanvien/xoa', 'App\Http\Controllers\HRMNhanVienController@postXoa')->name('nhanvien.xoa');
		Route::get('/nhanvien/trangthai/{id}', 'App\Http\Controllers\HRMNhanVienController@getKichHoat')->name('nhanvien.trangthai');
		
		Route::get('/nhanvien/donvi', 'App\Http\Controllers\HRMNhanVienDonViController@getDanhSach')->name('nhanvien.donvi');
		Route::post('/nhanvien/donvi/them', 'App\Http\Controllers\HRMNhanVienDonViController@postThem')->name('nhanvien.donvi.them');
		Route::post('/nhanvien/donvi/sua', 'App\Http\Controllers\HRMNhanVienDonViController@postSua')->name('nhanvien.donvi.sua');
		Route::post('/nhanvien/donvi/xoa', 'App\Http\Controllers\HRMNhanVienDonViController@postXoa')->name('nhanvien.donvi.xoa');
		
		Route::get('/nguoidung', 'App\Http\Controllers\SYSNguoiDungController@getDanhSach')->name('nguoidung');
		Route::post('/nguoidung/them', 'App\Http\Controllers\SYSNguoiDungController@postThem')->name('nguoidung.them');
		Route::post('/nguoidung/sua', 'App\Http\Controllers\SYSNguoiDungController@postSua')->name('nguoidung.sua');
		Route::post('/nguoidung/xoa', 'App\Http\Controllers\SYSNguoiDungController@postXoa')->name('nguoidung.xoa');
	});
	
	Route::prefix('baiviet')->name('baiviet.')->middleware('qlbaiviet')->group(function() {
		Route::get('', 'App\Http\Controllers\AdminController@getBaiVietHome')->name('home');
		
		Route::get('/danhsach', 'App\Http\Controllers\CMSBaiVietController@getDanhSach')->name('danhsach');
		Route::get('/them', 'App\Http\Controllers\CMSBaiVietController@getThem')->name('them');
		Route::post('/them', 'App\Http\Controllers\CMSBaiVietController@postThem');
		Route::get('/sua/{id}', 'App\Http\Controllers\CMSBaiVietController@getSua')->name('sua');
		Route::post('/sua/{id}', 'App\Http\Controllers\CMSBaiVietController@postSua')->name('sua');
		Route::post('/xoa', 'App\Http\Controllers\CMSBaiVietController@postXoa')->name('xoa');
		Route::get('/quantrong/{id}', 'App\Http\Controllers\CMSBaiVietController@getQuanTrong')->name('quantrong');
		Route::get('/kichhoat/{id}', 'App\Http\Controllers\CMSBaiVietController@getKichHoat')->name('kichhoat');
		
		Route::get('/suanhanh', 'App\Http\Controllers\CMSBaiVietController@getSuaNhanh')->name('suanhanh');
		Route::post('/suanhanh', 'App\Http\Controllers\CMSBaiVietController@postSuaNhanh')->name('suanhanh');
		
		Route::get('/vanban/{id}', 'App\Http\Controllers\CMSVanBanController@getDanhSach')->name('vanban');
		Route::post('/vanban/them', 'App\Http\Controllers\CMSVanBanController@postThem')->name('vanban.them');
		Route::post('/vanban/sua', 'App\Http\Controllers\CMSVanBanController@postSua')->name('vanban.sua');
		Route::post('/vanban/xoa', 'App\Http\Controllers\CMSVanBanController@postXoa')->name('vanban.xoa');
		Route::get('/vanban/{idBaiViet}/kichhoat/{id}', 'App\Http\Controllers\CMSVanBanController@getKichHoat')->name('vanban.kichhoat');
		Route::post('/vanban/ajax', 'App\Http\Controllers\CMSVanBanController@postVanBanAjax')->name('vanban.ajax');
		
		Route::get('/suavanban', 'App\Http\Controllers\CMSVanBanController@getSuaNhanh')->name('vanban.suanhanh');
		Route::post('/suavanban', 'App\Http\Controllers\CMSVanBanController@postSuaNhanh')->name('vanban.suanhanh');
	});
	
	Route::prefix('hinhanh')->name('hinhanh.')->middleware('qlbaiviet')->group(function() {
		Route::get('', 'App\Http\Controllers\AdminController@getHinhAnhHome')->name('home');
		
		Route::get('/danhsach', 'App\Http\Controllers\CMSHinhAnhController@getDanhSach')->name('danhsach');
		Route::get('/them', 'App\Http\Controllers\CMSHinhAnhController@getThem')->name('them');
		Route::post('/them', 'App\Http\Controllers\CMSHinhAnhController@postThem');
		Route::get('/sua/{id}', 'App\Http\Controllers\CMSHinhAnhController@getSua')->name('sua');
		Route::post('/sua/{id}', 'App\Http\Controllers\CMSHinhAnhController@postSua');
		Route::post('/xoa', 'App\Http\Controllers\CMSHinhAnhController@postXoa')->name('xoa');
		Route::get('/kichhoat/{id}', 'App\Http\Controllers\CMSHinhAnhController@getKichHoat')->name('kichhoat');
		Route::post('/ajax', 'App\Http\Controllers\CMSHinhAnhController@postHinhAnhAjax')->name('ajax');
		
		Route::get('/suanhanh', 'App\Http\Controllers\CMSHinhAnhController@getSuaNhanh')->name('suanhanh');
		Route::post('/suanhanh', 'App\Http\Controllers\CMSHinhAnhController@postSuaNhanh')->name('suanhanh');
	});
	
	Route::prefix('hosonhanvien')->name('hosonhanvien.')->group(function() {
		Route::get('', 'App\Http\Controllers\AdminController@getHoSoHome')->name('home');
		
		Route::get('/coban', 'App\Http\Controllers\HRMNhanVienController@getCoBan')->name('coban');
		Route::post('/coban/sua', 'App\Http\Controllers\HRMNhanVienController@postCoBan_Sua')->name('coban.sua');
		
		Route::get('/baibaokhoahoc', 'App\Http\Controllers\HRMBaiBaoKhoaHocController@getDanhSach')->name('baibaokhoahoc');
		Route::post('/baibaokhoahoc/them', 'App\Http\Controllers\HRMBaiBaoKhoaHocController@postThem')->name('baibaokhoahoc.them');
		Route::post('/baibaokhoahoc/sua', 'App\Http\Controllers\HRMBaiBaoKhoaHocController@postSua')->name('baibaokhoahoc.sua');
		Route::post('/baibaokhoahoc/xoa', 'App\Http\Controllers\HRMBaiBaoKhoaHocController@postXoa')->name('baibaokhoahoc.xoa');
		Route::get('/baibaokhoahoc/congbo/{id}', 'App\Http\Controllers\HRMBaiBaoKhoaHocController@getKichHoat')->name('baibaokhoahoc.congbo');
		
		Route::get('/detaikhoahoc', 'App\Http\Controllers\HRMDeTaiKhoaHocController@getDanhSach')->name('detaikhoahoc');
		Route::post('/detaikhoahoc/them', 'App\Http\Controllers\HRMDeTaiKhoaHocController@postThem')->name('detaikhoahoc.them');
		Route::post('/detaikhoahoc/sua', 'App\Http\Controllers\HRMDeTaiKhoaHocController@postSua')->name('detaikhoahoc.sua');
		Route::post('/detaikhoahoc/xoa', 'App\Http\Controllers\HRMDeTaiKhoaHocController@postXoa')->name('detaikhoahoc.xoa');
		Route::get('/detaikhoahoc/congbo/{id}', 'App\Http\Controllers\HRMDeTaiKhoaHocController@getKichHoat')->name('detaikhoahoc.congbo');
		
		Route::get('/huongdansaudaihoc', 'App\Http\Controllers\HRMHuongDanSauDaiHocController@getDanhSach')->name('huongdansaudaihoc');
		Route::post('/huongdansaudaihoc/them', 'App\Http\Controllers\HRMHuongDanSauDaiHocController@postThem')->name('huongdansaudaihoc.them');
		Route::post('/huongdansaudaihoc/sua', 'App\Http\Controllers\HRMHuongDanSauDaiHocController@postSua')->name('huongdansaudaihoc.sua');
		Route::post('/huongdansaudaihoc/xoa', 'App\Http\Controllers\HRMHuongDanSauDaiHocController@postXoa')->name('huongdansaudaihoc.xoa');
		
		Route::get('/quatrinhcongtac', 'App\Http\Controllers\HRMQuaTrinhCongTacController@getDanhSach')->name('quatrinhcongtac');
		Route::post('/quatrinhcongtac/them', 'App\Http\Controllers\HRMQuaTrinhCongTacController@postThem')->name('quatrinhcongtac.them');
		Route::post('/quatrinhcongtac/sua', 'App\Http\Controllers\HRMQuaTrinhCongTacController@postSua')->name('quatrinhcongtac.sua');
		Route::post('/quatrinhcongtac/xoa', 'App\Http\Controllers\HRMQuaTrinhCongTacController@postXoa')->name('quatrinhcongtac.xoa');
		
		Route::get('/sachgiaotrinhtailieu', 'App\Http\Controllers\HRMSachGiaoTrinhTaiLieuController@getDanhSach')->name('sachgiaotrinhtailieu');
		Route::post('/sachgiaotrinhtailieu/them', 'App\Http\Controllers\HRMSachGiaoTrinhTaiLieuController@postThem')->name('sachgiaotrinhtailieu.them');
		Route::post('/sachgiaotrinhtailieu/sua', 'App\Http\Controllers\HRMSachGiaoTrinhTaiLieuController@postSua')->name('sachgiaotrinhtailieu.sua');
		Route::post('/sachgiaotrinhtailieu/xoa', 'App\Http\Controllers\HRMSachGiaoTrinhTaiLieuController@postXoa')->name('sachgiaotrinhtailieu.xoa');
		Route::get('/sachgiaotrinhtailieu/congbo/{id}', 'App\Http\Controllers\HRMSachGiaoTrinhTaiLieuController@getKichHoat')->name('sachgiaotrinhtailieu.congbo');
		
		Route::get('/doimatkhau', 'App\Http\Controllers\SYSNguoiDungController@getDoiMatKhau')->name('doimatkhau');
		Route::post('/doimatkhau', 'App\Http\Controllers\SYSNguoiDungController@postDoiMatKhau')->name('doimatkhau');
	});
});

// Cấu hình
Route::prefix('app')->middleware('auth')->group(function() {
	Route::get('/v', function() {
		$laravel = app();
		return redirect()->route('admin.home')->with('status', 'Version: Laravel ' . $laravel::VERSION);
	})->name('app.version');
	
	Route::get('/key', function() {
		Artisan::call('key:generate');
		return redirect()->route('admin.home')->with('status', 'Key is generated.');
	})->name('app.key');
	
	Route::get('/down', function() {
		Artisan::call('down');
		return redirect()->route('admin.home')->with('status', 'Application is now in maintenance mode.');
	})->name('app.down');
	
	Route::get('/up', function() {
		Artisan::call('up');
		return redirect()->route('admin.home')->with('status', 'Application is now live.');
	})->name('app.up');
	
	Route::get('/clear/cache', function() {
		Artisan::call('cache:clear');
		return redirect()->route('admin.home')->with('status', 'Application cache is cleared.');
	})->name('app.clear.cache');
	
	Route::get('/clear/config', function() {
		Artisan::call('config:clear');
		return redirect()->route('admin.home')->with('status', 'Configuration cache is cleared.');
	})->name('app.clear.config');
	
	Route::get('/clear/route', function() {
		Artisan::call('route:clear');
		return redirect()->route('admin.home')->with('status', 'Route cache is cleared.');
	})->name('app.clear.route');
	
	Route::get('/clear/view', function() {
		Artisan::call('view:clear');
		return redirect()->route('admin.home')->with('status', 'Compiled views cache are cleared.');
	})->name('app.clear.view');
});