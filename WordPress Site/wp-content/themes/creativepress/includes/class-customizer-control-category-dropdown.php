<?php
class creativepress_Customize_Categories_Dropdown extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public function render_content() {

		$dropdown = wp_dropdown_categories(
			array(
				'name'             => '_customize-dropdown-categories-' . $this->id,
				'echo'             => 0,
				'hide_empty'       => false,
				'show_option_none' => '&mdash; ' . esc_html__( 'Select', 'creativepress' ) . ' &mdash;',
				'hide_if_empty'    => false,
				'selected'         => $this->value() ,
			)
		);

		$dropdown = str_replace('<select', '<select ' . $this->get_link() , $dropdown);
		printf('<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>', $this->label, $dropdown);
	}
}