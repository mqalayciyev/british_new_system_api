<h1>{{ config('app.name') }}</h1>
<p>@lang('content.Welcome') {{ $user->first_name }} {{ $user->last_name }}, qeydiyyatınız uğurla başa çatıb</p>
<p>@lang('content.Please click below Activate link and activate your registration')</p>
<p><strong><a href="{{ config('app.url') }}/user/activate/{{ $user->activation_key }}">@lang('content.Activate')</a></strong></p>