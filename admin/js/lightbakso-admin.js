(function( $ ) {
	'use strict';


	var checkbox 	= $('#lightbakso_margin_checkbox');
	var input_first = $('.same_margin').first();

	checkbox.click(function(){

		var $this = $(this);

		var state = $this.prop("checked");
		var value = $('.same_margin').first().val();
		var same_margin = $('.same_margin:not(:first)');

		if(state === true){
			same_margin.each(function(index){
				$( this ).val(value);
			});
		}

	});

	input_first.on('blur',function(){

		var $this = $('#lightbakso_margin_checkbox');

		var state = $this.prop("checked");
		var value = $('.same_margin').first().val();
		var same_margin = $('.same_margin:not(:first)');

		if(state === true){
			same_margin.each(function(index){
				$( this ).val(value);
			});
		}

	});


	var checkbox2 	= $('#lightbakso_padding_checkbox');
	var input_first2 = $('.same_padding').first();

	checkbox2.click(function(){

		var $this = $(this);

		var state = $this.prop("checked");
		var value = $('.same_padding').first().val();
		var same_padding = $('.same_padding:not(:first)');

		if(state === true){
			same_padding.each(function(index){
				$( this ).val(value);
			});
		}

	});

	input_first2.on('blur',function(){

		var $this = $('#lightbakso_padding_checkbox');

		var state = $this.prop("checked");
		var value = $('.same_padding').first().val();
		var same_padding = $('.same_padding:not(:first)');

		if(state === true){
			same_padding.each(function(index){
				$( this ).val(value);
			});
		}

	});


})( jQuery );
