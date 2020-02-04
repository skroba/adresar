<?php

class Address extends Controller {
	public function index() {
		$dbc = new DAO;
		$results = $dbc->propertyAll();
		$data = ['1', '2'];
		return Controller::view('all', $results);
	}

}