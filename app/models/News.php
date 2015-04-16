<?php

	class News extends MongoLid {

	    protected $collection = 'news';
	    public $timestamps = true;
	    public $softdeletes = true;
	}
