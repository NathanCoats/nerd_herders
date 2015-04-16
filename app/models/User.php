<?php

use Zizaco\ConfideMongo\ConfideMongoUser;

class User extends ConfideMongoUser {

    public static function getNames($id){
        $user = User::find($id);
        return $user->first_name." ".$user->last_name;
    }
}
