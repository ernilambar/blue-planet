<?php
/**
 * Widget Base Class
 *
 * @package  Widget_Base
 * @version  1.0
 */

/**
 * Core class for widget base.
 *
 * @since 1.0
 */
class Blue_Planet_Widget_Base extends WP_Widget {

	/**
	 * Fields.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	private $fields;

	/**
	 * PHP5 constructor.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $id_base         Optional Base ID for the widget.
	 * @param string $name            Name for the widget.
	 * @param array  $widget_options  Optional. Widget options.
	 * @param array  $control_options Optional. Widget control options.
	 * @param array  $fields Fields.
	 */
	function __construct( $id_base, $name, $widget_options = array(), $control_options = array(), $fields = array() ) {

		$this->fields = $fields;

		parent::__construct( $id_base, $name, $widget_options, $control_options );

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		foreach ( $this->fields as $key => $field ) {

			$instance[ $key ] = $this->sanitize( $key, $field, $new_instance[ $key ] );

		}

		return $instance;

	}

	function sanitize( $key, $field, $value ) {

		$field_type = 'text';
		if ( isset( $field['type'] ) ) {
			$field_type = esc_attr( $field['type'] );
		}
		if ( ! isset( $field['default'] ) ) {
			$field['default'] = null;
		}

		$output  = null;
		switch ( $field_type ) {
			case 'text':
				$output = sanitize_text_field( $value );
				break;
			case 'url':
				$output = esc_url_raw( $value );
				break;
			case 'email':
				$output = sanitize_email( $value );
				break;
			case 'number':
				if ( isset( $field['absolute'] ) && true === $field['absolute'] ) {
					$number = absint( $value );
				} else {
					$number = intval( $value );
				}
				$min    = ( isset( $field['min'] ) ? $field['min'] : $number );
				$max    = ( isset( $field['max'] ) ? $field['max'] : $number );
				$step   = ( isset( $field['step'] ) ? $field['step'] : 1 );
				if ( $min === $max ) {
					// Simple number.
					$output = ( $number ) ? $number : $field['default'];
				} else {
					// Number range.
					$output = $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $field['default'];
				}
				break;
			case 'textarea':
				if ( current_user_can( 'unfiltered_html' ) ) {
					$output = $value;
				} else {
					$sanitized_value = wp_kses_post( $value );
					$output = balanceTags( $sanitized_value , true );
				}
				break;
			case 'select':
			case 'radio':
				$input = esc_attr( $value );
				$choices = $field['options'];
				$output = array_key_exists( $input, $choices ) ? $input : $field['default'];
				break;
			case 'checkbox':
				$output = ! empty( $value );
				break;
			case 'dropdown-pages':
				$page_id = absint( $value );
				$output = ( 'page' === get_post_type( $page_id ) && 'publish' === get_post_status( $page_id ) ) ? $page_id : $field['default'];
				break;
			case 'dropdown-taxonomies':
				$output = absint( $value );
				break;
			default:
				$output = esc_attr( $value );
				break;
		}
		return $output;

	}

	function render_field( $key, $field, $instance ) {

		$value = null;
		if ( isset( $instance[ $key ] ) ) {
			$value = $instance[ $key ];
		}
		$field_type = 'text';
		if ( isset( $field['type'] ) ) {
			$field_type = esc_attr( $field['type'] );
		}
		if ( ! isset( $field['class'] ) ) {
			$field['class'] = '';
		}
		if ( ! isset( $field['placeholder'] ) ) {
			$field['placeholder'] = '';
		}
		if ( ! isset( $field['css'] ) ) {
			$field['css'] = '';
		}
		if ( ! isset( $field['description'] ) ) {
			$field['description'] = '';
		}
		if ( ! isset( $field['readonly'] ) ) {
			$field['readonly'] = false;
		}
		if ( ! isset( $field['options'] ) ) {
			$field['options'] = array();
		}
		if ( ! isset( $field['rows'] ) || absint( $field['rows'] ) < 1 ) {
			$field['rows'] = 4;
		}
		switch ( $field_type ) {
			case 'text':
			case 'url':
			case 'number':
			case 'email':
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
	                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label>
                    <input
                    type="<?php echo esc_attr( $field_type ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
                    value="<?php echo esc_attr( $value ); ?>"
                    class="<?php echo esc_attr( $field['class'] ); ?>"
                    style="<?php echo esc_attr( $field['css'] ); ?>"
                    placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"
                    <?php echo ( isset( $field['min'] ) ) ? ' min="' . esc_attr( $field['min'] ). '" ' : '' ; ?>
                    <?php echo ( isset( $field['max'] ) ) ? ' max="' . esc_attr( $field['max'] ). '" ' : '' ; ?>
                    <?php echo ( isset( $field['step'] ) ) ? ' step="' . esc_attr( $field['step'] ). '" ' : '' ; ?>
                    <?php echo ( true === $field['readonly'] ) ? ' readonly ' : '' ; ?>
                    />

                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>

                </p>
                <?php
				break;

			case 'heading':
				$css = 'text-align:center;background-color:#f1f1f1;padding:5px 0;';
				if ( ! empty( $field['css'] ) ) {
					$css = $field['css'];
				}
				?>
                <h4 class="widefat <?php echo esc_attr( $field['class'] ); ?>" style="<?php echo esc_attr( $css ); ?>">
                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                </h4>
                <?php
				break;

			case 'message':
				$css = 'padding:10px 0;';
				if ( ! empty( $field['css'] ) ) {
					$css = $field['css'];
				}
				?>
                <div class="widefat field-message <?php echo esc_attr( $field['class'] ); ?>" style="<?php echo esc_attr( $css ); ?>">
                    <?php echo $field['label']; ?>
                </div>
                <?php
				break;

			case 'divider':
				$css = 'border:1px #CCC solid;';
				if ( ! empty( $field['css'] ) ) {
					$css = $field['css'];
				}
				?>
	               <hr style="<?php echo esc_attr( $css ); ?>" />
                <?php
				break;

			case 'textarea':
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
	                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label>
                    <textarea
                    type="text"
                    rows="<?php echo absint( $field['rows'] ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
                    class="<?php echo esc_attr( $field['class'] ); ?>"
                    style="<?php echo esc_attr( $field['css'] ); ?>"
                    placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"
                    <?php echo ( true === $field['readonly'] ) ? ' readonly ' : '' ; ?>
                    ><?php echo esc_textarea( $value ); ?></textarea>
                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			case 'checkbox':
				?>
                <p>
                    <input
                    type="checkbox"
                    id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
                    class="<?php echo esc_attr( $field['class'] ); ?>"
                    style="<?php echo esc_attr( $field['css'] ); ?>"
                    <?php checked( ! empty( $value ) ); ?>
                    />
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
                    	<span class="field-label"><?php echo esc_html( $field['label'] ); ?></span>
                    </label>
                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			case 'radio':
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
                    	<span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label><br/>
                    <?php if ( ! empty( $field['options'] ) ) : ?>
                    	<?php foreach ( $field['options'] as $k => $v ) : ?>
                    		<label for="<?php echo esc_attr( $this->get_field_id( $key ) . '-' . $k ); ?>">
                    		<input type="radio" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) . '-' . $k ); ?>" value="<?php echo esc_attr( $k ); ?>" <?php checked( $k, $value ) ?> /><?php echo esc_html( $v ); ?>
                    		</label>&nbsp;&nbsp;
                    	<?php endforeach; ?>
                    <?php endif ?>

                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			case 'select':
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
	                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label>
                    <select
                    type="text"
                    id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"
                    class="<?php echo esc_attr( $field['class'] ); ?>"
                    style="<?php echo esc_attr( $field['css'] ); ?>"
                    >
                    <?php if ( ! empty( $field['options'] ) ) : ?>
                    	<?php foreach ( $field['options'] as $option_key => $label ) : ?>
		                    <option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $label ); ?></option>
                    	<?php endforeach; ?>
                    <?php endif ?>

                    </select>
                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			case 'dropdown-taxonomies':
				$args                    = array();
				$args['selected']        = esc_attr( $value );
				$args['taxonomy']        = ( isset( $field['taxonomy'] ) ) ? esc_attr( $field['taxonomy'] ) : 'category' ;
				$args['name']            = esc_attr( $this->get_field_name( $key ) );
				$args['id']              = esc_attr( $this->get_field_id( $key ) );
				$args['show_option_all'] = ( isset( $field['show_option_all'] ) ) ? esc_html( $field['show_option_all'] ) : '' ;
				$args['class']           = ( isset( $field['class'] ) ) ? esc_attr( $field['class'] ) : '' ;
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
	                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label>
                    <?php wp_dropdown_categories( $args ); ?>
                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			case 'dropdown-pages':
				$args                    = array();
				$args['selected']        = $value;
				$args['taxonomy']        = ( isset( $field['taxonomy'] ) ) ? esc_attr( $field['taxonomy'] ) : 'category' ;
				$args['name']            = esc_attr( $this->get_field_name( $key ) );
				$args['id']              = esc_attr( $this->get_field_id( $key ) );
				$args['show_option_none'] = ( isset( $field['show_option_none'] ) ) ? esc_html( $field['show_option_none'] ) : '' ;
				$args['class']           = ( isset( $field['class'] ) ) ? esc_attr( $field['class'] ) : '' ;
				?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>">
	                    <span class="field-label"><strong><?php echo esc_html( $field['label'] ); ?></strong></span>
                    </label>
                    <?php wp_dropdown_pages( $args ); ?>
                    <?php $this->render_description( $field, $this->get_field_id( $key ) ); ?>
                </p>
                <?php
				break;

			default:
				break;
		}
	}
	function form( $instance ) {

		$instance = $this->add_defaults( $instance );

		foreach ( $this->fields as $key => $field ) {

			$this->render_field( $key, $field, $instance );

		}

	}
	function render_description( $field, $id = '' ) {
		if ( ! isset( $field['description'] ) && empty( $field['description'] ) ) {
			return;
		}
		$custom_style = 'clear:both;display:block;';
		if ( isset( $field['adjacent'] ) && true === $field['adjacent'] ) {
			$custom_style = 'margin-left:5px;';
		}

		?>
		<label for="<?php echo esc_attr( $id ); ?>" style="<?php echo esc_attr( $custom_style ); ?>">
			<span class="field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
		</label>
		<?php

	}

	function add_defaults( $instance ) {

		$default_arr = array();
		if ( ! empty( $this->fields ) ) {
			foreach ( $this->fields as $key => $field ) {
				$default_arr[ $key ] = null;
				if ( ! isset( $instance[ $key ] ) && isset( $field['default'] ) ) {
					$default_arr[ $key ] = $field['default'];
				}

			}
		}
		$instance = array_merge( $default_arr, $instance );

		return $instance;
	}

	function get_params( $instance ) {
		$output = array();
		if ( ! empty( $this->fields ) ) {
			if ( isset( $instance['title'] ) ) {
				$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			}
			$output = $this->add_defaults( $instance );
		}
		return $output;
	}
}
