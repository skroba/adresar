<?php require_once __ROOT__ . '/imenik/views/assets/header.php';?>
   <div class="container">
<?php require_once __ROOT__ . '/imenik/views/assets/nav-bar.php';?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Insert New User</h1>
                <p>new.php</p>
      </div>
    </div>
     <?php
if (isset($_SESSION['message'])) {
	echo " <div class=\"alert alert-success\">
  <strong>";
	echo $_SESSION['message'];
	unset($_SESSION['message']);
	echo '</strong></div>';
}
?>

    <hr>
      <form action="/imenik/index.php/store" method="POST">
          <div class="form-group">
            <input type="text" name="name" id="name" aria-describedby="name" placeholder="Enter name">
             <input type="text" name="surname" id="surname" aria-describedby="surname" placeholder="Enter surname">
              <input type="text" name="address" id="adress" aria-describedby="adress" placeholder="Enter adress">
          </div>
          <button  type="submit" class="btn btn-primary">New user</button>
        </form>
       </div>
<?php require_once __ROOT__ . '/imenik/views/assets/footer.php';?>