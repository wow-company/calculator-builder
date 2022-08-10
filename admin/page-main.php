<?php
/**
 * Plugin main page
 *
 * @package     Wow_Plugin
 * @subpackage  Admin/Main_page
 * @author      Dmytro Lobov <helper@wow-company.com>
 * @license     GNU Public License
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wpdb;
$data = $wpdb->prefix . $this->plugin['prefix'];
$info = ( isset( $_REQUEST['info'] ) ) ? sanitize_text_field( $_REQUEST['info'] ) : '';
if ( $info === 'saved' ) {
	echo '<div class="updated" id="message"><p><strong>' . esc_html__( 'Item Added', 'calculator-builder' ) . '</strong>.</p></div>';
} elseif ( $info === 'update' ) {
	echo '<div class="updated" id="message"><p><strong>' . esc_html__( 'Item Updated', 'calculator-builder' ) . '</strong>.</p></div>';
} elseif ( $info === 'delete' ) {
	$del_id = absint( $_GET['did'] );
	$delete = $wpdb->delete( $data, array( 'ID' => $del_id ), array( '%d' ) );
	if ( absint( $delete ) > 0 ) {
		echo '<div class="updated" id="message"><p><strong>' . esc_html__( 'Item Deleted', 'calculator-builder' ) . '</strong>.</p></div>';
	}
}

$current_tab = ( isset( $_REQUEST["tab"] ) ) ? sanitize_text_field( $_REQUEST["tab"] ) : 'list';

$tabs_arr = array(
	'list'      => esc_attr__( 'List', 'calculator-builder' ),
	'settings'  => esc_attr__( 'Add new', 'calculator-builder' ),
	'tools'     => esc_attr__( 'Import/Export', 'calculator-builder' ),
	'support'   => esc_attr__( 'Support', 'calculator-builder' ),
	'docs'      => esc_attr__( 'Documentation', 'calculator-builder' ),
	'changelog' => esc_attr__( 'Changelog', 'calculator-builder' ),
);

$tabs = apply_filters( $this->plugin['slug'] . '_tab_menu', $tabs_arr );

$rate_url = 'https://wordpress.org/support/plugin/float-menu/reviews/#new-post';

$rating = $this->rating['wp_url'];
?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html( $this->plugin['name'] ); ?>
            v. <?php echo esc_html( $this->plugin['version'] ); ?></h1>
        <a href="?page=<?php echo esc_attr( $this->plugin['slug'] ); ?>&tab=settings" class="page-title-action">
			<?php esc_html_e( 'Add New', 'calculator-builder' ); ?></a>
        <hr class="wp-header-end">
		<?php if ( get_option( 'wow_' . $this->plugin['prefix'] . '_message' ) != 'read' ) : ?>
            <div class="notice notice-info is-dismissible wow-plugin-message">
                <p class="ideas">
                    <i class="dashicons dashicons-megaphone has-text-danger is-r-margin"></i>We are constantly trying to
                    improve the plugin and add more useful
                    features to it. Your support and your ideas for improving the plugin are very important to us. <br/>
                    <i class="dashicons dashicons-star-filled has-text-warning is-r-margin"></i>If you like the plugin,
                    please <a href="<?php echo esc_url( $rating ); ?>" target="_blank">leave a review</a> about it at
                    WordPress.org.<br/>

            </div>
		<?php endif; ?>

        <div id="wow-message"></div>

		<?php
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $tabs as $tab => $name ) {
			$class = ( $tab === $current_tab ) ? ' nav-tab-active' : '';
			if ( $tab === 'settings' ) {
				$action = ( isset( $_REQUEST["act"] ) ) ? sanitize_text_field( $_REQUEST["act"] ) : '';
				if ( ! empty( $action ) && $action === 'update' ) {
					echo '<a class="nav-tab' . esc_attr( $class ) . '" href="?page=' . esc_attr( $this->plugin['slug'] ) . '&tab='
					     . esc_attr( $tab ) . '">' . esc_attr__( 'Update', 'calculator-builder' ) . ' #'
					     . absint( $_REQUEST["id"] ) . '</a>';
				} else {
					echo '<a class="nav-tab' . esc_attr( $class ) . '" href="?page=' . esc_attr( $this->plugin['slug'] ) . '&tab='
					     . esc_attr( $tab ) . '">' . esc_attr( $name ) . '</a>';
				}
			} elseif ( $tab === 'document' ) {
				echo '<a class="nav-tab' . esc_attr( $class ) . '" href="https://calchub.xyz/documentation/" target="_blank">' . esc_attr( $name ) . '</a>';
			} elseif ( $tab === 'demo' ) {
				echo '<a class="nav-tab' . esc_attr( $class ) . '" href="https://calchub.xyz/" target="_blank">' . esc_attr( $name ) . '</a>';
			} else {
				echo '<a class="nav-tab' . esc_attr( $class ) . '" href="?page=' . esc_attr($this->plugin['slug']) . '&tab='
				     . esc_attr( $tab ) . '">' . esc_attr( $name ) . '</a>';
			}

		}
		echo '</h2>';

		$current_tab = array_key_exists( $current_tab, $tabs_arr ) ? 'page-' . $current_tab : $current_tab;
		$file        = apply_filters( $this->plugin['slug'] . '_menu_file', $current_tab );
		include_once( $file . '.php' );
		?>
    </div><input type="hidden" id="wow-navigation" value="<?php echo esc_attr( $this->plugin['slug'] ); ?>">
<?php
