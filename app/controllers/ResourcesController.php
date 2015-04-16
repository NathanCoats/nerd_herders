<?php

class ResourcesController extends Controller {

	public function index(){
		try{
			$resources = Resources::all()->sort( ['created_at'=>1] );
			$data = ['resources' => $resources];
			return View::make('resources.index',$data);
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
public function upload(){
	try{
		$uploadSuccess = array();
		$data = array();
		$file = Input::file('file');
		$folder = 'resources/';
		$extension = $file->getClientOriginalExtension();
		$videos = ['mp4','m4v','ogg','webm'];
		$audio  = ['mp3','wav','flac','m4a'];
		$images  = ['jpg','jpeg','gif','png'];
		if(in_array(strtolower($extension),$videos)){
			$folder.= "videos/";
		}

		else if(in_array(strtolower($extension),$audio)){
			$folder.= "audio/";
		}

		else if(in_array(strtolower($extension),$images)){
			$folder.= "images/";
		}

		else if(strtolower($extension) == 'pdf'){
			$folder.= "pdfs/";
		}

		$filename = $file->getClientOriginalName();
		$data[] = array(asset($folder.$filename), $file->getClientOriginalName());
		array_push($uploadSuccess, $file->move($folder, $filename));

		if (in_array(FALSE, $uploadSuccess)) {
			return 'File Could Not be Uploaded at this time.';
		}
		else {
			$resource = new Resources();
			$resource->type = $extension;
			$resource->name = htmlspecialchars($filename,ENT_QUOTES,'UTF-8',true);
			$resource->location = $folder;
			if($resource->save()){
				return Redirect::to('resources');
			}
			return 'Your File was not uploaded please try again.';
		}
	}
	catch(Exception $e){
		return $e->getMessage();
	}
}
public function download($id){
	try{
		$resource = Resources::find($id);
		$location = $resource->location.htmlspecialchars_decode($resource->name,ENT_QUOTES);
		return Response::download($location);
	}
	catch(Exception $e){
		return $e->getMessage();
	}
}

public function add(){
	try{
		return View::make('resources.new');
	}
	catch(Exception $e){
		return $e->getMessage();
	}
}

public function delete(){
	try{
		$id = Input::get('id');
		$resource = Resources::find($id);
		$data = Data::getMe('resource_path');
		$path = $data.$resource->location.$resource->name;
		$resource->delete();
		unlink($path);
		return 'true';
	}
	catch(Exception $e){
		return $e->getMessage();
	}
}

}
