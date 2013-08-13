<?php
/*
Template Name: Author List Page
*/
?>

<?php get_header(); ?>

<section id="omc-main">	

	<article id="omc-full-article">	
		<?php $omc_comment_type = get_post_meta(get_the_ID(), 'omc_comment_type_page', true);  ?>
		
		<?php 	the_post_thumbnail('blog-full-width', array('class' => 'featured-full-width-top page-margin')); ?>
		
		<h1><?php the_title(); ?> </h1>
		
		<?php the_content();?>		
		
		<?php if ($omc_comment_type == 'none' || $omc_comment_type == ''|| $omc_comment_type == 'fb') { ?>
		
			<div class="omc-page-space"></div>
		
		<?php } ?>
		
		<br class="clear" />
		
		<?php 
			// Get the current page url for FB comments
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		?>		
		
		<?php if ($omc_comment_type === 'fb' || $omc_comment_type === 'both') { ?>

			<div class="fb-comments" data-href="<?php echo $url; ?>" data-num-posts="4" data-width="620"></div> 
		
		<?php } ?>
		
		<?php if ($omc_comment_type === 'wp' || $omc_comment_type === 'both') { ?>
		
			<?php comments_template( '', true ); ?>
			
		<?php } ?>
		
	</article><!-- /omc-full-article -->

	<div class="omc-cat-top">
	
		<h1><em>The Funsponges are...</em></h1>
		
	</div>
	
<?php
$display_admins = true;
$order_by = 'registered'; // 'nicename', 'email', 'url', 'registered', 'display_name', or 'post_count'
$role = ''; // 'subscriber', 'contributor', 'editor', 'author' - leave blank for 'all'
$avatar_size = 100;
$hide_empty = true; // hides authors with zero posts
 
if(!empty($display_admins)) {
	$blogusers = get_users('orderby='.$order_by.'&role='.$role);
} else {
	$admins = get_users('role=administrator');
	$exclude = array();
	foreach($admins as $ad) {
		$exclude[] = $ad->ID;
	}
	$exclude = implode(',', $exclude);
	$blogusers = get_users('exclude='.$exclude.'&orderby='.$order_by.'&role='.$role);
}
$authors = array();
foreach ($blogusers as $bloguser) {
	$user = get_userdata($bloguser->ID);
	if(!empty($hide_empty)) {
		$numposts = count_user_posts($user->ID);
		if($numposts < 1) continue;
	}
	$authors[] = (array) $user;
}
 
echo '<ul class="omc-contributers">';
foreach($authors as $author) { 
	$display_name = $author['data']->display_name;
	$description = get_userdata($author['ID'])->user_description;
	$website = get_the_author_meta( 'user_url' );
	$twitter = get_userdata($author['ID'])->twitter;
	$facebook = get_userdata($author['ID'])->facebook;
	$linkedin = get_userdata($author['ID'])->linkedin; 				
	$youtube = get_userdata($author['ID'])->youtube;			
	$google = get_userdata($author['ID'])->google; 				
	$soundcloud = get_userdata($author['ID'])->soundcloud;
	$numposts2 = count_user_posts($author->ID);	

	$avatar = get_avatar($author['ID'], $avatar_size);
	$author_profile_url = get_author_posts_url($author['ID']);
 
echo '<li><a href="', $author_profile_url, '">', $avatar , '</a><a href="', $author_profile_url, '" class="contributor-link">', $display_name, ' <span> &rarr;</span></a><p>'.$description.'</p>'; ?>
		
	<div id="omc-author-social-icons">	
		<?php if($twitter !== '') {?><a class="omc-author-twitter" href="<?php echo $twitter; ?>"></a><?php } ?>
		<?php if($facebook !== '') {?><a class="omc-author-facebook" href="<?php echo $facebook; ?>"></a><?php } ?>
		<?php if($google !== '') {?><a class="omc-author-google" href="<?php echo $google; ?>"></a><?php } ?>
		<?php if($linkedin !== '') {?><a class="omc-author-linkedin" href="<?php echo $linkedin; ?>"></a><?php } ?>
		<?php if($youtube !== '') {?><a class="omc-author-youtube" href="<?php echo $youtube; ?>"></a><?php } ?>
		<?php if($soundcloud !== '') {?><a class="omc-author-soundcloud" href="<?php echo $soundcloud; ?>"></a><?php } ?>
		<br class="clear" />
	</div>
<?php }
echo '</li></ul>';
?>
	
	<br class="clear" />
		
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>