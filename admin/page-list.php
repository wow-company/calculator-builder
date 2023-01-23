<?php
/**
 * List of Items
 *
 * @package     CalcHub
 * @subpackage  Admin/List
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$list_table = new CalcHub_List_Table();
$list_table->prepare_items();
?>
    <div class="wrap">
        <form method="post">
			<?php
			$list_table->search_box( esc_attr__( 'Search', 'calculator-builder' ), 'calchub' );
			$list_table->display();
			?>
            <input type="hidden" name="page" value="<?php
			echo sanitize_text_field( $_REQUEST['page'] ); ?>"/>
        </form>
    </div>
<?php
