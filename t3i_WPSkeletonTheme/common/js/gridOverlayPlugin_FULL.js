/**
 * 
 */

function gridOvrlay() {
	
	var grid = [];
	var column ='<div class="GridOvlColumn"></div>';
	var ovrLay = '<div id="gridOverlay">';
	var onOffBtn = '<p id="gridBtnWrap">ovrLay:&nbsp;<input id="gridBtn" type="checkbox"></p>';
	
	jQuery('body').append(onOffBtn);
	
	for (i = 0; i < 16; i++) {
	   grid.push(column);
	}
	
	jQuery('body').append(ovrLay);
	jQuery('#wrap').append('<div id="ovrLayContainer">');
	//ovrLay.append(grid);
	jQuery('#ovrLayContainer').append(grid);
	
	jQuery('#gridBtnWrap').css({
	    'position': 'fixed',
	    'display': 'block',
	    'top': '20px',
	    'right':'20px',
	    //'z-index': '999999999',
	    'color':'green'});
	    
	jQuery('.GridOvlColumn').css({
	    'background-color': '#008000',
	    'display': 'block',
	    'height': '100%',
	    'width': '40px',
	    'margin-left': '10px',
	    'margin-right': '10px',
	    'float': 'left'});
	
	jQuery('#ovrLayContainer').css({
	    'height': '100%',
	    'position': 'fixed',
	    'top': '0',
	    'width': '100%',
	    'opacity': '0',
	    'z-index': '9999999'});   
	
	jQuery('#gridBtn').click(function() {
	    if ( !jQuery(this).is(':checked') )  {
	       jQuery('#ovrLayContainer').animate({'opacity':0}); 
	    }
	    if ( jQuery(this).is(':checked') )  {
	        jQuery('#ovrLayContainer').animate({'opacity':.3}); 
	    } 
	});
}

jQuery(function() {
	gridOvrlay();
});