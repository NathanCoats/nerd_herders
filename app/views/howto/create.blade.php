@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	<div class = 'container'>
		<div id = 'msg'></div>
		<h2 class = 'title'>New Tutorial</h2>
		<form id = 'myForm'>
			<div class = 'col-lg-8'>
				<label for 'title'>Tutorial Name:</label>
				<input class = 'form-control' name = 'title' id = 'title' placeholder = 'Tutorial Name' required>
			</div>
			<div class = 'col-lg-8'>
				<label for 'type'>Category:</label>
				<input class = 'form-control' name = 'type' id = 'type' placeholder = 'E.g Computer, Electronics, or Kniting if you so Desire.' required/>
			</div>
			<div class = 'col-lg-8'>
				<label for 'description'>Description:</label>
				<textarea class = 'form-control' name = 'description' id = 'description' placeholder = 'A Short Description of what Your Tutorial is About' required></textarea>
			</div>
			<div class = 'col-lg-8'>
				<label for 'instructions'>Instructions:</label>
				<textarea class = 'form-control' name = 'instructions' id = 'instructions' placeholder = 'A Step By Step Walkthrough of Your Tutorial.' required></textarea>
			</div>
			<button type = 'submit' class = 'btn btn-success'>Save Tutorial</button>
		</form>
	</div>
	<script>

		$('#myForm').submit(function(event){

			var title        = $('#title').val();
			var type         = $('#type').val();
			var description  = $('#description').val();
			var instructions = $('#instructions').val();
			var poster_id    = '{{Auth::user()->_id}}';
			var params = {poster_id:poster_id,title:title,description:description,type:type};

			$.post("{{route('howto.submit')}}",
				{params:params},
				function(data, textStatus, xhr) {
				 	if(data == 'true'){
						var msg = "<div class='alert alert-success myMsg' role='alert'>You Succesfully Created Your Tutorial</div>";
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
