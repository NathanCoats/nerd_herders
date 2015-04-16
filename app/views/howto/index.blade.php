@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	<div class = 'container'>
		<div id = 'msg'></div>
		<h2>Tutorial Home</h2>
		@if(!empty($tutorials))
			<table id = 'howto_table' class = 'table table-striped'>
				<thead>
					<tr>
						<th>Title</th>
						<th>Type</th>
						<th>Creator</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tutorials as $i => $tutorial)
						<?php
							$d = $tutorial->created_at;
							$date = $tutorial->created_at->sec;
						?>
						<tr>
							<td><a href = '{{route("howto")}}/{{$tutorial->_id}}'>{{$tutorial->title}}</a></td>
							<td>{{$tutorial->type}}</td>
							<td>{{User::getNames($tutorial->poster_id)}}</td>
							<td>{{date('F j g A',$date)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
		<button type = 'button' class = 'btn btn-info' id = 'addTutorial'>+ Tutorial</button>
	</div>
<script>
	$('#addTutorial').click(function(){
		window.location = "{{route('howto.create')}}";
	});
	$('#howto_table').dynatable();
</script>

@stop
