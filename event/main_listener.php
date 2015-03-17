<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_language_on_setup',
			'core.modify_text_for_display_after'		=> 'cr4_to_image',
			'core.modify_format_display_text_after'		=> 'cr4_to_image',
			'core.memberlist_prepare_profile_data'		=> 'view_profile_cards',
		);
	}

	/* @var \phpbb\config\config */
	protected $config;

	/* @var \un1matr1x\ogame\core\cr4me_link */
	protected $cr4me_link;

	/* @var \un1matr1x\ogame\core\profile_cards */
	protected $profile_cards;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config			Config helper
	 * @param \un1matr1x\ogame\core\cr4me_link		$cr4me_link		cr4me-link parser
	 */
	public function __construct(\phpbb\config\config $config, \un1matr1x\ogame\core\cr4me_link $cr4me_link,
					\un1matr1x\ogame\core\profile_cards $profile_cards, \phpbb\template\template $template,
					\phpbb\user $user)
	{
		$this->config        = $config;
		$this->cr4me_link    = $cr4me_link;
		$this->profile_cards = $profile_cards;
		$this->template      = $template;
		$this->user          = $user;
	}

	/**
	 * Load common language data
	 *
	 * @param	object	$event
	 * @return	null
	 * @access	public
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext          = $event['lang_set_ext'];
		$lang_set_ext[]        = array(
			'ext_name' => 'un1matr1x/ogame',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Function to replace cr4.me text links of with an image and a blue bar background
	 * NB: only the output to the visitors user agent is altered, the data in the
	 * database is unchanged.
	 *
	 * @param	object		$event	The event object
	 * @return	void
	 * @access	public
	 */
	public function cr4_to_image($event)
	{
		if ($this->config['un1matr1x_ogame_cr_link'])
		{
			$text          = $this->cr4me_link->cr4_to_image($event['text']);
			$event['text'] = $text;
		}
	}

	public function view_profile_cards($event)
	{
		$this->template->assign_block_vars('un1matr1x',
				$this->profile_cards->view_profile_cards($event['data']['user_id']));
	}
}
