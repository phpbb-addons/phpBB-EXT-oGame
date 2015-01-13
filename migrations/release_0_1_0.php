<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\migrations;

class release_0_1_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['un1matr1x_ogame_version'])
				&& version_compare($this->config['un1matr1x_ogame_version'], '0.1.0', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('un1matr1x_ogame_version', '0.1.0')),
			array('config.add', array('un1matr1x_ogame_cr_link', 1)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_OGAME_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_OGAME_TITLE',
				array(
					'module_basename'	=> '\un1matr1x\ogame\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
