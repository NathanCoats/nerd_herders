<?php

class Data extends MongoLid
{
	protected $collection = 'data_config';
	public $guarded = array();
	public $incrementing = true;
	public $timestamps = true;

	public static function getMe($key){
		try{
			$data = Data::where(['key' => $key])->first();
			if(empty($data->_id)){
				throw new Exception("I'm Sorry That Value Does Not Exist.");
			}
			return $data->value;
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}
