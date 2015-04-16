@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	<div class = 'container'>
		<div id = 'msg'></div>
		<h2 class = 'title'>Create News Entry</h2>
		<form id = 'myForm'>
			<div class = 'col-lg-8'>
				<label for 'type'>News Type:</label>
				<select class = 'form-control' id = 'type' required>
					<option value = 'group'>Group News</option>
					<option value = 'game'>Game News</option>
					<option value = 'anime'>Anime News</option>
				</select>
			</div>
			<div class = 'col-lg-8'>
				<label for 'title'>Title:</label>
				<input type = 'text' class = 'form-control' id = 'title' placeholder = 'Give it a Title' required>
			</div>
			<div class = 'col-lg-8'>
				<label for 'news'>News:</label>
				<textarea type = 'news' class = 'form-control' id = 'news' required></textarea>
			</div>
			<div id = 'accountButtons'>
				<button type = 'reset' class = 'btn btn-warning'>Clear Fields</button>
				<button type = 'submit' class = 'btn btn-success'>Post News</button>
			</div>
		</form>
	</div>
<script>
	$('#myForm').submit(function(event){
		var type = $('#type').val();
		var title = $('#title').val();
		var news = $('#news').val();
		var poster_id = '{{Auth::user()->_id}}';
		var params = {
						type:type,
						title:title,
						news:news,
						poster_id:poster_id
					};
		$.post(
			'{{route("news.submit")}}',
			{params:params},
			 function(data, textStatus, xhr) {
		 		if(data == 'true'){
			 		var msg = "<div class='alert alert-success myMsg' role='alert'><strong>Success!</strong> News Was Posted.</div>";
			 		$('#msg').html(msg);
			 		$( "#msg" ).fadeIn("slow", function(){});
		 	  	}
		 	  	else{
		 	  		var msg = "<div class='alert alert-danger myMsg' role='alert'>"+data+"</div>";
		 	  		$('#msg').html(msg);
		 	  		$( "#msg" ).fadeIn("slow", function(){});
		 	  	}
		});
		event.preventDefault();
	});
</script>
@stop
