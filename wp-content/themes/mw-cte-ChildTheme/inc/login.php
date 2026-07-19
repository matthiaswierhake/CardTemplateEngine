<?php
/**
 * Login-Funktionen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Login-Shortcode
 *
 * Verwendung:
 * [lsv_login]
 * [lsv_login_v2]
 */
function lsv_login_shortcode() {

	if ( is_user_logged_in() ) {

		$logout_url = wp_logout_url();

		return '
		<div class="lsv-login-card lsv-login-card-logged-in">

			<h3>Du bist bereits angemeldet.</h3>

			<p>Willkommen im Mitgliederbereich.</p>

			<p>
				<a class="lsv-login-button lsv-button-block" href="' . esc_url( LSV_MEMBER_URL ) . '">
					Zum Mitgliederbereich
				</a>
			</p>

			<p>
				<a class="lsv-login-button lsv-button-block lsv-button-secondary" href="' . esc_url( $logout_url ) . '">
					Abmelden
				</a>
			</p>

		</div>';
	}

	$error = '';

	if ( isset( $_GET['login'] ) && $_GET['login'] === 'failed' ) {
		$error = 'Benutzername oder Passwort ist falsch.';
	}

	if ( isset( $_POST['lsv_login_submit'] ) ) {

		if (
			! isset( $_POST['lsv_login_nonce'] ) ||
			! wp_verify_nonce( $_POST['lsv_login_nonce'], 'lsv_login_action' )
		) {

			$error = 'Sicherheitsprüfung fehlgeschlagen.';

		} else {

			$creds = array(
				'user_login'    => sanitize_user( wp_unslash( $_POST['lsv_username'] ) ),
				'user_password' => isset( $_POST['lsv_password'] ) ? wp_unslash( $_POST['lsv_password'] ) : '',
				'remember'      => isset( $_POST['lsv_remember'] ),
			);

			$user = wp_signon( $creds, false );

			if ( is_wp_error( $user ) ) {

				$error = 'Benutzername oder Passwort ist falsch.';

			} else {

				wp_safe_redirect( LSV_MEMBER_URL );
				exit;

			}
		}
	}

	ob_start();
	?>

	<div class="lsv-login-card">

		<?php if ( $error ) : ?>
			<div class="lsv-login-error">
				<?php echo esc_html( $error ); ?>
			</div>
		<?php endif; ?>

		<form method="post" class="lsv-login-form">

			<?php wp_nonce_field( 'lsv_login_action', 'lsv_login_nonce' ); ?>

			<label class="lsv-field-label">
				<span class="dashicons dashicons-admin-users"></span>
				Benutzername
			</label>

			<input
				type="text"
				name="lsv_username"
				class="lsv-input"
				required
			>

			<label class="lsv-field-label">
				<span class="dashicons dashicons-lock"></span>
				Passwort
			</label>

			<div class="lsv-password-wrap">

				<input
					type="password"
					name="lsv_password"
					id="lsv-password"
					class="lsv-input"
					required
				>

				<button
					type="button"
					class="lsv-toggle-password"
					aria-label="Passwort anzeigen">
					<span class="dashicons dashicons-visibility"></span>
				</button>

			</div>

			<label class="lsv-remember">
				<input type="checkbox" name="lsv_remember">
				<span>Angemeldet bleiben</span>
			</label>

			<button
				type="submit"
				name="lsv_login_submit"
				class="lsv-login-button">
				Anmelden
			</button>

			<p class="lsv-lost-password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
					Passwort vergessen?
				</a>
			</p>

		</form>

	</div>

	<?php
	return ob_get_clean();
}

add_shortcode( 'lsv_login', 'lsv_login_shortcode' );
add_shortcode( 'lsv_login_v2', 'lsv_login_shortcode' );

//add_action( 'wp_enqueue_scripts', 'fastwp_load_dashicons' );
/* WordPress Dashicons aktivieren */
