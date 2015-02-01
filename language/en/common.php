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
	'ACP_UN1MATR1X_OGAME_CR_LINK'			=> 'Prettify cr4.me-links?',
	'ACP_UN1MATR1X_OGAME_SETTING_SAVED'		=> 'Settings have been saved successfully!',
));
