# contacts-manager
Manage user contacts

1. Copy all contents of contacts-manager.zip and unzip the file or clone git clone https://github.com/thabelo/contacts-manager.git repo into your server directory.
2. Copy file `application/Config/database.conf.sample.php` and rename to `application/Config/database.conf.php` into same directory then edit the file to match your database settings.
```
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',		// HOST MACHINE 
		'user' => 'root',		// HOST USERNAME 
		'password' => 'password',	// HOST PASSWORD
		'database' => 'contacts',	// HOST DATABASE (*Optional to change)
	);
```
3. Using your browser navigate to contacts-manager and application should take you to the admin page and install the database and intialize tables.
	
