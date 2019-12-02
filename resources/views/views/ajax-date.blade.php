<option value="">Select Date</option>

@if(!empty($dates))

    @foreach($dates as $key => $value)

        <option value="{{ $value->start_date }}/{{ $value->end_date }}">{{ $value->start_date }}/{{ $value->end_date }}</option>

    @endforeach

@endif