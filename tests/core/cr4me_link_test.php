<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\core\cr4me_link;

require_once dirname(__FILE__).'/../../core/cr4me_link.php';

/**
* @group cr4me_core
*/
class cr4me_link_test extends \phpbb_test_case
{
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	public function test_version_agains_composer()
	{
		$config = new \phpbb\config\config(array());
		$config['un1matr1x_ogame_color'] = '31b0d5';
		$config['un1matr1x_ogame_color_font'] = 'ffffff';

		$text       = 'http://cr4.me/kb.php?show=1';
		$cr4me_link = new \un1matr1x\ogame\core\cr4me_link;
		$output     = $cr4me_link->cr4_to_image($text);

		$this->assertEquals('><span class="cr4me-link"><span class="cr4me-link-image ogame_crforme-icon"></span>'.$cr_id.'</span><', $output);
	}
}
