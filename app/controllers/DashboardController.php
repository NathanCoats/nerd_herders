<?php

class DashboardController extends Controller {

	public function index(){
		$data = [
			''=> ''
		];
		return View::make('dashboard',$data);
	}
}
