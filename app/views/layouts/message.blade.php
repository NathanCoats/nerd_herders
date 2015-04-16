@extends('layouts.admin')
<?php
/*
*
*/
?>
@section('content')

{{HTML::style('css/metro-bootstrap.css')}}
<style>
#sidebar
{
    width:30%;
    height:100%;
    float:left;
    margin-top: -40px;
}
#content
{
    width:69%;
    height: 100%;
    float:left;
    margin-top:  -40px;
}
.metro .sidebar,.metro .sidebar > ul li a
{
    background: #415f41;
}
#unhide
{
    float:left;
    margin-top: 22%;
    background: #415f41;
    color:white;
    width:20px;
    height: 20px;
}
.metro .sidebar > ul li.active a
{
    background: #172e1b;
}
.col-lg-8
{
    margin: 20px auto;
}
#unhide:hover
{
    cursor:pointer;
}
#s2id_to
{
    width:100%;
}
</style>

<div id = 'sidebar' class = 'metro'>
    <nav class="sidebar">
        <ul>
            <li class="title">Actions</li>
            <li class="active" id = 'compose'><a href="{{route('message.compose')}}">Compose A New Message</a></li>
            <li id = 'inbox'>
                @if($inbox_count > 0)
                    <a href="{{route('message.inbox')}}">View Inbox <small>({{$inbox_count}})</small></a>
                @else
                    <a href="{{route('message.inbox')}}">View Inbox</a>
                @endif
            </li>
            <li><a href="#" id ='sent'>View Sent Messages</a></li>
            <li>
                @if($draft_count > 0)
                    <a href="{{route('message.drafts')}}">View Drafts <small>({{$draft_count}})</small></a>
                @else
                    <a href="{{route('message.drafts')}}">View Drafts</a>
                @endif
            </li>
            <li><a id = 'hide' href = "#" class = 'glyphicon glyphicon-align-justify'></a></li>
        </ul>
    </nav>
</div>
<div id = 'unhide' class = 'glyphicon glyphicon-align-justify'></div>
<div id = 'content'>
</div>
{{HTML::script('js/jquery.widget.min.js')}}
{{HTML::script('js/metro-dropdown.js')}}
<script>
    $(document).ready(function() {
        $('#unhide').hide();
        $('#hide').click(function(){
            $("#sidebar").toggle( "slide" );
            $('#unhide').show();
        });
        $('#unhide').click(function(){
            $( "#sidebar" ).toggle( "slide" );
            $('#unhide').hide();
        });

        $(document).on('click','.get_message',function(){
            var id = $(this).parent().parent().find('.message_id').val();
            var message = message_array[id];
            var page = "<h2 class = 'title'>"+message.subject+"</h2>";
            page += "<h5 class = 'sender'>"+message.sender+"</h5>";
            page += "<p class = 'message'>"+message.message+"</p>"
            if(message.is_read == 0){
                $.post('{{route("message.read")}}',
                {id:id},
                function(data, textStatus, xhr) {

                });
                }
            $('#content').html(page);
        });

        $(document).on('click','#send',function(){

            var to = $("#to").select2("val");
            var from_id = {{Auth::User()->_id}};
            var title = $('#title').val();
            var message = $('#new_message').val();

            var params = {from_id:from_id,message:message,title:title};
            $.post('{{route("message.submit")}}',
            {to:to,params:params},
            function(data, textStatus, xhr) {
                alert(data);
            });
        });
</script>
@stop
