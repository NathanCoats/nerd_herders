@extends('layouts.message')
<?php
/*
*
*/
?>
@section('content')
    <h1 class = 'title'>Compose</h1>
    <div class = 'content'>
        <form id = 'myForm'>
            <div class = 'col-lg-8'>
                <label for = 'to'>To: </label>
                <input type = 'text'  id = 'to' required/>
            </div>
            <div class = 'col-lg-8'>
                <label for = 'title'>Message Subject: </label>
                <input type = 'text' class = 'form-control' id = 'title' value = ""/>
            </div>
            <div class = 'col-lg-8'>
                <label for = 'new_message'>Message: </label>
                <textarea id = 'new_message' class = 'form-control' placeholder 'You Message Goes Here.'></textarea>
            </div>
            <button type = 'submit' id = 'send' class = 'btn btn-success'>Send Message</button>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            var obj = JSON.parse('{{json_encode($users)}}');
            $('#to').select2({
                multiple: true
                ,query: function (query){
                    var data = {results: []};
                    $.each(obj, function(){
                        if(this.first_name != undefined && this.first_name != ""){
                            data.results.push({id: this.id, text: this.first_name +" "+ this.last_name });
                        }
                    });
                    query.callback(data);
                }
            });
            $('.select2-choices').addClass('form-control');

            $('#myForm').submit(function(event){
                event.preventDefault();
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
        });
    </script>

@stop
