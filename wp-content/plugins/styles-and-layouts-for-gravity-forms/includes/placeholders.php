<?php
//form placeholders section uses refresh method
/* Start of Section */
$wp_customize->add_section( 'gf_stla_form_id_placeholders' , array(
    'title' => 'Placeholders',
    'panel' => 'gf_stla_panel',
  ) );

 //label
 $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Font Size' ),
      'section' => 'gf_stla_form_id_placeholders',
      'settings' => array(),
    )
  )

);

$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size]' , array(
    'default'     => '',
    'transport'   => 'refresh',
    'type' => 'option'
  ) );

$wp_customize->add_control( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_placeholders', // Required, core or custom.
    'label' => __( '' ),
    'input_attrs' => array(
      'placeholder' => 'Ex: 40px'
    )
  )
);
/* for tablet */
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size-tab]' , array(
    'default'     => '',
    'transport'   => 'refresh',
    'type' => 'option'
  ) );

$wp_customize->add_control( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_placeholders', // Required, core or custom.
    'label' => __( '' ),
    'input_attrs' => array(
      'placeholder' => 'Ex: 40px'
    )
  )
);

/* for mobile */
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size-phone]' , array(
    'default'     => '',
    'transport'   => 'refresh',
    'type' => 'option'
  ) );

$wp_customize->add_control( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-size-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_placeholders', // Required, core or custom.
    'label' => __( '' ),
    'input_attrs' => array(
      'placeholder' => 'Ex: 40px'
    )
  )
);


/* Start of Section */
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[placeholders][font-color]' , array(
    'default'     => '',
    'transport'   => 'refresh',
    'type' => 'option'
  ) );

$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[placeholders][font-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Font Color' ),
      'section' => 'gf_stla_form_id_placeholders',
    )
  )
);

/* Start of Section */
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[placeholders][padding]' , array(
    'default'     => '',
    'transport'   => 'refresh',
    'type' => 'option'
  ) );

$wp_customize->add_control( 'gf_stla_form_id_'.$current_form_id.'[placeholders][padding]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_placeholders', // Required, core or custom.
    'label' => __( 'Padding' ),
    'input_attrs' => array(
      'placeholder' => 'Example: 5px 10px 5px 10px'
    )
  )
);
