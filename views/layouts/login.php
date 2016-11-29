<!DOCTYPE html>
<html lang="en">
<?= _view("partials/head"); ?>
<body>
	<?= _view("partials/header"); ?>
	<div>
		<?php if(!\App\Session::isLoggedIn()){ ?>
            <form method="post" action="/login" class="login-form">
				<input type="text" placeholder="Username" name="username">
				<input type="password" placeholder="Password" name="password">
				<input type="submit" value="Login">
            </form>
	    <?php } ?>
	</div>
	<?= _view("partials/footer"); ?>
</body>
</html>