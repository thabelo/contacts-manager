
<!doctype html>

<html lang="en">
<head>
	<?php include "../elements/header-admin.php"; ?>
</head>
<body>
	<form >
		<a class="button blue wide10"  href="../Contacts/"> View Contacts </a>
		<div class="clear"> </div>
		<?php
			require_once '../../../migrations/schema.php';	
	
			$schema = new Schema();
			$schema->recreateDatabase();
			$schema->recreateAllTables();
			$schema->addDefaultContactsTypes();
		?>
	</form>

</body>
</html>
