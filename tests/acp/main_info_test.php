<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\acp\main_info;

require_once dirname(__FILE__).'/../../acp/main_info.php';

/**
* @group cr4me_acp
*/
class main_info_test extends \phpbb_test_case
{
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	public function test_version_agains_composer()
	{
		$main_info     = new \un1matr1x\ogame\acp\main_info;
		$output        = $main_info->module();
		$composer_json = json_decode(file_get_contents(dirname(__FILE__).'/../../composer.json'),true);

		$this->assertEquals($composer_json['version'], $output['version']);
	}
}
