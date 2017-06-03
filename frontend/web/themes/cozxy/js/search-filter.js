 $(document).ready(function() {
    $("#search-filter").bind("submit", function(event){
  		event.preventDefault();
  		$.ajax({
  			url: '/ajax/search',
  			data: $(this).getForm().serialize(),
  			success: function(data){$('#product-list').html(data)},
  			dataType: 'html'
  		});
  	});
 	$(".category-filter").toggle(function(){
  		if ($("#category-select option[value=" + $(this).data('value') + "]").filter(":selected").length > 0){
  			$("#category-select option[value=" + $(this).data('value') + "]").attr('selected', false);
  			$(this).removeClass("search-filter-selection");
  		}
  		else{
  			$("#category-select option[value=" + $(this).data('value') + "]").attr('selected', 'selected');
  			$(this).addClass("search-filter-selection");
  		}
  		$(this).getForm().submit()
  	}, function(){
  		if ($("#category-select option[value=" + $(this).data('value') + "]").filter(":selected").length > 0){
  			$("#category-select option[value=" + $(this).data('value') + "]").attr('selected', false);
  			$(this).removeClass("search-filter-selection");
  		}
  		else{
  			$("#category-select option[value=" + $(this).data('value') + "]").attr('selected', 'selected');
  			$(this).addClass("search-filter-selection");
  		}
  		$(this).getForm().submit()
  	});
  	
 	$(".brand-filter").toggle(function(){
  		if ($("#brand-select option[value=" + $(this).data('value') + "]").filter(":selected").length > 0){
  			$("#brand-select option[value=" + $(this).data('value') + "]").attr('selected', false);
  			$(this).removeClass("search-filter-selection");
  		}
  		else{
  			$("#brand-select option[value=" + $(this).data('value') + "]").attr('selected', 'selected');
  			$(this).addClass("search-filter-selection");
  		}
  		$(this).getForm().submit()
  	}, function(){
  		if ($("#brand-select option[value=" + $(this).data('value') + "]").filter(":selected").length > 0){
  			$("#brand-select option[value=" + $(this).data('value') + "]").attr('selected', false);
  			$(this).removeClass("search-filter-selection");
  		}
  		else{
  			$("#brand-select option[value=" + $(this).data('value') + "]").attr('selected', 'selected');
  			$(this).addClass("search-filter-selection");
  		}
  		$(this).getForm().submit()
  	});
  	
  	$(".size-option").bind("click", function(){
		if ($(this).hasClass('search-filter-selection'))
		{
			$('#size-select').val("");
		}
		else
		{
			var val = $(this).attr('id');
	  		$('#size-select').val(val);
	  		$('.size-option').removeClass('search-filter-selection');
		}
		$(this).toggleClass('search-filter-selection');
	  	$(this).getForm().submit()
  	});
  	
  	$(".price-option").bind("click", function(){
  		if ($(this).hasClass('search-filter-selection')){
  			 $('#price-min').val("");
  			 $('#price-max').val("");
  		}
		else{
			 $('#price-min').val($(this).data('min'));
  			 $('#price-max').val($(this).data('max'));
  			$('.price-option').removeClass('search-filter-selection');
		}
  		$(this).toggleClass('search-filter-selection');
  		$(this).getForm().submit()
  	});
  	
  	$(".color-option").bind("click", function(){
  		var val = $(this).data('value');
		if ($(this).hasClass('color-selected')){
			$('#color-select').val("");
		}
		else{
	  		$('#color-select').val(val);
	  		$('.color-square').removeClass('color-selected');			
		}
  		$(this).toggleClass('color-selected');
  		$(this).getForm().submit()
  	});  	
  });