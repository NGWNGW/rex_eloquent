<?php
// init addon
$REX['ADDON']['name']['eloquent'] = 'Eloquent';
$REX['ADDON']['page']['eloquent'] = 'eloquent';
$REX['ADDON']['version']['eloquent'] = '1.1.0';
$REX['ADDON']['author']['eloquent'] = 'redaxo.org';
$REX['ADDON']['supportpage']['eloquent'] = 'forum.redaxo.org';
$REX['ADDON']['perm']['eloquent'] = 'eloquent[]';

// permissions
$REX['PERM'][] = 'eloquent[]';

// add lang file
if ($REX['REDAXO']) {
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/eloquent/lang/');
}

// includes
require($REX['INCLUDE_PATH'] . '/addons/eloquent/classes/class.rex_eloquent_utils.inc.php');

// default settings (user settings are saved in data dir!)
$REX['ADDON']['eloquent']['settings'] = array(
	'foo' => 'bar',
	'foo2' => true,
);

// overwrite default settings with user settings
rex_eloquent_utils::includeSettingsFile();

// load composer autoload
require 'vendor/autoload.php';

// load capsule database driver for eloquent
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $REX['DB']['1']['HOST'],
    'database' => $REX['DB']['1']['NAME'],
    'username' => $REX['DB']['1']['LOGIN'],
    'password' => $REX['DB']['1']['PSW'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);
// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

class_alias ('Illuminate\Database\Capsule\Manager' , 'DB');

if ($REX['REDAXO']) {
	// add subpages
	$REX['ADDON']['eloquent']['SUBPAGES'] = array(
		array('', $I18N->msg('eloquent_help'))
	);
}
?>
