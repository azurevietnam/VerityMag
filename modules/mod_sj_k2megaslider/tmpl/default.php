<?php
/**
 * @package Sj K2 Mega Slider
 * @version 3.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

JHtml::stylesheet('modules/' . $module->module . '/assets/css/styles-color.css');
JHtml::stylesheet('modules/' . $module->module . '/assets/css/styles.css');
if (!defined('SMART_JQUERY') && (int)$params->get('include_jquery', '1')) {
	JHtml::script('modules/' . $module->module . '/assets/js/jquery-1.8.2.min.js');
	JHtml::script('modules/' . $module->module . '/assets/js/jquery-noconflict.js');
	define('SMART_JQUERY', 1);
}
JHtml::script('modules/' . $module->module . '/assets/js/jquery.cycle.all.js');
ImageHelper::setDefault($params);

$image_config = array(
	'type' => $params->get('imgcfg_type'),
	'width' => $params->get('imgcfg_width'),
	'height' => $params->get('imgcfg_height'),
	'quality' => 90,
	'function' => ($params->get('imgcfg_function') == 'none') ? null : 'resize',
	'function_mode' => ($params->get('imgcfg_function') == 'none') ? null : substr($params->get('imgcfg_function'), 7),
	'transparency' => $params->get('imgcfg_transparency', 1) ? true : false,
	'background' => $params->get('imgcfg_background')
);

$small_image_config = array(
	'type' => $params->get('imgcfgnav_type'),
	'width' => $params->get('imgcfgnav_width'),
	'height' => $params->get('imgcfgnav_height'),
	'quality' => 90,
	'function' => ($params->get('imgcfgnav_function') == 'none') ? null : 'resize',
	'function_mode' => ($params->get('imgcfgnav_function') == 'none') ? null : substr($params->get('imgcfgnav_function'), 7),
	'transparency' => $params->get('imgcfgnav_transparency', 1) ? true : false,
	'background' => $params->get('imgcfgnav_background')
);

$instance = rand() . time();
if ($params->get('imgcfgnav_height') > 120) {
	$params->set('imgcfgnav_height', 120);
}
if ($params->get('start') <= 0) {
	$params->set('start', 0);
} else {
	$params->set('start', $params->get('start') - 1);
}
if ($params->get('start') >= count($list)) {
	$params->set('start', count($list) - 1);
}
$options = $params->toObject();

//update for total thumbnails per page

//$width_item = floor(($options->module_width - 24)/ $options->item_per_page);

?>

<div class="megaslider" id="sjk2megaslider_<?php echo $instance; ?>">
	<?php
	if (!empty($options->pretext)): ?>
		<div class="pretext"><?php echo $options->pretext; ?></div>
	<?php endif; ?>

	<div class="mgsl-wrap <?php echo $options->theme ?>">
		<div class="mgsl-wrap-inner <?php echo ($options->direction_display_when == 'hover') ? 'hover' : 'always'; ?>">
			<div class="mgsl-items">
				<?php $i = 0;
				foreach ($list as $item) {
					$i++; ?>
					<div
						class="mgsl-item <?php echo ($i == ($options->start + 1)) ? 'curr' : ''; ?>  <?php echo $options->item_position_description; ?>">
						<!--Begin sj-item-->
						<div class="mgsl-item-image">
							<a href="<?php echo $item->link; ?>" <?php echo SjK2MegaHelper::parseTarget($options->item_link_target); ?>
							   title="<?php echo $item->title; ?>">
								<?php if ($options->theme == 'theme3') { ?>
									<span class="mgsl-image-border-inner"></span>
								<?php } ?>
								<span class="mgsl-image-border"></span>
								<?php

								$img = SjK2MegaHelper::getK2Image($item, $params, $prefix = 'imgcfg');
								if (!empty($img)) {
									$img = ImageHelper::init($img, $image_config)->src();

									if ((is_file($img) && file_exists($img)) || SjK2MegaHelper::isUrl($img)) {
										?>
										<img src="<?php echo $img; ?>" title="<?php echo $item->title; ?>" alt="<?php echo $item->title; ?>"/>
									<?php }
								} ?>
							</a>
						</div>
						<div
							class="mgsl-item-info <?php echo ($options->theme == 'theme2') ? 'style1' : 'style2'; ?> top-<?php echo $options->item_position_description; ?>">
							<div class="transparency"></div>
							<div class="mgsl-item-content">
								<?php if ($item->normal_title != '') { ?>
									<div class="mgsl-item-title">
										<a href="<?php echo $item->link; ?>"  <?php echo SjK2MegaHelper::parseTarget($options->item_link_target); ?>
										   title="<?php echo $item->title; ?>">
											<?php echo $item->normal_title; ?>
										</a>
									</div>
								<?php } ?>
								<?php if ($item->Introtext != '') { ?>
									<div class="mgsl-item-description">
										<?php echo $item->Introtext; ?>
									</div>
								<?php } ?>

								<?php if (!empty($item->tags) && $params->get('item_tags_display',1)) { ?>
									<div class="item-tags">
										<?php foreach ($item->tags as $tag) { ?>
											<span class="tag-<?php echo $tag->id; ?>">
											<a class="label label-info" href="<?php echo $tag->link; ?>" title="<?php echo $tag->name; ?>"
											   target="_blank"><?php echo $tag->name; ?></a>
										</span>
										<?php } ?>
									</div>
								<?php } ?>

								<?php if ($options->item_readmore_display == 1 && $options->item_readmore_text != '') { ?>
									<div class="mgsl-item-readmore <?php echo $options->item_readmore_style ?>">
										<a href="<?php echo $item->link; ?>"  <?php echo SjK2MegaHelper::parseTarget($options->item_link_target); ?>
										   title="<?php echo $item->title; ?>">
											<span>
												<?php echo $options->item_readmore_text; ?>
											</span>
										</a>
									</div>
								<?php } ?>

							</div>
						</div>
					</div><!--End sj-item-->
				<?php } ?>
			</div>
			<?php if ($options->direction_display == 1) { ?>
				<div class="direction-on <?php echo $options->item_position_description; ?>">
					<div class="button-prev"></div>
					<div class="button-next"></div>
				</div>
			<?php } ?>
			<?php if ($options->theme == 'theme3') { ?>
				<?php if ($options->button_display == 1) { ?>
					<div class="pag-buttons">
						<ul class="pag-buttons-inner">
							<?php $i = 0;
							foreach ($list as $item) {
								$i++; ?>
								<li class="pag-button pag-button-<?php echo $i; ?>"><span><?php echo ($i <= 9) ? ('0' . ($i)) : $i; ?></span></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="mgsl-control" style="z-index:<?php echo 2 * count($list); ?>; height:<?php echo $options->imgcfgnav_height + 26 ?>px;">
			<div class="mgsl-nav-background"></div>
			<div class="mgsl-control-inner">
				<?php if ($options->prevnext_display == 1) { ?>
					<div class="mgsl-prev"></div>
					<div class="mgsl-next"></div>
				<?php } ?>
				<?php $left_right = $options->prevnext_display == 1 ? 25 : 9; ?>
				<div class="pag-list" style="left:<?php echo $left_right ?>px;right:<?php echo $left_right ?>px;">
					<ul class="pag-list-inner <?php echo $options->nav_type; ?>">
						<?php $i = 0;
						foreach ($list as $item) {
							$i++; ?>
							<li class="pag-item pag-item-<?php echo $i; ?>  <?php echo ($i == ($options->start + 1)) ? 'active' : ''; ?> "
							    style="width:<?php echo ($options->nav_type == 'type3') ? 180 : ''; ?>px;">
								<div class="pag-item-inner" style="height:<?php echo $options->imgcfgnav_height ?>px;">
									<div class="item-image"
									     style="width:<?php echo $options->imgcfgnav_width ?>px;height:<?php echo $options->imgcfgnav_height ?>px;max-width:<?php echo ($options->nav_type == 'type3') ? 168 : ''; ?>px;">
										<?php
										$img = SjK2MegaHelper::getK2Image($item, $params, $prefix = 'imgcfgnav');
										if (!empty($img)) {
											$img_nav = ImageHelper::init($img, $small_image_config)->src();

											if ((is_file($img_nav) && file_exists($img_nav)) || SjK2MegaHelper::isUrl($img_nav)) {
												?>
												<img src="<?php echo $img_nav; ?>" title="<?php echo $item->title; ?>"
												     alt="<?php echo $item->title; ?>"/>
											<?php }
										} ?>

									</div>
									<div class="item-info"
									     style="width:<?php echo ($options->nav_type == 'type3') ? (180 - $options->imgcfgnav_width - 22) : $options->imgcfgnav_width; ?>px;height:<?php echo $options->imgcfgnav_height ?>px;">
										<div class="item-title">
											<?php echo $item->smalltitle; ?>
										</div>
										<div class="item-description">
											<?php echo $item->SmallIntrotext; ?>
										</div>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Begin sj-mgsl-wrap-->

	<?php
	if (!empty($options->posttext)): ?>
		<div class="posttext"><?php echo $options->posttext; ?></div>
	<?php endif; ?>
</div>

<?php
ob_start();
?>

<?php if ($options->theme == 'theme1') { ?>
	#sjk2megaslider_<?php echo $instance; ?>{
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1{
	height:<?php echo $options->imgcfg_height + 22 + $options->imgcfgnav_height + 26 ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1 .mgsl-wrap-inner{
	height:<?php echo $options->imgcfg_height + 20; ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1  .mgsl-items{
	height:<?php echo $options->imgcfg_height + 20; ?>px;
	width:<?php echo $options->module_width - 2; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1 .mgsl-item{
	height:<?php echo $options->imgcfg_height; ?>px;
	width:<?php echo $options->module_width - 22 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1  .mgsl-item-image{
	width:<?php echo $options->imgcfg_width ?>px;
	height:<?php echo $options->imgcfg_height ?>px;
	max-width:<?php echo $options->module_width - 22 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1 .mgsl-item-info{
	<?php $w1 = $options->module_width - $options->imgcfg_width - 55;
	($w1 > 0) ? $w1 : 0; ?>
	width:<?php echo $w1 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme1 .direction-on{
	width:<?php echo $options->imgcfg_width ?>px;
	max-width:<?php echo $options->module_width - 22 ?>px;
	}
<?php } ?>
<?php if ($options->theme == 'theme2') { ?>
	#sjk2megaslider_<?php echo $instance; ?>{
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2{
	height:<?php echo $options->imgcfg_height + $options->imgcfgnav_height + 26 ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2 .mgsl-wrap-inner{
	height:<?php echo $options->imgcfg_height; ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2  .mgsl-items{
	height:<?php echo $options->imgcfg_height - 2; ?>px;
	width:<?php echo $options->module_width - 2; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2 .mgsl-item{
	height:<?php echo $options->imgcfg_height - 2; ?>px;
	width:<?php echo $options->module_width - 2 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2  .mgsl-item-image{
	width:<?php echo $options->imgcfg_width - 2 ?>px;
	height:<?php echo $options->imgcfg_height - 2 ?>px;
	max-width:<?php echo $options->module_width - 2 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2 .direction-on{
	width:<?php echo $options->imgcfg_width ?>px;
	max-width:<?php echo $options->module_width ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme2 .mgsl-item .transparency{
	display:<?php echo ($options->item_title_display == 1 || $options->item_description_display == 1) ? 'block' : 'none'; ?>
	}
<?php } ?>

<?php if ($options->theme == 'theme3') { ?>
	#sjk2megaslider_<?php echo $instance; ?>{
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3{
	height:<?php echo $options->imgcfg_height + 32 + $options->imgcfgnav_height + 26 ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .mgsl-wrap-inner{
	height:<?php echo $options->imgcfg_height + 32; ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3  .mgsl-items{
	height:<?php echo $options->imgcfg_height + 31; ?>px;
	width:<?php echo $options->module_width - 2; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .mgsl-item{
	height:<?php echo $options->imgcfg_height; ?>px;
	width:<?php echo $options->module_width - 42 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3  .mgsl-item-image{
	width:<?php echo $options->imgcfg_width ?>px;
	height:<?php echo $options->imgcfg_height ?>px;
	max-width:<?php echo $options->module_width - 42 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .mgsl-item-info{
	<?php $w3 = $options->module_width - $options->imgcfg_width - 63;
	($w3 > 0) ? $w3 : 0; ?>
	width:<?php echo $w3; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .direction-on{
	width:<?php echo $options->imgcfg_width - 38 ?>px;
	max-width:<?php echo $options->module_width - 80 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .pag-buttons{
	<?php if ($options->item_position_description == 'left') { ?>
		left:<?php echo ($options->module_width - $options->imgcfg_width - 176) / 2 ?>px;
	<?php } else { ?>
		right:<?php echo ($options->module_width - $options->imgcfg_width - 176) / 2 ?>px;
	<?php } ?>
	z-index:<?php echo 2 * count($list); ?>;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme3 .mgsl-item .mgsl-item-info.style2{
	display:<?php echo ($options->item_title_display == 1 || $options->item_description_display == 1 || $options->button_display == 1) ? 'block' : 'none'; ?>
	}
<?php } ?>

<?php if ($options->theme == 'theme4') { ?>
	#sjk2megaslider_<?php echo $instance; ?>{
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4{
	height:<?php echo $options->imgcfg_height + 22 + $options->imgcfgnav_height + 26 ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4 .mgsl-wrap-inner{
	height:<?php echo $options->imgcfg_height + 20; ?>px;
	width:<?php echo $options->module_width; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4  .mgsl-items{
	height:<?php echo $options->imgcfg_height + 20; ?>px;
	width:<?php echo $options->module_width - 2; ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4 .mgsl-item{
	height:<?php echo $options->imgcfg_height; ?>px;
	width:<?php echo $options->module_width - 52 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4  .mgsl-item-image{
	width:<?php echo $options->imgcfg_width ?>px;
	height:<?php echo $options->imgcfg_height ?>px;
	max-width:<?php echo $options->module_width - 22 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4 .mgsl-item-info{
	<?php $w4 = $options->module_width - $options->imgcfg_width - 85;
	($w4 > 0) ? $w4 : 0; ?>
	width:<?php echo $w4 ?>px;
	}
	#sjk2megaslider_<?php echo $instance; ?> .mgsl-wrap.theme4 .direction-on{
	width:<?php echo $options->imgcfg_width + 30 ?>px;
	max-width:<?php echo $options->module_width - 22 ?>px;
	}

<?php } ?>

<?php
$style_sheet = ob_get_contents();
@ob_end_clean();
$document = JFactory::getDocument();
$document->addStyleDeclaration($style_sheet);
?>
