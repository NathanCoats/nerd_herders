@extends('layouts.message')
<?php
/*
*
*/
?>
@section('content')

    <h1 class = 'title'>My Messages</h1>

    <div class = 'container'>
        <table class = 'table table-bordered' id = 'inbox_table'>
            <thead>
                <tr>
                    <th id= 'delete'>Delete</th>
                    <th>Message Subject</th>
                    <th>Sender</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $i => $message)
                    @if($message->is_read == 1)
                        <tr class = 'is_old'>
                    @else
                        <tr class = 'is_new'>
                    @endif
                        <input type = 'hidden' class = 'message_id' value = '{{$message->_id}}'>
                        <td>
                            <input type = 'checkbox' class = 'check'>
                        </td>
                        <td>
                            <a class = 'get_message' href = ''>{{$message->title}}</a>
                        </td>
                        <td>{{User::getNames($message->from_id)}}</td>
                        <td>{{date('F j g A',$message->updated_at->sec)}}</td>
                    </tr>
                @endforeach
            </tbody>
        <table>
    </div>
    <script>
        $(document).ready(function(){
            var messages = JSON.parse('{{json_encode($messages)}}');
            var message_array = [];
            $.each(messages, function(index, val) {
                 var temp = {};
                 temp.message = val.message;
                 temp.sender  = val.sender;
                 temp.receiver  = val.receiver;
                 temp.is_read  = val.is_read;
                 temp.id  = val.id;
                 temp.subject  = val.subject;
                 message_array[val.id] = temp;
            });
        });
    </script>

@stop
