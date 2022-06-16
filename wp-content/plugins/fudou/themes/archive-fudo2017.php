<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * Template: archive-fudo2017.php
 * 
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * @subpackage Twenty Seventeen
 * Version: 5.9.0
 */


	/**** 検索 SQL ****/
	require_once WP_PLUGIN_DIR . '/fudou/inc/inc-archive-fudo.php';

	/**** ヘッダー(前処理) ****/
	require_once WP_PLUGIN_DIR . '/fudou/inc/inc-archive-fudo-header.php';



	//物件一覧ページ
	get_header();

?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php do_action( 'archive-fudo1' ); ?>

			<header class="page-header">

				<?php if( $joken_url !='' ) { ?>
					<h1 class="page-title"><a href="<?php echo $joken_url;?>"><?php echo esc_html( esc_html( $org_title ) ); ?></a></h1>
				<?php  }else{  ?>
					<h1 class="page-title"><?php echo esc_html( esc_html( $org_title ) ); ?></h1>
				<?php  } ?>
			</header><!-- .page-header -->


			<?php echo $page_navigation; ?>


			<div id="list_simplepage">
			<?php
				//loop SQL
				if($sql !=''){
					//$sql2 = $wpdb->prepare($sql2,'');
					$metas = $wpdb->get_results( $sql2, ARRAY_A );
					if(!empty($metas)) {

						foreach ( $metas as $meta ) {
							$meta_id = $meta['object_id'];	//post_id
							$meta_data = get_post( $meta_id ); 
							$meta_title =  $meta_data->post_title;

							/*
							 * 物件一覧・物件表示テンプレート
							 *
							 * @param str      template name and uri.
							 * @param int      $post_id.
							 * @since Fudousan Plugin 5.1.0
							*/
							$archive_fudo_loop_template = apply_filters( 'archive_fudo_loop_template', 'archive-fudo-loop.php', $meta_id );

							echo '<article class="hentry">';
							require $archive_fudo_loop_template;
							echo '</article>';

						}
					}else{

						echo '<article class="hentry">';
						echo '<div class="list_simple_boxtitle">';
						echo "物件がありませんでした。<br /><br />";
						echo '</div>';
						echo '</article>';

					}
				}else{
						echo '<article class="hentry">';
						echo '<div class="list_simple_boxtitle">';
						echo "条件があいませんでした。<br /><br />";
						echo '</div>';
						echo '</article>';
				}
				//loop SQL END
			?>
			</div><!-- .list_simplepage -->

			<?php echo $page_navigation; ?>

			<?php do_action( 'archive-fudo2' ); ?>

			<br /><p align="right" class="pageback"><a href="#" onClick="history.back(); return false;">前のページにもどる</a></p>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->
<?php
get_footer();
