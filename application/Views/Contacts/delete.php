<?php
require_once '../../Controller/contacts_types_controller.php';
require_once '../../Controller/contacts_controller.php';

$contactsData = new ContactsController();
$contacts = $contactsData->findById($_GET['id']);

if ($contacts) {
	$contactsTypes = new ContactsTypesController();
	$contactsTypesData = $contactsTypes->findById($contacts['Contacts']['id']);
}

?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/contacts_controller.php" method="post">
		<h2> Are you sure you want to delete </h2>
		<input type="hidden" name="action" value="delete"/>
		<input type="hidden" name="data[Contacts][id]" value="<?php echo $contacts['Contacts']['id']; ?>"/>
		<label>Delete: <?php echo $contactsTypesData['ContactsTypes']['name'].": ".$contacts['Contacts']['value']; ?> </label>
		<br>
		<div>
			<input class="button green wid25"  type="submit"  value="Yes"/>
			<a class="button red wide25" href="../Contacts/"> Cancel </a>
		</div>
	</form>
</body>
</html>
