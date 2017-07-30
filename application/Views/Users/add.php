<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/users_controller.php" method="post">
		<h2> Add User </h2>
		<input type="hidden" name="action" value="add"/>
		<input type="text" name="data[User][firstname]" />
		<br>
		<input type="text" name="data[User][lastname]" />
		<br>
		<input class="button green wide25" type="submit"  value="Add User"/>
		<a class="button red wide25" href="../Users/">  Cancel </a>
	</form>
</body>
</html>
