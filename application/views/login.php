
	<!-- Page Name -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-3">Account Login</h1>
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

						if( isset($custom_error) ) {
							echo '<li>'.$custom_error.'</li>';
						}

						echo '</ul>';

						if($new_user == TRUE) {
							echo '
							<div class="alert alert-success fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>

								Account registered successfully!<br>
								Please login below to continue
							</div>

							<?php
						}

						?>
						
						<form action="<?php echo base_url('login'); ?>" method="post">
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" name="email" type="email" class="form-control" placeholder="Your email" autofocus required>
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input id="password" name="password" type="password" class="form-control" id="password" placeholder="Your password" required>
							</div>

							<input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">

							<div class="text-center">
								<button id="submit" name"register" class="btn btn-primary">Login</button>
							</div>
						</form>

					</div>

				</div>

		</div>

	</div>
