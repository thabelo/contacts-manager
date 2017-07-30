<?php
require_once '../../Controller/contacts_types_controller.php';
require_once '../../Controller/contacts_controller.php';
require_once '../../Controller/users_controller.php';

$contactsData = new ContactsController();
$contacts = $contactsData->findAllContacts();

?>

<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>

<body>
	<a class="button blue wide10" type="submit" href="../Users/"> View Users </a>
	<div class="clear"> </div>
	<table>
		<tr>
				<th> <?php echo 'Person'; ?></th>
				<th> <?php echo 'Contact'; ?></th>
				<th > <?php echo 'Type'; ?></th>
				<th> Edit</th>
				<th> Delete</th>
		</tr>
		<?php 
		foreach ($contacts as $contact) {
			if ($contact) {
				$contactsTypes = new ContactsTypesController();
				$contactsTypesData = $contactsTypes->findById($contact['Contacts']['contacts_types_id']);

				$users = new UsersController();
				$users = $users->findById($contact['Contacts']['users_id']);
			}
		?>
		<tr>
			<td> <?php echo ucfirst($users['User']['firstname'])." ".ucfirst($users['User']['lastname']); ?></td>
			<td> <?php echo $contact['Contacts']['value']; ?></td>
			<td> <?php echo $contactsTypesData['ContactsTypes']['name']; ?></td>
			<td> <a class="button green" href="edit.php?id=<?php echo $contact['Contacts']['id']; ?>">Edit </a></td>
			<td> <a class="button red" href="delete.php?id=<?php echo $contact['Contacts']['id']; ?>">Delete </a></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
