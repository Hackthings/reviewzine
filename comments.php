<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package islemag
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

	<div id="comments" class="comments-area">

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<span><?php esc_html_e( 'Comments', 'reviewzine' ); ?></span>
			</h3>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'reviewzine' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'reviewzine' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'reviewzine' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation. ?>

			<ul class="comments-list media-list">
				<?php
					wp_list_comments( array(
						'callback'          => 'reviewzine_comment',
						'avatar_size'       => 80
					) );
				?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'reviewzine' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'reviewzine' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'reviewzine' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php endif; ?>

		<?php endif; ?>

		<?php	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'reviewzine' ); ?></p>
		<?php endif; ?>

		<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
		'author' =>
			'<div class="col-sm-4">
			  <div class="form-group">
				  <label for="author" class="input-desc">' . __( 'Name', 'reviewzine' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> '.
				 '<input id="author" class="form-control" placeholder="'. esc_html__( 'Name', 'reviewzine' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .	'" size="30"' . $aria_req . ' />
				 </div>
				</div>',

		'email' =>
			'<div class="col-sm-4">
			  <div class="form-group">
				 <label for="email" class="input-desc">' . __( 'Email', 'reviewzine' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> '. 
			  '<input id="email" class="form-control" placeholder="'. esc_html__( 'Your E-mail', 'reviewzine' ).'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' />
			  </div>
			 </div>',

		'url' =>
			'<div class="col-sm-4">
			  <div class="form-group">
			   <label for="url" class="input-desc">' . __( 'Website', 'reviewzine' ) . '</label>' .
			  '<input id="url" class="form-control" placeholder="'. esc_html__( 'Website', 'reviewzine' ).'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" />
			  </div>
			 </div>',
		);

		$args = array(
			'class_submit' 			=> 'btn btn-dark',
			'fields' 						=> apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' 		=> '<div class="form-group">
											<label for="comment" class="input-desc">' . _x( 'Comment', 'noun', 'reviewzine' ) . '</label>
											<textarea class="form-control" id="comment" name="comment" aria-required="true" placeholder="'. esc_html__( 'Your Message', 'reviewzine' ).'"></textarea>
										</div>',
			'title_reply_before'    => '<h3 id="reply-title" class="comment-reply-title"><span>',
			'title_reply_after'     => '</span></h3>'
		);

		comment_form( $args );
		?>

	</div><!-- #comments -->
