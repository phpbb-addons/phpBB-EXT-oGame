<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\event;

/**
* @ignore
*/
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_language_on_setup',
			'core.modify_text_for_display_after'		=> 'cr4_to_image',
			'core.modify_format_display_text_after'		=> 'cr4_to_image',
		);
	}

	/* @var string phpEx */
	protected $php_ext;

	/* @var Container */
	protected $phpbb_container;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\auth\auth */
	protected $auth;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param string									$php_ext
	 * @param Container 								$phpbb_container
	 * @param \phpbb\db\driver\driver_interfacer		$db
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\controller\helper				$helper		Controller helper object
	 * @param \phpbb\auth\auth						$auth
	 * @param \phpbb\template						$template	Template object
	 * @param \phpbb\user							$user
	 * @param \phpbb\path_helper						$phpbb_path_helper
	 * @param \phpbb\extension\manager				$phpbb_extension_manager
	 */
	public function __construct($php_ext, Container $phpbb_container, \phpbb\db\driver\driver_interface $db,
								\phpbb\config\config $config, \phpbb\controller\helper $helper,
								\phpbb\auth\auth $auth, \phpbb\template\template $template,
								\phpbb\user $user, \phpbb\path_helper $phpbb_path_helper,
								\phpbb\extension\manager $phpbb_extension_manager)
	{
		$this->phpbb_path_helper = $phpbb_path_helper;
		$this->phpbb_extension_manager = $phpbb_extension_manager;
		$this->php_ext = $php_ext;
		$this->phpbb_container = $phpbb_container;
		$this->db = $db;
		$this->config 			= $config;
		$this->helper 			= $helper;
		$this->auth				= $auth;
		$this->template = $template;
		$this->user 			= $user;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'un1matr1x/ogame',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function cr4_to_image($event)
	{

		$text = $event['text'];
		// Define the ext path. We will use it later for assigning the correct path to our local images
		$ext_path = $this->phpbb_path_helper->update_web_root_path($this->phpbb_extension_manager->get_extension_path('un1matr1x/ogame', true));

		//Replace CR-Links with nicer Images
		$search_kb = array();
		$search_kb[0] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;pw=[a-zA-Z0-9]{6}&amp;lang=[a-z_]{2,11}<#'; //?show= &pw= &lang=
		$search_kb[1] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;lang=[a-z_]{2,11}&amp;pw=[a-zA-Z0-9]{6}<#'; //?show= &lang= &pw=
		$search_kb[11] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;lang=[a-z_]{2,11}&amp;pw=<#'; //?show= &lang= &pw=
		$search_kb[2] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?pw=[a-zA-Z0-9]{6}&amp;show=([0-9]+)&amp;lang=[a-z_]{2,11}<#'; //?pw= &show= &lang=
		$search_kb[3] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?pw=[a-zA-Z0-9]{6}&amp;lang=[a-z_]{2,11}&amp;show=([0-9]+)<#'; //?pw= &lang= &show=
		$search_kb[12] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?lang=[a-z_]{2,11}&amp;show=([0-9]+)&amp;pw=[a-zA-Z0-9]{6}<#'; //?lang= &show= &pw=
		$search_kb[4] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?lang=[a-z_]{2,11}&amp;show=([0-9]+)&amp;pw=<#'; //?lang= &show= &pw=
		$search_kb[5] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?lang=[a-z_]{2,11}&amp;pw=[a-zA-Z0-9]{6}&amp;show=([0-9]+)<#'; //?lang= &pw= &show=
		$search_kb[6] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;pw=[a-zA-Z0-9]{6}<#'; //show= &pw=
		$search_kb[10] = '#[^"]http://kb.un1matr1x.de/kb\.php\?lang=[a-z_]{2,11}&amp;show=([0-9]+)<#'; //?lang= &show=
		$search_kb[7] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;lang=[a-z_]{2,11}<#'; //show= &lang=
		$search_kb[8] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)&amp;pw=<#'; //?show= &pw=
		$search_kb[9] 	= '#[^"]http://kb.un1matr1x.de/kb\.php\?show=([0-9]+)<#'; //?show=

		$replace_kb = '><span style class="cr4me-link">
						<img src="' . $ext_path.'images/cr_no_gd.png">$1</span><';

		$text = preg_replace($search_kb, $replace_kb, $text);

		$event['text'] = $text;
	}
}
