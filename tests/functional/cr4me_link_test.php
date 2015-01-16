<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\tests\functional;

/**
* @group functional
*/
class cr4me_functional_posting_test extends \phpbb_functional_test_case
{
	public function test_post_new_topic_with_cr4me()
	{
		$this->login();

		// Test creating topic with a cr-link
		$post = $this->create_topic(2, 'CR4Me Test Topic', 'Some text about stuff http://kb.un1matr1x.de/kb.php?show=1 with text.');

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertGreaterThan(0, $crawler->filter('.cr4me-link')->count());

		// Test creating a reply with a cr-link
		$post2 = $this->create_post(2, $post['topic_id'], 'Re: CR4Me Test Topic', 'Some more text with another cr - http://kb.un1matr1x.de/kb.php?lang=da&show=3369&pw=');

		$crawler = self::request('GET', "viewtopic.php?t={$post2['topic_id']}&sid={$this->sid}");
		$this->assertGreaterThan(1, $crawler->filter('.cr4me-link')->count());

		// Test quoting a message
		$crawler = self::request('GET', "posting.php?mode=quote&f=2&t={$post2['topic_id']}&p={$post2['post_id']}&sid={$this->sid}");
		$this->assertGreaterThan(2, $crawler->filter('.cr4me-link')->count());
	}
}
