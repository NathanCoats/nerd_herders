<?php

	class Message extends MongoLid {

	    protected $collection     = 'message';
	    protected $guarded   = array();
	    public $incrementing = true;
	    public $timestamps   = true;
	    public $softdeletes  = true;

		public function readMe(){
			$this->is_read = 1;
			$this->save();
			return $this;
		}
	}
