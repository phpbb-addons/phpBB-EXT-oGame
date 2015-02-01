<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\acp;

class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\un1matr1x\ogame\acp\main_module',
			'title'		=> 'ACP_OGAME_TITLE',
			'version'	=> '0.1.0',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_OGAME',
									'auth' => 'ext_un1matr1x/ogame && acl_a_board',
									'cat' => array('ACP_OGAME_TITLE')),
			),
		);
	}
}
