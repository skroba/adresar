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
            <input type="text" name="search" id="search" placeholder="Find User" label="Find" required>
          </div>
          <button  type="submit" class="btn btn-primary">Search...</button>
        </form>
        <div>
    <br>

  <?php if (!empty($_SESSION['data'])) {
	if (!isset($_GET['page'])) {
		$_GET['page'] = 0;
	}

	$num = ceil(count($_SESSION['data']) / 3);
	echo " <div class=\"alert alert-success\"><strong>";
	echo "Available contacts: " . count($_SESSION['data']);
	echo '</strong></div>';
	echo "<table class=\"table\">
              <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Address</th>
                <th>Action</th>
              </tr>";
	for ($i = $_GET['page']; $i < $_GET['page'] + 3; $i++) {
		if (!empty($_SESSION['data'][$i])) {
			echo '
                  <tr>
                    <td>' . $_SESSION['data'][$i]['name'] . '</td>
                    <td>' . $_SESSION['data'][$i]['surname'] . '</td>
                    <td>' . $_SESSION['data'][$i]['address'] . '</td>
                    <td>
                    <ul>
  <li class="btn btn-warning "><a style="color:white" href="/imenik/index.php/show?' . $_SESSION['data'][$i]['id'] . '">Edit</a> </li>
  <li class="btn btn-danger"><a  style="color:white" href="/imenik/index.php/delete?' . $_SESSION['data'][$i]['id'] . '">Delete</a> </li>

</ul>
</td>
                  </tr>';
		}

	}

	echo "
                </table>";
	echo "</div>";
	echo "<ul class=\"d-flex justify-content-center\">";
	for ($i = 0; $i < $num; $i++) {
		echo '<li class="btn btn-success"><a style= "color:white"  href="/imenik/index.php?page=' . $i * 3 . '">' . $i . '</a></li>';
	}
	echo '</ul>';
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
<?php require_once __ROOT__ . '/imenik/views/assets/footer.php';?>