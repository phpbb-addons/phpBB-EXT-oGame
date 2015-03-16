<?php
/**
*
* @package phpBB Extension - oGame
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace un1matr1x\ogame\core;

class cr4me_link
{
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
	 * Identify the show-parameter of the url-query and add this to the
	 * callback output.
	 *
	 * @param	array		id or name of capturing group as key
	 * @return	string		callback for cr4_to_image
	 * @access	public
	 */
	public function cr_link_with_id($matches)
	{
		$counter        = 0;
		$cr_id          = 0;
		$personal_color = '';

		while ($counter <= 2)
		{
			if ((isset ($matches['id'.$counter])) && (!empty($matches['id'.$counter])))
			{
				$cr_id = $matches['id'.$counter];
			}
			$counter++;
		}

		if (($this->config['un1matr1x_ogame_color'] <> '31b0d5') ||
			($this->config['un1matr1x_ogame_color_font'] <> 'ffffff'))
		{
			$personal_color  = ' style="background-color:#'.$this->config['un1matr1x_ogame_color'].' !important; ';
			$personal_color .= 'color:#'.$this->config['un1matr1x_ogame_color_font'].' !important;"';
		}

		return '><span class="cr4me-link"'.$personal_color.
				'><span class="cr4me-link-image un1matr1x_cr4me-icon"></span>'.$cr_id.'</span><';
	}

	/**
	 * Function to replace cr4.me text links of with an image and a blue bar background
	 * NB: only the output to the visitors user agent is altered, the data in the
	 * database is unchanged.
	 *
	 * @param	string		$text	the original text
	 * @return	string		$text	the text with the replaced cr4me-links
	 * @access	public
	 */
	public function cr4_to_image($text)
	{
		$cr_link_pattern  = '@[^\"]http(s)?://(kb\\.un1matr1x\\.de|cr4\\.me)\\/kb\\.php\\?(?<amp>(&amp;|&))?(';
		$cr_link_pattern .= '(?<query>(lang=)([a-z_]{2,11})?|(pw=)([a-zA-Z0-9]{6})?)|show=(?<id1>[0-9]+))(';
		$cr_link_pattern .= '(?&amp)?((?&query)|show=(?<id2>[0-9]+))?)((?&amp)?((?&query)|show=(?<id3>[0-9]+))?)<@';
		$text             = preg_replace_callback($cr_link_pattern, 'self::cr_link_with_id', $text);

		return $text;

	}
}
