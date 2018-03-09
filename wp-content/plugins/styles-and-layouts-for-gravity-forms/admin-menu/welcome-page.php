<?php

class Gf_Stla_Welcome_Page{

  function __construct() {
    add_action( 'admin_menu', array( $this, 'register_menu' ) );
  }

    public function register_menu() {

    add_submenu_page(  'stla_licenses', 'Documentation', 'Documentation', 'manage_options', 'stla-documentation', array( $this, 'show_documentation' ) );
    //add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );


  }

  function show_documentation(){
    $gf_stla_version = get_plugin_data( GF_STLA_DIR.'/styles-layouts-gravity-forms.php', $markup = true, $translate = true );
    
?>
<div class="wrap" >

  <h1><strong><?php printf( __( 'Styles & Layouts for Gravity Forms &nbsp;v%s' ), $gf_stla_version["Version"] ); ?></strong></h1>

  <div class="about-text">
    <?php printf(  '<span class="stla-intro"> Styles & Layout for Gravity Forms lets you create beautiful designs for your Forms with WordPress "Customizer". All the changes are previewed instantly.</span> ' ); ?>
   <br><br> <a href="https://paypal.me/wpmonks"><img class="stla-donate" src="<?php echo GF_STLA_URL . '/admin-menu/images/donate-button.png'; ?>"></a>
  </div>

 <div class="stla-left-container">

  <div class="stla-feature-box" >
        <h2 class="stla-highlight"><span style="vertical-align: bottom;" class="dashicons dashicons-editor-ul"></span>Features:</h2>
      <ul class="stla-featurelist">
         <li><strong></strong>Live preview all changes.</li>
          <li><strong></strong>Large set of options to customize different aspects of form.</li>
          <li><strong></strong>Create different designs for different forms.</li>
                  </ul>

      </div>
  <div>
        <h2 class ="stla-highlight">How to use Styles and Layouts for Gravity Forms</h2>
        <div style="text-align:center; max-width:100%; height:auto;">
   <h2> Video Tutorial for Styles and Layouts for Gravity Forms</h2>
   <iframe width="560" height="315" src="https://www.youtube.com/embed/m--V51i7PLM" frameborder="0" allowfullscreen></iframe>
   </div>

        <ul>
          <?php if ( ! class_exists('RGFormsModel') ) { ?>
            <li><strong>Step #0: </strong><a href="http://gravityforms.com/" target="_blank">Install & Activate <code>Gravity Forms</code></a>.</li>
          <?php } ?>

          <li style="margin-bottom: 16px; margin-top: 16px;"><strong>Step #1:</strong> Login into WordPress Dashboard and open the page in "frontend" where you have added the form.</li>
          <img class="stla-image" src="<?php echo GF_STLA_URL . '/admin-menu/images/step1.png'; ?>" /><br>
          <li style="margin-bottom: 16px; margin-top: 16px;"><strong>Step #2:</strong> Open customizer from admin bar and navigate to <strong>Styles & Layouts Gravity Forms</strong> panel.</li>
          <img class="stla-image" src="<?php echo GF_STLA_URL . '/admin-menu/images/step2.png'; ?>" /><br>
          <li style="margin-bottom: 16px; margin-top: 16px;"><strong>Step #3:</strong> Select the form you want to design and the page will automatically refresh.</li>
          <img class="stla-image" src="<?php echo GF_STLA_URL . '/admin-menu/images/step3.png'; ?>" /><br>
          <li style="margin-bottom: 16px; margin-top: 16px;"><strong>Step #4:Now  you will see all options to design the form.</li>
          <img class="stla-image" src="<?php echo GF_STLA_URL . '/admin-menu/images/step4.png'; ?>" /><br>
          <li style="margin-bottom: 16px; margin-top: 16px;"><strong>Step #5:</strong> Every change will be previewed instantly. Now click on <strong>Save and Publish</strong> button to save the changes. </li>
          <img class="stla-image" src="<?php echo GF_STLA_URL . '/admin-menu/images/step5.png'; ?>" /><br>
          <li style="margin-bottom: 16px; margin-top: 16px;"><strong> <a href="https://wpmonks.com/contact-us/">Contact us</a> for support or custom work. <a href="https://wordpress.org/support/plugin/styles-and-layouts-for-gravity-forms/reviews/#new-post">Rate plugin</a> on WordPress.org to support our work.</strong> </li>

        </ul>

      </div>

 </div> <!-- Last Div -->

 <div class="stla-right-container">

<h2 class="stla-highlight">Gravity Forms Addons:</h2>

    <a href="https://wpmonks.com/downloads/addon-bundle?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/addon-bundle.jpg"></a>
    <a href="https://wpmonks.com/downloads/material-design?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/material-design.jpg"></a>
    <a href="https://wpmonks.com/downloads/theme-pack?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/theme-pack.jpg"></a>
    <a href="https://wpmonks.com/downloads/grid-layout?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/grid-layout.jpg"></a>
<a href="https://wpmonks.com/downloads/field-icons?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/field-icons.jpg"></a>
<a href="https://wpmonks.com/downloads/tooltips?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/tooltips.jpg"></a>
<a href="https://wpmonks.com/downloads/custom-themes?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/custom-themes.jpg"></a>
<a href="https://wpmonks.com/styles-and-layouts-for-gravity-forms/?src=customizer#x-section-6"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/more-addons.jpg"></a>
<a href="https://wpmonks.com/contact-us/?src=doc-sidebar"><img class="stla-image stla-sidebar-image" src="<?php echo GF_STLA_URL; ?>/css/images/support.jpg"></a>

</div>
 <?php
}
}

new Gf_Stla_Welcome_Page();