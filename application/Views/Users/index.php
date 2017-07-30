<?php
require_once '../../Controller/users_controller.php';
require_once '../../Controller/contacts_controller.php';

$usersData = new UsersController();
$users = $usersData->findAllUsers();


?>
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header.php"; ?>
</head>

<body>
	<a class="button blue wide10" type="submit" href="../Users/add.php"> Add New Person </a>
	<br>
	<br>
	<table>
		<tr>
			<th> <?php echo 'Firstname'; ?></th>
			<th> <?php echo 'Lastname'; ?></th>
			<th> Edit </th>
			<th> Delete </th>
			<th> View </th>
			<th> Add </th>
		</tr>
		<?php 
		foreach ($users as $user) {
			$contacts = new ContactsController();
			$contactsData = $contacts->findAllUserContacts($user['User']['id']);
		?>
		<tr>
			<td> <?php echo ucfirst($user['User']['firstname']); ?></td>
			<td> <?php echo ucfirst($user['User']['lastname']); ?></td>
			<td> <a class="button green" href="edit.php?id=<?php echo $user['User']['id']; ?>">Edit </a></td>
			<td> <a class="button red" href="delete.php?id=<?php echo $user['User']['id']; ?>">Delete </a></td>
			<td> <a class="button orange" href="../Contacts/user_contacts.php?user=<?php echo $user['User']['id']; ?>"> View Contacst  (<?php echo sizeof($contactsData); ?>)</a></td>
			<td> <a class="button blue" href="../Contacts/add.php?user=<?php echo $user['User']['id']; ?>"> Add Contact </a></td>

		</tr>
		<?php } ?>
	</table>
</body>
</html>
