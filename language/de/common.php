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
	'ACP_OGAME'								=> 'Einstellungen',

	'ACP_UN1MATR1X_OGAME_COLOR'				=> 'Hintergrundfarbe',
	'ACP_UN1MATR1X_OGAME_COLOR_FONT'		=> 'Schriftfarbe',
	'ACP_UN1MATR1X_OGAME_CR_LINK'			=> 'cr4.me-Links verschönern?',
	'ACP_UN1MATR1X_OGAME_SETTING_SAVED'		=> 'Einstellungen wurden erfolgreich gespeichert!',
	'ACP_UN1MATR1X_OGAME_STYLE_EXPLAIN'		=> 'Wähle deine eigene Farbgebung für die Linkverschönerung. Die 
												Standartfarbe für den Hintergrund ist <b>31b0d5</b> und für die Schrift
												<b>ffffff</b>.',

	'SHOW_CR4_ME_PROFILE'					=> 'cr4.me-Profil anzeigen',
	'SHOW_GAMEFORGE_PROFILE'				=> 'Gameforge-Profil anzeigen',

	'UN1MATR1X_CR4ME'						=> 'cr4.me',
	'UN1MATR1X_GAMEFORGE'					=> 'Gameforge',
));
