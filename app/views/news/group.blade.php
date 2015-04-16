@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')

<div class = 'container'>
	<h2>Group News</h2>
	@if(!empty($news))
		<table id = 'group_table' class = 'table table-striped'>
			<thead>
				<tr>
					<th>Title</th>
					<th>Type</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($news as $i => $entry)
					<?php
						$d = $entry->created_at;
						$date = $entry->created_at;
					?>
					<tr>
						<td><a href = '{{route("news")}}/{{$entry->_id}}'>{{$entry->title}}</a></td>
						<td>{{$entry->type}}</td>
						<td>{{date('F j g A',$date->sec)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class = 'alert alert-warning'>There are no Group News Entries</p>
	@endif
	<button type = 'button' class = 'btn btn-info' id = 'addNews'>+ News</button>
</div>
<script>
	$('#addNews').click(function(){
		window.location = "{{route('news.create')}}";
	});
	$('#group_table').dynatable();
</script>
@stop
