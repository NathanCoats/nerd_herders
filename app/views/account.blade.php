@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
<div id = 'msg'></div>
	<h2 class = 'title'>User Account</h2>
	<form id = 'myForm'>
		<div class = 'row'>
			<div class = 'col-lg-8'>
				<label for 'first_name'>First Name:</label>
				<input type = 'text' class = 'form-control' id = 'first_name' value = "{{$user->first_name}}">
			</div>
			<div class = 'col-lg-8'>
				<label for 'last_name'>Last Name:</label>
				<input type = 'text' class = 'form-control' id = 'last_name'  value = "{{$user->last_name}}">
			</div>
		</div>
		<div class = 'row'>
			<div class = 'col-lg-8'>
				<label for 'phone'>Phone:</label>
				<input type = 'phone' class = 'form-control' id = 'phone'  value = "{{$user->phone}}">
			</div>
			<div class = 'col-lg-8'>
				<label for 'email'>Email:</label>
				<input type = 'text' class = 'form-control' id = 'email'  value = "{{$user->email}}">
			</div>
		</div>
		<div class = 'row'>
			<div class = 'col-lg-8'>
				<label for 'password'>Password:</label>
				<input type = 'password' class = 'form-control' id = 'password'>
			</div>
			<div class = 'col-lg-8'>
				<label for 'confirmPassword'>Confirm Password:</label>
				<input type = 'password' class = 'form-control' id = 'confirmPassword'>
			</div>
		</div>
	<div id = 'accountButtons'>
		<button type = 'reset' class = 'btn btn-warning'>Clear Fields</button>
		<button type = 'submit' class = 'btn btn-success'>Accept Changes</button>
	</div>
</form>
<script>
	$('#myForm').submit(function(event){
		var email = $('#email').val();
		var password = $('#password').val();
		var confirmPassword = $('#confirmPassword').val();

		if(password == confirmPassword){

			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var phone = $('#phone').val();
			var params = {
							first_name:first_name,
							last_name:last_name,
							phone:phone,
							email:email
						};
			$.post(
				'{{route("account.edit")}}',
				{params:params,pass:password,id:'{{$user->_id}}'},
				 function(data, textStatus, xhr) {
			 		if(data == 'true'){
				 		var msg = "<div class='alert alert-success myMsg' role='alert'><strong>Success!</strong> Account Was Successfully Updated.</div>";
				 		$('#msg').html(msg);
				 		$( "#msg" ).fadeIn("slow", function(){});
			 	  	}
			 	  	else{
			 	  		var msg = "<div class='alert alert-danger myMsg' role='alert'>"+data+"</div>";
			 	  		$('#msg').html(msg);
			 	  		$( "#msg" ).fadeIn("slow", function(){});
			 	  	}
			});
		}
		else {
			var msg = "<div class='alert alert-warning myMsg' role='alert'><strong> Passwords Did not Match.</strong></div>";
			$('#msg').html(msg);
			$( "#msg" ).fadeIn("slow", function(){});
		}
		event.preventDefault();
	});
</script>
@stop
