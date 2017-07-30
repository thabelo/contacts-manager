<?php
require_once '../../Controller/contacts_types_controller.php';

$contactsTypes = new ContactsTypesController();
if (isset($_GET['id'])) {
	$contactTypesData = $contactsTypes->findById($_GET['id']);
} else {
	echo "Edit data id is not defined";
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
		<input type="hidden" name="action" value="edit"/>
		<input type="hidden" name="data[ContactsTypes][id]" value="<?php echo $contactTypesData['ContactsTypes']['id']; ?>"/>
		<label class="bg-green wide96 label-header"> Edit Contact Types </label>
		<input class="wide50" type="text" name="data[ContactsTypes][name]" value="<?php echo $contactTypesData['ContactsTypes']['name']; ?>"/>
		<div class="clear"> </div>
		<input class="button green wide100" type="submit"  value="Update Contact"/>
	</form>
</body>
</html>
