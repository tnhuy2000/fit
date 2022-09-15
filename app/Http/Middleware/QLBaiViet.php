<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class QLBaiViet
{
	public function handle($request, Closure $next)
	{
		if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qlbaiviet")
		{
			return $next($request);
		}
		return redirect()->route('admin.forbidden')->with('error_message', 'Người dùng không đủ quyền hạn để thao tác chức năng này!');
	}
}