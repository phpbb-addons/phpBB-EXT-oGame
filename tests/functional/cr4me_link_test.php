<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\tests\cr4me_link;

/**
* @group cr4me_link
*/
class cr4me_link_posting_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	/**
	 * @param boolean $status
	 */
	protected function set_beautification_enable($db, $status)
	{
		$sql = "UPDATE phpbb_config
			SET config_value = '".(($status) ? '1' : '0')."'
			WHERE config_name = 'un1matr1x_ogame_cr_link'";
		$db->sql_query($sql);
		$this->purge_cache();
	}

	/**
	 * @return	object	$post	the created post for furter tests
	 */
	public function test_cr4me_beautification()
	{
		$this->login();

		$post    = $this->create_topic(2, 'CR4Me Test Topic',
				'Some text about stuff http://cr4.me/kb.php?show=1 with text.');
		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertEquals(1, $crawler->filter('.cr4me-link')->count());

		return $post;
	}

	/**
	 * @depends test_cr4me_beautification
	 * @return	object	$post	the created post for furter tests
	 */
	public function test_kbun1matr1x_beautification($post)
	{
		$this->login();

		$post2   = $this->create_post(2, $post['topic_id'], 'Re: CR4Me Test Topic',
				'Some more text with another cr - [url]http://kb.un1matr1x.de/kb.php?lang=da&show=3369&pw=[/url]');
		$crawler = self::request('GET', "viewtopic.php?t={$post2['topic_id']}&sid={$this->sid}");
		$this->assertEquals(2, $crawler->filter('.cr4me-image')->count());

		return $post;
	}

	/**
	 * @depends test_kbun1matr1x_beautification
	 */
	public function test_without_beautification($post)
	{
		$db = $this->get_db();
		$this->set_beautification_enable($db, false);
		$this->login();

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertEquals(0, $crawler->filter('.cr4me-image')->count());
		$this->assertEquals(0, $crawler->filter('.cr4me-link')->count());

		$this->logout();
	}
}
