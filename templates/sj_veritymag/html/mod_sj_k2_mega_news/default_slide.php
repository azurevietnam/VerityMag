<?php
/**
 * @package SJ Mega News for K2
 * @version 3.1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;
?>
<?php $rest = 0;
foreach ($_items as $item) {
	$rest++; ?>
	<div id="yt_custom_id_<?php echo $rest;?>" class="meganew-item">
		<div class="meganew-item-inner">
			<?php
			$img = K2MegaNewsHelper::getK2Image($item, $params);
                //var_dump($img);die;
			if ($img) {
				?>
				<div class="item-image">
					<a href="<?php echo $item->link; ?>"
					   title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
						<?php echo K2MegaNewsHelper::imageTag($img); ?>
					</a>
				</div>
			<?php } ?>
            <?php if (($params->get('item_title_display') == 1) || ($options->item_desc_display == 1 && $item->displayIntrotext != '') || ($item->tags != '' && !empty($item->tags) || ($params->get('item_readmore_display') == 1)) || $params->get('item_created_display', 1) || $params->get('item_author_display', 1) || $params->get('item_authorAvatar_display')) { ?>
            <div class="item-info">

            <?php if ($params->get('item_title_display') == 1) { ?>
				<div class="item-title">
					<h3><a href="<?php echo $item->link; ?>"
					   title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
						<?php echo K2MegaNewsHelper::truncate($item->name, $params->get('item_title_max_characs'),''); ?>
					</a></h3>
				</div>
			<?php
			} ?>
            <div class="item-author-info">
            <?php if($params->get('item_authorAvatar_display')): ?>
				<div class="item-avatar"><a class="k2Avatar moduleItemAuthorAvatar" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" rel="author" href="<?php echo $item->authorLink; ?>">
						<img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="height:auto;" />
				</a></div>
			<?php endif; ?>
            <?php if ($params->get('item_created_display', 1)) {?>
                <span class="item-created"><?php echo JText::sprintf( JHtml::_('date', $item->created, JText::_('DATE_FORMAT_TEMPLATE')));?></span>
            <?php } ?>
            <?php if ($params->get('item_author_display', 1)) {?>
                <div class="item-author">
					<?php echo JText::_('K2_AUTHOR_BY'); ?>
		
					<?php if(isset($item->authorLink)): ?>
					<a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
					<?php else: ?>
					<?php echo $item->author; ?>
					<?php endif; ?>
				</div>
				 
            <?php } ?>
            </div>
			<?php if ($options->item_desc_display == 1 && $item->displayIntrotext != '') { ?>
				<div class="item-description">
                <?php echo ($params->get('item_desc_max_characs') >1)?(K2MegaNewsHelper::truncate($item->displayIntrotext, $params->get('item_desc_max_characs')-1,'')):$item->displayIntrotext; ?>

				</div>
			<?php } ?>



			<?php if ($params->get('itemCommentsCounter') == 1) { ?>
				<div class="item-comment">
					<?php
					if ($item->numOfComments == 1) {
						echo $item->numOfComments . '&nbsp;' . 'comment';
					} else {
						echo $item->numOfComments . '&nbsp;' . 'comments';
					}
					?>
				</div>
			<?php } ?>

			<?php if ($item->tags != '' && !empty($item->tags)) { ?>
				<div class="item-tags">
					<div class="tags">
						<?php $hd = -1;
						foreach ($item->tags as $tag): $hd++; ?>
							<span class="tag-<?php echo $tag->id . ' tag-list' . $hd; ?>">
								<a class="label label-info" href="<?php echo $tag->link; ?>"
								   title="<?php echo $tag->name; ?>" target="_blank">
									<?php echo $tag->name; ?>
								</a>
							</span>
						<?php endforeach; ?>
					</div>
				</div>
			<?php } ?>

			<?php if ($params->get('item_readmore_display') == 1) { ?>
				<div class="item-readmore">
					<a href="<?php echo $item->link; ?>"
					   title="<?php echo $item->name; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?> >
						<?php echo $params->get('item_readmore_text'); ?>
					</a>
				</div>
			<?php } ?>
</div>
<?php } ?>
		</div>
	</div>
	<?php
	$cleart = 'clrt1';
	if ($rest % 2 == 0) $cleart .= ' clrt2';
	if ($rest % 3 == 0) $cleart .= ' clrt3';
	if ($rest % 4 == 0) $cleart .= ' clrt4';
	if ($rest % 5 == 0) $cleart .= ' clrt5';
	if ($rest % 6 == 0) $cleart .= ' clrt6';
	?>
	<div class="<?php echo $cleart; ?>"></div>
<?php } ?>
<?php
if ((int)$params->get('item_viewall_display', 1)) {
	?>
	<div class="meganew-viewall">
		<a href="<?php echo $items->link; ?>"
		   title="<?php echo $items->name; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?> >
			<?php echo $params->get('item_viewall_text', 'View') . ' ' . $items->name; ?>
		</a>
	</div>
<?php } ?>