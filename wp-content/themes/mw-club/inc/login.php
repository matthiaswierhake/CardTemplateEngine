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
 * [club_login]
 * [club_login_v2]
 */
function club_login_shortcode() {

    if ( is_user_logged_in() ) {

        $logout_url = wp_logout_url( CLUB_LOGIN_URL );

        return '
		<div class="club-login-card club-login-card-logged-in">

			<h3>Du bist bereits angemeldet.</h3>

			<p>Willkommen im Mitgliederbereich.</p>

			<p>
				<a class="club-login-button club-button-block" href="' . esc_url( CLUB_MEMBER_URL ) . '">
					Zum Mitgliederbereich
				</a>
			</p>

			<p>
				<a class="club-login-button club-button-block club-button-secondary" href="' . esc_url( $logout_url ) . '">
					Abmelden
				</a>
			</p>

		</div>';
    }

    $action = isset( $_GET['action'] )
            ? sanitize_key( wp_unslash( $_GET['action'] ) )
            : 'login';

    if ( 'lostpassword' === $action ) {
        return club_lostpassword_form();
    }

    $error = '';

    if ( isset( $_GET['login'] ) && 'failed' === sanitize_key( wp_unslash( $_GET['login'] ) ) ) {
        $error = 'Benutzername oder Passwort ist falsch.';
    }

    if ( isset( $_POST['club_login_submit'] ) ) {

        if (
                ! isset( $_POST['club_login_nonce'] ) ||
                ! wp_verify_nonce(
                        sanitize_text_field( wp_unslash( $_POST['club_login_nonce'] ) ),
                        'club_login_action'
                )
        ) {

            $error = 'Sicherheitsprüfung fehlgeschlagen.';

        } else {

            $creds = array(
                    'user_login'    => isset( $_POST['club_username'] )
                            ? sanitize_user( wp_unslash( $_POST['club_username'] ) )
                            : '',
                    'user_password' => isset( $_POST['club_password'] )
                            ? wp_unslash( $_POST['club_password'] )
                            : '',
                    'remember'      => isset( $_POST['club_remember'] ),
            );

            $user = wp_signon( $creds, is_ssl() );

            if ( is_wp_error( $user ) ) {
                $error = 'Benutzername oder Passwort ist falsch.';
            } else {
                wp_safe_redirect( CLUB_MEMBER_URL );
                exit;
            }
        }
    }

    $lostpassword_url = add_query_arg(
            'action',
            'lostpassword',
            CLUB_LOGIN_URL
    );

    ob_start();
    ?>

    <div class="club-login-card">

        <?php if ( $error ) : ?>
            <div class="club-login-error">
                <?php echo esc_html( $error ); ?>
            </div>
        <?php endif; ?>

        <form method="post" class="club-login-form">

            <?php wp_nonce_field( 'club_login_action', 'club_login_nonce' ); ?>

            <label class="club-remember">
                <span><H5>Bitte melde dich mit deinen Zugangsdaten an.</H5></span>
            </label>

            <label class="club-field-label" for="club-username">
                <span class="dashicons dashicons-admin-users"></span>
                Benutzername
            </label>

            <input
                    type="text"
                    name="club_username"
                    id="club-username"
                    class="club-input"
                    autocomplete="username"
                    required
            >

            <label class="club-field-label" for="club-password">
                <span class="dashicons dashicons-lock"></span>
                Passwort
            </label>

            <div class="club-password-wrap">

                <input
                        type="password"
                        name="club_password"
                        id="club-password"
                        class="club-input"
                        autocomplete="current-password"
                        required
                >

                <button
                        type="button"
                        class="club-toggle-password"
                        aria-label="Passwort anzeigen">
                    <span class="dashicons dashicons-visibility"></span>
                </button>

            </div>

            <label class="club-remember">
                <input type="checkbox" name="club_remember">
                <span>Angemeldet bleiben</span>
            </label>

            <button
                    type="submit"
                    name="club_login_submit"
                    class="club-login-button">
                Anmelden
            </button>

            <p class="club-lost-password">
                <a href="<?php echo esc_url( $lostpassword_url ); ?>">
                    Passwort vergessen?
                </a>
            </p>

        </form>

    </div>

    <?php
    return ob_get_clean();
}

/**
 * Formular „Passwort vergessen“ auf der Login-Seite.
 */
function club_lostpassword_form() {

    $message      = '';
    $message_type = '';

    if ( isset( $_POST['club_lostpassword_submit'] ) ) {

        if (
                ! isset( $_POST['club_lostpassword_nonce'] ) ||
                ! wp_verify_nonce(
                        sanitize_text_field( wp_unslash( $_POST['club_lostpassword_nonce'] ) ),
                        'club_lostpassword_action'
                )
        ) {

            $message      = 'Sicherheitsprüfung fehlgeschlagen.';
            $message_type = 'error';

        } else {

            $user_login = isset( $_POST['user_login'] )
                    ? sanitize_text_field( wp_unslash( $_POST['user_login'] ) )
                    : '';

            if ( '' === $user_login ) {

                $message      = 'Bitte gib deinen Benutzernamen oder deine E-Mail-Adresse ein.';
                $message_type = 'error';

            } else {

                retrieve_password( $user_login );

                $message = 'Wenn ein passendes Konto gefunden wurde, wurde eine E-Mail zum Zurücksetzen des Passworts versendet.';
                $message_type = 'success';
            }
        }
    }

    ob_start();
    ?>

    <div class="club-login-card">

        <h3>Passwort vergessen</h3>

        <p>
            Gib deinen Benutzernamen oder deine E-Mail-Adresse ein.
        </p>

        <?php if ( $message ) : ?>
            <div class="club-login-<?php echo esc_attr( $message_type ); ?>">
                <?php echo esc_html( $message ); ?>
            </div>
        <?php endif; ?>

        <form method="post" class="club-login-form">

            <?php wp_nonce_field( 'club_lostpassword_action', 'club_lostpassword_nonce' ); ?>

            <label class="club-field-label" for="club-user-login">
                Benutzername oder E-Mail-Adresse
            </label>

            <input
                    type="text"
                    name="user_login"
                    id="club-user-login"
                    class="club-input"
                    autocomplete="username"
                    required
            >

            <button
                    type="submit"
                    name="club_lostpassword_submit"
                    class="club-login-button">
                Neues Passwort anfordern
            </button>

        </form>

        <p class="club-lost-password">
            <a href="<?php echo esc_url( CLUB_LOGIN_URL ); ?>">
                Zurück zum Login
            </a>
        </p>

    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'club_login', 'club_login_shortcode' );
add_shortcode( 'club_login_v2', 'club_login_shortcode' );