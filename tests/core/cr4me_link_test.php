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

	public function test_link_recognition()
	{
		$config     = new \phpbb\config\config(array());
		$text       = array();
		$text[]     = 'http://cr4.me/kb.php?show=1';
		$text[]     = 'http://kb.un1matr1x.de/kb.php?show=1';
		$text[]     = 'http://cr4.me/kb.php?show=1&pw=abc123';
		$text[]     = 'http://cr4.me/kb.php?show=1&lang=es_us';
		$text[]     = 'http://cr4.me/kb.php?show=1&pw=abc123&lang=es_us';
		$text[]     = 'http://cr4.me/kb.php?pw=abc123&show=1';
		$text[]     = 'http://cr4.me/kb.php?lang=de&show=1';
		$text[]     = 'http://cr4.me/kb.php?show=1&lang=es_us&pw=abc123';
		$text[]     = 'http://cr4.me/kb.php?lang=es_us&show=1&pw=abc123';
		$text[]     = 'http://cr4.me/kb.php?lang=es_us&pw=abc123&show=1';
		$text[]     = 'http://cr4.me/kb.php?pw=abc12&lang=es_us3&show=1';
		$counter    = 0;
		$cr4me_link = new \un1matr1x\ogame\core\cr4me_link($config);

		$config['un1matr1x_ogame_color']      = '31b0d5';
		$config['un1matr1x_ogame_color_font'] = 'ffffff';

		while ($counter <= 10)
		{
			$output = $cr4me_link->cr4_to_image('>'.$text[$counter].'<');
			$this->assertEquals('><span class="cr4me-link"><span class="cr4me-link-image ogame_crforme-icon">'
								.'</span>1</span><', $output);
			$counter++;
		}
	}
}
