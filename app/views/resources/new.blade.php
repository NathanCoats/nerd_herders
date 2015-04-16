@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
    <div id = 'msg'></div>
    <h2 class = 'title'>New Resource</h2>
    <div class = 'formRow'>
        <form id = 'myForm' action = "{{route('resources.upload')}}" class = "dropzone" id = "my-awesome-dropzone" method = "post" enctype = "multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
            <input id = 'file' type = "file" name = "file">
            <button type = 'submit' class = 'btn btn-success'>Upload</button>
        </form>
    </div>
<style>
.formRow
{
    float:none;
    margin-top: 15px;
    margin-bottom: 15px;
}
#file
{
    margin: auto;
    padding-left:80px;
    margin-top:30px;
    margin-bottom:30px;
}
#myForm > div
{
    display:none;
}
</style>
{{HTML::script('js/dropzone.js')}}
<script>
</script>
@stop
