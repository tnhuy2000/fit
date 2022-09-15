<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class NavbarComposer
{
	/**
	 * Create a new composer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Dependencies automatically resolved by service container...
	}
	
	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		// Weather
		if(!session()->has('topbar_weather_icon'))
		{
			try
			{
				$weather = $this->getWeatherInfo();
				$weather_condition = $weather->list[0];
				$topbar_weather_icon = $this->getWeatherIcon($weather_condition->weather[0]->icon);
				$topbar_weather_temperature = $weather_condition->main->temp;
			}
			catch(Exception $e)
			{
				$topbar_weather_icon = 'clouds';
				$topbar_weather_temperature = 'N/A';
			}
			session()->put('topbar_weather_icon', $topbar_weather_icon);
			session()->put('topbar_weather_temperature', $topbar_weather_temperature);
		}
		else
		{
			$topbar_weather_icon = session()->get('topbar_weather_icon');
			$topbar_weather_temperature = session()->get('topbar_weather_temperature');
		}
		
		$today = date('Y-m-d H:i:s');
		$topbar_today = $this->getTodayInfo($today);
		
		$navbar_data_thongbao = DB::table('cms_chude as cd')
			->leftJoin('cms_baiviet as bv', 'cd.ID', '=', 'bv.MaChuDe')
			->where([['bv.KichHoat', 1], ['cd.ID', '>', 1]])
			->select(DB::raw('cd.ID, cd.TenChuDe, cd.TenChuDeKhongDau, count(bv.ID) as TongBaiViet'))
			->groupBy('cd.ID', 'cd.TenChuDe', 'cd.TenChuDeKhongDau')
			->orderBy('cd.ThuTuHienThi', 'asc')->get();
		
		$navbar_data_lienketngoai = DB::table('cms_lienketngoai')
			->where('KichHoat', 1)
			->orderBy('ThuTuHienThi', 'asc')->get();
		
		$view->with(['topbar_today' => $topbar_today, 'topbar_weather_icon' => $topbar_weather_icon, 'topbar_weather_temperature' => $topbar_weather_temperature, 'navbar_data_thongbao' => $navbar_data_thongbao, 'navbar_data_lienketngoai' => $navbar_data_lienketngoai]);
	}
	
	public function getWeatherInfo()
	{
		$url = 'https://api.openweathermap.org/data/2.5/forecast';
		
		$query = array(
			'id' => '1575627', // Long Xuyên
			'appid' => '47af03fe658a769a6251ca0b910bb37e',
			'cnt' => '1',
			'units' => 'metric',
		);
		
		$header = array(
			
		);
		
		$options = array(
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_HEADER => false,
			CURLOPT_URL => $url . '?' . http_build_query($query),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
		);
		
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($response);
	}
	
	public function getWeatherIcon($code)
	{
		$icons = array(
			'01d' => 'sun',
			'01n' => 'moon',
			'02d' => 'sun-cloud',
			'02n' => 'moon-cloud',
			'03d' => 'clouds-sun',
			'03n' => 'clouds-moon',
			'04d' => 'clouds',
			'04n' => 'clouds',
			'09d' => 'cloud-showers',
			'09n' => 'cloud-showers',
			'10d' => 'cloud-sun-rain',
			'10n' => 'cloud-moon-rain',
			'11d' => 'thunderstorm-sun',
			'11n' => 'thunderstorm-moon',
			'13d' => 'snowflake',
			'13n' => 'snowflake',
			'50d' => 'fog',
			'50n' => 'fog'
		);
		
		return $icons[$code];
	}
	
	public function getTodayInfo($raw_date)
	{
		if(($raw_date == '0000-00-00 00:00:00') || empty($raw_date)) return false;
		
		$arr = explode(' ', $raw_date);
		$str_day = $arr[0];
		$str_time = $arr[1];
		
		$arr_day = explode('-', $str_day);
		$year	= (int)$arr_day[0];
		$month	= (int)$arr_day[1];
		$day	= (int)$arr_day[2];
		
		$ndow = date('w', mktime(0, 0, 0, $month, $day, $year));
		$dow = '';
		switch($ndow)
		{
			case 0:
				$dow = 'Chủ Nhật, ';
				break;
			case 1:
				$dow = 'Thứ Hai, ';
				break;
			case 2:
				$dow = 'Thứ Ba, ';
				break;
			case 3:
				$dow = 'Thứ Tư, ';
				break;
			case 4:
				$dow = 'Thứ Năm, ';
				break;
			case 5:
				$dow = 'Thứ Sáu, ';
				break;
			case 6:
				$dow = 'Thứ Bảy, ';
				break;
		}
		
		$arr_time = explode(':', $str_time);
		$hour	= (int)$arr_time[0];
		$minute	= (int)$arr_time[1];
		$second	= (int)$arr_time[2];
		
		if(@date('Y', mktime(0, 0, 0, $month, $day, $year)) == $year)
		{
			return $dow . date('d/m/Y, H:i', mktime($hour, $minute, $second, $month, $day, $year)) . ' (GMT+7)';
		}
		else
		{
			return $dow . ereg_replace('2037' . '$', $year, date('d/m/Y, H:i', mktime($hour, $minute, $second, $month, $day, 2037))) . ' (GMT+7)';
		}
	}
}