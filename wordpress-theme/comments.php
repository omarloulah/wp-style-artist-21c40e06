<?php
/**
 * Comments Template
 *
 * @package TechPolse
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            printf(
                _n('%s Comment', '%s Comments', $comments_number, 'techpolse'),
                number_format_i18n($comments_number)
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('Older Comments', 'techpolse'),
            'next_text' => __('Newer Comments', 'techpolse'),
        ));
        ?>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments" style="color: var(--muted-foreground); font-style: italic;">
            <?php esc_html_e('Comments are closed.', 'techpolse'); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => __('Leave a Comment', 'techpolse'),
        'title_reply_to'       => __('Reply to %s', 'techpolse'),
        'cancel_reply_link'    => __('Cancel Reply', 'techpolse'),
        'label_submit'         => __('Post Comment', 'techpolse'),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="btn btn-primary">%4$s</button>',
        'comment_notes_before' => '',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'techpolse') . '</label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required></textarea></p>',
    ));
    ?>
</div>
