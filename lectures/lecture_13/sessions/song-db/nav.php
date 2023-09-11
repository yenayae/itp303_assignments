<nav class="container-fluid bg-light p-2">
	<div class="row">
		<div class="col-12 d-flex">

			<?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) : ?>
				<a class="text-center p-2 ml-auto" href="../login/login.php">Login</a>
			<?php else : ?>
				<div class="text-center p-2 ml-auto">Hello <?php echo $_SESSION['username'] ?>!</div>

				<a class="text-center p-2" href="../login/logout.php">Logout</a>
			<?php endif; ?>
		</div>
	</div> <!-- .row -->
</nav>