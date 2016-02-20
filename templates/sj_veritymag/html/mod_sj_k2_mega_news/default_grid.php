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
$item0 = $_items[0];
$other_items = $_items;
    ImageHelper::setDefault($params);
?>

	<div class="item-other">
		<div class="other-link">
			<?php
                $key=0; $i=0;
                foreach ($other_items as $item) { $key++; $i++;?>
                <?php
                    if($key == 1){
                        echo '<div class="magenew-col col-sm-6">';
                    }
                ?>
				<div class="meganew-custom <?php echo ($i == count($other_items) || $i == 1)? " col-sm-12 big-image":" col-sm-6"?>">

                    <?php
                        if($i == count($other_items)){
                            $a = count($other_items) - 1;
                            $img = K2MegaNewsHelper::getK2Image($other_items[$a], $params, 'imgcfgfirst');
                        }else
                        if($i == 1){
                            $img = K2MegaNewsHelper::getK2Image($item0, $params, 'imgcfgfirst');
                        }else{
                            $img = K2MegaNewsHelper::getK2Image($item, $params, 'imgcfg');
                        }
                        
                    if ($img) {
                        ?>
                        <div class="item-image">

                            <a href="<?php echo $item->link; ?>"
                               title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
                                <?php if($i == count($other_items) || $i == 1){
                                    echo K2MegaNewsHelper::imageTag($img, $first_image_config);
                                }else{
                                    echo K2MegaNewsHelper::imageTag($img, $image_config);
                                }
                                    ?>
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
                                        <?php echo K2MegaNewsHelper::truncate($item->name, $params->get('item_title_max_characs'),''); ?>
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
                <?php
                    if($key == 3 || $key == count($other_items)){
                        echo '</div>';$key = 0;
                    }
                ?>

			<?php } ?>
		</div>
	</div>
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