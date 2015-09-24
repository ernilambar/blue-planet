<div class="wrap">
  <h2><?php _e( 'Blue Planet Theme Options', 'blue-planet' ); ?></h2>

  <h3><?php _e( 'Important - Please read carefully!', 'blue-planet' ); ?></h3>
  <div><pre>
    <?php _e( 'Theme Options are moved to Customizer from this version. To access theme options go to `Appearance` -> `Customize`.', 'blue-planet' ); ?>
    <br />
    <?php _e( 'But you need to copy current theme settings to Customizer using button below.', 'blue-planet' ); ?>
  </pre></div>

  <form action="" method="post">
  <?php wp_nonce_field( 'blue_planet_convert_settings_to_customizer', 'blue_planet_convert_nonce_field' ); ?>
    <?php submit_button( __( 'Copy existing theme settings to Customizer', 'blue-planet' ) ); ?>
  </form>

  <h3><?php _e( 'Depreciated Fields', 'blue-planet' ); ?></h3>
  <div>
    <?php _e( '3 fields from Theme Options are depreciated as those fields are considered as Plugin Territory in Theme Review. If you need those features, please use relevant plugins.', 'blue-planet' ); ?>
  </div>
  <p><strong><?php _e( 'Depreciated fields will be removed in next version.', 'blue-planet' ); ?></strong></p>
  <ul style="list-style-type:disc; list-style-position:inside;">
    <li><?php _e( 'Javascript in Header', 'blue-planet' ); ?></li>
    <li><?php _e( 'Javascript in Footer', 'blue-planet' ); ?></li>
    <li><?php _e( 'FeedBurner URL', 'blue-planet' ); ?></li>
  </ul>
  <p><?php _e( 'You can try out these plugins:', 'blue-planet' ); ?> </p>
  <ul style="list-style-type:disc; list-style-position:inside;">
    <li><a href="https://wordpress.org/plugins/wp-custom-header-footer/" target="_blank"><?php _e( 'WP Custom Header Footer', 'blue-planet' ); ?></a></li>
    <li><a href="https://wordpress.org/plugins/feedburner-plugin/" target="_blank"><?php _e( 'FD Feedburner Plugin', 'blue-planet' ); ?></a></li>
  </ul>

  <br />
  <br />
  <hr />
  <br />
  <br />
  <div style="font-weight:bold; text-align:center;"><?php _e( 'This page will be removed from admin menu in the next version', 'blue-planet' ); ?></div>

</div>
