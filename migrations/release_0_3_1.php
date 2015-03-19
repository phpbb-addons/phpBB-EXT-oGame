<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\migrations;

class release_0_3_1 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['un1matr1x_ogame_version'])
				&& version_compare($this->config['un1matr1x_ogame_version'], '0.3.1', '>=');
	}

	public static function depends_on()
	{
		return array('\un1matr1x\ogame\migrations\release_0_2_1');
	}

}
