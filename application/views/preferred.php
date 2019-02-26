
	<!-- Page Name -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-3">My Preferred Shops</h1>
			</div>
		</div>
	</div>

	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<?php

			if( empty($preferred) ) {
				?>

				<div class="col-lg-12 text-center">
					<h5 class="mt-3">You don't have any preferred shops yet</h5>
				</div>

				<?php
			} else  {
				foreach ($preferred as $id => $shop) {
					?>

					<div class="col-sm-3 mt-3">

						<div class="col card">
							<div class="card-body">
								<h5 class="card-title"><?php echo $shop['name']; ?></h5>
								<img class="card-img-top" src="<?php echo $shop['image']; ?>" alt="Card image cap">
								<p class="card-text"><?php echo $shop['description']; ?></p>

								<form method="post" action="preferred">
									<input name="id" type="hidden" value="<?php echo $id; ?>">
									<button name="action" type="^submit" class="btn btn-lg btn-info btn-block" value="unlike">Remove</button>
								</form>

							</div>
						</div>

					</div>

					<?php
				}
			}

			?>

		</div>

	</div>
