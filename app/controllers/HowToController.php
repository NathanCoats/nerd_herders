<?php

class HowToController extends Controller {

	public function index(){
		$tutorials = HowTo::all()->sort( ['created_at'=>1] );
		$data = [
			'tutorials' => $tutorials
		];
		return View::make('howto.index',$data);
	}

	public function view($id){
		$howto = HowTo::find($id);
		$data = [
			'howto' => $howto
		];
		return View::make('howto.howto',$data);
	}

	public function create(){
		$data = [];
		return View::make('howto.create',$data);
	}
	public function edit($id){
		$howto = HowTo::find($id);
		$data = [
			'howto' => $howto
		];
		return View::make('howto.edit',$data);
	}

	public function submitEdit(){
		try{
			$id = Input::get('id');
			$object = HowTo::find($id);
			$params = Input::get('params');

			foreach ($params as $i => $param) {
				if(!empty($i) && $i != null && $i != ""){
					$object->{$i} = $param;
				}
			}
			if($object->save()){
				return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function submit(){
		try{
			$object = new HowTo;
			$params = Input::get('params');

			foreach ($params as $i => $param) {
				if(!empty($i) && $i != null && $i != ""){
					$object->{$i} = $param;
				}
			}
			if($object->save()){
				return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function delete(){
		try{
			$id = Input::get('id');
			$object = HowTo::find($id);
			if($object->delete()){
				return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}
