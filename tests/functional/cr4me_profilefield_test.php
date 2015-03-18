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
	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	/**
	 * Function to test if custom profile fields can be used and data is stored correct
	 *
	 * @return void
	 */
	public function test_submitting_profile_info()
	{
		$this->add_lang('ucp');
		$this->login();
		$crawler = self::request('GET', 'ucp.php?i=ucp_profile&mode=profile_info');
		$this->assertContainsLang('UCP_PROFILE_PROFILE_INFO', $crawler->filter('#cp-main h2')->text());
		$form    = $crawler->selectButton('Submit')->form(array(
			'pf_ogame_crforme'		=> '2',
			'pf_ogame_gameforge'	=> '47634',
		));
		$crawler = self::submit($form);
		$this->assertContainsLang('PROFILE_UPDATED', $crawler->filter('#message')->text());
		$crawler = self::request('GET', 'ucp.php?i=ucp_profile&mode=profile_info');
		$form    = $crawler->selectButton('Submit')->form();
		$this->assertEquals('2', $form->get('pf_ogame_crforme')->getValue());
		$this->assertEquals('47634', $form->get('pf_ogame_gameforge')->getValue());
	}
}
