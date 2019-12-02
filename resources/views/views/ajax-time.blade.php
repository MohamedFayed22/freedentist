<option value="">Select Time</option>

@if(!empty($dates))

    @foreach($dates as $key => $value)

        <option value="{{ $value->id }}{{ $value->start_time }}/{{ $value->end_time }}">{{ $value->start_time }}-{{ $value->end_time }}</option>

    @endforeach

@endif