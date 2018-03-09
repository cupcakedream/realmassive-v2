<?php
//form  section
/* Start of Section */
 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][text-align]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[section-break-description][text-align]',   array(
    'type' => 'select',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_section_break_title_description', // Required, core or custom.
    'label' => __( 'Description Font Alignment' ),
    'choices'        => $align_pos,
  )
);

/* Start of Section */
//label
 $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Description Font Size' ),
      'section' => 'gf_stla_form_id_section_break_title_description',
      'settings' => array(),
    )
  )

);

   /* for pc */
 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_section_break_title_description', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);

   /* for tablet */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size-tab]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_section_break_title_description', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);
  /* for mobile */
   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size-phone]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[section-break-description][font-size-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_section_break_title_description', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px'
  )
  )
);

/* Start of Section */
 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[section-break-description][font-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Description Font Color' ),
      'section' => 'gf_stla_form_id_section_break_title_description',
    )
  )
);

  $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][background-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[section-break-description][background-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Description Background Color' ),
      'section' => 'gf_stla_form_id_section_break_title_description',
    )
  )
);


   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[section-break-description][padding]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[section-break-description][padding]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_section_break_title_description', // Required, core or custom.
    'label' => __( 'Padding' ),
   'input_attrs' => array(
    'placeholder' => 'Example: 5px 10px 5px 10px'
  )
  )
);