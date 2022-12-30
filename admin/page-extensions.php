<?php
/**
 * Extensions Page
 *
 * @package     CalcHub
 * @subpackage  Admin/Support
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     GNU Public License
 * @version     1.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


?>
<h2>These add functionality to your Calculator Builder.</h2>

<div class="calchub-cards">
    <div class="calchub-card">
        <div class="calchub-card-img">
            <img src="<?php echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/calchub-style-logo.png">
        </div>
        <div class="calchub-card-content">
            <h4 class="calchub-card-title">CALCHUB Style</h4>
            <p class="calchub-card-text">
                Easily add styles to each individual calculator. Customizable calculator according to the style of the
                site or individual page.
            </p>
        </div>
        <div class="calchub-card-footer">
			<?php if ( ! class_exists( 'CalcHub_Style' ) ) : ?>
                <a href="https://calchub.xyz/downloads/calchub-style/" target="_blank" class="button is-link">GET FREE</a>
			<?php else : ?>
				<?php do_action( 'calchub_style_activation_license' ); ?>
			<?php endif; ?>
        </div>

    </div>
</div>
