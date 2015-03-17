<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\core;

/**
* @ignore
*/
use Symfony\Component\DependencyInjection\Container;

class profile_cards
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\user */
	protected $user;

	/* @var Container */
	protected $phpbb_container;


	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user,
								Container $phpbb_container)
	{
		$this->config          = $config;
		$this->db              = $db;
		$this->user            = $user;
		$this->phpbb_container = $phpbb_container;
	}

	public function view_profile_cards($user_id)
	{
		/* @var $cp \phpbb\profilefields\manager */
		$un1_cp         = $this->phpbb_container->get('profilefields.manager');
		$profile_fields = $un1_cp->grab_profile_fields_data($user_id);

		$gf_id = $profile_fields[$user_id]['ogame_gameforge']['value'];
		$cr_id = $profile_fields[$user_id]['ogame_crforme']['value'];

		//TODO add language to url for the gcard & cr4me-signature
		$template_array = array(
			'U_GAMEFORGE_ID'		=> $gf_id ? $gf_id : false,
			'U_CR4ME_ID'			=> $cr_id ? $cr_id : false,
		);

		return $template_array;

	}
}
