<?php
/**
 * The Sidebar containing the header widget areas.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 */
?>

<?php
if ( ! is_active_sidebar( 'spacious_header_toggle_sidebar_one' ) &&
     ! is_active_sidebar( 'spacious_header_toggle_sidebar_two' ) &&
     ! is_active_sidebar( 'spacious_header_toggle_sidebar_three' ) &&
     ! is_active_sidebar( 'spacious_header_toggle_sidebar_four' ) &&
     ! is_active_sidebar( 'spacious_header_sidebar_full_width' ) ) {
	return;
}

$header_columns = spacious_options( 'spacious_togglable_header_sidebar_column', 'four' );

$header_column_class = '';
if ( $header_columns == 'two-style-1' || $header_columns == 'two-style-2' || $header_columns == 'three-style-1' || $header_columns == 'three-style-2' || $header_columns == 'three-style-3' || $header_columns == 'four-style-1' || $header_columns == 'four-style-2' ) {
	$header_column_class = 'header-sidebar-dynamic-width';
}

$spacious_header_sidebars = array(
	'one'           => array(
		'header_column_one'   => 'tg-column-full',
		'header_column_two'   => '',
		'header_column_three' => '',
		'header_column_four'  => '',
	),
	'two'           => array(
		'header_column_one'   => 'tg-one-half',
		'header_column_two'   => 'tg-one-half tg-one-half-last',
		'header_column_three' => '',
		'header_column_four'  => '',
	),
	'three'         => array(
		'header_column_one'   => 'tg-one-third',
		'header_column_two'   => 'tg-one-third tg-column-2',
		'header_column_three' => 'tg-one-third tg-after-two-blocks-clearfix',
		'header_column_four'  => '',
	),
	'four'          => array(
		'header_column_one'   => 'tg-one-fourth tg-column-1',
		'header_column_two'   => 'tg-one-fourth tg-column-2',
		'header_column_three' => 'tg-one-fourth tg-after-two-blocks-clearfix tg-column-3',
		'header_column_four'  => 'tg-one-fourth tg-one-fourth-last tg-column-4',
	),
	'two-style-1'   => array(
		'header_column_one'   => 'tg-one-half-large',
		'header_column_two'   => 'tg-one-half-small',
		'header_column_three' => '',
		'header_column_four'  => '',
	),
	'two-style-2'   => array(
		'header_column_one'   => 'tg-one-half-small',
		'header_column_two'   => 'tg-one-half-large',
		'header_column_three' => '',
		'header_column_four'  => '',
	),
	'three-style-1' => array(
		'header_column_one'   => 'tg-one-third-small',
		'header_column_two'   => 'tg-one-third-large',
		'header_column_three' => 'tg-one-third-small',
		'header_column_four'  => '',
	),
	'three-style-2' => array(
		'header_column_one'   => 'tg-one-third-large',
		'header_column_two'   => 'tg-one-third-small',
		'header_column_three' => 'tg-one-third-small',
		'header_column_four'  => '',
	),
	'three-style-3' => array(
		'header_column_one'   => 'tg-one-third-small',
		'header_column_two'   => 'tg-one-third-small',
		'header_column_three' => 'tg-one-third-large',
		'header_column_four'  => '',
	),
	'four-style-1'  => array(
		'header_column_one'   => 'tg-one-fourth-large',
		'header_column_two'   => 'tg-one-fourth-small',
		'header_column_three' => 'tg-one-fourth-small',
		'header_column_four'  => 'tg-one-fourth-small',
	),
	'four-style-2'  => array(
		'header_column_one'   => 'tg-one-fourth-small',
		'header_column_two'   => 'tg-one-fourth-small',
		'header_column_three' => 'tg-one-fourth-small',
		'header_column_four'  => 'tg-one-fourth-large',
	),
);
?>

<div class="header-widgets-wrapper">
	<div class="inner-wrap">
		<div class="header-widgets-area <?php echo esc_attr( $header_column_class ); ?> clearfix">

			<?php foreach ( $spacious_header_sidebars as $key => $spacious_header_sidebar ) { ?>
				<?php if ( $header_columns == $key ) : ?>

					<div class="<?php echo esc_attr( $spacious_header_sidebar['header_column_one'] ); ?>">
						<?php
						// Calling the header sidebar if it exists.
						if ( ! dynamic_sidebar( 'spacious_header_toggle_sidebar_one' ) ):
						endif;
						?>
					</div>

					<?php if ( $spacious_header_sidebar['header_column_two'] ) { ?>
						<div class="<?php echo esc_attr( $spacious_header_sidebar['header_column_two'] ); ?>">
							<?php
							// Calling the header sidebar if it exists.
							if ( ! dynamic_sidebar( 'spacious_header_toggle_sidebar_two' ) ):
							endif;
							?>
						</div>
					<?php } ?>

					<?php if ( $spacious_header_sidebar['header_column_three'] ) { ?>
						<div class="<?php echo esc_attr( $spacious_header_sidebar['header_column_three'] ); ?>">
							<?php
							// Calling the header sidebar if it exists.
							if ( ! dynamic_sidebar( 'spacious_header_toggle_sidebar_three' ) ):
							endif;
							?>
						</div>
					<?php } ?>

					<?php if ( $spacious_header_sidebar['header_column_four'] ) { ?>
						<div class="<?php echo esc_attr( $spacious_header_sidebar['header_column_four'] ); ?>">
							<?php
							// Calling the header sidebar if it exists.
							if ( ! dynamic_sidebar( 'spacious_header_toggle_sidebar_four' ) ):
							endif;
							?>
						</div>
					<?php } ?>

				<?php endif; ?>
			<?php } ?>

			<?php if ( is_active_sidebar( 'spacious_header_sidebar_full_width' ) ) { ?>
				<div class="header-full-width-sidebar">
					<?php dynamic_sidebar( 'spacious_header_sidebar_full_width' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
