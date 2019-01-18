	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
	  <div class="container">
		<a class="navbar-brand" href="<?php echo base_url(); ?>">Nearby Shops</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
		  <ul class="navbar-nav ml-auto">

			<?php

			$isSignedIn = TRUE;

			if( $isSignedIn ) {
				?>

				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('nearby'); ?>">Nearby Shops</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('preferred'); ?>">My Preferred Shops</a>
				</li>

				<?php
			} else {
				?>

				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('register'); ?>">Register</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('signin'); ?>">Signin</a>
				</li>

				<?php
			}

			?>

		  </ul>
		</div>
	  </div>
	</nav>
