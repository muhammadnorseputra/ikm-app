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
		 elseif($theme_active == 'default'):
		 	$theme_component = ['bg' => 'bg-default', 'text' => 'text-white', 'navbar' => 'navbar-dark'];
		 else:
		 	$theme_component = ['bg' => 'bg-white', 'text' => 'text-white', 'navbar' => 'navbar-dark'];
		 endif;

		 $t_component = '';
		 foreach ($property as $key => $value) {
		 	$t_component .= $theme_component[$value]." ";
		 }
		 return $t_component;
	}
	function meta_theme($uri) {
		if($uri === 'skm') {
			$meta = "<meta content='#0d6efd' name='theme-color' />
							<meta content='#0d6efd' name='msapplication-TileColor' />
							<meta content='#0d6efd' name='msapplication-navbutton-color' />
							<meta content='#0d6efd' name='apple-mobile-web-app-status-bar-style' />
							<meta content='true' name='apple-mobile-web-app-capable' />";
		} elseif($uri === 'ikm') {
			$meta = "<meta content='#212529' name='theme-color' />
							<meta content='#212529' name='msapplication-TileColor' />
							<meta content='#212529' name='msapplication-navbutton-color' />
							<meta content='#212529' name='apple-mobile-web-app-status-bar-style' />
							<meta content='true' name='apple-mobile-web-app-capable' />";
		} elseif($uri == 'survei') {
			$meta = "<meta content='#198754' name='theme-color' />
							<meta content='#198754' name='msapplication-TileColor' />
							<meta content='#198754' name='msapplication-navbutton-color' />
							<meta content='#198754' name='apple-mobile-web-app-status-bar-style' />
							<meta content='true' name='apple-mobile-web-app-capable' />";
		} else {
			$meta = "<meta content='#0d6efd' name='theme-color' />
							<meta content='#0d6efd' name='msapplication-TileColor' />
							<meta content='#0d6efd' name='msapplication-navbutton-color' />
							<meta content='#0d6efd' name='apple-mobile-web-app-status-bar-style' />
							<meta content='true' name='apple-mobile-web-app-capable' />";
		}
		return $meta;
	}
}