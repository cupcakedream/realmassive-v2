<?php
/* Start of Section */
$wp_customize->add_section( 'gf_stla_form_id_checkbox_inputs' , array(
    'title' => 'Checkbox Inputs',
    'panel' => 'gf_stla_panel',
  ) );

//Label
  $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Width' ),
      'section' => 'gf_stla_form_id_checkbox_inputs',
      'settings' => array(),
    )
  )

);


/* for pc */
 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 400px '
  )
  )
);
/* for tablets */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width-tab]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );
  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 400px '
  )
  )
);
/* for mobile */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width-phone]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][max-width-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 400px '
  )
  )
);
/* Start of Section */

//Label
  $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Font Size' ),
      'section' => 'gf_stla_form_id_checkbox_inputs',
      'settings' => array(),
    )
  )

);
/* for pc */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);

/* for tablet */
    $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size-tab]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);

/* for phone */
    $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size-phone]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-size-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);
/* Start of Section */
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][font-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Font Color' ),
      'section' => 'gf_stla_form_id_checkbox_inputs',
    )
  )
);
  
/* Start of Section */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][padding]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[checkbox-inputs][padding]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_checkbox_inputs', // Required, core or custom.
    'label' => __( 'Padding' ),
   'input_attrs' => array(
    'placeholder' => 'Example: 5px 10px 5px 10px'
  )
  )
);