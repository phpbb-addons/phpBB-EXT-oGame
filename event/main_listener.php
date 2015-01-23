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
	 * @param string								$php_ext
	 * @param Container								$phpbb_container
	 * @param \phpbb\db\driver\driver_interfacer	$db
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\controller\helper				$helper		Controller helper object
	 * @param \phpbb\auth\auth						$auth
	 * @param \phpbb\template						$template	Template object
	 * @param \phpbb\user							$user
	 * @param \phpbb\path_helper					$phpbb_path_helper
	 * @param \phpbb\extension\manager				$phpbb_extension_manager
	 */
	public function __construct($php_ext, Container $phpbb_container, \phpbb\db\driver\driver_interface $db,
								\phpbb\config\config $config, \phpbb\controller\helper $helper,
								\phpbb\auth\auth $auth, \phpbb\template\template $template,
								\phpbb\user $user, \phpbb\path_helper $phpbb_path_helper,
								\phpbb\extension\manager $phpbb_extension_manager)
	{
		$this->phpbb_path_helper		= $phpbb_path_helper;
		$this->phpbb_extension_manager	= $phpbb_extension_manager;
		$this->php_ext					= $php_ext;
		$this->phpbb_container			= $phpbb_container;
		$this->db						= $db;
		$this->config					= $config;
		$this->helper					= $helper;
		$this->auth						= $auth;
		$this->template					= $template;
		$this->user						= $user;
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

	public function cr_link_with_id($matches)
	{
		return '><span style class="cr4me-link"><img src="' . $ext_path.'images/cr_no_gd.png">'.$matches['id'].'</span><';
	}

	public function cr4_to_image($event)
	{

		$text = $event['text'];

		//Replace CR-Links with nicer Images

		$cr_link_pattern = '/[^\"]http(s)?:\\/\\/(?<url>kb\\.un1matr1x\\.de|cr4\\.me)\\/kb\\.php\\?(?<pa1>lang=[a-z_]{2-11}|show=(?<id>[0-9]+)|pw=([a-zA-Z0-9]{6})?)(&amp;|&)?(?&pa1)?(&amp;|&)?/';

		$text = preg_replace_callback($cr_link_pattern, 'self::cr_link_with_id', $text);

		$event['text'] = $text;
	}
}
