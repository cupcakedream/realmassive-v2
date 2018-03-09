( function( $ ) {

//hide all the selection fields if no form selected
$('body').on('click', '#accordion-panel-gf_stla_panel', function(){
	console.log( $('#customize-control-gf_stla_hidden_field_for_form_id').length );
if($('#customize-control-gf_stla_hidden_field_for_form_id').length){
	
    $('#accordion-section-gf_stla_form_id_material_design').hide();
    }

});
})(jQuery);

