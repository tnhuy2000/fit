<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Storage;
use App\Models\CMS_ChuDe;
use App\Models\CMS_BaiViet;
use App\Models\CMS_HinhAnh;
use App\Models\CMS_VanBan;
use App\Models\CMS_TrinhChieu;
use App\Models\CMS_TrinhChieu_Mini;
use App\Models\CMS_BangDienTu;
use App\Models\SYS_NguoiDung;
use App\Models\HRM_NhanVien;
use App\Models\HRM_DonVi;
use App\Models\HRM_NhanVien_DonVi;
use App\Models\HRM_QuaTrinhCongTac;
use App\Models\HRM_BaiBaoKhoaHoc;
use App\Models\HRM_DeTaiKhoaHoc;
use App\Models\HRM_SachGiaoTrinhTaiLieu;
use App\Models\HRM_HuongDanSauDaiHoc;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function getHome()
	{
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		$slider_path = config('app.url') . '/storage/app/slider/';
		$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
		
		// Slider
		$cms_trinhchieu_mini = CMS_TrinhChieu_Mini::where('KichHoat', 1)
			->orderBy('ThuTuHienThi', 'asc')->get();
		
		$cms_trinhchieu = CMS_TrinhChieu::where('KichHoat', 1)
			->orderBy('ThuTuHienThi', 'asc')->get();
		
		// Tin nóng
		$cms_bangdientu = CMS_BangDienTu::where('KichHoat', 1)
			->orderBy('ThuTuHienThi', 'asc')
			->orderBy('created_at', 'desc')->get();
		
		// Tin hoạt động
		$cms_baiviet = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', '>', 1]])
			->orderBy('created_at', 'desc')
			->take(12)->get();
		
		$cms_baiviet_first_file = array();
		foreach($cms_baiviet as $value)
		{
			$cms_baiviet_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_dir))
			{
				$cms_baiviet_files = scandir($cms_baiviet_dir);
				if(isset($cms_baiviet_files[3]))
				{
					$extension2 = strtolower(pathinfo($cms_baiviet_files[3], PATHINFO_EXTENSION));
					if(in_array($extension2, $extensions))
						$cms_baiviet_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_dir . $cms_baiviet_files[3];
					else
						$cms_baiviet_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_first_file[$value->ID] = $no_image;
		}
		
		// Hình ảnh hoạt động
		$cms_hinhanh = CMS_HinhAnh::where('KichHoat', 1)
			->orderBy('created_at', 'desc')
			->take(12)->get();
		
		$cms_hinhanh_chude = CMS_HinhAnh::join('cms_chude', 'cms_hinhanh.MaChuDe', '=', 'cms_chude.ID')
			->select('MaChuDe', 'TenChuDe', 'TenChuDeKhongDau')
			->orderBy('TenChuDe', 'asc')
			->distinct()->get();
		
		$hinhanhhoatdong = array();
		foreach($cms_hinhanh as $value)
		{
			$dir = 'storage/app/' . $value->ThuMuc . '/';
			if(file_exists($dir))
			{
				$files = scandir($dir);
				if(isset($files[3]))
				{
					$extension2 = strtolower(pathinfo($files[3], PATHINFO_EXTENSION));
					if(in_array($extension2, $extensions))
						$first_file = config('app.url') . '/'. $dir . $files[3];
					else
						$first_file = $no_image;
				}
				else
					$first_file = $no_image;
			}
			else
				$first_file = $no_image;
			
			$hinhanhhoatdong[] = array(
				'ID' => $value->ID,
				'MoTa' => $value->MoTa,
				'MoTaKhongDau' => $value->MoTaKhongDau,
				'HinhDaiDien' => $first_file,
				'TenChuDe' => $value->CMS_ChuDe->TenChuDe,
				'TenChuDeKhongDau' => $value->CMS_ChuDe->TenChuDeKhongDau
			);
		}
		
		return view('frontend.index', compact('slider_path', 'cms_trinhchieu_mini', 'cms_trinhchieu', 'cms_bangdientu', 'cms_baiviet', 'cms_baiviet_first_file', 'hinhanhhoatdong', 'cms_hinhanh_chude'));
	}
	
	public function getEN()
	{
		session()->put('enLanguage', true);
		return redirect()->route('home');
	}
	
	public function getVI()
	{
		session()->forget('enLanguage');
		return redirect()->route('home');
	}
	
	public function getRSS()
	{
		$cms_baiviet = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', '>', 1]])
			->orderBy('created_at', 'desc')
			->take(10)->get();
		
		$data = [
			'version' => 'https://jsonfeed.org/version/1.1',
			'title' => 'Bài viết của Khoa Công nghệ thông tin - ĐHAG',
			'home_page_url' => 'https://fit.agu.edu.vn',
			'feed_url' => 'https://fit.agu.edu.vn/rss',
			'favicon' => 'https://fit.agu.edu.vn/public/favicon.ico',
			'language' => 'vi_VN',
			'items' => []
		];
		
		foreach($cms_baiviet as $key => $post)
		{
			$data['items'][$key] = [
				'id' => $post->ID,
				'title' => $post->TieuDe,
				'tag' => $post->CMS_ChuDe->TenChuDe,
				'url' => route('baiviet.chitiet', ['chuDe' => $post->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $post->TieuDeKhongDau . '-' . $post->ID . '.html']),
				'summary' => $post->TomTat,
				'content_html' => $post->NoiDung,
				'author' => $post->SYS_NguoiDung->name,				
				'date_published' => $post->created_at,
				'date_modified' => $post->updated_at
			];
		}
		
		return $data;
	}
	
	public function getNghienCuuKhoaHoc ()
	{
		// Đề tài khoa học
		$hrm_detaikhoahoc = HRM_DeTaiKhoaHoc::where('HienThiCongKhai', 1)
			->orderBy('NamNghiemThu', 'desc')->get();
		
		// Bài báo khoa học
		$hrm_baibaokhoahoc = HRM_BaiBaoKhoaHoc::where('HienThiCongKhai', 1)
			->orderBy('NamXuatBan', 'desc')->get();
		
		// Sách - Giáo trình - Tài liệu
		$hrm_sachgiaotrinhtailieu = HRM_SachGiaoTrinhTaiLieu::where('HienThiCongKhai', 1)
			->orderBy('NamXuatBan', 'desc')->get();
		
		return view('frontend.nghiencuukhoahoc', compact('hrm_detaikhoahoc', 'hrm_baibaokhoahoc', 'hrm_sachgiaotrinhtailieu'));
	}
	
	public function getLienHe()
	{
		return view('frontend.lienhe');
	}
	
	public function getSoDoToChuc()
	{
		return view('frontend.sodotochuc');
	}
	
	public function getBaiViet($chuDe = '')
	{
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		if(empty($chuDe))
		{
			$session_title = 'Tất cả bài viết';
			$cms_baiviet = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', '>', 1]])
				->orderBy('QuanTrong', 'desc')
				->orderBy('created_at', 'desc')
				->paginate(20);
		}
		else
		{
			$cms_chude = CMS_ChuDe::where('TenChuDeKhongDau', $chuDe)->firstOrFail();
			$cms_baiviet = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', $cms_chude->ID]])
				->orderBy('QuanTrong', 'desc')
				->orderBy('created_at', 'desc')
				->paginate(20);
		}
		
		$cms_baiviet_first_file = array();
		foreach($cms_baiviet as $value)
		{
			$cms_baiviet_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_dir))
			{
				$cms_baiviet_files = scandir($cms_baiviet_dir);
				$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
				if(isset($cms_baiviet_files[3]))
				{
					$extension = strtolower(pathinfo($cms_baiviet_files[3], PATHINFO_EXTENSION));
					if(in_array($extension, $extensions))
						$cms_baiviet_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_dir . $cms_baiviet_files[3];
					else
						$cms_baiviet_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_first_file[$value->ID] = $no_image;
		}
		
		// Thống kê bài viết theo chủ đề
		$cms_chude_thongke = DB::table('cms_chude as cd')
			->leftJoin('cms_baiviet as bv', 'cd.ID', '=', 'bv.MaChuDe')
			->where([['bv.KichHoat', 1], ['cd.ID', '>', 1]])
			->select(DB::raw('cd.ID, cd.TenChuDe, cd.TenChuDeKhongDau, count(bv.ID) as TongBaiViet'))
			->groupBy('cd.ID', 'cd.TenChuDe', 'cd.TenChuDeKhongDau')
			->orderBy('cd.ThuTuHienThi', 'asc')->get();
		
		// Xem nhiều nhất
		$cms_baiviet_xnn = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', '>', 1]])
			->orderBy('LuotXem', 'desc')
			->take(10)->get();
		
		$cms_baiviet_xnn_first_file = array();
		foreach($cms_baiviet_xnn as $value)
		{
			$cms_baiviet_xnn_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_xnn_dir))
			{
				$cms_baiviet_xnn_files = scandir($cms_baiviet_xnn_dir);
				$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
				if(isset($cms_baiviet_xnn_files[3]))
				{
					$extension = strtolower(pathinfo($cms_baiviet_xnn_files[3], PATHINFO_EXTENSION));
					if(in_array($extension, $extensions))
						$cms_baiviet_xnn_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_xnn_dir . $cms_baiviet_xnn_files[3];
					else
						$cms_baiviet_xnn_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_xnn_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_xnn_first_file[$value->ID] = $no_image;
		}
		
		if(empty($chuDe))
			return view('frontend.baiviet', compact('session_title', 'cms_baiviet', 'cms_baiviet_first_file', 'cms_chude_thongke', 'cms_baiviet_xnn', 'cms_baiviet_xnn_first_file'));
		else
			return view('frontend.baiviet', compact('cms_chude', 'cms_baiviet', 'cms_baiviet_first_file', 'cms_chude_thongke', 'cms_baiviet_xnn', 'cms_baiviet_xnn_first_file'));
	}
	
	public function getBaiViet_ChiTiet($chuDe, $titleWithID)
	{
		$arrTitleWithID = explode('.', $titleWithID);
		$tieuDe = explode('-', $arrTitleWithID[0]);
		$maBaiViet = $tieuDe[count($tieuDe) - 1];
		
		if(!is_numeric($maBaiViet)) abort(404);
		
		$cms_baiviet = CMS_BaiViet::where('ID', $maBaiViet)
			->firstOrFail();
		$cms_baiviet_truoc = CMS_BaiViet::where('ID', $maBaiViet - 1)
			->first();
		$cms_baiviet_sau = CMS_BaiViet::where('ID', $maBaiViet + 1)
			->first();
		
		// Cập nhật lượt xem
		$idXem = 'BV' . $maBaiViet;
		if(!session()->has($idXem))
		{
			$orm = CMS_BaiViet::find($maBaiViet);
			$orm->LuotXem = $cms_baiviet->LuotXem + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		// Dữ liệu kèm theo bài viết
		$cms_baiviet_vanban = array();
		$cms_baiviet_nhanvien = array();
		if($cms_baiviet->MaLoai == 2)
		{
			$cms_baiviet_vanban = CMS_VanBan::where([['KichHoat', 1], ['MaBaiViet', $cms_baiviet->ID]])
				->get();
			$cms_baiviet_nhanvien = null;
		}
		elseif($cms_baiviet->MaLoai == 3)
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = HRM_NhanVien_DonVi::where('MaDonVi', $cms_baiviet->MaDonVi)
				->orderBy('ThuTuHienThi', 'asc')->get();
		}
		else
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = null;
		}
		
		// Thống kê bài viết theo chủ đề
		$cms_chude_thongke = DB::table('cms_chude as cd')
			->leftJoin('cms_baiviet as bv', 'cd.ID', '=', 'bv.MaChuDe')
			->where([['bv.KichHoat', 1], ['cd.ID', '>', 1]])
			->select(DB::raw('cd.ID, cd.TenChuDe, cd.TenChuDeKhongDau, count(bv.ID) as TongBaiViet'))
			->groupBy('cd.ID', 'cd.TenChuDe', 'cd.TenChuDeKhongDau')
			->orderBy('cd.ThuTuHienThi', 'asc')->get();
		
		// Bài viết liên quan
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		$cms_baiviet_lq = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', $cms_baiviet->MaChuDe]])
			->orderBy('created_at', 'desc')
			->take(5)->get();
		
		$cms_baiviet_lq_first_file = array();
		foreach($cms_baiviet_lq as $value)
		{
			$cms_baiviet_lq_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_lq_dir))
			{
				$cms_baiviet_lq_files = scandir($cms_baiviet_lq_dir);
				$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
				if(isset($cms_baiviet_lq_files[3]))
				{
					$extension = strtolower(pathinfo($cms_baiviet_lq_files[3], PATHINFO_EXTENSION));
					if(in_array($extension, $extensions))
						$cms_baiviet_lq_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_lq_dir . $cms_baiviet_lq_files[3];
					else
						$cms_baiviet_lq_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_lq_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_lq_first_file[$value->ID] = $no_image;
		}
		
		return view('frontend.baiviet-chitiet', compact('cms_baiviet', 'cms_baiviet_truoc', 'cms_baiviet_sau', 'cms_baiviet_vanban', 'cms_baiviet_nhanvien', 'cms_chude_thongke', 'cms_baiviet_lq', 'cms_baiviet_lq_first_file'));
	}
	
	public function getBaiVietCNTT()
	{
		$maBaiViet = 10;
		
		$cms_baiviet = CMS_BaiViet::where('ID', $maBaiViet)
			->firstOrFail();
		$cms_baiviet_truoc = CMS_BaiViet::where('ID', $maBaiViet - 1)
			->first();
		$cms_baiviet_sau = CMS_BaiViet::where('ID', $maBaiViet + 1)
			->first();
		
		// Cập nhật lượt xem
		$idXem = 'BV' . $maBaiViet;
		if(!session()->has($idXem))
		{
			$orm = CMS_BaiViet::find($maBaiViet);
			$orm->LuotXem = $cms_baiviet->LuotXem + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		// Dữ liệu kèm theo bài viết
		$cms_baiviet_vanban = array();
		$cms_baiviet_nhanvien = array();
		if($cms_baiviet->MaLoai == 2)
		{
			$cms_baiviet_vanban = CMS_VanBan::where([['KichHoat', 1], ['MaBaiViet', $cms_baiviet->ID]])
				->get();
			$cms_baiviet_nhanvien = null;
		}
		elseif($cms_baiviet->MaLoai == 3)
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = HRM_NhanVien_DonVi::where('MaDonVi', $cms_baiviet->MaDonVi)
				->orderBy('ThuTuHienThi', 'asc')->get();
		}
		else
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = null;
		}
		
		// Thống kê bài viết theo chủ đề
		$cms_chude_thongke = DB::table('cms_chude as cd')
			->leftJoin('cms_baiviet as bv', 'cd.ID', '=', 'bv.MaChuDe')
			->where([['bv.KichHoat', 1], ['cd.ID', '>', 1]])
			->select(DB::raw('cd.ID, cd.TenChuDe, cd.TenChuDeKhongDau, count(bv.ID) as TongBaiViet'))
			->groupBy('cd.ID', 'cd.TenChuDe', 'cd.TenChuDeKhongDau')
			->orderBy('cd.ThuTuHienThi', 'asc')->get();
		
		// Bài viết liên quan
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		$cms_baiviet_lq = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', $cms_baiviet->MaChuDe]])
			->orderBy('created_at', 'desc')
			->take(5)->get();
		
		$cms_baiviet_lq_first_file = array();
		foreach($cms_baiviet_lq as $value)
		{
			$cms_baiviet_lq_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_lq_dir))
			{
				$cms_baiviet_lq_files = scandir($cms_baiviet_lq_dir);
				$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
				if(isset($cms_baiviet_lq_files[3]))
				{
					$extension = strtolower(pathinfo($cms_baiviet_lq_files[3], PATHINFO_EXTENSION));
					if(in_array($extension, $extensions))
						$cms_baiviet_lq_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_lq_dir . $cms_baiviet_lq_files[3];
					else
						$cms_baiviet_lq_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_lq_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_lq_first_file[$value->ID] = $no_image;
		}
		
		return view('frontend.baiviet-chitiet', compact('cms_baiviet', 'cms_baiviet_truoc', 'cms_baiviet_sau', 'cms_baiviet_vanban', 'cms_baiviet_nhanvien', 'cms_chude_thongke', 'cms_baiviet_lq', 'cms_baiviet_lq_first_file'));
	}
	
	public function getBaiVietKTPM()
	{
		$maBaiViet = 11;
		
		$cms_baiviet = CMS_BaiViet::where('ID', $maBaiViet)
			->firstOrFail();
		$cms_baiviet_truoc = CMS_BaiViet::where('ID', $maBaiViet - 1)
			->first();
		$cms_baiviet_sau = CMS_BaiViet::where('ID', $maBaiViet + 1)
			->first();
		
		// Cập nhật lượt xem
		$idXem = 'BV' . $maBaiViet;
		if(!session()->has($idXem))
		{
			$orm = CMS_BaiViet::find($maBaiViet);
			$orm->LuotXem = $cms_baiviet->LuotXem + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		// Dữ liệu kèm theo bài viết
		$cms_baiviet_vanban = array();
		$cms_baiviet_nhanvien = array();
		if($cms_baiviet->MaLoai == 2)
		{
			$cms_baiviet_vanban = CMS_VanBan::where([['KichHoat', 1], ['MaBaiViet', $cms_baiviet->ID]])
				->get();
			$cms_baiviet_nhanvien = null;
		}
		elseif($cms_baiviet->MaLoai == 3)
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = HRM_NhanVien_DonVi::where('MaDonVi', $cms_baiviet->MaDonVi)
				->orderBy('ThuTuHienThi', 'asc')->get();
		}
		else
		{
			$cms_baiviet_vanban = null;
			$cms_baiviet_nhanvien = null;
		}
		
		// Thống kê bài viết theo chủ đề
		$cms_chude_thongke = DB::table('cms_chude as cd')
			->leftJoin('cms_baiviet as bv', 'cd.ID', '=', 'bv.MaChuDe')
			->where([['bv.KichHoat', 1], ['cd.ID', '>', 1]])
			->select(DB::raw('cd.ID, cd.TenChuDe, cd.TenChuDeKhongDau, count(bv.ID) as TongBaiViet'))
			->groupBy('cd.ID', 'cd.TenChuDe', 'cd.TenChuDeKhongDau')
			->orderBy('cd.ThuTuHienThi', 'asc')->get();
		
		// Bài viết liên quan
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		$cms_baiviet_lq = CMS_BaiViet::where([['KichHoat', 1], ['MaChuDe', $cms_baiviet->MaChuDe]])
			->orderBy('created_at', 'desc')
			->take(5)->get();
		
		$cms_baiviet_lq_first_file = array();
		foreach($cms_baiviet_lq as $value)
		{
			$cms_baiviet_lq_dir = 'storage/app/files/posts/' . str_pad($value->ID, 7, '0', STR_PAD_LEFT) . '/';
			if(file_exists($cms_baiviet_lq_dir))
			{
				$cms_baiviet_lq_files = scandir($cms_baiviet_lq_dir);
				$extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
				if(isset($cms_baiviet_lq_files[3]))
				{
					$extension = strtolower(pathinfo($cms_baiviet_lq_files[3], PATHINFO_EXTENSION));
					if(in_array($extension, $extensions))
						$cms_baiviet_lq_first_file[$value->ID] = config('app.url') . '/'. $cms_baiviet_lq_dir . $cms_baiviet_lq_files[3];
					else
						$cms_baiviet_lq_first_file[$value->ID] = $no_image;
				}
				else
					$cms_baiviet_lq_first_file[$value->ID] = $no_image;
			}
			else
				$cms_baiviet_lq_first_file[$value->ID] = $no_image;
		}
		
		return view('frontend.baiviet-chitiet', compact('cms_baiviet', 'cms_baiviet_truoc', 'cms_baiviet_sau', 'cms_baiviet_vanban', 'cms_baiviet_nhanvien', 'cms_chude_thongke', 'cms_baiviet_lq', 'cms_baiviet_lq_first_file'));
	}
	
	public function getBaiViet_ChiTiet_OldLink($id, $title)
	{
		if(!is_numeric($id)) abort(404);
		
		$cms_baiviet = CMS_BaiViet::where('ID', $id)
			->firstOrFail();
		
		return redirect()->route('baiviet.chitiet', ['chuDe' => $cms_baiviet->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_baiviet->TieuDeKhongDau . '-' . $cms_baiviet->ID . '.html']);
	}
	
	public function postVanBanTaiVe(Request $request)
	{
		$baiviet_vanban = CMS_VanBan::where('ID', $request->id)
			->firstOrFail();
		$file_path = config('app.url') . '/storage/app/files/posts/' . str_pad($baiviet_vanban->MaBaiViet, 7, '0', STR_PAD_LEFT) . '/';
		$file = $file_path . $baiviet_vanban->DuongDan;
		
		// Cập nhật lượt download
		// Chính sách: 1 máy chỉ tăng 1 lần
		$idXem = 'VB' . $request->id;
		if(!session()->has($idXem))
		{
			$orm = CMS_VanBan::find($request->id);
			$orm->LuotDownload = $baiviet_vanban->LuotDownload + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		return redirect($file);
	}
	
	public function getHinhAnh($chuDe = '')
	{
		$no_image = config('app.url') . '/public/frontend/images/no-image.jpg';
		if(empty($chuDe))
		{
			$session_title = 'Hình ảnh hoạt động';
			$cms_hinhanh = CMS_HinhAnh::where('KichHoat', 1)
				->orderBy('created_at', 'desc')
				->paginate(12);
		}
		else
		{
			$cms_chude = CMS_ChuDe::where('TenChuDeKhongDau', $chuDe)->firstOrFail();
			$cms_hinhanh = CMS_HinhAnh::where([['KichHoat', 1], ['MaChuDe', $cms_chude->ID]])
				->orderBy('created_at', 'desc')
				->paginate(12);
		}
		
		$cms_hinhanh_chude = CMS_HinhAnh::join('cms_chude', 'cms_hinhanh.MaChuDe', '=', 'cms_chude.ID')
			->select('MaChuDe', 'TenChuDe', 'TenChuDeKhongDau')
			->orderBy('TenChuDe', 'asc')
			->distinct()->get();
		
		$cms_hinhanh_first_file = array();
		foreach($cms_hinhanh as $value)
		{
			$dir = 'storage/app/' . $value->ThuMuc . '/';
			if(file_exists($dir))
			{
				$files = scandir($dir);
				if(isset($files[3]))
					$cms_hinhanh_first_file[$value->ID] = config('app.url') . '/'. $dir . $files[3];
				else
					$cms_hinhanh_first_file[$value->ID] = $no_image;
			}
			else
				$cms_hinhanh_first_file[$value->ID] = $no_image;
		}
		
		if(empty($chuDe))
			return view('frontend.hinhanh', compact('session_title', 'cms_hinhanh_chude', 'cms_hinhanh', 'cms_hinhanh_first_file'));
		else
			return view('frontend.hinhanh', compact('cms_chude', 'cms_hinhanh_chude', 'cms_hinhanh', 'cms_hinhanh_first_file'));
	}
	
	public function getHinhAnh_ChiTiet($chuDe, $titleWithID)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		
		$arrTitleWithID = explode('.', $titleWithID);
		$tieuDe = explode('-', $arrTitleWithID[0]);
		$maHinhAnh = $tieuDe[count($tieuDe) - 1];
		
		if(!is_numeric($maHinhAnh)) abort(404);
		
		$cms_hinhanh = CMS_HinhAnh::where('ID', $maHinhAnh)
			->firstOrFail();
		$cms_hinhanh_truoc = CMS_HinhAnh::where('ID', $maHinhAnh - 1)
			->first();
		$cms_hinhanh_sau = CMS_HinhAnh::where('ID', $maHinhAnh + 1)
			->first();
		
		$all_files = array();
		$dir = '';
		if(is_null($cms_hinhanh->ThuMuc) || trim($cms_hinhanh->ThuMuc) == '')
			$all_files = null;
		else
		{
			$dir = '/storage/app/' . $cms_hinhanh->ThuMuc . '/';
			$files = Storage::files($cms_hinhanh->ThuMuc . '/');
			foreach($files as $file)
				$all_files[] = pathinfo($file);
		}
		
		// Cập nhật lượt xem
		$idXem = 'HA' . $maHinhAnh;
		if(!session()->has($idXem))
		{
			$orm = CMS_HinhAnh::find($maHinhAnh);
			$orm->LuotXem = $cms_hinhanh->LuotXem + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		return view('frontend.hinhanh-chitiet', compact('cms_hinhanh', 'cms_hinhanh_truoc', 'cms_hinhanh_sau', 'dir', 'all_files'));
	}
	
	public function getHinhAnh_ChiTiet_OldLink($id, $title)
    {
		if(!is_numeric($id)) abort(404);
		
		$cms_hinhanh = CMS_HinhAnh::where('ID', $id)
			->firstOrFail();
		
		return redirect()->route('hinhanh.chitiet', ['chuDe' => $cms_hinhanh->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_hinhanh->MoTaKhongDau . '-' . $cms_hinhanh->ID . '.html']);
	}
	
	public function getGoogleLogin()
	{
		return Socialite::driver('google')->redirect();
	}
	
	public function getGoogleCallback()
	{
		try
		{
			$user = Socialite::driver('google')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();
		}
		catch(Exception $e)
		{
			return redirect()->route('login')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
		}
		
		if(!Str::contains($user->email, 'agu.edu.vn'))
		{
			return redirect()->route('login')->with('warning', 'Phải sử dụng email của AGU!');
		}
		
		$existingUser = SYS_NguoiDung::where('email', $user->email)->first();
		if($existingUser)
		{
			Auth::login($existingUser, true);
			return redirect()->route('admin.home');
		}
		else
		{
			return redirect()->route('login')->with('warning', 'Tài khoản không thuộc quản lý của FIT!');
		}
	}
	
	public function getNhanVien()
	{
		$no_photo = config('app.url') . "/public/frontend/images/no-photo.jpg";
		$staffs_path = config('app.url') . "/storage/app/files/staffs/";
		
		$hrm_donvi = HRM_DonVi::whereIn('ID', [1, 2, 3, 8])
			->orderBy('ID', 'asc')->get();
		
		$hrm_nhanvien_donvi = HRM_NhanVien_DonVi::whereIn('MaDonVi', [1, 2, 3, 8])
			->orderBy('MaDonVi', 'asc')
			->orderBy('ThuTuHienThi', 'asc')->get();
		
		return view('frontend.nhanvien', compact('hrm_donvi', 'hrm_nhanvien_donvi', 'staffs_path', 'no_photo'));
	}
	
	public function getNhanVien_ChiTiet($hoVaTenSlug)
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		$no_photo = config('app.url') . "/public/frontend/images/no-photo.jpg";
		$staffs_path = config('app.url') . "/storage/app/files/staffs/";
		
		$hrm_nhanvien = HRM_NhanVien::where('HoVaTenKhongDau', $hoVaTenSlug)->firstOrFail();
		
		if($hrm_nhanvien == null) abort(404);
		
		// Quá trình công tác
		$hrm_quatrinhcongtac = HRM_QuaTrinhCongTac::where('MaNhanVien', $hrm_nhanvien->ID)
			->orderBy('ThoiGian', 'desc')->get();
		
		// Đề tài khoa học
		$hrm_detaikhoahoc = HRM_DeTaiKhoaHoc::where('MaNhanVien', $hrm_nhanvien->ID)
			->orderBy('NamNghiemThu', 'desc')->get();
		
		// Bài báo khoa học
		$hrm_baibaokhoahoc = HRM_BaiBaoKhoaHoc::where('MaNhanVien', $hrm_nhanvien->ID)
			->orderBy('NamXuatBan', 'desc')->get();
		
		// Sách - Giáo trình - Tài liệu
		$hrm_sachgiaotrinhtailieu = HRM_SachGiaoTrinhTaiLieu::where('MaNhanVien', $hrm_nhanvien->ID)
			->orderBy('NamXuatBan', 'desc')->get();
		
		// Hướng dẫn SĐH
		$hrm_huongdansaudaihoc = HRM_HuongDanSauDaiHoc::where('MaNhanVien', $hrm_nhanvien->ID)
			->orderBy('NamHuongDan', 'desc')->get();
		
		// Cập nhật lượt xem
		// Chính sách: 1 máy chỉ tăng 1 lần
		$idXem = "NV" . $hrm_nhanvien->ID;
		if(!session()->has($idXem))
		{
			$orm = HRM_NhanVien::find($hrm_nhanvien->ID);
			$orm->LuotXem = $hrm_nhanvien->LuotXem + 1;
			$orm->save();
			session()->put($idXem, 1);
		}
		
		return view('frontend.nhanvien-chitiet', compact('hrm_nhanvien', 'staffs_path', 'no_photo', 'hrm_quatrinhcongtac', 'hrm_detaikhoahoc', 'hrm_baibaokhoahoc', 'hrm_sachgiaotrinhtailieu', 'hrm_huongdansaudaihoc'));
	}
	
	public function getNhanVien_ChiTiet_OldLink($username)
	{
		$hrm_nhanvien = HRM_NhanVien::where('Email', 'like', $username . '%')->firstOrFail();
		if($hrm_nhanvien == null) abort(404);
		return redirect()->route('nhansu.chitiet', ['hoVaTenSlug' => $hrm_nhanvien->HoVaTenKhongDau]);
	}
}