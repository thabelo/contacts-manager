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
	<form action="../../Controller/contacts_controller.php" method="post">
		<h2> Add Contact For : <?php echo $user['User']['firstname']." ". $user['User']['lastname']; ?></h2>
		<input type="hidden" name="action" value="add"/>
		<input type="hidden" name="data[Contacts][users_id]" value="<?php echo $user_id; ?>"/>
		<br>
		<input type="text" name="data[Contacts][value]" />
		<br>
		<select class="button blue wide100" name="data[Contacts][contacts_types_id]" >
			<option value="">(choose one)</option>
			<?php foreach ($contactsTypesData as $contactsTypes) { ?>
				<option class="center" value="<?php echo $contactsTypes['ContactsTypes']['id']?>"><?php echo $contactsTypes['ContactsTypes']['name']?></option>
			<?php } ?>
		</select>
		<br>
		<br>
		<input class="button green wide100" type="submit"  value="Add Contact"/>
	</form>
</body>
</html>
