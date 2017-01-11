<?php
/**
 * @package    Makosa
 * @author     Brian Teeman
 * @copyright  (C) 2016 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;
/**
 * Makosa Plugin by Brian Teeman
 *
 * @since  1.0.0
 */
class plgSystemMakosa extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the Makosa
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	private function displayMakosa()
	{
		$display_makosa = false;

		if (!$display_makosa)
		{
			$bgimage_url    = JUri::base() . 'media/plg_makosa/images/' . $this->params->get('bgimage', '404error.jpg');
			$caption        = $this->params->get('caption', '');
			$fonts          = $this->params->get('fonts', 'Roboto+Slab|Roboto');
			$font 			= str_replace("+", " ", $fonts);
			$font           = explode("|", $font);
			$text           = $this->params->get('text', JText::_('PLG_SYSTEM_MAKOSA_404'));
			$title 			= $this->params->get('title', $this->app->get('sitename'));
			$uri            = JUri::getInstance();

			// Social Media
			$facebook       = $this->params->get('facebook', '');
			$facebook_url   = 'https://facebook.com/' . $facebook;
			$instagram      = $this->params->get('instagram', '');
			$instagram_url  = 'https://instagram.com/' . $instagram;
			$twitter        = $this->params->get('twitter', '');
			$twitter_url    = 'https://twitter.com/' . $twitter;
			$youtube        = $this->params->get('youtube', '');
			$youtube_url    = 'https://youtube.com/' . $youtube;

			$path = JPluginHelper::getLayoutPath('system', 'makosa');
			include $path;

			$this->app->close();
		}

	}
	
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
		JError::setErrorHandling(E_ERROR, 'callback', array('PlgSystemMakosa', 'checkError'));
	}



	public static function checkError(&$error)
	{
			
			$app = JFactory::getApplication();
			
            if (!$app->isAdmin() and ($error->getCode() == 404)) {
			    header('HTTP/1.0 404 Not Found');
				echo "hello world";
			//	$this->displayMakosa();
				exit();
			}
			else JError::customErrorPage($error);   
	}
}
?>