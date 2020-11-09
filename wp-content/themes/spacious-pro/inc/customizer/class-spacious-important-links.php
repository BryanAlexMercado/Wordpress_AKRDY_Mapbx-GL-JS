<?php

class Spacious_Important_Links extends WP_Customize_Control {

	public $type = 'spacious-important-links';

	public function render_content() {
		//Add Theme instruction, Support Forum, Demo Link, Rating Link
		$important_links = array(
			'support'       => array(
				'link' => esc_url( 'https://themegrill.com/contact/' ),
				'text' => esc_html__( 'Support Forum', 'spacious' ),
			),
			'documentation' => array(
				'link' => esc_url( 'https://docs.themegrill.com/spacious/' ),
				'text' => esc_html__( 'Documentation', 'spacious' ),
			),
			'demo'          => array(
				'link' => esc_url( 'https://demo.themegrill.com/spacious-demos/' ),
				'text' => esc_html__( 'View Demo', 'spacious' ),
			),
		);
		foreach ( $important_links as $important_link ) {
			echo wp_kses(
				'<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_html( $important_link['text'] ) . ' </a></p>',
				array(
					'a' => array(
						'href' => array(),
						'target' => array(),
					),
					'p' => array(),
				)
			);

		}
		?>
		<?php
	}

}

