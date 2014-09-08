<?php
/**

 * Template Name: query1

 */

get_header();



function queryagent(){
	$wechat="";
	$wechat=$_POST['wechat'];
	if(empty($wechat)){
	echo "<center><lable style='color:red;'>请先输入代理商微信号再进行验证。</lable></center><hr>";
	return;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$wechat = trim($wechat);
	$wechat = stripslashes($wechat);
	}
	require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	global $wpdb;
	$table_name = $wpdb->prefix . "agentquery";
	$querystr = "SELECT * FROM wp_agentquery WHERE wechat='".$wechat."'";
	$result = $wpdb->get_results($querystr);
	if(!empty($result)){
	$i=0;
	while ($i< count($result)){  
		echo "<center><lable style='color:red;'>".$result[$i]->name."</lable>&nbsp是我公司授权代理商，微信号为：<lable style='color:red;'>".$result[$i]->wechat."</lable>，请放心购买。</center><hr>";
		$i++;  }
	}
	else{
	echo "<center>微信号:".$wechat."&nbsp>>&nbsp<lable style='color:red;'>无相关授权记录，谨防假冒。</lable></center><hr>";
	}
}
?>
<div id="main-content" class="main-content">
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<p>
			<?php 
			if($_POST['query'])
			{
			queryagent();
			}?>
			</p><br>
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
			
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
