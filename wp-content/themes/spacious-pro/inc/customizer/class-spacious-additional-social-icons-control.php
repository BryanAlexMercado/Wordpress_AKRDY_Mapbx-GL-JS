<?php

class Spacious_Additional_Social_Icons_Control extends WP_Customize_Control {

	public $type = 'spacious-additional-social-icons';

	public function render_content() {
		echo wp_kses(
			__( 'Add font awesome icon name. Example: soundcloud. You can find list <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'spacious' ), array(
				'a' => array(
					'href' => array(),
				)
			)
		);
		?>
		<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>>
	<?php }

}
