<?php

class MessageController extends Controller {

	public function inbox(){
		$id                 = Auth::user()->_id;
		$messages      = Message::where('to_id','=',$id)->orderBy('updated_at','DESC')->get();
		$inbox_count = Message::where('is_read','=',0)->count();
		$draft_count  = Message::where('from_id', '=', $id)->where('is_sent','=',0)->count();

		$ms = [];

		$data = [
		'inbox_count' => $inbox_count,
		'draft_count' => $draft_count,
		'messages'    => $messages
		];
		return View::make('message.inbox',$data);
	}

	public function drafts(){
		$id  = Auth::user()->_id;
		$drafts = Message::where('from_id','=',$id)->where('is_sent', '=', 0)->get();
		$inbox_count = Message::where('is_read','=',0)->count();
		$draft_count  = Message::where('from_id', '=', $id)->where('is_sent','=',0)->count();

		$data = [
			'inbox_count' => $inbox_count,
			'draft_count' => $draft_count,
			'drafts'          => $drafts,
		];
		return View::make('message.drafts',$data);
	}

	public function sent(){
		$id     = Auth::user()->_id;
		$inbox_count = Message::where('is_read','=',0)->count();
		$draft_count  = Message::where('from_id', '=', $id)->where('is_sent','=',0)->count();
		$sent = Message::where('from_id','=',$id)->where('is_sent', '=', 1)->get();

		$data = [
			'inbox_count' => $inbox_count,
			'draft_count' => $draft_count,
			'sent'          => $sent,
		];
		return View::make('message.sent',$data);
	}

	public function compose(){
		$users = User::all();
		$id     = Auth::user()->_id;
		$inbox_count = Message::where('is_read','=',0)->count();
		$draft_count  = Message::where('from_id', '=', $id)->where('is_sent','=',0)->count();
		$data = [
			'users' => $users,
			'inbox_count' => $inbox_count,
			'draft_count' => $draft_count
		];
		return View::make('message.compose',$data);
	}

	public function edit(){
		try{
			$id = Input::get('id');
			$object = Message::find($id);
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
			$params = Input::get('params');
			$to     = Input::get('to');
			foreach($to as $msg)
			{
				$t = intval($msg);
				if($t != 0 && $t != "" && $t != null){
					$object = new Message;
					foreach ($params as $i => $param) {
						if(!empty($i) && $i != null && $i != ""){
							$object->{$i} = $param;
						}
					}
					$object->to_id = $t;
				}
			}
			$object->is_sent = 1;
			$object->save();
			return 'true';
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
	public function readMe(){
		try{
			$id = Input::get('id');
			Message::where('id','=',$id)->update(array('is_read' => 1));
			return 'true';
		}
		catch(Exception $e){
			return $e->getMessage;
		}
	}

	public function delete(){
		try{
			$id = Input::get('id');
			$object = Message::find($id);
			if($object->delete()){
				return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}
