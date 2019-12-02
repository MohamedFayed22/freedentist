@extends('frontend.app')

@section('style')
<link rel="stylesheet" type="text/css"         
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"    
ref="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>


@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pending reservation</div>

                <div class="panel-body">
				<table>
					<thead>
						<tr>
							<th>Date/Time</th>
							
							<th>Patient name</th>
							<th width="100">Treatment name</th>
							<th width="100">Details</th>
							<th width="100">Action</th>
						</tr>
					</thead>
				
				 @foreach($events as $i=>$event)
				 <tbody>
				 <tr>
				 	<td width="100"> {{ $event->start_date }}</td>
				 	
				 	<td width="100">  {{ $user[$i]->name }}</td>
				 	<td width="100">  {{ $treatments[$i]->treatment_name_en }}</td>
				 	<td width="100"><a href="#">Deatils</a>  </td>
				 	<td width="100"><a href="#">accepet/Cancel</a>  </td>
				 </tr></tbody>
                    
                   
					<br/>
					@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
