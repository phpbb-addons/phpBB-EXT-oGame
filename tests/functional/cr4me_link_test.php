<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\cr4me_link;

/**
* @group cr4me_link
*/
class cr4me_link_posting_test extends \phpbb_functional_test_case
{
	/**
	* Define the extensions to be tested
	*
	* @return string[] vendor/name of extension(s) to test
	*/
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	/**
	 * Function to alter config-values
	 *
	 * @param integer $value
	 * @param string $name
	 * @return void
	 */
	protected function change_config_value($db, $value, $name)
	{
		$sql = "UPDATE phpbb_config
			SET config_value = '".$value."' WHERE config_name = '".$name."'";
		$db->sql_query($sql);
		$this->purge_cache();
	}

	/**
	 * Function to test if link-pretification is working on functional-boards
	 *
	 * This function add a first post with a simple cr4.me-link and tested if the cr4me-link class appears in the DOM.
	 * Then a second post is added to this topic with another cr4.me-link and tested for cr4me-link-image class @ DOM.
	 *
	 * @return	object	$post	the created post for furter tests
	 */
	public function test_cr4me_beautification()
	{
		$this->login();

		$post    = $this->create_topic(2, 'CR4Me Test Topic',
				'Some text about stuff http://cr4.me/kb.php?show=1 with text.');
		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");

		$this->assertEquals(1, $crawler->filter('.cr4me-link')->count());

		$post2   = $this->create_post(2, $post['topic_id'], 'Re: CR4Me Test Topic',
				'Some more text with another cr - [url]http://kb.un1matr1x.de/kb.php?lang=da&show=3369&pw=[/url]');
		$crawler = self::request('GET', "viewtopic.php?t={$post2['topic_id']}&sid={$this->sid}");

		$this->assertEquals(2, $crawler->filter('.cr4me-link-image')->count());

		return $post;
	}

	/**
	 * Function to test if personalized link-pretification is working on functional-boards
	 *
	 * This function alter the colors for pretification and checks if the above created posts show this additional
	 * inline css
	 *
	 * @return	object	$post	the created post for furter tests
	 * @depends test_cr4me_beautification
	 */
	public function test_personal_beautification($post)
	{
		$db = $this->get_db();
		$this->change_config_value($db, 'ff00ff', 'un1matr1x_ogame_color');
		$this->change_config_value($db, '000000', 'un1matr1x_ogame_color_font');
		$this->login();

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertEquals(2, $crawler->
					filter('span[style="background-color:#ff00ff !important; color:#000000 !important;"]')->count());

		return $post;
	}

	/**
	 * Function to test if link-pretification can be turned off on functional-boards
	 *
	 * @return void
	 * @depends test_personal_beautification
	 */
	public function test_without_beautification($post)
	{
		$db = $this->get_db();
		$this->change_config_value($db, 0, 'un1matr1x_ogame_cr_link');
		$this->login();

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertEquals(0, $crawler->filter('.cr4me-image')->count());
		$this->assertEquals(0, $crawler->filter('.cr4me-link')->count());

		$this->logout();
	}
}
