<?php
/**
 * Support Page
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

$plugin    = 'CalcHub v.' . CALCHUB_VERSION;
$website   = get_option( 'home' );
$form_type = ( isset( $_GET['type'] ) && ( $_GET['type'] === 'idea' ) ) ? 'Idea' : 'Issue';
?>
    <div class="about-wrap wow-box">
        <div class="feature-section one-col">
            <div class="col">
                <p>To get your support related question answered in the fastest timing, please send a message via the
                    form below
                    or write to us on email <a href="mailto:yoda@calchub.xyz">yoda@calchub.xyz</a>.</p>
                <p>Also, you can send us your ideas and suggestions for improving the plugin.</p>
				<?php
				$error = array();
				if ( ! empty( $_POST['action'] ) && ! empty( $_POST['calchub_support'] ) ) {
					if ( wp_verify_nonce( $_POST['calchub_support'], 'calchub_send' )
					     && current_user_can( 'manage_options' )
					) {
						$name    = ! empty( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
						$email   = ! empty( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
						$type    = ! empty( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '';
						$subject = ! empty( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
						$message = ! empty( $_POST['message'] ) ? wp_kses_post( $_POST['message'] ) : '';
						if ( empty( $name ) ) {
							$error[] = esc_attr__( 'Please, Enter your Name.', 'calculator-builder' );
						}
						if ( empty( $email ) ) {
							$error[] = esc_attr__( 'Please, Enter your Email.', 'calculator-builder' );
						}
						if ( empty( $subject ) ) {
							$error[] = esc_attr__( 'Please, Enter Subject of Message.', 'calculator-builder' );
						}
						if ( empty( $message ) ) {
							$error[] = esc_attr__( 'Please, Enter your Message.', 'calculator-builder' );
						}

						if ( count( $error ) == 0 ) {
							$headers = array(
								'From: ' . $name . ' <' . $email . '>',
								'content-type: text/html',
							);
							$message = '				
								<html>
								<head></head>
								<body>
								<table>
								<tr>
								<td><strong>Plugin:</strong></td>
								<td>' . esc_attr( $plugin ) . '</td>
								</tr>
								<tr>
								<td><strong>Website:</strong></td>
								<td>' . esc_url( $website ) . '</td>
								</tr>
								</table>
								' . nl2br( wp_kses_post( $message ) ) . '
								</body>
								</html>';
							$subject = $type . ': ' . $subject;
							wp_mail( 'yoda@calchub.xyz', $subject, $message, $headers );
							echo '<div class="notice notice-success is-dismissible"><p>'
							     . esc_attr__( 'Your Message sent to the Support.',
									'calculator-builder' ) . '</p></div>';
						}
					} else {
						echo '<div class="notice notice-warning is-dismissible"><p>'
						     . esc_attr__( 'Sorry, but message did not send. Please, contact us yoda@calchub.xyz',
								'calculator-builder' ) . ' </p></div>';
					}
				}
				?>
				<?php
				if ( count( $error ) > 0 ) {
					echo '<div class="notice notice-error is-dismissible"><p>' . implode( "<br />", $error )
					     . '</p></div>';
				} ?>
                
                <form method="post" action="" class="wow-plugin">

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Type</label>
                        </div>
                        <div class="field-body">
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="type" value="Issue" <?php
									checked( 'Issue', $form_type ); ?>>
                                    Technical issues
                                </label>
                                <p class="help"> I am having technical issues with Plugin.</p>

                                <label class="radio">
                                    <input type="radio" name="type" value="Idea" <?php
									checked( 'Idea', $form_type ); ?>>
                                    Idea
                                </label>
                                <p class="help has-text-weight-semibold has-text-info">Submit an idea for a calculator
                                    and get and receive the calculator file after it is develop</p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">From</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input is-radiusless is-dark" type="text" name="name"
                                           placeholder="Name" required>
                                    <span class="icon is-small is-left">
										<i class="dashicons dashicons-admin-users"></i>
									</span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input is-radiusless is-dark" type="email" name="email"
                                           placeholder="Email" required value="<?php
									echo get_option( 'admin_email' ); ?>">
                                    <span class="icon is-small is-left">
										<i class="dashicons dashicons-email"></i>
									</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Subject</label>
                        </div>
                        <div class="field-body">
                            <div class="field ">
                                <div class="control is-expanded">
                                    <input class="input is-radiusless is-dark" type="text" name="subject"
                                           placeholder="Enter Message Subject" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Question</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea is-radiusless is-dark"
                                              placeholder="Explain how we can help you" name="message"
                                              required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label">
                            <!-- Left empty for spacing -->
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input type="submit" name="action" class="button is-info is-radiusless"
                                           value="Send message">
                                </div>
                            </div>
                        </div>
                    </div>

					<?php
					wp_nonce_field( 'calchub_send', 'calchub_support' ); ?>

                </form>
            </div>
        </div>
    </div>
<?php
