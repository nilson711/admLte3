<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'RequestCare')
<img src="http://localhost:8000/img/homecare_logo.png" class="logo" alt="RequestCare">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
