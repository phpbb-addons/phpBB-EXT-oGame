<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\cr4me_profilefield;

/**
* @group cr4me_link
*/
class cr4me_profilefield_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	public function test_submitting_profile_info()
	{
		$this->add_lang('ucp');
		$this->login();
		$crawler = self::request('GET', 'ucp.php?i=ucp_profile&mode=profile_info');
		$this->assertContainsLang('UCP_PROFILE_PROFILE_INFO', $crawler->filter('#cp-main h2')->text());
		$form    = $crawler->selectButton('Submit')->form(array(
			'pf_un1matr1x_cr4me'		=> '2',
			'pf_un1matr1x_gameforge'	=> '47634',
		));
		$crawler = self::submit($form);
		$this->assertContainsLang('PROFILE_UPDATED', $crawler->filter('#message')->text());
		$crawler = self::request('GET', 'ucp.php?i=ucp_profile&mode=profile_info');
		$form    = $crawler->selectButton('Submit')->form();
		$this->assertEquals('2', $form->get('pf_un1matr1x_cr4me')->getValue());
		$this->assertEquals('47634', $form->get('pf_un1matr1x_gameforge')->getValue());
	}
}
