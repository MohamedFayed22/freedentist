<option>@lang('login.select')</option>
@if(!empty($cities))

    @foreach($cities as $key => $value)

        <option value="{{ $key }}">{{ $value }}</option>

    @endforeach

@endif