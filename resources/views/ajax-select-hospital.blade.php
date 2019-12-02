<option>@lang('login.select')</option>
@if(!empty($hospitals))

    @foreach($hospitals as $key => $value)

        <option value="{{ $key }}">{{ $value }}</option>

    @endforeach

@endif