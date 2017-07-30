<?php
require_once '../../Controller/users_controller.php';
require_once '../../Controller/contacts_controller.php';
require_once '../../Controller/contacts_types_controller.php';

$contactsData = new ContactsController();
if (isset($_GET['id'])) {
	$contact = $contactsData->findById($_GET['id']);
} else {
	echo "Edit data id is not defined";
	exit;
}
if ($contact) {
	$users = new UsersController();
	$users = $users->findById($contact['Contacts']['users_id']);
}

$contactsTypes = new ContactsTypesController();
$contactsTypesData = $contactsTypes->findAllContactsTypes();

?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>
<body>
	<form action="../../Controller/contacts_controller.php" method="post">
		<h2> Edit Contacts </h2>
		<input type="hidden" name="action" value="edit"/>
		<input type="hidden" name="data[Contacts][id]" value="<?php echo $contact['Contacts']['id']; ?>"/>
		<label class="bg-green wide96 label-header"> Edit Contact Detail For: <?php echo $users['User']['firstname']." ".$users['User']['lastname']; ?> </label>
		<div class="clear"> </div>
		<select class="button blue wide100 center" name="data[Contacts][contacts_types_id]" >
			<option value="">(choose one)</option>
			<?php foreach ($contactsTypesData as $contactsTypes) { ?>
				<?
					$selected = false;
					if ($contact['Contacts']['contacts_types_id'] === $contactsTypes['ContactsTypes']['id']) {
						$selected= "selected";
					}
				?>
				<option <?php echo $selected; ?> value="<?php echo $contactsTypes['ContactsTypes']['id']?>"><?php echo $contactsTypes['ContactsTypes']['name']?></option>
			<?php } ?>
		</select>
		<div class="clear"> </div>
		<input class="wide50" type="text" name="data[Contacts][value]" value="<?php echo $contact['Contacts']['value']; ?>"/>
		<div class="clear"> </div>
		<input class="button green wide100" type="submit"  value="Update Contact"/>
	</form>
</body>
</html>
