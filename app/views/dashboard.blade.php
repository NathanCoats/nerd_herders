@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')

<h2 class = 'title'>User Dashboard</h2>
<h2 class = 'title'>Welcome {{Auth::user()->first_name}}</h2>


@stop
