<?php
class UsersTableSeeder extends Seeder {

  public function run()
  {
    $user = new User;
    $user->id = 1;
    $user->username = 'coanat40';
    $user->email = 'foo@bar.com';
    $user->first_name = "Nathan";
    $user->last_name  = "Coats";
    $user->confirmed = 1;
    $user->password = '12345678';
    $user->password_confirmation = '12345678';
    $user->confirmation_code = md5(uniqid(mt_rand(), true));

    if(! $user->save()) {
      Log::info('Unable to create user '.$user->username, (array)$user->errors());
    } else {
      Log::info('Created user "'.$user->username.'" <'.$user->email.'>');
    }

    $user2             = new User;
    $user->id          = 2;
    $user2->username   = 'Admin';
    $user2->first_name = "Bob";
    $user2->last_name  = "Hope";
    $user2->email      = 'gason@nerdherders.org';
    $user->confirmed   = 1;
    $user2->password   = '12345678';
    $user2->password_confirmation = '12345678';
    $user2->confirmation_code = md5(uniqid(mt_rand(), true));

    if(! $user2->save()) {
      Log::info('Unable to create user '.$user2->username, (array)$user2->errors());
    } else {
      Log::info('Created user "'.$user2->username.'" <'.$user2->email.'>');
    }
  }
}