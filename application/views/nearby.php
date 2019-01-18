
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

							<form method="post" action="nearby/user_action">
								<button name="like" type="submit" class="btn btn-lg btn-success" value="<?php echo $shop['id']; ?>">Like</button>
								<button name="dislike" type="submit" class="btn btn-lg btn-danger pull-right" value="<?php echo $shop['id']; ?>">Dislike</button>
							</form>

						</div>
					</div>

				</div>

				<?php
			}

			?>

		</div>

	</div>
