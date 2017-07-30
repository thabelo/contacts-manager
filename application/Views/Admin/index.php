<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/users_controller.php" method="post">
		<h3> Welcome To Contacts Manager: Please be careful not to wake the Gremlins </h3>
		<div class="clear"> </div>
		<a class="button blue wide25" href="../Users/">  Manage Users </a>
		<div class="clear"> </div>
		<a class="button blue wide25" href="../Contacts/">  Manage Contacts </a>
		<div class="clear"> </div>
		<a class="button blue wide25" href="../ContactsTypes/">  Manage Contact Types </a>
		<div class="clear"> </div>
		<a class="button red wide25" href="../Admin/reset_schema.php">  Manage Database </a>
	</form>
</body>
</html>
