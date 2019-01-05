<?php

$pageSubTitle = "Home";

include("views/header.php");

include("views/navbar.php");

?>
     <!-- Page Content -->
    <div class="container">
      <div class="row">

        <div class="col-lg-12 text-center">

          <h1 class="mt-3">Web Coding Challenge</h1>
         
          <div class="jumbotron mt-3">
            <h1 class="display-4">Nearby Shops!</h1>
            <hr class="my-4">
            <p>Just a simple implementation of a web app that lists nearby shops.</p>
            <a class="btn btn-primary btn-lg" href="register" role="button">Register</a>
            <a class="btn btn-primary btn-lg" href="signin" role="button">Signin</a>
          </div>
        
        </div>

      </div>
    </div>

<?php

include("views/footer.php");

?>