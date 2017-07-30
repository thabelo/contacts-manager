<?php
require_once '../../Controller/contacts_types_controller.php';
require_once '../../Controller/users_controller.php';

$contactsTypesData = new ContactsTypesController();
$contactsTypes = $contactsTypesData->findAllContactsTypes();

?>

<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>

<body>
	<a class="button blue wide10" type="submit" href="../ContactsTypes/add.php"> Add Contact Type </a>
	<div class="clear"> </div>
	<table>
		<tr>
				<th > <?php echo 'Type'; ?></th>
				<th> Edit</th>
				<th> Delete</th>
		</tr>
		<?php 
		foreach ($contactsTypes as $contactType) { ?>
		<tr>
			<td> <?php echo $contactType['ContactsTypes']['name']; ?></td>
			<td> <a class="button green" href="edit.php?id=<?php echo $contactType['ContactsTypes']['id']; ?>">Edit </a></td>
			<td> <a class="button red" href="delete.php?id=<?php echo $contactType['ContactsTypes']['id']; ?>">Delete </a></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
