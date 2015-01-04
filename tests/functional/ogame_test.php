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
class ogame_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	public function test_index()
	{
		$crawler = self::request('GET', 'viewtopic.php?f=2&t=1');
		$this->assertGreaterThan(0, $crawler->filter('.profile-custom-field')->count());
	}
}
