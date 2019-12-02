<option value="">Select Day</option>

@if(!empty($days))

    @foreach($days as $key => $value)

        <option value="{{ $key }}">{{ $value }}</option>

    @endforeach

@endif