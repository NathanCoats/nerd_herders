@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	@if(!empty($news))

		<h2>{{$news->title}}</h2>
		<p>{{$news->news}}</p>

	@if(Auth::user()->_id == $news->poster_id)
		<button type = 'button' class = 'btn btn-info' onclick = "window.location.href = '{{route('news')}}/edit/{{$news->_id}}'">Edit News Post</button><br />
		<button type = 'button' class = 'btn btn-danger' id = 'delete'>Delete News Post</button>
	@endif
	@else
		<p class = 'alert alert-warning'>This News Does Not Exist.</p>
	@endif
	<script>
	$(document).ready(function() {
		$('#delete').click(function(){
			var r = confirm('Are You Sure This Cannot Be Undone');
			if(r){
			$.post('{{route("news.delete")}}',
			{ id: {{$news->_id}} },
			function(data, textStatus, xhr) {
			 	if(data == 'true'){
			 		alert('You Successfully Deleted This News Post');
			 		window.location = '{{route("news")}}';
				}
				else{
					var msg = "<div class='alert alert-danger myMsg' role='alert'>"+data+"</div>";
					$('#msg').html(msg);
					$( "#msg" ).fadeIn("slow", function(){});
				}
			});
			}
		});
	});
	</script>
@stop
