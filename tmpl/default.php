<?php
/**
* @package     Joomla.Site
* @subpackage  mod_heimatnews
*
* @copyright   Copyright (C) 2016 mttronc
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

if (!$articles)
{
  echo '<span class="label label-important">Keine Beträge gefunden.</span>';
}
$width = $params->get('width','450') - 12;
?>
<style>
.heimatwidget
{
  width: <?php echo $width; ?>px;
  padding: 5px;
  font-family: Arial, 'Nimbus Sans L', sans-serif;
  font-size: 12px;
  color: <?php echo $params->get('color_font','#111111'); ?>;
  background-color: <?php echo $params->get('color_bg','#ffffff'); ?>;
  border: 1px solid <?php echo $params->get('color_border','#bbbbbb'); ?>;
  line-height: 15px;
  overflow: hidden;
}
</style>
<?php foreach($articles as $article) : ?>
  <div class="heimatwidget">
    <?php echo $article->content; ?>
  </div>
<?php endforeach; ?>
