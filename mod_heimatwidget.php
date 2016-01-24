<?php
/**
* @package     Joomla.Site
* @subpackage  mod_heimatwidget
*
* @copyright   Copyright (C) 2016 mttronc
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

if ($params->get('links'))
{
	$articles = ModHeimatwidgetHelper::getArticles(
		$params->get('links'),
		$params->get('width'),
		$params->get('color_border'),
		$params->get('color_font'));
	require JModuleHelper::getLayoutPath($module->module, 'default');
}
else
{
	echo '<span class="label label-important">Keine Beträge gefunden.</span>';
}
