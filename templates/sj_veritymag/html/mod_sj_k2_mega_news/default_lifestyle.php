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
<?php
$item0 = array_shift($_items);
$other_items = $_items;
?>
	<div class="item-first col-sm-6 col-sm-push-3">
        <div class="item-first-inner">

		<?php $img = K2MegaNewsHelper::getK2Image($item0, $params, 'imgcfgfirst');
		if ($img) {
            //var_dump($item0);die;
			?>
			<div class="item-image">
				<a href="<?php echo $item0->link; ?>"
				   title="<?php echo $item0->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
					<?php echo K2MegaNewsHelper::imageTag($img, $first_image_config); ?>
				</a>

			</div>
		<?php } ?>
        <div class="item-category">
            <a href="<?php echo $item0->cat_link; ?>"
               title="<?php echo $item0->categoryname; ?>" >
                <?php echo $item0->categoryname; ?>
            </a>
        </div>
        <?php if (($params->get('item_title_display') == 1) || ($options->item_desc_display == 1 && $item0->displayIntrotext != '')) { ?>
            <div class="item-info">
                <?php if ($params->get('item_title_display') == 1) { ?>
                    <div class="item-title">
                        <h3>
                        <a href="<?php echo $item0->link; ?>"
                           title="<?php echo $item0->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
                            <?php echo K2MegaNewsHelper::truncate($item0->name, $params->get('item_title_max_characs')); ?>
                        </a>
                        </h3>
                    </div>

                    <?php if ($params->get('item_created_display', 1)) {?>
                        <span class="item-created"><?php echo JText::sprintf( JHtml::_('date', $item0->created, JText::_('DATE_FORMAT_TEMPLATE')));?></span>
                    <?php } ?>
                    <?php if ($params->get('item_author_display', 1)) {?>
                        <div class="item-author">
                            <?php echo JText::_('K2_AUTHOR_BY'); ?>
                
                            <?php if(isset($item0->authorLink)): ?>
                            <a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item0->author); ?>" href="<?php echo $item0->authorLink; ?>"><?php echo $item0->author; ?></a>
                            <?php else: ?>
                            <?php echo $item0->author; ?>
                            <?php endif; ?>
                        </div>
                         
                    <?php } ?>
                <?php } ?>
                <?php if ($options->item_desc_display == 1 && $item0->displayIntrotext != '') { ?>
                    <div class="item-description">
                        <?php echo ($params->get('item_desc_max_characs') >1)?(K2MegaNewsHelper::truncate($item0->displayIntrotext, $params->get('item_desc_max_characs')-1,'')):$item0->displayIntrotext; ?>
                    </div>
                <?php } ?>
            </div>

		<?php
		} ?>



		<?php if ($params->get('itemCommentsCounter') == 1) { ?>
			<div class="item-comment">
				<?php
				if ($item0->numOfComments == 1) {
					echo $item0->numOfComments . '&nbsp;' . 'comment';
				} else {
					echo $item0->numOfComments . '&nbsp;' . 'comments';
				}
				?>
			</div>
		<?php } ?>

		<?php if ($item0->tags != '' && !empty($item0->tags)) { ?>
			<div class="item-tags">
				<div class="tags">
					<?php $hd = -1;
					foreach ($item0->tags as $tag): $hd++; ?>
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
				<a href="<?php echo $item0->link; ?>"
				   title="<?php echo $item0->title; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?> >
					<?php echo $params->get('item_readmore_text'); ?>
				</a>
			</div>
		<?php } ?>
        </div>
	</div>
<?php if (!empty($other_items) && $params->get('item_more_display',1)) { ?>

			<?php
                
                foreach ($other_items as $key=>$item) { ?>
				<div class="col-sm-3 <?php echo ($key==0) ? "col-sm-pull-6" : " ";?>">

                    <?php
                    $img = K2MegaNewsHelper::getK2Image($item, $params);
                    if ($img) {
                        ?>
                        <div class="item-image">

                            <a href="<?php echo $item->link; ?>"
                               title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
                                <?php echo K2MegaNewsHelper::imageTag($img, $image_config); ?>
                            </a>

                        </div>
                    <?php } ?>
                    <div class="item-category">
                        <a href="<?php echo $item->cat_link; ?>"
                           title="<?php echo $item->categoryname; ?>" >
                            <?php echo $item->categoryname; ?>
                        </a>
                    </div>
					<?php if (($params->get('item_title_display') == 1) || ($options->item_desc_display == 1 && $item->displayIntrotext != '')) { ?>
                        <div class="item-info">
                            <?php if ($params->get('item_title_display') == 1) { ?>
                                <div class="item-title">
                                    <h3>
                                    <a href="<?php echo $item->link; ?>"
                                       title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
                                        <?php echo K2MegaNewsHelper::truncate($item->name, $params->get('item_title_max_characs')); ?>
                                    </a>
                                    </h3>
                                </div>

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
                            <?php } ?>
                            <?php if ($options->item_desc_display == 1 && $item->displayIntrotext != '') { ?>
                                <div class="item-description">
                                    <?php echo ($params->get('item_desc_max_characs') >1)?(K2MegaNewsHelper::truncate($item->displayIntrotext, $params->get('item_desc_max_characs')-1,'')):$item->displayIntrotext; ?>
                                </div>
                            <?php } ?>
                        </div>

                    <?php } ?>
				</div>
			<?php } ?>

<?php
}
if ((int)$params->get('item_viewall_display', 1)) {
	?>
	<div class="meganew-viewall">
		<a href="<?php echo $items->link; ?>"
		   title="<?php echo $items->name; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?> >
			<?php echo $params->get('item_viewall_text', 'View') . ' ' . $items->name; ?>
		</a>
	</div>
<?php } ?>