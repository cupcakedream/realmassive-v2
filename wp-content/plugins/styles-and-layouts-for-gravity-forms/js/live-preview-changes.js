jQuery(document).ready( function( $ ) {


var urlParams =gf_stla_localize_current_form;
var gradientColor1 = '';
var gradientColor2 = '';
var gradientDirection = 'left,';
var gradientDirectionSafari = 'right,';
var gradientDirectionStandard = 'to left,';
var backgroundOpacity = '';
var backgroundColor ='';
var backgroundType ='';
var gradientStandard = '';
var gradientOpera = '';
var gradientFirefox = '';
var gradientSafari = '';
var backgroundImage = '';

//get intial value of background type selected by user
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-type]', function( control ) {
                backgroundType = control.get();
                
            }); 

//get initial saved value of background opacity
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-opacity]', function( control ) {
                backgroundOpacity = control.get();
                
            }); 
//get intial background image
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-image]', function( control ) {
                backgroundImage = control.get();
                
            }); 

//get initial saved value of background color
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-color]', function( control ) {

                hexColor = control.get();
                if(hexColor){
                  hexColor = hexColor.match(/[^#]\S+/g);
                  backgroundColor = hexToRgbNew(hexColor[0]);
                  backgroundColor = updateBackgroundOpacity(backgroundOpacity, backgroundColor);
                }
            }); 


//get initial saved value of Gradient color 1
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-color-1]', function( control ) {
                color = control.get();
                h = color/360;
                 gradientColor1 = hslTorgb(h)
                 gradientColor1 = updateBackgroundOpacity(backgroundOpacity, gradientColor1);

            }); 

//get initial saved value of Gradient color 2
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-color-2]', function( control ) {
                color = control.get();
                h = color/360;
                 gradientColor2 = hslTorgb(h);
                 gradientColor2 = updateBackgroundOpacity(backgroundOpacity, gradientColor2);
            }); 

//get initial saved value of Gradient direction and save it to different variables 
wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-direction]', function( control ) {
                direction = control.get();
                  switch(direction){
                  case 'left':
                      gradientDirection = 'right,';
                      gradientDirectionSafari = 'left,';
                      gradientDirectionStandard = 'to right,';
                      break;
                   case 'diagonal':
                      gradientDirection = 'bottom right,';
                      gradientDirectionSafari = 'left top,';
                      gradientDirectionStandard = 'to bottom right,'; 
                      break;
                    default:
                      gradientDirection = '';
                      gradientDirectionSafari = '';
                      gradientDirectionStandard = ''; 
                }
            }); 

//Save new value of gradient direction in different variables
function saveGradientDirection(direction){
      switch(direction){
                  case 'left':
                      gradientDirection = 'right,';
                      gradientDirectionSafari = 'left,';
                      gradientDirectionStandard = 'to right,';
                      break;
                   case 'diagonal':
                      gradientDirection = 'bottom right,';
                      gradientDirectionSafari = 'left top,';
                      gradientDirectionStandard = 'to bottom right,'; 
                      break;
                    default:
                      gradientDirection = '';
                      gradientDirectionSafari = '';
                      gradientDirectionStandard = ''; 
                }
                  
}


/**
 * Converts an HSL color value to RGB. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes h, s, and l are contained in the set [0, 1] and
 * returns r, g, and b in the set [0, 255].
 *
 * @param   {number}  h       The hue
 * @param   {number}  s       The saturation
 * @param   {number}  l       The lightness
 * @return  {Array}           The RGB representation


 */



function hslTorgb(h, s=0.5, l=0.4){
    var r, g, b;

    if(s == 0){
        r = g = b = l; // achromatic
    }else{
        var hue2rgb = function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return 'rgb('+Math.round(r * 255)+', '+Math.round(g * 255)+', '+ Math.round(b * 255)+')';
}

//function to convert hex to rgb
function hexToRgbNew(hex) {
  var arrBuff = new ArrayBuffer(4);
  var vw = new DataView(arrBuff);
  vw.setUint32(0,parseInt(hex, 16),false);
  var arrByte = new Uint8Array(arrBuff);

  return "rgb("+arrByte[1] + "," + arrByte[2] + "," + arrByte[3]+")";
}

//Add opacity to rgb

function updateBackgroundOpacity(opacity, color){
  
  color = color.replace(')','');
  color = color.split(',');

  var rgbLength = color.length;
  if(rgbLength == 3){
    color.push(opacity);
  }
  else{
    color[3] = opacity;
  }
  color[0] = color[0].replace('rgba(', '');
  color[0] = color[0].replace('rgb(', '');
  color = "rgba("+color[0]+","+color[1]+","+color[2]+","+color[3]+")";
  
  return color;
}

//Set Gradient color properites for all browsers

function setGradientProperties(){

gradientStandard = 'linear-gradient('+gradientDirectionStandard.concat(gradientColor1)+','+ gradientColor2+')';
gradientOpera = '-o-linear-gradient('+gradientDirection.concat(gradientColor1)+','+ gradientColor2+')';
gradientFirefox = '-moz-linear-gradient('+gradientDirection.concat(gradientColor1)+','+ gradientColor2+')';
gradientSafari = '-webkit-linear-gradient('+gradientDirectionSafari.concat(gradientColor1)+','+ gradientColor2+')';
}



/**
 * Not compatible with wordpress 4.7 onwards
 * using wp_localize script from now onwards
 */
// (window.onpopstate = function () {
//     var match,
//         pl     = /\+/g,  // Regex for replacing addition symbol with a space
//         search = /([^&=]+)=?([^&]*)/g,
//         decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
//         query  = window.location.search.substring(1);

//     urlParams = {};
//     while (match = search.exec(query))
//        urlParams[decode(match[1])] = decode(match[2]);
// })();
 
//Check if px is added, if not then add automatically (not for margins and paddings)
function addPxToValue(to){

  if(!(/\D/.test(to))){
    to = to+'px';
  }
     return to;
}

//Check if px is added, if not then add automatically  for margins and paddings
function addPxToMarginPadding(to){
var marginPadding = to.split(" ");


var arrayLength = marginPadding.length;
var newMarginPadding = '';
for (var i = 0; i < arrayLength; i++) {
  if(!(/\D/.test(marginPadding[i]))){
    marginPadding[i] = marginPadding[i]+'px';
  }
   newMarginPadding +=marginPadding[i]+' ';

}
     return newMarginPadding;
}

function addGoogleFont(FontName) {
var fontPlus='';
    FontName=FontName.split(" ");
    if($.isArray(FontName)){
      fontPlus = FontName[0];
      for(var i=1; i<FontName.length; i++){
       fontPlus = fontPlus +'+'+FontName[i];
      }

    }

    $("<link href='https://fonts.googleapis.com/css?family=" + fontPlus + "' rel='stylesheet' type='text/css'>").appendTo("head");
}
//********************************* Form Wrapper *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-color]', function( value ) {
    value.bind( function( to ) {
                hexColor = to;
                hexColor = hexColor.match(/[^#]\S+/g);
                backgroundColor = hexToRgbNew(hexColor[0]);
                backgroundColor = updateBackgroundOpacity(backgroundOpacity, backgroundColor);
                $( '#gform_wrapper_'+urlParams ).css( 'background-image','none' );
               // $( '#gform_wrapper_'+urlParams ).css( 'background','' );
            $( '#gform_wrapper_'+urlParams ).css( 'background',backgroundColor );
            console.log(backgroundColor);
         } );
  } );

    wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-color-1]', function( value ) {
    value.bind( function( to ) {
              var h = to/360;
            gradientColor1 = hslTorgb(h);
            gradientColor1 = updateBackgroundOpacity(backgroundOpacity, gradientColor1);
             setGradientProperties();
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientStandard);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientOpera);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientFirefox);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientSafari);
         } );
  } );

      wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-color-2]', function( value ) {
    value.bind( function( to ) {
              var h = to/360;
            gradientColor2 = hslTorgb(h);
            gradientColor2 = updateBackgroundOpacity(backgroundOpacity, gradientColor2);
            setGradientProperties();
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientStandard);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientOpera);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientFirefox);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientSafari);
         } );
  } );

      wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][gradient-direction]', function( value ) {
    value.bind( function( to ) {
             var returnValue =  saveGradientDirection(to) ;
             setGradientProperties();
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientStandard);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientOpera);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientFirefox);
            $( '#gform_wrapper_'+urlParams ).css( 'background', gradientSafari);
         } );
      
  } );

       wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-opacity]', function( value ) {
    value.bind( function( to ) {

          backgroundOpacity = to;
          if(backgroundColor){
            backgroundColor = updateBackgroundOpacity(backgroundOpacity, backgroundColor);
          }
            gradientColor1 = updateBackgroundOpacity(backgroundOpacity, gradientColor1);
             gradientColor2 = updateBackgroundOpacity(backgroundOpacity, gradientColor2);
             setGradientProperties();

            if(backgroundType == 'gradient'){
              $( '#gform_wrapper_'+urlParams ).css( 'background-image','none' );
              $( '#gform_wrapper_'+urlParams ).css( 'background-color',backgroundColor );
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientStandard);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientOpera);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientFirefox);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientSafari);
              
             }
             if(backgroundType == 'color'){
              $( '#gform_wrapper_'+urlParams ).css( 'background-image','none' );
               // $( '#gform_wrapper_'+urlParams ).css( 'background', "none");
                $( '#gform_wrapper_'+urlParams ).css( 'background-color', backgroundColor);
             } 
         } );
  } );

      wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-type]', function( value ) {
    value.bind( function( to ) {
            backgroundType = to;
            setGradientProperties();
            if(backgroundType == 'gradient'){
             
              $( '#gform_wrapper_'+urlParams ).css( 'background-image','none' );
              $( '#gform_wrapper_'+urlParams ).css( 'background',backgroundColor );
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientStandard);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientOpera);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientFirefox);
              $( '#gform_wrapper_'+urlParams ).css( 'background', gradientSafari);
              
             }
             if(backgroundType == 'color'){

                $( '#gform_wrapper_'+urlParams ).css( 'background-image','none' );
               // $( '#gform_wrapper_'+urlParams ).css( 'background', "");
                $( '#gform_wrapper_'+urlParams ).css( 'background', backgroundColor);
             } 

             if(backgroundType == 'image'){

                $( '#gform_wrapper_'+urlParams ).css( 'background-image','url(' + backgroundImage + ')' );

             } 

         } );
  } );

  // wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-opacity]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#gform_wrapper_'+urlParams ).css( 'opacity',to );
  //        } );
  // } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams ).css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][font]', function( value ) {
    value.bind( function( to ) {
      if(to == 'Default') {
         $( '#gform_wrapper_'+urlParams ).css( 'font-family','inherit' );
      }
      else{
              addGoogleFont(to);
            $( '#gform_wrapper_'+urlParams ).css( 'font-family','"'+to+'"' );
          }
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams ).css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][background-image]', function( value ) {
    value.bind( function( to ) {
      backgroundImage = to;
            $( '#gform_wrapper_'+urlParams ).css( 'background-image','url(' + to + ')' );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][margin]', function( value ) {

    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-wrapper][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams ).css( 'padding',to);
         } );
  } );

//********************************* Form Header *******************************************

  wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'background',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][border-type]', function( value ) {
    value.bind( function( to ) {

            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'border-radius',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][margin]', function( value ) {
    value.bind( function( to ) {
    to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-header][padding]', function( value ) {
    value.bind( function( to ) {
    to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading' ).css( 'padding',to);
         } );
  } );


//********************************* Form Title *******************************************


wp.customize( 'gf_stla_form_id_'+urlParams+'[form-title][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_title' ).css( 'color',to );
         } );
  } );



wp.customize( 'gf_stla_form_id_'+urlParams+'[form-title][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_title' ).css( 'font-size',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-title][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_title' ).css( 'text-align',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[form-title][margin]', function( value ) {
    value.bind( function( to ) {
  to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_title' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-title][padding]', function( value ) {
    value.bind( function( to ) {
   to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_title' ).css( 'padding',to);
         } );
  } );


//********************************* Form Description *******************************************

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-description][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_description' ).css( 'color',to );
         } );
  } );



wp.customize( 'gf_stla_form_id_'+urlParams+'[form-description][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_description' ).css( 'font-size',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-description][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_description' ).css( 'text-align',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[form-description][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_description' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[form-description][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_heading .gform_description' ).css( 'padding',to);
         } );
  } );

//********************************* Dropdown Fields *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'background',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[dropdown-fields][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield select' ).css( 'padding',to);
         } );
  } );

//********************************* Radio Inputs *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[radio-inputs][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_radio' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[radio-inputs][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_radio' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[radio-inputs][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_radio' ).css( 'width',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[radio-inputs][margin]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_radio' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[radio-inputs][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_radio' ).css( 'padding',to);
         } );
  } );

//********************************* Checkbox Inputs *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[checkbox-inputs][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_checkbox' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[checkbox-inputs][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_checkbox label' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[checkbox-inputs][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_checkbox' ).css( 'width',to );
         } );
  } );


// wp.customize( 'gf_stla_form_id_'+urlParams+'[checkbox-inputs][margin]', function( value ) {
//     value.bind( function( to ) {
//             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_checkbox' ).css( 'margin',to );
//          } );
//   } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[checkbox-inputs][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_checkbox label' ).css( 'padding',to);
         } );
  } );
//********************************* Field Labels *******************************************

  // wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][display]', function( value ) {
  //   value.bind( function( to ) {
  //           if(to){
  //             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'display','none' );
  //           }
  //           else{
  //             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'display','inherit' );
  //           }
  //        } );
  // } );
  
  wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'text-align',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[field-labels][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_label' ).css( 'padding',to);
         } );
  } );

//********************************* Sub Labels *******************************************


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-sub-labels][font-color]', function( value ) {
    value.bind( function( to ) {
                $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_full label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_right label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_left label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_hour label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_minute label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_month label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_day label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_year label' ).css( 'color',to );

              $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_first label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_last label' ).css( 'color',to );
             
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_1 label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_2 label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_city label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_state label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_zip label' ).css( 'color',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_country label' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[field-sub-labels][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_full label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_right label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_left label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_hour label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_minute label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_month label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_day label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_year label' ).css( 'font-size',to );

             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_first label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_last label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_1 label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_2 label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_city label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_state label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_zip label' ).css( 'font-size',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_country label' ).css( 'font-size',to );

         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-sub-labels][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_full label' ).css( 'padding',to);
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_right label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_complex .ginput_left label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_hour label' ).css( 'padding',to);
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_time_minute label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_month label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_day label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_date_year label' ).css( 'padding',to );

             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_first label' ).css( 'padding',to);
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .name_last label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_1 label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_line_2 label' ).css( 'padding',to);
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_city label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_state label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_zip label' ).css( 'padding',to );
             $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .address_country label' ).css( 'padding',to );
         } );
  } );
//********************************* Field Descriptions *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[field-descriptions][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[field-descriptions][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-descriptions][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'display','block' );
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'text-align',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[field-descriptions][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[field-descriptions][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .gfield_description' ).css( 'padding',to);
         } );
  } );

//********************************* Text Fields *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'background',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][margin]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][padding]', function( value ) {
    value.bind( function( to ) {
    to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield input[type=text]' ).css( 'padding',to);
         } );
  } );

//********************************* Paragraph Textarea Fields *******************************************
  wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'font-size',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'background',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[text-fields][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'border-radius',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[paragraph-textarea][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'width',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[paragraph-textarea][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[paragraph-textarea][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield textarea' ).css( 'padding',to);
         } );
  } );

//********************************* List Field Table*******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-table][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list' ).css( 'background-color',to );
         } );
  } );

  //********************************* List Field Heading*******************************************

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-heading][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list thead th' ).css( 'font-size',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-heading][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list thead th' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-heading][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list thead th' ).css( 'background-color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-heading][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list thead th' ).css( 'text-align',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-heading][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list thead th' ).css( 'padding',to );
         } );
  } );

//********************************* List Field Cell*******************************************

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-cell][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'font-size',to );
         } );
  } );

      wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-cell][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'color',to );
         } );
  } );

     wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-cell][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'background-color',to );
         } );
  } );

     wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-cell][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list tbody tr td.gfield_list_cell input' ).css( 'text-align',to );
         } );
  } );

  //********************************* List Field Cell Container*******************************************

   wp.customize( 'gf_stla_form_id_'+urlParams+'[list-field-cell-container][padding]', function( value ) {
    value.bind( function( to ) {
     to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gfield .ginput_list table.gfield_list tbody tr td.gfield_list_cell' ).css( 'padding',to );
         } );
  } );

//********************************* Submit Button *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][button-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'background',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'background',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'background',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'background',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'background',to );
         } );
  } );

  // wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][hover-color]', function( value ) {
  //   value.bind( function( to ) {
  //           $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]:hover' ).css( 'background',to );
  //           $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button:hover' ).css( 'background',to );
  //        } );
  // } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][height]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'height',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'height',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'height',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'height',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'height',to );

         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][button-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_footer' ).css( 'text-align',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'float',to );
             $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'text-align',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'font-size',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'font-size',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'font-size',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'font-size',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'font-size',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'border-width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'border-width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'border-width',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'border-style',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-style',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'border-style',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'border-style',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'border-color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'border-color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'border-color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'border-radius',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'border-radius',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'border-radius',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'border-radius',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'color',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'margin',to );
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'margin',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'margin',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'margin',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[submit-button][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer input[type=submit]' ).css( 'padding',to);
            $( '#gform_wrapper_'+urlParams+' .gform_footer button.mdl-button' ).css( 'padding',to);
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_previous_button' ).css( 'padding',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer .gform_next_button' ).css( 'padding',to );
            $( '#gform_wrapper_'+urlParams+' .gform_page_footer input[type=submit]' ).css( 'padding',to );
         } );
  } );

//********************************* Section Break Title *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-title][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_title' ).css( 'color',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-title][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_title' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-title][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_title' ).css( 'text-align',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-title][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_title' ).css( 'background-color',to );
         } );
  } );


//********************************* Section Break Description *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_description' ).css( 'color',to );
         } );
  } );

  wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_description' ).css( 'background-color',to );
         } );
 } );
  
   wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_description' ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_description' ).css( 'text-align',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][margin]', function( value ) {
    value.bind( function( to ) {
    to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection .gsection_description' ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[section-break-description][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .gform_body .gform_fields .gsection' ).css( 'padding',to);
         } );
  } );

//********************************* Confirmation Message *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gforms_confirmation_message_'+urlParams ).css( 'color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gforms_confirmation_message_'+urlParams ).css( 'text-align',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gforms_confirmation_message_'+urlParams ).css( 'background',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gforms_confirmation_message_'+urlParams ).css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gforms_confirmation_message_'+urlParams ).css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[confirmation-message][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gforms_confirmation_message_'+urlParams ).css( 'padding',to);
         } );
  } );

//********************************* error Message *******************************************


  wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][font-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][text-align]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'text-align',to );
         } );
  } );

   wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][font-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'font-size',to );
         } );
  } );


wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][max-width]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][background-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'background',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][border-size]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'border-width',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][border-type]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'border-style',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][border-color]', function( value ) {
    value.bind( function( to ) {
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'border-color',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][border-radius]', function( value ) {
    value.bind( function( to ) {
      to = addPxToValue(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'border-radius',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][margin]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'margin',to );
         } );
  } );

wp.customize( 'gf_stla_form_id_'+urlParams+'[error-message][padding]', function( value ) {
    value.bind( function( to ) {
      to = addPxToMarginPadding(to);
            $( '#gform_wrapper_'+urlParams+' .validation_error').css( 'padding',to);
         } );
  } );



} );

