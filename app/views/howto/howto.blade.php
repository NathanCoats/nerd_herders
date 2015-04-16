@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
	<div class = 'container'>
		<div id = 'msg'></div>
		@if(!empty($howto))
			<h2 class = 'title'>{{$howto->name}}</h2>
			<h2>{{$howto->title}}</h2>
			<p>{{$howto->description}}</p>
			<p>{{$howto->instructions}}</p>
			<p>{{User::getNames($howto->poster_id)}}</p>
			@if(Auth::user()->_id == $howto->poster_id)
				<button type = 'button' class = 'btn btn-info' onclick = "window.location.href = '{{route('howto')}}/edit/{{$howto->_id}}'">Edit Tutorial</button><br />
				<button type = 'button' class = 'btn btn-danger' id = 'delete'>Delete Tutorial</button>
			@endif
		@else
			<p class = 'alert alert-warning'>Sorry, This Tutorial Does Not Exist.</p>
		@endif
	</div>
	<script>
		$(document).ready(function() {
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
@stop
