<?php
/**
* @package     Joomla.Site
* @subpackage  mod_heimatnews
*
* @copyright   Copyright (C) 2016-2017 mttronc
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

if (!$articles)
  echo '<span class="label label-important">Keine Beträge gefunden.</span>';
?>

<?php if (!$params->get('css','0')):
  $width = $params->get('width','450') - 12;
  if ($params->get('fluidwidth','0')):
    $width = 'max-width: ' . $width . 'px;';
  else:
    $width = 'width: ' . $width . 'px;';
  endif;
?>
  <style>
  .heimatwidget
  {
    <?php echo $width; ?>
    padding: 5px;
    color: <?php echo $params->get('color_font','#111111'); ?>;
    background-color: <?php echo $params->get('color_bg','#ffffff'); ?>;
    border: 1px solid <?php echo $params->get('color_border','#bbbbbb'); ?>;
  }
  </style>
<?php endif; ?>

<?php foreach($articles as $article) : ?>
  <div class="heimatwidget">
    <?php echo $article->content; ?>
  </div>
<?php endforeach; ?>

<?php if ($params->get('css','0')): ?>
  <?php JHtml::_('jquery.framework', false); ?>
  <?php JHtml::_('bootstrap.loadCss'); ?>
  <?php /* remove original styling and add Bootstrap classes */ ?>
  <script>
    jQuery('.heimatwidget').find('*').removeAttr('style');
    jQuery('.heimatwidget').each(function() {
      var a = jQuery(this).find('a.pointer').detach();
      var h = jQuery(this).find('h3>a').detach();
      jQuery(this).find('h3').remove();
      jQuery(this).find('.mediadbgalleryfloat').remove();
      jQuery(this).find('div>div').remove();
      jQuery(this).prepend(a);
      jQuery(this).addClass('media');
      jQuery(this).find('a.pointer')
        .addClass('pull-<?php echo $params->get('img_pull','left'); ?>');
      jQuery(this).find('a.pointer>img').addClass('media-object');
      jQuery(this).find('div').first().addClass('media-body');
      jQuery(this).find('div').first().prepend(h);
      jQuery(jQuery(this).find('div>a').contents()).wrap('<h4></h4>');
      jQuery(this).find('h4').addClass('media-heading');
      jQuery(jQuery(this).find('div').first().contents().eq(3))
        .wrap('<p style="line-height: 15px; text-align: justify;"></p>');
      jQuery(jQuery(this).find('div').last().contents()).wrap('<b></b>');
    });

    <?php if ($params->get('fixedheight','1')): ?>
      jQuery(document).ready(function() {
        jQuery('.heimatwidget').each(function() {
          var height = jQuery(jQuery(this).find('a.pointer>img')).height() + 10;
          var div = jQuery(this).find('.media-body');
          var text = jQuery(div).find('p').text().split(' ');
          jQuery(div).attr('style', 'height: ' + height + 'px;');
          while (div.prop('scrollHeight') > div.height()) {
            text.pop();
            jQuery(div).find('p').html(text.join(' ') + '...');
          }
        });
      });
    <?php endif; ?>
  </script>
<?php endif; ?>
