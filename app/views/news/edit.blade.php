@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	<div id = 'msg'></div>
	<h2 class = 'title'>{{$news->title}}</h2>
	<form id = 'myForm'>
		<div class = 'col-lg-8'>
			<label for 'type'>News Type:</label>
			<select class = 'form-control' id = 'type' required>
				<option value = ''>Please Select A Type</option>
				<option value = 'group'>Group News</option>
				<option value = 'game'>Game News</option>
				<option value = 'anime'>Anime News</option>
			</select>
		</div>
		<div class = 'col-lg-8'>
			<label for 'title'>Title:</label>
			<input type = 'text' class = 'form-control' id = 'title' placeholder = 'Give it a Title' required value = '{{$news->title}}'>
		</div>
		<div class = 'col-lg-8'>
			<label for 'news'>News:</label>
			<textarea type = 'news' class = 'form-control' id = 'news' required>{{$news->news}}</textarea>
		</div>
		<div id = 'accountButtons'>
			<button type = 'submit' class = 'btn btn-success'>Post News</button>
			@if(Auth::user()->_id == $news->poster_id)
				<button type = 'button' class = 'btn btn-danger' id = 'delete'>Delete News Post</button>
			@endif
		</div>
	</form>
	<script>
		$(document).ready(function() {

			var type = '{{$news->type}}';
			if(type != undefined && type != null && type != ""){
				$('#type').val(type);
			}

			$('#myForm').submit(function(event){
				var type = $('#type').val();
				var title = $('#title').val();
				var news = $('#news').val();
				var poster_id = {{Auth::user()->_id}};
				var id = {{$news->_id}};
				var params = {
								type:type,
								title:title,
								news:news,
								poster_id:poster_id
							};
				$.post(
					'{{route("news.edit.submit")}}',
					{id:id,params:params},
					 function(data, textStatus, xhr) {
					 	if(data == 'true'){
							var msg = "<div class='alert alert-success myMsg' role='alert'>You Succesfully Updated Your News Post</div>";
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
