/**
 * function gridOvrlay(){var a=[];jQuery("body").append('<p id="gridBtnWrap">ovrLay:&nbsp;<input id="gridBtn" type="checkbox"></p>');for(i=0;16>i;i++)a.push('<div class="GridOvlColumn"></div>');jQuery("body").append('<div id="gridOverlay">');jQuery("#wrap").append('<div id="ovrLayContainer">');jQuery("#ovrLayContainer").append(a);jQuery("#gridBtnWrap").css({position:"fixed",display:"block",top:"20px",right:"20px","z-index":"999999999",color:"green"});jQuery(".GridOvlColumn").css({"background-color":"#008000", display:"block",height:"100%",width:"40px","margin-left":"10px","margin-right":"10px","float":"left"});jQuery("#ovrLayContainer").css({height:"100%",position:"fixed",top:"0",width:"100%",opacity:"0","z-index":"9999999"});jQuery("#gridBtn").click(function(){jQuery(this).is(":checked")||jQuery("#ovrLayContainer").animate({opacity:0});jQuery(this).is(":checked")&&jQuery("#ovrLayContainer").animate({opacity:0.3})})}jQuery(function(){gridOvrlay()});
 */

function gridOvrlay() {

	var grid = [];
	var column ='<div class="one column GridOvlColumn"></div>';
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
	    'z-index': '999999999',
	    'color':'green'});

	jQuery('.GridOvlColumn').css({
	    'background-color': '#008000',
	    'display': 'block',
	    'height': '100%',
	    //'width': '40px',
	    //'margin-left': '10px',
	    //'margin-right': '10px',
	    'float': 'left'});

	jQuery('#ovrLayContainer').css({
	    'height': '100%',
	    'position': 'absolute',
	    'top': '0',
	    'width': '100%',
	    //'opacity': '0',
	    'z-index': '-999999'});

	jQuery('#gridBtn').click(function() {
	    if ( !jQuery(this).is(':checked') )  {
			jQuery('#ovrLayContainer').animate({'opacity':0});
			jQuery('#ovrLayContainer').css('z-index',-9999999999);

	    }
	    if ( jQuery(this).is(':checked') )  {
	    	jQuery('#ovrLayContainer').css('z-index',9999999999);
	        jQuery('#ovrLayContainer').animate({'opacity':.3});
	    }
	});
}

jQuery(function() {
	gridOvrlay();
});