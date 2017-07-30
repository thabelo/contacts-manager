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
		<h2> Edit User </h2>
		<input type="hidden" name="action" value="edit"/>
		<input type="hidden" name="data[User][id]" value="<?php echo $users['User']['id']; ?>"/>
		<br>
		<input type="text" name="data[User][firstname]" value="<?php echo $users['User']['firstname']; ?>"/>
		<br>
		<input type="text" name="data[User][lastname]" value="<?php echo $users['User']['lastname']; ?>"/>
		<br>
		<input class="button green wide100" type="submit"  value="Update User"/>
	</form>
</body>
</html>
