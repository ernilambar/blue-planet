<?php
/**
 * Custom Customizer Controls.
 *
 * @package Blue_Planet
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Customize Control for Heading.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Blue_Planet_Customize_Heading_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
	?>
      <# if ( data.label ) { #>
      	<h3 class="bp-customize-heading">{{ data.label }}</h3>
      <# } #>
    <?php
	}
}

/**
 * Customize Control for Message.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Blue_Planet_Customize_Message_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'message';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
	?>
	<?php if ( ! empty( $this->label ) ) : ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<?php endif; ?>
	<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description bp-customize-message"><?php echo $this->description; ?></span>
	<?php endif; ?>
	<?php
	}
}

/**
 * Customize Control for Taxonomy Select.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Blue_Planet_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-taxonomies';

	/**
	 * Taxonomy.
	 *
	 * @access public
	 * @var string
	 */
	public $taxonomy = '';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$our_taxonomy = 'category';
		if ( isset( $args['taxonomy'] ) ) {
			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
			if ( true === $taxonomy_exist ) {
				$our_taxonomy = esc_attr( $args['taxonomy'] );
			}
		}
		$args['taxonomy'] = $our_taxonomy;
		$this->taxonomy = esc_attr( $our_taxonomy );

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		$tax_args = array(
		'hierarchical' => 0,
		'taxonomy'     => $this->taxonomy,
		);
		$all_taxonomies = get_categories( $tax_args );

	?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php $this->link(); ?>>
            <?php
			  printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), __( '&mdash; Select &mdash;', 'blue-planet' ) );
				?>
            <?php if ( ! empty( $all_taxonomies ) ) : ?>
				<?php foreach ( $all_taxonomies as $key => $tax ) : ?>
                <?php
				  printf( '<option value="%s" %s>%s</option>', $tax->term_id, selected( $this->value(), $tax->term_id, false ), $tax->name );
					?>
				<?php endforeach; ?>
			<?php endif; ?>
         </select>

    </label>
    <?php
	}
}
