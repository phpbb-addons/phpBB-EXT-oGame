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
	/** @var un1matr1x\ogame\event\main_listener */
	protected $listener;
	protected $config;
	protected $cr4me_link;
	protected $profile_cards;

	/**
	* Setup test environment
	*/
	public function setUp()
	{
		parent::setUp();

		// Load/Mock classes required by the event listener class
		$this->config        = new \phpbb\config\config();
		$this->template      = $this->getMockBuilder('\phpbb\template\template')->getMock();
		$this->cr4me_link    = new \un1matr1x\ogame\core\cr4me_link($this->config);
		$this->profile_cards = new \un1matr1x\ogame\core\profile_cards($this->config);
	}

	/**
	* Create our event listener
	*/
	protected function set_listener()
	{
		$this->listener = new un1matr1x\ogame\event\main_listener(
			$this->config,
			$this->cr4me_link,
			$this->profile_cards
		);
	}

	/**
	* Test the event listener is constructed correctly
	*/
	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

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
