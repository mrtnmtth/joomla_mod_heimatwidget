<?php
/**
* @package     Joomla.Site
* @subpackage  mod_heimatwidget
*
* @copyright   Copyright (C) 2016 mttronc
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

/**
 * Helper for mod_heimatwidget
 *
 * @since  0.1
 */
class ModHeimatwidgetHelper
{
	public static function getArticles($links, $width, $color_border, $color_font)
	{
		$urls = explode("\n", $links);
		$articles = array();
		foreach($urls as $url)
		{
			$article = new stdClass();
			$article->url = $url;
			// regex replaces everything that is not a digit
			$article->id = preg_replace('/\D/', '', strrchr($url, '-d'));
			// continue with next item if no id can be determined
			if (!$article->id) continue;
			$article->ajax = 'http://www.myheimat.de/ajax/widgets/action/loadjs/'
				.'generateWidget/?widget_width='.$width.'&widget_colorBorder='
				.trim($color_border, '#').'&widget_colorFont='.trim($color_font, '#')
				.'&widget_type=document&meta_document='.$article->id;
			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_URL, $article->ajax);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$article->content = curl_exec ($curl);
			curl_close ($curl);
			$article->content = ltrim(ltrim($article->content),
				'document.getElementById(\'\').innerHTML = \'');
			$article->content = rtrim(rtrim($article->content), '\';');
			array_push($articles, $article);
		}
		return $articles;
	}
}
