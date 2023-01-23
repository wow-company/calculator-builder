<?php
/**
 * Extensions Page
 *
 * @package     CalcHub
 * @subpackage  Admin/Support
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>
<h2>These add functionality to your Calculator Builder.</h2>

<div class="page-extensions">


    <div class="tabs" id="extensions-tab">
        <ul class="tabs__caption">
            <li class="is-active"><a>Extensions</a></li>
            <li><a>Calculators</a></li>
        </ul>
    </div>

    <div class="tabs__content is-active">

        <div class="calchub-cards">

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
						echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/calchub-style-logo.png">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">CalcHub Style</h4>
                        <p class="calchub-card-text">
                            Easily add styles to each individual calculator. Customizable calculator according to the
                            style
                            of
                            the
                            site or individual page. </p>
                    </div>
                    <div class="calchub-card-footer">
						<?php
						if ( ! class_exists( 'CalcHub_Style' ) ) : ?>
                            <a href="https://calchub.xyz/downloads/calchub-style/" target="_blank"
                               class="button is-link">GET
                                FREE</a>
						<?php
						else : ?><?php
							do_action( 'calchub_style_activation_license' ); ?><?php
						endif; ?>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
						echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/calchub-counter-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">CalcHub Counter</h4>
                        <p class="calchub-card-text">
                            Add the button likes and calculation counter to your calculators and you'll be able to track
                            it
                            easily. </p>
                    </div>
                    <div class="calchub-card-footer">
						<?php
						if ( ! class_exists( 'CalcHub_Counter' ) ) : ?>
                            <a href="https://calchub.xyz/downloads/calchub-counter/" target="_blank"
                               class="button is-link">GET
                                Now</a>
						<?php
						else : ?><?php
							do_action( 'calchub_counter_activation_license' ); ?><?php
						endif; ?>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/calchub-print-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">CalcHub Print</h4>
                        <p class="calchub-card-text">
                            Easily add an online calculator print button as well as a copy URL button. </p>
                    </div>
                    <div class="calchub-card-footer">
				        <?php
				        if ( ! class_exists( 'CalcHub_Print' ) ) : ?>
                            <a href="https://calchub.xyz/downloads/calchub-print/" target="_blank"
                               class="button is-link">GET
                                Now</a>
				        <?php
				        else : ?><?php
					        do_action( 'calchub_print_activation_license' ); ?><?php
				        endif; ?>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/calchub-wpcf7-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">CalcHub WPCF7</h4>
                        <p class="calchub-card-text">
                            Integrate WordPress plugin <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> into the plugin Calculator Builder </p>
                    </div>
                    <div class="calchub-card-footer">
				        <?php
				        if ( ! class_exists( 'CalcHub_WPCF7' ) ) : ?>
                            <a href="https://calchub.xyz/downloads/calchub-wpcf7/" target="_blank"
                               class="button is-link">GET
                                Now</a>
				        <?php
				        else : ?><?php
					        do_action( 'calchub_wpcf7_activation_license' ); ?><?php
				        endif; ?>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="tabs__content">

        <div class="calchub-cards">

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/appearance-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Appearance calculators</h4>
                        <p class="calchub-card-text">
                            A set of online appearance calculators. Online appearance calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/appearance-calculators/" target="_blank"
                        class="button is-link">GET
                        Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/cardiology-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Cardiology calculators</h4>
                        <p class="calchub-card-text">
                            A set of online cardiology calculators. Online cardiology calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/cardiology-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/food-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Food calculators</h4>
                        <p class="calchub-card-text">
                            A set of online food calculators. Online food calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/food-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/investment-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Investment calculators</h4>
                        <p class="calchub-card-text">
                            A set of online investment calculators. Online investment calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/investment-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/loan-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Loan calculators</h4>
                        <p class="calchub-card-text">
                            A set of online loan calculators. Online loan calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/loan-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/pharmacology-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Pharmacology calculators</h4>
                        <p class="calchub-card-text">
                            A set of online pharmacology calculators. Online pharmacology calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/pharmacology-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>

            <div class="calchub-card-wrapper">
                <div class="calchub-card">
                    <div class="calchub-card-img">
                        <img src="<?php
				        echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/sets/pregnancy-logo.jpg">
                    </div>
                    <div class="calchub-card-content">
                        <h4 class="calchub-card-title">Pregnancy calculators</h4>
                        <p class="calchub-card-text">
                            A set of online pregnancy calculators. Online pregnancy calculators are easy to download and install on your site.
                        </p>
                    </div>
                    <div class="calchub-card-footer">
                        <a href="https://calchub.xyz/downloads/pregnancy-calculators/" target="_blank"
                           class="button is-link">GET
                            Now</a>
                    </div>

                </div>
            </div>


        </div>

    </div>

</div>
