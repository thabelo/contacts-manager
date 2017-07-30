<?php
require_once '../../Controller/contacts_types_controller.php';

$contactsTypes = new ContactsTypesController();
if (isset($_GET['id'])) {
	$contactsTypesData = $contactsTypes->findById($_GET['id']);
} else {
	echo "Delete data id is not defined";
	exit;
}

?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/contacts_types_controller.php" method="post">
		<h2> Are you sure you want to delete </h2>
		<input type="hidden" name="action" value="delete"/>
		<input type="hidden" name="data[ContactsTypes][id]" value="<?php echo $contactsTypesData['ContactsTypes']['id']; ?>"/>
		<label>Delete: <?php echo $contactsTypesData['ContactsTypes']['name']; ?> </label>
		<br>
		<div>
			<input class="button green wid25"  type="submit"  value="Yes"/>
			<a class="button red wide25" href="../ContactsTypes/"> Cancel </a>
		</div>
	</form>
</body>
</html>
