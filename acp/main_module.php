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

class main_module
{
	public $u_action;

	public function main()
	{
		global $user, $template, $request, $config;

		$user->add_lang('acp/common');
		$user->add_lang_ext('un1matr1x/ogame', 'common');
		$this->tpl_name   = 'un1matr1x_ogame_body';
		$this->page_title = $user->lang('ACP_OGAME_TITLE');
		add_form_key('un1matr1x/ogame');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('un1matr1x/ogame'))
			{
				trigger_error('FORM_INVALID');
			}

			$ogame_color = (preg_match('/^[a-f0-9]{3,6}$/i', $request->variable('un1matr1x_ogame_color', '')))
							? $request->variable('un1matr1x_ogame_color', '') : $config['un1matr1x_ogame_color'];

			$ogame_color_font = (preg_match('/^[a-f0-9]{3,6}$/i', $request->variable('un1matr1x_ogame_color_font', ''))
							) ? $request->variable('un1matr1x_ogame_color_font', '') :
							$config['un1matr1x_ogame_color_font'];

			$config->set('un1matr1x_ogame_cr_link', $request->variable('un1matr1x_ogame_cr_link', 0));
			$config->set('un1matr1x_ogame_color', $ogame_color);
			$config->set('un1matr1x_ogame_color_font', $ogame_color_font);

			trigger_error($user->lang('ACP_UN1MATR1X_OGAME_SETTING_SAVED').adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'						=> $this->u_action,
			'UN1MATR1X_OGAME_ACTIV'			=> true,
			'UN1MATR1X_OGAME_COLOR'			=> $config['un1matr1x_ogame_color'],
			'UN1MATR1X_OGAME_COLOR_FONT'	=> $config['un1matr1x_ogame_color_font'],
			'UN1MATR1X_OGAME_CR_LINK'		=> $config['un1matr1x_ogame_cr_link'],
		));
	}
}
