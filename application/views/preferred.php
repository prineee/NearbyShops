
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

			foreach ($shops as $shop) {
				?>

				<div class="col-sm-3">

					<div class="col card">
						<div class="card-body">
							<h5 class="card-title"><?php echo $shop['name']; ?></h5>
							<img class="card-img-top" src="<?php echo $shop['img']; ?>" alt="Card image cap">
							<p class="card-text"><?php echo $shop['description']; ?></p>

							<form method="post" action="preferred/user_action">
								<button name="unlike" type="^submit" class="btn btn-lg btn-info btn-block" value="<?php echo $shop['id']; ?>">Unlike</button>
							</form>

						</div>
					</div>

				</div>

				<?php
			}

			?>

		</div>

	</div>
