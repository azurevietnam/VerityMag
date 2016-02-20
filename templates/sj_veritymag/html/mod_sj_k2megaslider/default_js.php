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
?>
<script type="text/javascript">
	//<![CDATA[		
	jQuery(document).ready(function($){
		function setSlidingTo(index, options){
			var tabs = $('#sjk2megaslider_<?php echo $instance;?> .pag-list .pag-item');
			var tabs_holder = tabs.eq(0).parent();
			var tabs_container = tabs_holder.parent();
							
			if (tabs_container && tabs_holder){
				tabs_container.css({height: function(){
					return tabs_container.height();
				}});
				tabs_container.css({position: 'absolute'});
				tabs_holder.css({position: 'absolute'});
			}
			var viewport   = {};
			viewport.left  = 0;
			viewport.right = tabs_container.width();
			
			var visible   = {};
			visible.left  = viewport.left  - parseInt( tabs_holder.position().left );
			visible.right = viewport.right - parseInt( tabs_holder.position().left );
			
			var posUpdate = function(){
				visible.left  = viewport.left  - parseInt( tabs_holder.position().left );
				visible.right = viewport.right - parseInt( tabs_holder.position().left );
			};
			
			var slidingTo = function(index, d){
				if (!d){
					d = 500
				}
				if (index >= 0){
					if (index == 0){
						index = 1;
					}
					var prevLeft = tabs.eq(index-1).position().left;
					if (prevLeft < visible.left){
						tabs_holder.animate({
							left: '+='+(visible.left-prevLeft)+'px'
						}, {
							duration: d,
							complete: posUpdate,
							queue:false 
						});
					}
				}
				if (index < tabs.length){
					if (index == tabs.length-1){
						index = tabs.length-2;
					}
					var nextRight = tabs.eq(index+1).position().left + tabs.eq(index+1).width();
					if (nextRight > visible.right){
						tabs_holder.animate({
							left: '-='+(nextRight-visible.right)+'px'
						}, {
							duration: d,
							complete: posUpdate,
							queue:false 
						});
					}
				}
			};								
			slidingTo(index);	
		}
		function setSlidingButton(index, options){
			var tabs = $('#sjk2megaslider_<?php echo $instance;?> .pag-buttons .pag-button');
			var tabs_holder = tabs.eq(0).parent();
			var tabs_container = tabs_holder.parent();
							
			if (tabs_container && tabs_holder){
				tabs_container.css({height: function(){
					return tabs_container.height();
				}});
				tabs_container.css({position: 'absolute'});
				tabs_holder.css({position: 'absolute'});
			}
			var viewport   = {};
			viewport.left  = 0;
			viewport.right = tabs_container.width();
			
			var visible   = {};
			visible.left  = viewport.left  - parseInt( tabs_holder.position().left );
			visible.right = viewport.right - parseInt( tabs_holder.position().left );
			
			var posUpdate = function(){
				visible.left  = viewport.left  - parseInt( tabs_holder.position().left );
				visible.right = viewport.right - parseInt( tabs_holder.position().left );
			};
			
			var slidingbutton = function(index, d){
				if (!d){
					d = 500
				}
				if (index >= 0){
					if (index == 0){
						index = 1;
					}
					var prevLeft = tabs.eq(index-1).position().left;
					if (prevLeft < visible.left){
						tabs_holder.animate({
							left: '+='+(visible.left-prevLeft)+'px'
						}, {
							duration: d,
							complete: posUpdate,
							queue:false 
						});
					}
				}
				if (index < tabs.length){
					if (index == tabs.length-1){
						index = tabs.length-2;
					}
					var nextRight = tabs.eq(index+1).position().left + tabs.eq(index+1).width();
					if (nextRight > visible.right){
						tabs_holder.animate({
							left: '-='+(nextRight-visible.right)+'px'
						}, {
							duration: d,
							complete: posUpdate,
							queue:false 
						});
					}
				}
			};								
			slidingbutton(index);	
		}		
		
		$('#sjk2megaslider_<?php echo $instance;?>  .mgsl-items').sjmegacycle({	
			before: function(curr, next, options){
				$('#sjk2megaslider_<?php echo $instance;?> .mgsl-item').eq(options.startingSlide).addClass('curr');
				if (typeof options.inited == 'undefined'){
					var slidingTo = options.startingSlide;
					options.inited = true;					
					if(typeof options.fxs != 'undefined'){						
						var tmp=[];
						var j=0;											
						for(var i=0;i<options.fxs.length;i++){
							if(options.fxs[i]=='none'){												
								continue;
							}										
							tmp[j++]=options.fxs[i];													
						}					
						if(tmp.length!=options.fxs.length){
							options.fxs=tmp;
						}		
						
					}										
				} else {
					var slidingTo = options.nextSlide;
					$('#sjk2megaslider_<?php echo $instance;?> .mgsl-item').removeClass('curr');
					$('#sjk2megaslider_<?php echo $instance;?> .mgsl-item').eq(options.nextSlide).addClass('curr').css({left:0,top:0});
				}
				setSlidingTo(slidingTo, options);
				<?php if($options->theme=='theme3' && $options->button_display==1)  {?>
					setSlidingButton(slidingTo, options);
				<?php } ?>	
			},			
			fx: '<?php echo $options->effect; ?>',
			speed:<?php echo $options->slideshow_speed; ?>,
			timeout:<?php echo ($options->play==1)?($options->timer_speed):0; ?>,
			pause:<?php echo $options->pause_hover ;?>,
			startingSlide:<?php echo $options->start; ?>,
			pager: '#sjk2megaslider_<?php echo $instance;?> .pag-list .pag-item,  #sjk2megaslider_<?php echo $instance;?> .pag-buttons .pag-button',
			pagerAnchorBuilder: function(i, el){
				return $('#sjk2megaslider_<?php echo $instance;?>  .pag-list .pag-item:eq(' + i + ') , #sjk2megaslider_<?php echo $instance;?> .pag-buttons .pag-button:eq(' + i + ')');
			},
			updateActivePagerLink: function(pager, i, clsName){
				$('#sjk2megaslider_<?php echo $instance;?> .pag-list .pag-item').removeClass('active').eq(i).addClass('active');
				$('#sjk2megaslider_<?php echo $instance;?> .pag-buttons .pag-button').removeClass('active').eq(i).addClass('active');
			},
			next: '#sjk2megaslider_<?php echo $instance;?> .button-next , #sjk2megaslider_<?php echo $instance;?> .mgsl-next',
			prev: '#sjk2megaslider_<?php echo $instance;?> .button-prev , #sjk2megaslider_<?php echo $instance;?> .mgsl-prev',			
			pagerEvent: '<?php echo $options->pager_event; ?>'				
		});		
	});
	//]]>
</script>