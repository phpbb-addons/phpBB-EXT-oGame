<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\migrations\data\v030;

/**
 * profilefield for gameforge.com-ID
 */
class profilefield_gameforge extends \phpbb\db\migration\profilefield_base_migration
{
	public static function depends_on()
	{
		return array(
			'\un1matr1x\ogame\migrations\release_0_3_1',
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'create_custom_field'))),
		);
	}

	protected $profilefield_name = 'ogame_gameforge';

	protected $profilefield_database_type = array('VCHAR', '');

	protected $profilefield_data = array(
		'field_name'			=> 'ogame_gameforge',
		'field_type'			=> 'profilefields.type.string',
		'field_ident'			=> 'ogame_gameforge',
		'field_length'			=> '20',
		'field_minlen'			=> '1',
		'field_maxlen'			=> '20',
		'field_novalue'			=> '',
		'field_default_value'	=> '',
		'field_validation'		=> '[0-9]+',
		'field_required'		=> 0,
		'field_show_novalue'	=> 0,
		'field_show_on_reg'		=> 0,
		'field_show_on_pm'		=> 1,
		'field_show_on_vt'		=> 1,
		'field_show_profile'	=> 1,
		'field_hide'			=> 0,
		'field_no_view'			=> 0,
		'field_active'			=> 1,
		'field_is_contact'		=> 1,
		'field_contact_desc'	=> 'SHOW_GAMEFORGE_PROFILE',
		'field_contact_url'		=> 'http://gameforge.com/profile/show/%s',
	);
}
