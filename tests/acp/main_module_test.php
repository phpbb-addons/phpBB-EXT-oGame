<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\acp\main_module;

require_once dirname(__FILE__) . '/../../acp/main_module.php';

/**
* @group cr4me_acp
*/
class main_module_test extends \phpbb_test_case
{
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	public function test_check_hex_color()
	{
		$main_module = new \un1matr1x\ogame\acp\main_module;
		$color1      = $main_module->check_hex_color('fff','000');
		$this->assertEquals('fff', $color1);
	}
}
