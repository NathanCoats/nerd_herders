<?php

class AccountController extends Controller {

	public function account(){
		$user = User::find(Auth::user()->_id);
		$data = [
			'user' => $user
		];
		return View::make('account',$data);
	}

	public function editAccount(){
		try{

			$id = Auth::user()->_id;
			$values = Input::get('params');
			$admin = User::find($id);

			$info = array(
				'First_Name' => $values['first_name'],
				'Last_Name' => $values['last_name']
				);
			$rules = array(
				'First_Name' => 'required|min:2',
				'Last_Name' => 'required|min:2'
				);
			if($values['email'] != $admin->email)
			{
				$info['Email']  = $values['email'];
				$rules['Email'] = "required|email|unique:admin";
			}

			$validator = Validator::make($info,$rules);
			if ($validator->fails())
			{
				$msg = "";
			   foreach ($validator->messages()->toArray() as $i => $message){

			   		$msg .= " $i: ";
			   		foreach ($message as $k => $fail) {
			   			$msg .= " $fail: ";
			   		}
			   }
			   return $msg;
			}
			$pass = Input::get('pass');
			if(isset($pass) && $pass != "")
			{
				if(strlen ($pass) < 8 )
				{
					return 'Your Password Must be at least 8 Characters';
				}
			}

			$admin->update(array('password'=> Hash::make($pass)));

			foreach ($values as $field => $value)
			{
				$admin->update(array($field => $value));
			}

			return 'You Successfully updated Your Account Info.';
		}
		catch (Exception $e){
			return $e;
		}
	}
}
