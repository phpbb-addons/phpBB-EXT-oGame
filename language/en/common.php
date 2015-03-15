<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'ACP_OGAME_TITLE'						=> 'oGame Extension',
	'ACP_OGAME'								=> 'Settings',

	'ACP_UN1MATR1X_OGAME_COLOR'				=> 'Background color',
	'ACP_UN1MATR1X_OGAME_COLOR_FONT'		=> 'Text font color',
	'ACP_UN1MATR1X_OGAME_CR_LINK'			=> 'Prettify cr4.me-links?',
	'ACP_UN1MATR1X_OGAME_SETTING_SAVED'		=> 'Settings have been saved successfully!',
	'ACP_UN1MATR1X_OGAME_STYLE_EXPLAIN'		=> 'Choose your own color scheme for the link prettification.The default 
												clors are <b>31b0d5</b> for the background and <b>ffffff</b> for the 
												font.',

	'SHOW_CR4_ME_PROFILE'					=> 'View cr4.me Profile',
	'SHOW_GAMEFORGE_PROFILE'				=> 'View Gameforge Profile',

	'UN1MATR1X_CR4ME'						=> 'cr4.me',
	'UN1MATR1X_GAMEFORGE'					=> 'Gameforge',
));
