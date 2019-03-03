
	<!-- Page Name -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-3">Shop Locator</h1>
			</div>
		</div>
	</div>

	<!-- Page Content -->
	<div class="container">

		<?php

		if($location === FALSE) {
			?>

			<div class="row">
				<div class="mx-auto">
					<button id="getLocation" class="btn btn-primary">Get Location</button>
				</div>
			</div>

			<?php
		}

		?>

		<div class="row">
			<div class="alert mx-auto mt-3 hidden" role="alert">
				<span id="alert"></span>
				<button type="button" class="close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>

		<div class="row">

			<?php

			if( empty($shops) ) {
				?>

				<div class="col-lg-12 text-center">
					<h5 class="mt-3">No shops available or nearby</h5>'
				</div>

				<?php
			} else  {
				foreach ($shops as $id => $shop) {
					?>

					<div class="col-sm-3 mt-3">

						<div class="col card">
							<div class="card-body">
								<h5 class="card-title"><?php echo $shop['name']; ?></h5>
								<img class="card-img-top" src="<?php echo $shop['image']; ?>" alt="Card image cap">
								<p class="card-text"><?php echo $shop['description']; ?></p>

								<form method="post" action="nearby">
									<input name="id" type="hidden" value="<?php echo $id; ?>">
									<button name="action" type="submit" class="btn btn-lg btn-success" value="like">Like</button>
									<button name="action" type="submit" class="btn btn-lg btn-danger pull-right" value="dislike">Dislike</button>
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
