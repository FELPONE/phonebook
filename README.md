# phonebook

Installation:

Set your db credentials in application/config/database.php
Set your base url in application/config/config.php
Ensure you have mod_rewrite enabled on your server

In application folder run composer install

Front-end package management:

Install npm and bower,
apt-get install npm
npm install bower -g
ln -s /usr/bin/nodejs   /usr/bin/node
bower install

Migration:

In the root folder,

 run application/vendor/bin/phinx migrate -c ./phinx.php
 
 Seed you db:

 	run application/vendor/bin/phinx  seed:run -s UserSeeder
	run application/vendor/bin/phinx  seed:run -s ContactSeeder
	
	After seeding you can pick up one username from the table user and use it to login in the app with the password : "password".


