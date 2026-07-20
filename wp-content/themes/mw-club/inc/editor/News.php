<?php

require_once __DIR__ . '/Field.php';
require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/Toolbar.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_News {

    public static function render() {

        ob_start();

        $action  = $_GET['action'] ?? 'list';
        $post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset( $_POST['club_cms_nonce'] )
            && wp_verify_nonce( $_POST['club_cms_nonce'], 'club_cms_save' )
        ) {

            $title = isset( $_POST['title'] )
                ? sanitize_text_field( $_POST['title'] )
                : '';

            $summary = isset( $_POST['summary'] )
                ? sanitize_textarea_field( $_POST['summary'] )
                : '';

            $image_id = isset( $_POST['featured_image'] )
                ? absint( $_POST['featured_image'] )
                : 0;

            if ( $action === 'edit' && $post_id ) {

                wp_update_post( array(
                    'ID'           => $post_id,
                    'post_title'   => $title,
                    'post_excerpt' => $summary,
                ) );

                if ( $image_id ) {
                    set_post_thumbnail( $post_id, $image_id );
                } else {
                    delete_post_thumbnail( $post_id );
                }

            } elseif ( $action === 'new' ) {

                $new_id = wp_insert_post( array(
                    'post_type'    => 'post',
                    'post_status'  => 'publish',
                    'post_title'   => $title,
                    'post_excerpt' => $summary,
                ) );

                if ( $new_id && ! is_wp_error( $new_id ) ) {

                    if ( $image_id ) {
                        set_post_thumbnail( $new_id, $image_id );
                    }

                    wp_safe_redirect(
                        add_query_arg(
                            array(
                                'module' => 'news',
                                'action' => 'edit',
                                'post'   => $new_id,
                            ),
                            get_permalink()
                        )
                    );

                    exit;
                }
            }
        }

        $title    = '';
        $summary  = '';
        $image_id = 0;

        if ( $action === 'edit' && $post_id ) {

            $post = get_post( $post_id );

            if ( $post ) {
                $title    = $post->post_title;
                $summary  = $post->post_excerpt;
                $image_id = get_post_thumbnail_id( $post_id );
            }
        }

        echo CLUB_Toolbar::render(
            'Neuigkeiten',
            '?module=news&action=new'
        );
        ?>

        <?php if ( $action === 'new' || $action === 'edit' ) : ?>

            <p>
                <a href="?module=news">
                    ← Zurück zur Liste
                </a>
            </p>

            <?php echo CLUB_Form::begin( 'Neue Neuigkeit' ); ?>

            <?php
            CLUB_Form::text(
                'title',
                'Titel',
                $title
            );

            CLUB_Form::textarea(
                'summary',
                'Kurztext',
                $summary
            );

            CLUB_Form::image(
                'featured_image',
                'Beitragsbild',
                $image_id
            );
            ?>

            <?php echo CLUB_Form::end(); ?>

        <?php else : ?>

            <?php
            $query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 20,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            ?>

            <?php echo CLUB_Card::begin( 'Vorhandene Neuigkeiten' ); ?>

            <?php if ( $query->have_posts() ) : ?>

                <ul class="club-news-list">

                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <li>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="club-news-list-image">
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                </div>
                            <?php endif; ?>

                            <strong><?php the_title(); ?></strong>

                            <a
                                    href="?module=news&action=edit&post=<?php the_ID(); ?>"
                                    style="margin-left:15px;">
                                ✏ Bearbeiten
                            </a>

                            <br>

                            <small><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></small>

                        </li>

                    <?php endwhile; ?>

                </ul>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>

                <p>Noch keine Neuigkeiten vorhanden.</p>

            <?php endif; ?>

            <?php echo CLUB_Card::end(); ?>

        <?php endif; ?>

        <?php
        return ob_get_clean();
    }
}