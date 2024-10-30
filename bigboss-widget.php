<?php
/**
* Plugin Name: Bigboss Recent Post Widget
* Plugin URI: http://wordpress.org/plugins/bigboss-recent-post-widget
* Description: Bigboss Recent Post Widget for Showing Recent Post with thumbnail and title in widget/sidebar area of your 	
  wordpress site with Exceptional setting option thumbnails size , thumbnails border , title font size , color etc.
* Version: 4.0.2
* Author: Bulbul bigboss
* Author URI: https://www.facebook.com/bulbulbigbossbd
* Text Domain: bigboss-recent-post-widget
* Tags:Latest-news,Advance recent post,Recent post shortcode, Recent post Seting ,Latest news widget with thumbnials and title ,
post widget thumbnails , recent post thumbnails , thumbnail and post title widget
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


//

class BbWidgetArea extends WP_Widget{
	
	
	public function __construct(){
			parent::__construct(false,'Bigboss Recent Post Widget', array(
			
					'description' => 'Bigboss Recent Post Widget for Showing Recent Post with thumbnail and title (excluding current post) in widget/sidebar area of your wordpress site' 
			));
		
		}
		
		
		
public function widget($args, $instance){
		
		$title = $instance['title'];
		$bbpostimg = $instance['post-image-size'];
		$bbpostimgpostion = $instance['thumbpostionb'];
		$bbtitlepostion = $instance['bbtitlepostion'];
		$thumbdis = $instance['thumbdis'];
		$bbtitlecolor = $instance['bbtitlecolor'];
		$bbpostdate  = $instance['bbpostdate'];
		$bbtitlefontsize = $instance['bbtitlefontsize'];
		$bbpostauthor = $instance['bbpostauthor'];
		$bbnumberofpost =$instance['bbnumberofpost'];
		?>
        
        <style type="text/css">
		.bbrecentpost-area{
			width:100%;
			height:auto;
			float:left;
			}
        
        .bbpost-thumb{
			width:27%;
			height:auto;
			float:<?php echo $bbpostimgpostion ;?>;
			}
		.bbpost-thumb img{
			width:<?php echo $bbpostimg ; ?> ;
			display:<?php if($thumbdis=='NO'){
				echo "none";
				
				} 
				else{
					echo "block";
					
					}
				
				?> ;
				height:auto;
				border-radius:3px;
				box-shadow:1px 1px 2px 1px <?php echo $bbtitlecolor; ?>;
				padding:3px;
				transition:1s all;
			}
		.bbpost-thumb img:hover{
			transform: scale(1.1);
			}	
		 .title-area{
			 	width:<?php if($thumbdis=='NO'){
				echo "100%" ;
				
				}
				else {
					echo "65%" ;
					}?>;
				float:<?php echo $bbtitlepostion; ?> ;
				height:auto;
				margin-left:5%;
				}
		.bbpost-title{
			color:<?php echo $bbtitlecolor; ?> !important;
			line-height:normal;
			font-size:<?php echo $bbtitlefontsize ; ?>px ;
			transition:1s all;
			}
		.bbpost-title:hover{
			transform: scale(1.1);
			}
		.bbpost-date{
			display:<?php if($bbpostdate=='NO'){
				echo "none";
				
				} 
				else{
					echo "block";
					
					}
				
				?>;
				font-size:10px;}
			
		.bbrecentpost-area li {
				width: 100%;
				float: left;
				list-style: none;
				margin-bottom: 5px;
				margin-top: 5px;
			}
		.widget_bbwidgetarea{
			float:left;
			}
		.post-author{display:<?php if($bbpostauthor=='NO'){
				echo "none";
				
				} 
				else{
					echo "block";
					
					}
				
				?>;
				font-size:10px; }
        
        
        
        </style>
        
        <?php echo $args['before_widget'];?>
        
        <?php echo $args['before_title'] . $title .$args['after_title'] ; ?>
        
              
        
        <ul class="bbrecentpost-area">
		
         <?php
		 
	global $post;

    $args=array(
    'post_type' => 'post',
    'orderby' => 'post_date',
    'posts_per_page' => $bbnumberofpost,
	'post__not_in' => array( $post->ID )
    );

   $bbpost= query_posts($args);
   ?>
 
		 <?php if ($bbpost): ?>
         <?php foreach ($bbpost as $post): ?>
         <?php setup_postdata($post); ?>
        
      
  
        
        
        <li>
        <a class="bbpost-title" href="<?php the_permalink();?>">
        <div class="bbpost-thumb"><?php the_post_thumbnail();?></div>
        <div class="title-area">
        <?php the_title();?></a>
        <p class="bbpost-date">Post on : <?php echo get_the_date(); ?> </p>
        <p class="post-author">By: <?php the_author();?></p>
        </div>
        </li>
       
        
      
        <?php endforeach; ?>
 <?php else : ?>
    <h4 class="center">No Post Found</h2>
    <p class="center"> If You are admin add some post</p>
    <?php include (TEMPLATEPATH . "/searchform.php"); ?>
 <?php endif; ?>
       
        
         </ul>
       <?php echo ' '.$args['after_widget'].' .'; ?>
        
       
		
		
		<?php  }
		
		
	
	
/*form function from here 

Form Function Start from here 

*/		
public function form($instance){
		$title = $instance['title'];
		$bbpostimg = $instance['post-image-size'];
		$bbpostimgpostion = $instance['thumbpostionb'];
		$bbtitlepostion = $instance['bbtitlepostion'];
		$thumbdis = $instance['thumbdis'];
		$bbtitlecolor = $instance['bbtitlecolor'];
		$bbpostdate  = $instance['bbpostdate'];
		$bbtitlefontsize = $instance['bbtitlefontsize'];
		$bbpostauthor = $instance['bbpostauthor'];
		$bbnumberofpost =$instance['bbnumberofpost'];
		
		?>
    
    <p>
    	<label for="<?php $this->get_field_id('title');?>">Title</label>
        <input type="text" name="<?php echo $this->get_field_name('title');?>" id="<?php $this->get_field_id('title');?>" class="widefat" value="<?php echo $title ; ?>" />
        
        </p>
        
           <p>
        <label for="<?php $this->get_field_id('bbnumberofpost');?>"> Number of Post - Eg: 30 <br/> set 0 to show all</label>
        
        <input type="number" class="widefat" name="<?php echo $this->get_field_name('bbnumberofpost');?>" id="<?php $this->get_field_id('bbnumberofpost');?>" value="<?php echo $bbnumberofpost; ?>">
        
 
         
    
    </p>
        
        
        
        
         <p>
        <label for="<?php $this->get_field_id('thumbdis');?>">Show Post Thumbnails </label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('thumbdis');?>" 
        id="<?php $this->get_field_id('thumbdis');?>">
        
        	<option><?php echo $thumbdis ;?> </option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        
        </select>
         
    
    </p>
        
        
        
        
        
        
        
        <?php if($thumbdis=='YES'){?>
        <p>
        <label>Post thumbnails Size exam : 90px</label>
        
         <input type="text" name="<?php echo $this->get_field_name('post-image-size');?>" id="<?php $this->get_field_id('post-image-size');?>" class="widefat" value="<?php echo $bbpostimg ; ?>" />
         
    
    </p>
    
    
      <p>
        <label for="<?php $this->get_field_id('thumbpostionb');?>">Post thumbnails Position</label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('thumbpostionb');?>" id="<?php $this->get_field_id('thumbpostionb');?>">
        
        	<option><?php echo $bbpostimgpostion ;?> </option>
            <option value="left">left</option>
            <option value="right">right</option>
        
        </select>
         
    
    </p>
    
    <?php }?> <!-- End thumbnail area from here -->
    
    
    
       <p>
        <label for="<?php $this->get_field_id('bbtitlepostion');?>">Title Position</label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('bbtitlepostion');?>" id="<?php $this->get_field_id('bbtitlepostion');?>">
        
        	<option><?php echo $bbtitlepostion ;?> </option>
            <option value="left">left</option>
            <option value="right">right</option>
        
        </select>
         
    
    </p>
    
    
       <p>
        <label for="<?php $this->get_field_id('bbtitlecolor');?>">Title Color </label>
        
        <input type="color" class="" name="<?php echo $this->get_field_name('bbtitlecolor');?>" id="<?php $this->get_field_id('bbtitlecolor');?>" value="<?php echo $bbtitlecolor; ?>">
        
 
         
    
    </p>
    
    
      <p>
        <label for="<?php $this->get_field_id('bbtitlefontsize');?>">Title Font Size - Eg: 18  <br/> Don't Use px</label>
        
        <input type="number" class="widefat" name="<?php echo $this->get_field_name('bbtitlefontsize');?>" id="<?php $this->get_field_id('bbtitlefontsize');?>" value="<?php echo $bbtitlefontsize; ?>">
        
 
         
    
    </p>
    
    
    
     <p>
        <label for="<?php $this->get_field_id('bbpostdate');?>">Display Post Date</label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('bbpostdate');?>" 
        id="<?php $this->get_field_id('bbpostdate');?>">
        
        	<option><?php echo $bbpostdate ;?> </option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        
        </select>
         
    
    </p>
    
       <p>
        <label for="<?php $this->get_field_id('bbpostauthor');?>">Display Author Name </label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('bbpostauthor');?>" 
        id="<?php $this->get_field_id('bbpostauthor');?>">
        
        	<option><?php echo $bbpostauthor ;?> </option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        
        </select>
         
    
    </p>
		
		
		<?php }
		
	
	
	
	}//end class BbWidgetArea here

function registerBBwidget(){
	register_widget('BbWidgetArea');
	
	}
add_action('widgets_init','registerBBwidget');