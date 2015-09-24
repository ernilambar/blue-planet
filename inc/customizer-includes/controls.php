<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;


/**
 * Customize Control for Heading
 */
class Blue_Planet_Customize_Heading_Control extends WP_Customize_Control {

  public $type = 'heading';

  public function render_content() {

    ?>
      <h3 class="bp-customize-heading"><?php echo esc_html( $this->label ); ?></h3><!-- .bp-customize-heading -->
    <?php
  }

}


/**
 * Customize Control for Message
 */
class Blue_Planet_Customize_Message_Control extends WP_Customize_Control {

  public $type = 'message';

  public function render_content() {

    ?>
      <div class="bp-customize-message">
        <?php echo $this->description; ?>
      </div> <!-- .bp-customize-message -->
    <?php
  }

}

/**
 * Customize Control for Taxonomy Select
 */
class Blue_Planet_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


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

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__( 'Select', 'blue-planet' ) );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}
