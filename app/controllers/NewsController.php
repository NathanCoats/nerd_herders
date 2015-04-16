<?php

class NewsController extends Controller {

	public function index(){
		$news = News::all()->sort( ['created_at'=>1] );
		$data = [
			'news' => $news
		];
		return View::make('news.index',$data);
	}

	public function view($id){
		$news = News::find($id);
		$data = [
			'news' => $news
		];
		return View::make('news.news',$data);
	}

	public function anime(){
		$news = News::where(['type' => 'anime'])->sort( ['created_at'=>1] );
		$data = [
			'news' => $news
		];

		return View::make('news.anime',$data);
	}

	public function group(){
		$news = News::where(['type' => 'group'])->sort( ['created_at'=>1] );

		$data = [
			'news' => $news
		];

		return View::make('news.group',$data);
	}

	public function game(){
		$news = News::where(['type' => 'game'])->sort( ['created_at'=>1] );
		$data = [
			'news' => $news,
			'date' => ''
		];

		return View::make('news.game',$data);
	}

	public function create(){
		$data = [

		];
		return View::make('news.create',$data);
	}

	public function edit($id){
		try{
			$object = News::find($id);
			$data = [
				'news' => $object
			];
			return View::make('news.edit',$data);
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function submitEdit(){
		try{
			$id = Input::get('id');
			$params = Input::get('params');
			$object = News::find($id);

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
			$object = new News;
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
			$object = News::find($id);
			if($object->save()){
				return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}
