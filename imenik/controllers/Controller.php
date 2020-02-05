<?php

class Controller {

	public static function view($page, $data = []) {
		$_SESSION['data'] = $data;
		require './views/' . $page . '.php';
	}
}
