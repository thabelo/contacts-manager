<?php
require_once '../../Controller/contacts_types_controller.php';
require_once '../../Controller/users_controller.php';

$contactsTypes = new ContactsTypesController();
$contactsTypesData = $contactsTypes->findAllContactsTypes();

if (isset($_GET['user'])) {
	$user_id = $_GET['user'];
	if ($user_id) {
		$users = new UsersController();
		$user = $users->findById($user_id);
	}
}
?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/contacts_types_controller.php" method="post">
		<h2> Add Contact Type </h2>
		<input type="hidden" name="action" value="add"/>
		<br>
		<input type="text" name="data[ContactsTypes][name]" />
		<div class="clear"> </div>
		<input class="button green wide100" type="submit"  value="Add Contact"/>
	</form>
</body>
</html>
