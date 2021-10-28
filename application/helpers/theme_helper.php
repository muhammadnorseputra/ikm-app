<?php  
/**
 * Function Name
 *
 * Function Description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */
 
if (! function_exists('theme'))
{
	function theme($property=null,$component=null)
	{
		 $CI =& get_instance();
		 $uid = $CI->session->userdata('user_id');
		 $theme = $CI->users->user_preferensi($uid)->row();
		 $theme_active = $theme->$component;
		 $theme_component = [];
		 if($theme_active == 'dark'):
		 	$theme_component = ['bg' => 'bg-dark', 'text' => 'text-white', 'navbar' => 'navbar-dark'];
		 elseif($theme_active == 'light'):
		 	$theme_component = ['bg' => 'bg-light', 'text' => 'text-dark', 'navbar' => 'navbar-light'];
		 elseif($theme_active == 'white'):
		 	$theme_component = ['bg' => 'bg-white', 'text' => '', 'navbar' => 'navbar-light'];
		 elseif($theme_active == 'primary'):
		 	$theme_component = ['bg' => 'bg-primary', 'text' => 'text-white', 'navbar' => 'navbar-dark'];
		 else:
		 	$theme_component = ['bg' => 'bg-primary', 'text' => 'text-white', 'navbar' => 'navbar-dark'];
		 endif;

		 $t_component = '';
		 foreach ($property as $key => $value) {
		 	$t_component .= $theme_component[$value]." ";
		 }
		 return $t_component;
	}
}