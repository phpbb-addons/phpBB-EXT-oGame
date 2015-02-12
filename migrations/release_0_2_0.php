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

class release_0_2_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['un1matr1x_ogame_version'])
				&& version_compare($this->config['un1matr1x_ogame_version'], '0.2.0', '>=');
	}

	public static function depends_on()
	{
		return array('\un1matr1x\ogame\migrations\release_0_1_0');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('un1matr1x_ogame_color', '31b0d5')),
		);
	}
}
