@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	@if(!empty($howto->_id) && $howto->_id != 0 && Auth::user()->_id == $howto->poster_id)
		<div class = 'container'>
			<div id = 'msg'></div>
			<h2 class = 'title'>{{$howto->name}}</h2>
			<form id = 'myForm'>
				<div class = 'col-lg-8'>
					<label for 'title'>Tutorial Name:</label>
					<input class = 'form-control' name = 'title' id = 'title' placeholder = 'Tutorial Name' required value = "{{$howto->title}}"/>
				</div>
				<div class = 'col-lg-8'>
					<label for 'type'>Category:</label>
					<input class = 'form-control' name = 'type' id = 'type' placeholder = 'E.g Computer, Electronics, or Kniting if you so Desire.' required value = "{{$howto->type}}"/>
				</div>
				<div class = 'col-lg-8'>
					<label for 'description'>Description:</label>
					<textarea class = 'form-control' name = 'description' id = 'description' placeholder = 'A Short Description of what Your Tutorial is About' required>{{$howto->description}}</textarea>
				</div>
				<div class = 'col-lg-8'>
					<label for 'instructions'>Instructions:</label>
					<textarea class = 'form-control' name = 'instructions' id = 'instructions' placeholder = 'A Short Description of what Your Tutorial is About' required>{{$howto->instructions}}</textarea>
				</div>
				<button type = 'submit' class = 'btn btn-success'>Save Tutorial</button><br/>
				@if(Auth::user()->_id == $howto->poster_id)
					<button type = 'button' class = 'btn btn-danger' id = 'delete'>Delete Tutorial</button>
				@endif
			</form>
		</div>
		<script>
		$(document).ready(function() {
			$('#myForm').submit(function(event){
				var title        = $('#title').val();
				var type         = $('#type').val();
				var description  = $('#description').val();
				var instructions = $('#instructions').val();
				var poster_id    = '{{Auth::user()->_id}}';
				var id           = {{$howto->_id}};
				var params       = {poster_id:poster_id,instructions:instructions,title:title,description:description,type:type};

				$.post("{{route('howto.edit.submit')}}",
					{id:id,params:params},
					function(data, textStatus, xhr) {
					 	if(data == 'true'){
							var msg = "<div class='alert alert-success myMsg' role='alert'>You Succesfully Updated Your Tutorial</div>";
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
			$('#delete').click(function(){
				var r = confirm('Are You Sure This Cannot Be Undone');
				if(r){
				$.post('{{route("howto.delete")}}',
				{ id: {{$howto->_id}} },
				function(data, textStatus, xhr) {
				 	if(data == 'true'){
				 		alert('You Successfully Deleted This Tutorial');
				 		window.location = '{{route("howto")}}';
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
	@else
		<p class = 'alert alert-warning'>This is Not Your Tutorial To Edit.</p>
	@endif
@stop
