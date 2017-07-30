<?php
require_once '../../Controller/users_controller.php';

$usersData = new UsersController();
$users = $usersData->findById($_GET['id']);

?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/users_controller.php" method="post">
		<h2> Are you sure you want to delete </h2>
		<input type="hidden" name="action" value="delete"/>
		<input type="hidden" name="data[User][id]" value="<?php echo $users['User']['id']; ?>"/>
		<label><?php echo $users['User']['firstname']." ".$users['User']['lastname']; ?></label>
		<br>
		<input class="button green wid25" type="submit"  value="Yes"/>
		<input class="button red wid25"  type="button"  value="Cancel"/>
	</form>
</body>
</html>
