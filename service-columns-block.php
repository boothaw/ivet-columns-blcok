<?php
/**
 * Plugin Name:       Service Columns Block
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       service-columns-block
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_service_columns_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_service_columns_block_block_init' );


function services_list() {
	ob_start();
	?>
<div class="services-columns">
    <?php
		$args = array(
			'category' => 'service',
			'posts_per_page' => '6'
		);
		$posts_array = new WP_Query($args);
		if ( $posts_array -> have_posts() ) :
			while ( $posts_array -> have_posts() ) :
				$posts_array -> the_post();
				$id = get_the_ID();
				$link = get_permalink();
				$title = get_the_title();
		?>
    <a class="service" href="<?php echo $link ?>" id="service-<?php echo $id ?>">
        <h3>
            <?php echo $title ?>
        </h3>
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" viewBox="0 0 50 16" style="enable-background:new 0 0 50 16;" xml:space="preserve">
            <style type="text/css">
            .st0 {
                fill: #B9E6D0;
            }
            </style>
            <path class="st0" d="M49.7,7.3l-6.4-6.4c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4L46.6,7H1C0.4,7,0,7.4,0,8s0.4,1,1,1h45.6
	l-4.7,4.7c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l6.4-6.4C50.1,8.3,50.1,7.7,49.7,7.3z" />
        </svg>

    </a>
    <?php endwhile; endif; ?>
</div>
<?php
	return ob_get_clean();
}
add_shortcode('services_list','services_list');