# DatabaseHook
PHP library to hook any database (supported by PDO) to a PHP application

## Installation
1. Put *dbhook* folder in the same path as PHP application (can be placed in subfolders)
2. Create configuration file - XML, JSON or INI
3. Import dbhook.php
4. Call DatabaseHook::configure('configuration_file');
5. Assign an instance of DatabaseHook to a $var. Ex:
 $dbHook = DatabaseHook::getInstance();

## Configuration

### XML
<?xml version="1.0" encoding="UTF-8"?>
<root>
	<host>{{HOST NAME}}</host>
	<database>{{DATABASE}}</database>
	<username>{{USERNAME}}</username>
	<password>{{PASSWORD}}</password>
	<autocommit>{{1 for Autocommit, 0 for transactions}}</autocommit>
</root>

### JSON
{
	"host": "{{HOST_NAME}}",
	"database": "{{DATABASE}}",
	"username": "{{USERNAME}}",
	"password": "{{PASSWORD}}",
	"autocommit": {{1 for Autocommit, 0 for transactions}}
}

### INI
host={{HOST_NAME}}
database={{DATABASE}}
username={{USERNAME}}
password={{PASSWORD}}
autocommit={{1 for Autocommit, 0 for transactions}}

## History
v0.1 - Initial version
v0.2 - Added dbmodel to provide abstract class than can implement a DAO