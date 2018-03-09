jQuery(document).ready(function($){
    
    var base_url = window.location.origin;
    
    if( typeof(ajax_object.ajaxurl) === undefined || ajax_object.ajaxurl === '' || typeof(ajax_object.ajaxurl) === 'undefined' ){
        ajax_object.ajaxurl = base_url+'/wp-admin/admin-ajax.php';
    }
    
    $('body').on('click', '.el-load-more', function(){
        
        var elem    = $(this);
        var blog    = elem.parents('.el-dbe-blog-extra');
        var load    = elem.attr('data-load');
        var total   = elem.attr('data-total');
        var color   = elem.css('color');
        var params  = {};
        
        elem.remove();
        
        blog.find('.ajax-pagination').append('<span class="el-loader" style="color: '+color+';">Loading...</span>');
        
        blog.next('.el-blog-params').find('input').each(function(){
            $.each(this.attributes, function(i,element) {
                if( $(this).val() !== 'hidden' ){
                    params[element.name] = $(this).val();
                }
            });
        });
        
        $.ajax({
			type: "POST",
			url: ajax_object.ajaxurl,
			data: {
				action: 'el_load_posts',
				security: ajax_object.ajax_nonce,
				page: load,
				total_pages: total,
				parameters: params,
			},
			success: function (response) {
			    setTimeout(function(){
                    blog.find('.el-loader').fadeOut('1500');
			        blog.find('.ajax-pagination').remove();
			        blog.append(response);
			    },1500);
			},
			error: function () {
			  alert('Oops!! Something went wrong!! Try later!');
			}
		});
		
    });
    
    $('body').on('click', '.el-show-less', function(){
        
        var elem                = $(this);
        var blog                = elem.parents('.el-dbe-blog-extra');
        var num                 = parseInt(elem.attr('data-num'));
        var total               = parseInt(elem.attr('data-total'));
        var load_more_text      = elem.attr('data-load-more-text');
        var color               = elem.css('color');
        var icon                = elem.attr('data-icon');
        var custom_class        = ''
        var data_icon           = '';
        if( typeof(icon) != 'undefined' && icon != '' ){
            custom_class    = ' et_pb_custom_button_icon';
            data_icon       = ' data-icon="'+icon+'"';
        }
        
        elem.remove();
        
        blog.find('.ajax-pagination').append('<span class="el-loader" style="color: '+color+';">Loading...</span>');
        
        setTimeout(function(){
            blog.find('.el-loader').fadeOut('200');
            setTimeout(function(){ 
                blog.find('.et_pb_post_extra:not(:lt('+(num)+'))').fadeOut('400');
                blog.find('.el-loader').remove();
                blog.find('.ajax-pagination').append('<a'+data_icon+' class="et_pb_button el-button el-load-more et-waypoint et_pb_animation_bottom et-animated'+custom_class+'" data-load="1" data-total="'+total+'">'+load_more_text+'</a>');
            },200);
            setTimeout(function(){                
                blog.find('.et_pb_post_extra:not(:lt('+(num)+'))').remove();
            },600);
        },1500);
        
    });
    
    $('body .el-dbe-blog-extra .post-categories a').each( function(){
        $(this).on('mouseenter', function(){
            var color   = $(this).attr('data-hover-color');
            var bgcolor = $(this).attr('data-hover-bgcolor');
            if( typeof(color) !== undefined ){
                $(this).css('color', color);
            }
            if( typeof(bgcolor) !== undefined ){
                $(this).css('background-color', bgcolor);
                if( $(this).parents('.et_pb_post_extra').hasClass('el_dbe_block_extended') ){
                    $(this).css('border-color', bgcolor);   
                }
            }
        });
        
        $(this).on('mouseout', function(){
            var color   = $(this).attr('data-color');
            var bgcolor = $(this).attr('data-bgcolor');
            if( typeof(color) !== undefined ){
                $(this).css('color', color);
            }
            if( typeof(bgcolor) !== undefined ){
                $(this).css('background-color', bgcolor);
                if( $(this).parents('.et_pb_post_extra').hasClass('el_dbe_block_extended') ){
                    $(this).css('border-color', bgcolor);   
                }
            }
        });
    });
    
});