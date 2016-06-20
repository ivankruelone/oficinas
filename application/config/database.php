<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '192.168.1.221';
$db['default']['username'] = 'root';
$db['default']['password'] = 'hachi1417#';
$db['default']['database'] = 'compras';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//
$db['li']['hostname'] = '192.168.1.221';
$db['li']['username'] = 'root';
$db['li']['password'] = 'garigol';
$db['li']['database'] = 'oficinas';
$db['li']['dbdriver'] = 'mysqli';
$db['li']['dbprefix'] = '';
$db['li']['pconnect'] = FALSE;
$db['li']['db_debug'] = TRUE;
$db['li']['cache_on'] = FALSE;
$db['li']['cachedir'] = '';
$db['li']['char_set'] = 'utf8';
$db['li']['dbcollat'] = 'utf8_general_ci';
$db['li']['swap_pre'] = '';
$db['li']['autoinit'] = TRUE;
$db['li']['stricton'] = FALSE;

//Facturacion
$db['facturacion']['hostname'] = '192.168.1.200';
$db['facturacion']['username'] = 'desarrolloDB';
$db['facturacion']['password'] = 'desarrollo';
$db['facturacion']['database'] = 'facturacion';
$db['facturacion']['dbdriver'] = 'mysql';
$db['facturacion']['dbprefix'] = '';
$db['facturacion']['pconnect'] = FALSE;
$db['facturacion']['db_debug'] = TRUE;
$db['facturacion']['cache_on'] = FALSE;
$db['facturacion']['cachedir'] = '';
$db['facturacion']['char_set'] = 'utf8';
$db['facturacion']['dbcollat'] = 'utf8_general_ci';
$db['facturacion']['swap_pre'] = '';
$db['facturacion']['autoinit'] = TRUE;
$db['facturacion']['stricton'] = FALSE;

//Facturacion
$db['facturacion']['hostname'] = '192.168.1.200';
$db['facturacion']['username'] = 'desarrolloDB';
$db['facturacion']['password'] = 'desarrollo';
$db['facturacion']['database'] = 'facturacion';
$db['facturacion']['dbdriver'] = 'mysql';
$db['facturacion']['dbprefix'] = '';
$db['facturacion']['pconnect'] = FALSE;
$db['facturacion']['db_debug'] = TRUE;
$db['facturacion']['cache_on'] = FALSE;
$db['facturacion']['cachedir'] = '';
$db['facturacion']['char_set'] = 'utf8';
$db['facturacion']['dbcollat'] = 'utf8_general_ci';
$db['facturacion']['swap_pre'] = '';
$db['facturacion']['autoinit'] = TRUE;
$db['facturacion']['stricton'] = FALSE;

//Michoacan2016
$db['michoacan2016']['hostname'] = '162.251.85.134';
$db['michoacan2016']['username'] = 'fenixtch_mich';
$db['michoacan2016']['password'] = 'lifana1417#';
$db['michoacan2016']['database'] = 'fenixtch_michoacan';
$db['michoacan2016']['dbdriver'] = 'mysqli';
$db['michoacan2016']['dbprefix'] = '';
$db['michoacan2016']['pconnect'] = FALSE;
$db['michoacan2016']['db_debug'] = TRUE;
$db['michoacan2016']['cache_on'] = FALSE;
$db['michoacan2016']['cachedir'] = '';
$db['michoacan2016']['char_set'] = 'utf8';
$db['michoacan2016']['dbcollat'] = 'utf8_general_ci';
$db['michoacan2016']['swap_pre'] = '';
$db['michoacan2016']['autoinit'] = TRUE;
$db['michoacan2016']['stricton'] = FALSE;

//Zacatecas
$db['zacatecas']['hostname'] = '192.168.0.7';
$db['zacatecas']['username'] = 'izuniga';
$db['zacatecas']['password'] = 'ivan2';
$db['zacatecas']['database'] = 'zacatecas';
$db['zacatecas']['dbdriver'] = 'postgre';
$db['zacatecas']['dbprefix'] = '';
$db['zacatecas']['pconnect'] = FALSE;
$db['zacatecas']['db_debug'] = TRUE;
$db['zacatecas']['cache_on'] = FALSE;
$db['zacatecas']['cachedir'] = '';
$db['zacatecas']['char_set'] = 'utf8';
$db['zacatecas']['dbcollat'] = 'utf8_general_ci';
$db['zacatecas']['swap_pre'] = '';
$db['zacatecas']['autoinit'] = TRUE;
$db['zacatecas']['stricton'] = FALSE;

//Estado de mexico
$db['edomex']['hostname'] = '192.168.0.6';
$db['edomex']['username'] = 'izuniga';
$db['edomex']['password'] = 'ivan2';
$db['edomex']['database'] = 'edomex';
$db['edomex']['dbdriver'] = 'postgre';
$db['edomex']['dbprefix'] = '';
$db['edomex']['pconnect'] = FALSE;
$db['edomex']['db_debug'] = TRUE;
$db['edomex']['cache_on'] = FALSE;
$db['edomex']['cachedir'] = '';
$db['edomex']['char_set'] = 'utf8';
$db['edomex']['dbcollat'] = 'utf8_general_ci';
$db['edomex']['swap_pre'] = '';
$db['edomex']['autoinit'] = TRUE;
$db['edomex']['stricton'] = FALSE;

//Quintanaa Roo
$db['quintana']['hostname'] = '192.168.0.8';
$db['quintana']['username'] = 'izuniga';
$db['quintana']['password'] = 'ivan2';
$db['quintana']['database'] = 'quintanaroo';
$db['quintana']['dbdriver'] = 'postgre';
$db['quintana']['dbprefix'] = '';
$db['quintana']['pconnect'] = FALSE;
$db['quintana']['db_debug'] = TRUE;
$db['quintana']['cache_on'] = FALSE;
$db['quintana']['cachedir'] = '';
$db['quintana']['char_set'] = 'utf8';
$db['quintana']['dbcollat'] = 'utf8_general_ci';
$db['quintana']['swap_pre'] = '';
$db['quintana']['autoinit'] = TRUE;
$db['quintana']['stricton'] = FALSE;

//Bansefi
$db['bansefi']['hostname'] = '192.168.0.40';
$db['bansefi']['username'] = 'izuniga';
$db['bansefi']['password'] = 'ivan2';
$db['bansefi']['database'] = 'bansefi';
$db['bansefi']['dbdriver'] = 'postgre';
$db['bansefi']['dbprefix'] = '';
$db['bansefi']['pconnect'] = FALSE;
$db['bansefi']['db_debug'] = TRUE;
$db['bansefi']['cache_on'] = FALSE;
$db['bansefi']['cachedir'] = '';
$db['bansefi']['char_set'] = 'utf8';
$db['bansefi']['dbcollat'] = 'utf8_general_ci';
$db['bansefi']['swap_pre'] = '';
$db['bansefi']['autoinit'] = TRUE;
$db['bansefi']['stricton'] = FALSE;

//metro
$db['metro']['hostname'] = '192.168.0.10';
$db['metro']['username'] = 'izuniga';
$db['metro']['password'] = 'ivan2';
$db['metro']['database'] = 'metro';
$db['metro']['dbdriver'] = 'postgre';
$db['metro']['dbprefix'] = '';
$db['metro']['pconnect'] = FALSE;
$db['metro']['db_debug'] = TRUE;
$db['metro']['cache_on'] = FALSE;
$db['metro']['cachedir'] = '';
$db['metro']['char_set'] = 'utf8';
$db['metro']['dbcollat'] = 'utf8_general_ci';
$db['metro']['swap_pre'] = '';
$db['metro']['autoinit'] = TRUE;
$db['metro']['stricton'] = FALSE;

//michoacan
$db['michoacan']['hostname'] = '192.168.0.5';
$db['michoacan']['username'] = 'postgres';
$db['michoacan']['password'] = 'Nazgul';
$db['michoacan']['database'] = 'michoacan4f';
$db['michoacan']['dbdriver'] = 'postgre';
$db['michoacan']['dbprefix'] = '';
$db['michoacan']['pconnect'] = FALSE;
$db['michoacan']['db_debug'] = TRUE;
$db['michoacan']['cache_on'] = FALSE;
$db['michoacan']['cachedir'] = '';
$db['michoacan']['char_set'] = 'utf8';
$db['michoacan']['dbcollat'] = 'utf8_general_ci';
$db['michoacan']['swap_pre'] = '';
$db['michoacan']['autoinit'] = TRUE;
$db['michoacan']['stricton'] = FALSE;


//Polanco
$db['polanco']['hostname'] = 'fenixpolanco.homeip.net\\SVR-FenixPolanc';
$db['polanco']['username'] = 'Pruebas1';
$db['polanco']['password'] = 'Prueb@s1';
$db['polanco']['database'] = 'FenixPharmacyPtoVtaPolanco';
$db['polanco']['dbdriver'] = 'mssql';
$db['polanco']['dbprefix'] = '';
$db['polanco']['pconnect'] = FALSE;
$db['polanco']['db_debug'] = TRUE;
$db['polanco']['cache_on'] = FALSE;
$db['polanco']['cachedir'] = '';
$db['polanco']['char_set'] = 'utf8';
$db['polanco']['dbcollat'] = 'utf8_general_ci';
$db['polanco']['swap_pre'] = '';
$db['polanco']['autoinit'] = TRUE;
$db['polanco']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */