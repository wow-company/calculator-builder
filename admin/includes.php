<?php
/**
 * Includes JS and CSS
 *
 * @package     CALCHUB
 * @subpackage  CALCHUB/Admin_Class
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$includes = isset( $param['includes'] ) ? count($param['includes']) : 0;

?>


<div id="includeFiles">
	<?php
	if ( $includes > 0 ) {
		for ( $i = 0; $i < $includes; $i ++ ) { ?>

            <div class="columns is-centered">
                <div class="column is-half-desktop">
                    <div class="field has-addons has-addons-right">
                        <div class="control">
                            <div class="select">
                                <select name="param[includes][]">
                                    <option value="css" <?php selected( $param['includes'][ $i ], 'css' ); ?>>css
                                    </option>
                                    <option value="js" <?php selected( $param['includes'][ $i ], 'js' ); ?>>js</option>
                                </select>
                            </div>
                        </div>
                        <div class="control is-expanded">
                            <input type="url" class="input" name="param[includes_file][]"
                                   value="<?php echo $param['includes_file'][ $i ]; ?>" placeholder="URL to file">
                        </div>
                    </div>
                </div>
                <div class="column is-one-quarter">
                    <div class="buttons">
                        <span class="button is-danger is-outlined is-normal button-delete-item">
                            Delete
                        </span>
                        <span class="button is-normal button-sorted">
                            Sort
                        </span>
                    </div>

                </div>
            </div>

			<?php
		}
	}
	?>
</div>

<div class="columns is-centered">
    <div class="column is-half-desktop">
        <button class="button " id="addButton">
            Add new
        </button>
    </div>
    <div class="column is-one-quarter"></div>
</div>