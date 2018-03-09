<?php
//form fields section

$wp_customize->add_section( 'gf_stla_form_id_list_field' , array(
    'title' => 'List Field',
    'panel' => 'gf_stla_panel',
  ) );

 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-table][background-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-table][background-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Table background Color' ),
      'section' => 'gf_stla_form_id_list_field',
    )
  )
);

//   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-table][margin]' , array(
//       'default'     => '',
//       'transport'   => 'postMessage',
//       'type' => 'option'
//   ) );

//   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-table][margin]',   array(
//     'type' => 'text',
//     'priority' => 10, // Within the section.
//     'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
//     'label' => __( 'Table Margin' ),
//    'input_attrs' => array(
//     'placeholder' => 'Example: 5px 10px 5px 10px'
//   )
//   )
// );



 /* Start of Section */
 //label
 $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Heading Font Size' ),
      'section' => 'gf_stla_form_id_list_field',
      'settings' => array(),
    )
  )

);
 /* for pc*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px '
  )
  )
);
  /* for_tablet*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size-tab]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px '
  )
  )
);
  
  /* for_phone*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size-phone]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-size-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px '
  )
  )
);







 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );


  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-heading][font-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Heading Font Color' ),
      'section' => 'gf_stla_form_id_list_field',
    )
  )
);

 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][background-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-heading][background-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Heading background Color' ),
      'section' => 'gf_stla_form_id_list_field',
    )
  )
);

$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][text-align]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-heading][text-align]',   array(
    'type' => 'select',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( 'Heading Position' ),
    'choices'        => $align_pos,
  )
);


   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-heading][padding]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-heading][padding]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( 'Heading Padding' ),
   'input_attrs' => array(
    'placeholder' => 'Example: 5px 10px 5px 10px'
  )
  )
);


 /* Start of Section */
 //label
 $wp_customize->add_control(
  new WP_Customize_Label_Only(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size-label-only]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Cell Text Font Size' ),
      'section' => 'gf_stla_form_id_list_field',
      'settings' => array(),
    )
  )

);
 /* for pc*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

  
  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Example: 40px or 90%'
  )
  )
);
  /* for_tablet*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size-tab]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size-tab]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px '
  )
  )
);
  
  /* for_phone*/
$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size-phone]' , array(
      'default'     => '',
      'transport'   => 'refresh',
      'type' => 'option'
  ) );

   $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-size-phone]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( '' ),
   'input_attrs' => array(
    'placeholder' => 'Ex: 40px '
  )
  )
);


 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][background-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-cell][background-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Cell background Color' ),
      'section' => 'gf_stla_form_id_list_field',
    )
  )
);

 $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-color]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize, // WP_Customize_Manager
    'gf_stla_form_id_'.$current_form_id.'[list-field-cell][font-color]', // Setting id
    array( // Args, including any custom ones.
      'label' => __( 'Cell Text Font Color' ),
      'section' => 'gf_stla_form_id_list_field',
    )
  )
);

$wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell][text-align]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-cell][text-align]',   array(
    'type' => 'select',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( 'Cell Text Alignment' ),
    'choices'        => $align_pos,
  )
);


   $wp_customize->add_setting( 'gf_stla_form_id_'.$current_form_id.'[list-field-cell-container][padding]' , array(
      'default'     => '',
      'transport'   => 'postMessage',
      'type' => 'option'
  ) );

  $wp_customize->add_control('gf_stla_form_id_'.$current_form_id.'[list-field-cell-container][padding]',   array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'gf_stla_form_id_list_field', // Required, core or custom.
    'label' => __( 'Cell Padding' ),
   'input_attrs' => array(
    'placeholder' => 'Example: 5px 10px 5px 10px'
  )
  )
);

