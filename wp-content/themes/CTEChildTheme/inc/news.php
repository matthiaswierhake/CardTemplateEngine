<?php
/**
 * Aktuelle Neuigkeiten
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function lsv_news_shortcode() {

    $query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'category_name'  => 'aktuelles',
    ) );

    ob_start();
    ?>

    <div class="lsv-news-box">

        <div class="lsv-box-title">
            <span class="dashicons dashicons-media-document"></span>
            Aktuelle Neuigkeiten
        </div>

        <?php if ( current_user_can( 'edit_posts' ) ) : ?>
            <a class="lsv-news-add" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
                + Neue Neuigkeit
            </a>
        <?php endif; ?>

        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <div class="lsv-news-item">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="lsv-news-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="lsv-news-content">

                        <h4>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <p>
                            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
                        </p>

                        <div class="lsv-news-date">
                            <?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?>
                        </div>

                        <?php if ( current_user_can( 'edit_post', get_the_ID() ) ) : ?>
                            <div class="lsv-news-actions">

                                <a href="<?php echo esc_url( get_edit_post_link() ); ?>">
                                    Bearbeiten
                                </a>

                                <?php if ( current_user_can( 'delete_post', get_the_ID() ) ) : ?>
                                    <a class="delete"
                                       href="<?php echo esc_url( get_delete_post_link( get_the_ID(), '', true ) ); ?>"
                                       onclick="return confirm('Diese Neuigkeit wirklich löschen?');">
                                        Löschen
                                    </a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        <?php else : ?>

            <p>Keine aktuellen Neuigkeiten vorhanden.</p>

        <?php endif; ?>

    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'lsv_news', 'lsv_news_shortcode' );