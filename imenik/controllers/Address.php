<?php

class Address extends Controller {

	public function index() {
		$dbc = new Dao;
		$results = $dbc->propertyAll();
		return Controller::view('all', $results);
	}

	public function create() {

		return Controller::view('new');
	}

	public function store() {

		if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['address'])) {
			$dbc = new Dao;
			$dbc->indexCreate($_POST['name'], $_POST['surname'], $_POST['address']);
			$_SESSION['message'] = 'User added!';
			return Controller::view('new');
		} else {
			$_SESSION['message'] = 'Please provide data for all fields!';
			return Controller::view('new');
		}
	}

	public function show($id) {
		$dbc = new Dao;
		$results = $dbc->indexShow($id);
		return Controller::view('show', $results);
	}

	public function find() {
		$dbc = new Dao;
		$results = $dbc->indexFind($_POST['search']);
		return Controller::view('find', $results);
	}

	public function update() {
		$dbc = new Dao;
		$dbc->indexUpdate($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['id']);
		$_SESSION['message'] = 'Updated!';
		return Controller::view('find');
	}

	public function destroy($id) {
		$dbc = new Dao;
		$dbc->indexDestroy($id);
		$this->index();
	}
}