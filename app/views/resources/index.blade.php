@extends('layouts.admin')
<?php
/*
*
*/
?>

@section('content')
{{HTML::style('css/video-js.css')}}
<style>
.fade
{
	display:none;
}
</style>
<div id = 'msg'></div>
<h2 class = 'title'>Resources</h2>
	@if(!empty($resources))
	<div class = 'container'>
		<table id = 'resourcesTable' class = 'table table-striped table-hover'>
			<thead id = 'tableHeader'>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Location</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($resources as $i => $resource)
					<tr>
						<td><a href = '{{route("resources")}}'>{{$resource->name}}</a></td>
						<td>{{$resource->type}}</td>
						<td>{{$resource->location}}</td>
						<td>
							<input type = 'hidden' id = 'resource_id' value = '{{$resource->_id}}'>
							<a class = 'glyphicon glyphicon-remove remove icons' data-toggle="tooltip"  data-placement="top" title="Remove Resource"></a>
							<a class = 'glyphicon glyphicon-eye-open view icons'  data-toggle="tooltip" data-placement="top" title="View Resource"></a>
							<a class = 'glyphicon glyphicon-download download icons' data-toggle="tooltip" data-placement="top" title="Download Resource"></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@else
		<p class = 'alert alert-warning'>There are Currently No Resources</p>
	@endif
<button class = 'btn btn-success addresource'>+ Upload Resource</button>
<div class="modal fade" id="my-asset-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close closeMe" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h4 class="modal-title" id="my-modal-label"></h4>
	</div>
	<div class="modal-body" id = 'my-modal-body'>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger closeMe" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-info downloadMe">Download Resource</button>
	</div>
	</div>
</div>
</div>
{{HTML::script('js/video.js')}}
<script>
	$(document).ready(function() {
		$('#my-asset-modal').modal('hide');
		var asset_id;

		$(document).on('click','.closeMe',function(){
				$('#my-asset-modal').modal('hide');
		});

		$(document).on('click','.view',function(){
			var th = $(this);
			var obj = JSON.parse('{{json_encode($resources)}}');
			var sArray = [];
			$.each(obj, function(index, val) {
				var datta = {id:val.id,location:val.location,name:val.name,type:val.type};
				sArray[val.id] = datta;
			});
			var id = $(th).parent().find('#resource_id').val();
			asset_id = id;
			var resource = sArray[id];
			var src = resource.location + resource.name;
			if(resource.type == 'mp4' || resource.type == 'avi' || resource.type == 'swf' || resource.type == 'm4v' || resource.type == 'webm'){
				var data = "<video id='video' class='video-js vjs-default-skin' controls preload='auto' width='640' height='264' poster='' data-setup='{}'>"+
				"<source src='/"+src+"' type = 'video/"+resource.type+"'>"+
				"<p class='vjs-no-js'>"+
					"To view this video please enable JavaScript, and consider upgrading to a web browser"+
					"that <a href='http://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>"+
				"</p></video>";
			}
			else if (resource.type == 'mp3' || resource.type == 'flac' || resource.type == 'wav' || resource.type == 'm4a'){
				var data = "<video id='video' class='video-js vjs-default-skin' controls preload='auto' width='640' height='264' data-setup='{}'>"+
				"<source src='/"+src+"' type = 'audio/"+resource.type+"'>"+
				"<p class='vjs-no-js'>"+
					"To view this video please enable JavaScript, and consider upgrading to a web browser"+
					"that <a href='http://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>"+
				"</p></video>";
			}
			else
			{
				var data = "<embed id = 'embed' src='{{asset('resources')}}/"+resource.name+"' ></embed>";
			}

			$('#my-modal-body').html(data);
			$('#my-modal-label').html(resource.name);
			$('#my-asset-modal').modal('show');
		});

		$('.addresource').click(function(){
			window.location = "{{route('resources.new')}}";
		});

		$(document).on('click','.remove',function(){
			var c = confirm("Are You Sure You Want To Delete This Resource? This Action Cannot Be Undone!");
			if(c){
				var id = $(this).parent().find('#resource_id').val();
				$(this).parent().parent().remove();
				$.post('{{route("resources.delete")}}',
				{id:id},
				function(data, textStatus, xhr) {
					if(data == 'true'){
						var msg = "<div class='alert alert-success myMsg' role='alert'>The Resource Was Successfully Deleted!</div>";
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
		});

		$(document).on('click','.download',function(){
			var id = $(this).parent().find('#resource_id').val();
			var temp = '{{route("download")}}';
			var spot = temp.lastIndexOf('/');
			var url = temp.substr(0,spot + 1);
			url += id
			window.location = url;
		});

		$('.downloadMe').click(function(){
			var temp = '{{route("download")}}';
			var spot = temp.lastIndexOf('/');
			var url = temp.substr(0,spot + 1);
			url += asset_id;
			window.location = url;
		});


		$('#resourcesTable').dynatable();
	});
</script>
@stop
