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

	/* @var \phpbb\config\config */
	protected $config;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config
	 */
	public function __construct(\phpbb\config\config $config)
	{
		$this->config = $config;
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
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'un1matr1x/ogame',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Replaces the 
	*
	* @param	array	id or name of capturing group as key
	* @return	callback for cr4_to_image
	* @access	public
	*/
	public function cr_link_with_id($matches)
	{
		return '><span class="cr4me-link"><span class="cr4me-image"></span>'.$matches['id'].'</span><';
	}

	/**
	* Function to replace cr4.me text links of with an image and a blue bar background
	* NB: only the output to the visitors user agent is altered, the data in the
	* database is unchanged.
	*
	* @param	object		$event	The event object
	* @return	null
	* @access	public
	*/ 
	public function cr4_to_image($event)
	{
		if ($this->config['un1matr1x_ogame_cr_link'])
		{
			$text = $event['text'];
			$cr_link_pattern = '/[^\"]http(s)?:\\/\\/(?<url>kb\\.un1matr1x\\.de|cr4\\.me)\\/kb\\.php\\?';
			$cr_link_pattern .= '(?<pa1>lang=[a-z_]{2-11}|show=(?<id>[0-9]+)|pw=([a-zA-Z0-9]{6})?)';
			$cr_link_pattern .= '(&amp;|&)?(?&pa1)?(&amp;|&)?</';
			$text = preg_replace_callback($cr_link_pattern, 'self::cr_link_with_id', $text);
			$event['text'] = $text;
		}
	}
}
