<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\InvalidUserException;
use Illuminate\Database\Eloquent\RuntimeException;
class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		try{
			$email = Input::get('email');
			$count = User::where('email','=',$email)->count();
			if($count > 0){
				switch ($response = Password::remind(Input::only('email'), function($message)
				{
				    $message->subject('Password Reminder');
				}))
				{
					case Password::INVALID_USER:
						throw new Exception("I'm Sorry, That Email Has Not Yet Been Registered.");

					case Password::REMINDER_SENT:
						return 'true';
				}
			}
			else{
				throw new Exception("I'm Sorry, That Email Has Not Yet Been Registered.");
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token)
	{
		if (is_null($token)) App::abort(404);
		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		try{
			$credentials = Input::only(
				'email', 'password', 'password_confirmation', 'token'
			);

			$response = Password::reset($credentials, function($user, $password)
			{

				$user->password = Hash::make($password);
				$user->save();
			});

			switch ($response)
			{
				case Password::INVALID_PASSWORD:
				case Password::INVALID_TOKEN:
				case Password::INVALID_USER:
					throw new Exception("Either Your Email is Incorrect or You Have Already Reset Your Password.");

				case Password::PASSWORD_RESET:
					return 'true';
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

}
