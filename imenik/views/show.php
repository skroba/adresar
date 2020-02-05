<?php require_once __ROOT__ . '/imenik/views/assets/header.php';?>
    <div class="container">
<?php require_once __ROOT__ . '/imenik/views/assets/nav-bar.php';?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Edit user</h1>
                <p>show.php</p>
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

       <form action="/imenik/index.php/show?<?php echo $_SESSION['data'][0]['id'] ?>" method="POST">
          <div class="form-group">
            <input hidden type="text" name="id" id="id" aria-describedby="id" value="<?php echo $_SESSION['data'][0]['id']; ?>">
            <input type="text" name="name" id="name" aria-describedby="name" placeholder="Enter name" value="<?php echo $_SESSION['data'][0]['name']; ?>">
             <input type="text" name="surname" id="surname" aria-describedby="surname" placeholder="Enter surname" value="<?php echo $_SESSION['data'][0]['surname']; ?>">
              <input type="text" name="address" id="address" aria-describedby="address" placeholder="Enter adress"value="<?php echo $_SESSION['data'][0]['address']; ?>">
          </div>
          <button  type="submit" class="btn btn-warning">Update</button>
           <li class="btn btn-danger"><a style="color:white" href="/imenik/index.php/delete?<?php echo $_SESSION['data'][0]['id'] ?>">Delete</a> </li>
        </form>
        <div>

        </div>
       </div>

     </div>
<?php require_once __ROOT__ . '/imenik/views/assets/footer.php';?>