<?php
/**
* @author Unknown Bliss (Michael Cullum of http://unknownbliss.co.uk)
* @package umil
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup(); 

$auth_settings = array();
if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// Some blog files we need
//require "{$phpbb_root_path}includes/mods/constants_blog.$phpEx";

// The name of the mod to be displayed during installation.
$mod_name = 'Rules Title Changer';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'rtc_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
*/
//$language_file = 'mods/kb';

/*
* Options to display to the user (this is purely optional, if you do not need the options you do not have to set up this variable at all)
* Uses the acp_board style of outputting information, with some extras (such as the 'default' and 'select_user' options)
*/
/*$options = array(
	'kb_enable'				=> array('lang' => 'KB_ENABLE',			'validate' => 'bool',	'type' => 'radio:yes_no', 	'explain' => false),
	'kb_link_name'			=> array('lang' => 'KB_LINK_NAME',		'validate' => 'string',	'type' => 'text:40:50', 	'explain' => true),
	'kb_header_name'		=> array('lang' => 'KB_HEADER_NAME',	'validate' => 'string',	'type' => 'text:40:50', 	'explain' => true),
	'kb_copyright'			=> array('lang' => 'KB_PER_COPYRIGHT',	'validate' => 'string',	'type' => 'text:40:50', 	'explain' => true),
);
*/

/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = "{T_THEME_PATH}/images/image.png";

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$mod = array(
	'name'		=> 'Rules Title Changer',
	'version'	=> '0.0.3',
	'config'	=> 'rules_title_changer_version',
	'enable'	=> 'rules_title_changer_enable',
);


$versions = array(
	'0.0.3'	=> array(
		//no database changes
	),

	'0.0.2'	=> array(
		//no database changes
	),

	'0.0.1'	=> array(
		'table_column_add' => array(
				array('phpbb_forums', 'forum_rules_title', array('VCHAR', '')),
			),
		),

		'cache_purge' => array(
			'template',
		),
	);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);
