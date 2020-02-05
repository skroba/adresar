<?php require_once __ROOT__ . '/imenik/views/assets/header.php';?>
    <div class="container">
<?php require_once __ROOT__ . '/imenik/views/assets/nav-bar.php';?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Find user</h1>
        <p>all.php</p>
      </div>
    </div>
<?php
if (isset($_SESSION['message'])) {
	echo " <div class=\"alert alert-success\"><strong>";
	echo $_SESSION['message'];
	unset($_SESSION['message']);
	echo '</strong></div>';
}
?>
    <hr>
      <form action="/imenik/index.php/find" method="POST">
          <div class="form-group">
            <input type="text" name="search" id="search" placeholder="Find User" label="Find" required="">
          </div>
          <button  type="submit" class="btn btn-primary">Search...</button>
        </form>
        <div>
    <br>

              <?php if (!empty($_SESSION['data'])) {
	echo " <div class=\"alert alert-success\"><strong>";
	echo "Available contacts" . count($_SESSION['data']);
	echo '</strong></div>';
	echo "<table class=\"table\">
              <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Address</th>
                <th>Action</th>
              </tr>";
	for ($i = 0; $i < 3; $i++) {
		foreach ($_SESSION['data'] as $user) {
			echo '
                  <tr>
                    <td>' . $user['name'] . '</td>
                    <td>' . $user['surname'] . '</td>
                    <td>' . $user['address'] . '</td>
                    <td><ul>
  <li class="btn "><a href="/imenik/index.php/show?' . $user['id'] . '">Edit</a> </li>
  <li class="btn "><a href="/imenik/index.php/delete?' . $user['id'] . '">Delete</a> </li>
</ul></td>
                  </tr>';
		}

	}
	echo "
                </table>";
	unset($_SESSION['data']);
} else {
	if (isset($_SESSION['data'])) {
		unset($_SESSION['data']);
		echo "Can't find anything ";
	} else {
		echo "";
	}
}
?>
        </div>
       </div>

     </div>
<?php require_once __ROOT__ . '/imenik/views/assets/footer.php';?>