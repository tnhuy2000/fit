<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" />
@else
<img src="{{ asset('public/xsktag/logo.png') }}" class="logo" />
{{ $slot }}
@endif
</a>
</td>
</tr>
