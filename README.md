# contacts-manager
Manage user contacts

1. Copy all contents of agsworld.zip or clone git repo into your server directory and unzip the file.
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
3. Navigate to agsworld and application should take you to the admin page and install the database and intialize tables.
	
