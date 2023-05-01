<?php
/**
 * Table for calculators list
 *
 * @package     CalcHub
 * @subpackage  Admin/Table_List
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// WP_List_Table is not loaded automatically so we need to load it in our application
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 *
 */
class CalcHub_List_Table extends WP_List_Table {

	/**
	 * Number of items per page
	 *
	 * @var int
	 * @since 1.5
	 */
	private int $per_page = 30;

	private string $table = 'calculator_builder';

	private string $shortcode = 'Calculator';

	/**
	 * CalcHub_List_Table constructor.
	 */
	public function __construct() {
		// Set parent defaults
		parent::__construct( [
			'ajax' => false,
		] );
		$this->process_bulk_action();
	}

	/**
	 * Process the bulk actions
	 *
	 * @access public
	 * @return void
	 * @since  1.4
	 */
	public function process_bulk_action(): void {
		$ids    = isset( $_POST['ID'] ) ? ( map_deep( $_POST['ID'], 'absint' ) ) : false;
		$action = $this->current_action();

		if ( ! is_array( $ids ) ) {
			$ids = [ $ids ];
		}

		if ( empty( $action ) ) {
			return;
		}
		global $wpdb;
		$table = $wpdb->prefix . $this->table;

		foreach ( $ids as $id ) {
			if ( 'delete-items' === $this->current_action() ) {
				$wpdb->delete( $table, [ 'id' => $id ] );
			}
		}
	}

	public function search_box( $text, $input_id ): void {
		$input_id .= '-search-input';
		if ( ! empty( $_REQUEST['orderby'] ) ) {
			echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
		}
		if ( ! empty( $_REQUEST['order'] ) ) {
			echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
		}
		?>
		<p class="search-box">
			<label class="screen-reader-text" for="<?php
			echo esc_attr( $input_id ) ?>"><?php
				echo esc_html( $text ); ?>
				:</label>
			<input type="search" id="<?php
			echo esc_attr( $input_id ) ?>" name="s" value="<?php
			_admin_search_query(); ?>"/>
			<?php
			submit_button( $text, 'button', false, false, [ 'ID' => 'search-submit' ] ); ?>
		</p>
		<?php
	}

	/**
	 * Define what data to show on each column of the table
	 *
	 * @param array $item Data
	 * @param String $column_name - Current column name
	 *
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {
		return $item[ $column_name ];
	}

	public function column_title( $item ): string {
		$slug          = CALCHUB_PLUGIN_SLUG;
		$title         = ! empty( $item['title'] ) ? $item['title'] : esc_attr__( 'Untitle', 'calculator-builder' );
		$edit_url      = admin_url( '/admin.php?page=' . $slug . '&tab=settings&act=update&id='
		                            . urlencode( $item['ID'] ) );
		$duplicate_url = admin_url( '/admin.php?page=' . $slug . '&tab=settings&act=duplicate&id='
		                            . urlencode( $item['ID'] ) );
		$delete_url    = admin_url( '/admin.php?page=' . $slug . '&id=' . urlencode( $item['ID'] ) );
		$delete_url    = wp_nonce_url( $delete_url, 'calchub_action', 'calculator_delete' );
		$export_url    = admin_url( '/admin.php?page=' . $slug . '&calchub_action=export_tool&id=' . urlencode( $item['ID'] ) );
		$export_url    = wp_nonce_url( $export_url, 'calchub_action', 'calchub_export_import' );
		$actions       = [
			'edit'      => '<a href="' . esc_url( $edit_url ) . '">' . esc_attr__( 'Edit',
					'calculator-builder' ) . '</a>',
			'duplicate' => '<a href="' . esc_url( $duplicate_url ) . '" class="has-text-success">' . esc_attr__( 'Duplicate',
					'calculator-builder' )
			               . '</a>',
			'delete'    => '<a href="' . esc_url( $delete_url ) . '" class="has-text-danger">' . esc_attr__( 'Delete',
					'calculator-builder' ) . '</a>',
			'export'    => '<a href="' . esc_url( $export_url ) . '" class="has-text-warning">' . esc_attr__( 'Export',
					'calculator-builder' ) . '</a>',
		];
		$view_url      = $this->get_attachmed_link( $item['ID'] );
		if(!empty($view_url)) {
			$actions['view'] = '<a href="' . esc_url( $view_url ) . '" target="_blank">' . esc_attr__( 'View','calculator-builder' ) . '</a>';
		}

		return '<a href="' . esc_url( $edit_url ) . '">' . $title . '</a>' . $this->row_actions( $actions );
	}

	private function get_attachmed_link( $id ) {
		global $wpdb;
		$table  = $wpdb->prefix . $this->table;
		$sSQL   = $wpdb->prepare( "select * from $table WHERE id = %d", $id );
		$result = $wpdb->get_row( $sSQL );
		$link   = '';
		if ( ! empty( $result ) ) {
			$param = unserialize( $result->param );
			$link  = isset( $param['calc_link'] ) ? $param['calc_link'] : '';
		}

		return $link;
	}

	/**
	 * Prepare the items for the table to process
	 *
	 * @return Void
	 */
	public function prepare_items(): void {
		$columns     = $this->get_columns();
		$hidden      = $this->get_hidden_columns();
		$sortable    = $this->get_sortable_columns();
		$data        = $this->table_data();
		$perPage     = $this->per_page;
		$currentPage = $this->get_pagenum();

		if ( $data ) {
			usort( $data, [ &$this, 'sort_data' ] );
			$data = array_slice( $data, ( ( $currentPage - 1 ) * $perPage ), $perPage );
		}

		$totalItems            = $this->list_count();
		$this->_column_headers = [ $columns, $hidden, $sortable ];
		$this->items           = $data;

		$this->set_pagination_args( [
			'total_items' => $totalItems,
			'per_page'    => $perPage,
			'total_pages' => ceil( $totalItems / $perPage ),
		] );
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns(): array {
		$columns = [
			'cb'    => '<input type="checkbox" />',
			'title' => esc_attr__( 'Title', 'calculator-builder' ),
			'code'  => esc_attr__( 'Shortcode', 'calculator-builder' ),
			'tag'   => esc_attr__( 'Tag', 'calculator-builder' ),
		];

		$columns = apply_filters( 'calchub_table_columns', $columns );

		return $columns;
	}

	/**
	 * Define which columns are hidden
	 *
	 * @return Array
	 */
	public function get_hidden_columns(): array {
		return [];
	}

	/**
	 * Define the sortable columns
	 *
	 * @return array
	 */
	public function get_sortable_columns(): array {
		return [
			'ID' => array( 'ID', false ),
		];
	}

	/**
	 * Get the table data
	 *
	 * @return Array
	 */
	private function table_data(): array {
		global $wpdb;
		$data   = [];
		$paged  = $this->get_paged();
		$offset = $this->per_page * ( $paged - 1 );
		$result = $this->get_data_result();

		if ( ! empty( $result ) ) {
			foreach ( $result as $key => $value ) {
				$title = ! empty( $value->title ) ? $value->title : esc_attr__( 'Untitle', 'calculator-builder' );
				$tag   = '';

				if ( isset( $value->tag ) ) {
					$tag_url = admin_url( '/admin.php?page=' . CALCHUB_PLUGIN_SLUG . '&tag=' . $value->tag );
					$tag     = '<a href="' . esc_url( $tag_url ) . '">' . $value->tag . '</a>';
				}
				$args   = [
					'ID'    => $value->id,
					'title' => '<a href="admin.php?page=' . esc_attr( CALCHUB_PLUGIN_SLUG ) . '&tab=settings&act=update&id=' . absint( $value->id ) . '">' . esc_attr( $title ) . '</a>',
					'tag'   => $tag,
					'code'  => '<div class="field has-addons"><div class="control">
                <input class="input is-small is-dark" type="text" readonly value="[Calculator id=\'' . absint( $value->id ) . '\']"></div>
                <div class="control"><span class="button is-small is-dark calc-copy-shortcode">
                                       ' . esc_attr__( 'Copy', 'calculator-builder' ) . '</span></div></div>',
				];
				$data[] = apply_filters( 'calchub_table_column', $args, $value->id );
			}
		}

		return $data;
	}

	private function get_data_result() {
		global $wpdb;
		$table      = $wpdb->prefix . $this->table;
		$search     = $this->get_search();
		$tag_search = ( ! empty( $_REQUEST['tag'] ) ) ? sanitize_text_field( $_REQUEST  ['tag'] ) : '';
		$tag_search = ( $tag_search === 'all' ) ? '' : $tag_search;
		$result     = '';

		if ( empty( $search ) ) {
			$result = $wpdb->get_results( "SELECT * FROM $table order by id desc" );
			if ( ! empty( $tag_search ) ) {
				$result = $wpdb->get_results( "SELECT * FROM $table WHERE tag='$tag_search' order by id desc" );
			}
		} elseif ( trim( $search ) === 'UnTitle' ) {
			$result = $wpdb->get_results( "SELECT * FROM $table WHERE title='' order by id desc" );
			if ( ! empty( $tag_search ) ) {
				$result = $wpdb->get_results( "SELECT * FROM $table WHERE title='' AND tag='$tag_search' order by id desc" );
			}
		} elseif ( is_numeric( $search ) ) {
			$query = $wpdb->prepare( "SELECT * FROM $table WHERE id=%d", absint( $search ) );
			if ( ! empty( $tag_search ) ) {
				$query = $wpdb->prepare( "SELECT * FROM $table WHERE id=%d AND tag='%s'", absint( $search ),
					$tag_search );
			}
			$result = $wpdb->get_results( $query );
		} else {
			$wild  = '%';
			$find  = sanitize_text_field( $search );
			$like  = $wild . $wpdb->esc_like( $find ) . $wild;
			$query = $wpdb->prepare( "SELECT * FROM $table WHERE title LIKE %s order by id desc", $like );
			if ( ! empty( $tag_search ) ) {
				$query = $wpdb->prepare( "SELECT * FROM $table WHERE title LIKE %s AND tag='%s' order by id desc",
					$like, $tag_search );
			}
			$result = $wpdb->get_results( $query );
		}

		return $result;
	}

	/**
	 * Retrieve the current page number
	 *
	 * @access public
	 * @return int Current page number
	 * @since  1.5
	 */
	public function get_paged(): int {
		return isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;
	}

	/**
	 * Retrieves the search query string
	 *
	 * @access public
	 * @return mixed string If search is present, false otherwise
	 * @since  1.0
	 */
	public function get_search() {
		return ! empty( $_POST['s'] ) ? urldecode( trim( sanitize_text_field( $_POST['s'] ) ) ) : false;
	}

	public function list_count(): int {
		$result = $this->get_data_result();

		return count( $result );
	}

	/**
	 * Render the checkbox column
	 *
	 * @access public
	 *
	 * @param array $item Contains all the data for the checkbox column
	 *
	 * @return string Displays a checkbox
	 * @since  1.0
	 */
	public function column_cb( $item ): string {
		return sprintf( '<input type="checkbox" name="%1$s[]" value="%2$s" />', 'ID', $item['ID'] );
	}

	/**
	 * Retrieve the bulk actions
	 *
	 * @access public
	 * @return array $actions Array of the bulk actions
	 * @since  1.4
	 */
	public function get_bulk_actions(): array {
		return [
			'delete-items' => esc_attr__( 'Delete', 'calculator-builder' ),
		];
	}

	/**
	 * Gets the name of the primary column.
	 *
	 * @return string Name of the primary column.
	 * @since  1.0
	 * @access protected
	 *
	 */
	protected function get_primary_column_name(): string {
		return 'ID';
	}

	/**
	 * Allows you to sort the data by the variables set in the $_GET
	 *
	 * @return Mixed
	 */
	private function sort_data( $a, $b ) {
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? sanitize_text_field( $_GET['orderby'] ) : 'ID';
		// If no order, default to asc
		$order = ( ! empty( $_GET['order'] ) ) ? sanitize_text_field( $_GET['order'] ) : 'desc';
		// Determine sort order
		$result = strnatcmp( $a[ $orderby ], $b[ $orderby ] );

		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : - $result;
	}

	protected function extra_tablenav( $which ) {
		if ( 'top' === $which ) {
			$tags = CALCHUB()->db->get_tags_from_table();

			$tag_search = ( ! empty( $_REQUEST['tag'] ) ) ? sanitize_text_field( $_REQUEST  ['tag'] ) : '';
			$tag_search = ( $tag_search === 'all' ) ? '' : $tag_search;

			echo '<div class="alignleft actions"><label for="filter-by-tag" class="screen-reader-text">' . __( 'Filter by tag',
					'calculator-builder' ) . '</label>';
			echo '<select name="tag" id="filter-by-tag">';
			echo '<option value="all"' . selected( 'all', $tag_search, false ) . '>' . __( 'All',
					'calculator-builder' ) . '</option>';

			if ( ! empty( $tags ) ) {
				foreach ( $tags as $tag ) {
					echo '<option value="' . trim( esc_attr( $tag['tag'] ) ) . '"' . selected( $tag['tag'], $tag_search,
							false ) . '>' . esc_attr( $tag['tag'] ) . '</option>';
				}
			}
			echo '</select>';
			submit_button( __( 'Filter', 'calculator-builder' ), 'secondary', 'action', false );
			echo '</div>';
		}
	}

}
