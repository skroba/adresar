<?php

class Address extends Controller {

	public function index() {
		$dbc = new Dao;
		$results = $dbc->propertyAll();
		return Controller::view('all', $results);
	}

	public function create() {

		if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['address'])) {
			$dbc = new Dao;
			$dbc->indexCreate($_POST['name'], $_POST['surname'], $_POST['address']);
			$_SESSION['message'] = 'User added!';
			return Controller::view('create');
		} else {
			$_SESSION['message'] = 'Please provide data for all fields!';
			return Controller::view('create');
		}
	}

	public function show($id) {
		$dbc = new Dao;
		if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['address'])) {
			$dbc->indexUpdate($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['id']);
			$_SESSION['message'] = 'Updated!';
		}
		if (empty($id)) {
			$id = $_POST['id'];
		}
		$results = $dbc->indexShow($id);
		return Controller::view('show', $results);
	}

	public function find() {
		$dbc = new Dao;
		if (isset($_POST['search'])) {
			$results = $dbc->indexFind($_POST['search']);
			return Controller::view('find', $results);
		}
		$results = $dbc->indexFind($_GET['search']);
		return Controller::view('find', $results);
	}

	public function destroy($id) {
		$dbc = new Dao;
		$dbc->indexDestroy($id);
		$this->index();
	}
}