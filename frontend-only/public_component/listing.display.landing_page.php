<?php foreach ($property_data as $property): ?>
	<div class="col-12 col-md-4">
		<form class="container mt-3 " action="landing.listing.view.php" method="post">
			<div class="card shadow">
				<div class="card-header d-flex align-items-center">
					<img src="image/profile_image/<?= htmlspecialchars($property['profile_picture']) ?>" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px;">
					<div>
						<h6 class="card-title mb-0"> <?= htmlspecialchars($property['fullname']) ?> </h6>
						<small class="text-muted"><?= htmlspecialchars($property['post_created_at']) ?></small>
					</div>
				</div>
				<img src="image/post_property_image/<?= htmlspecialchars($property['post_images']) ?>" alt="Property" class="card-img-top img-fluid" style="width:100%; height:300px;">
				<div class="card-body">
					<h5 class="card-title"><?= htmlspecialchars($property['post_title']) ?></h5>
					<h6 class="mb-2">₱<?= htmlspecialchars($property['post_price']) ?></h6>
					<div class="d-flex justify-content-between mb-2">
						<small class="text-muted"><?= htmlspecialchars($property['room_count']) ?> Rooms • <?= htmlspecialchars($property['bathroom_count']) ?> Baths • <?= htmlspecialchars($property['sqr_meters']) ?> m²</small>
					</div>
					<p class="card-text small"><i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($property['post_location']) ?></p>
					<div class="d-flex justify-content-between align-items-center">
                        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($property['post_id']); ?>">
                        <input type='submit' class="btn btn-sm text-light" value='View Post' style="background-color: #A5B68D">
					</div>
				</div>
			</div>
		</form>
	</div>
<?php endforeach; ?>