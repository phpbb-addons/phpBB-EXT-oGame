<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\event\main_listener;

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

class event_listener_test extends \phpbb_test_case
{
	/**
	* Test the event listener is subscribing events
	*/
	public function test_getSubscribedEvents()
	{
		$this->assertEquals(array(
			'core.user_setup',
			'core.modify_text_for_display_after',
			'core.modify_format_display_text_after',
			'core.memberlist_prepare_profile_data',
		), array_keys(un1matr1x\ogame\event\main_listener::getSubscribedEvents()));
	}
}
