
	<!-- Page Name -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-3">Account Registration</h1>
			</div>
		</div>
	</div>

	<!-- Page Content -->
	<div class="container h-100">

		<div class="row h-100 mt-5 justify-content-center align-items-center">

				<div class="col-3.5 card">

					<div class="card-body">

						<?php

						$validation_errors = validation_errors();
						
						echo '<ul>';

						if( ! empty($validation_errors) ) {
							echo $validation_errors;
						}

						echo '</ul>';

						?>

						<form action="<?php echo base_url('register'); ?>" method="post">
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" title="A valid email address is required" autofocus required>
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input id="password" name="password" type="password" class="form-control" placeholder="Create strong password" title="A strong password of at least 8 characters is required" required>
							</div>

							<input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">

							<div class="text-center">
								<button id="submit" name"register" type="submit" class="btn btn-primary">Register</button>
							</div>
						</form>

					</div>

				</div>

		</div>

	</div>
