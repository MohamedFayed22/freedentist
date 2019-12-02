<option value="">Select Service</option>

@if(!empty($dentists))

    @foreach($dentists as $key => $value)

        <option value="{{ $key }}">{{ $value }}</option>

    @endforeach

@endif