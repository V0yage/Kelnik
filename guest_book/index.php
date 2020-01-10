<?php
	include_once('general.php');
	
	$query = mysqli_query($dbLink, 'SELECT * FROM posts ORDER BY date DESC LIMIT 5');
	$posts = [];
	while ($resultRow = mysqli_fetch_assoc($query)) {
		$posts[] = $resultRow;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<header>
			<div class="container">
				<h1>Guest book</h1>
			</div>
		</header>
		<section class="main">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="last-posts">
							<div class="h2">Posts list</div>
							<ul class="posts-list">
								<?php foreach ($posts as $post): ?>
								<li class="post">
									<div class="post-header">
										<div class="post-title"><?= $post['name'] ?></div>
										<div class="show-more badge"></div>
									</div>
									<div class="post-info">
										<p class="post-text"><?= $post['text'] ?></p>
										<div class="post-date"><?= $post['date'] ?></div>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="col-6">
						<div class="add-post">
							<div class="add-post-header">
								<div class="h2">Append new post</div>
							</div>
							<div class="add-post-body">
								<form>
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" name="name" value="name value" required>
									</div>
									<div class="form-group">
										<label for="text">Post text</label>
										<textarea name="text" rows="5" required>text value</textarea>
									</div>
									<div>
										<input type="submit" class="btn btn-primary" value="Append">
										<input type="button" class="btn btn-default" value="Clear">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<script src="script.js"></script>
	</body>
</html>