<?php
/*
	Template Name: Main Template
	Description: Main Template
*/
?>


<?php get_header();
//do_action('skeleton_before_content');
//get_template_part( 'loop', 'page' );
//do_action('skeleton_after_content');
//get_sidebar('page');
?>



<style>
body {
	background: #000;

}

.box {
	height: 300px;
	background: blue;
}
#ovrLayContainer {
	z-index: -1;
}

</style>



	<?php the_content(); ?>

     <canvas id="testCanvas" width="800" height="800"></canvas>

<script>


var stage;

function handleAnimation() {

//find canvas and load images, wait for last image to load
var canvas = document.getElementById("testCanvas");

// create a new stage and point it at our canvas:
stage = new createjs.Stage(canvas);

//a.1
a1_group = new createjs.Container();
a1_maskParent = new createjs.Container();

a1_mask = new createjs.Shape();
a1_mask.graphics.f("red").p("ADwTYIjwAAILGzYILQTYIvAAAIB4jSIHgAAIlopsInWM+").cp();
a1_mask.x = 0;
a1_mask.y = 0;
a1_mask.alpha = .3;
a1_mask.cache(0, 0, 200, 200);
a1_maskParent.addChild(a1_mask);

a1_1 = new createjs.Shape();
a1_1.graphics.f("rgba(96,255,0,254)").p("ALGAAIrGTYIDwAAIHWs+IAAma").cp().ef();
a1_1.x = -70;
a1_1.y = 125;
a1_1.cache(0, 0, 80, 135);
a1_group.addChild(a1_1);

a1_2 = new createjs.Shape();
a1_2.graphics.f("rgba(96,255,0,254)").p("AQuQGIlopsIAAmaILQTYIlojS").cp().ef();
a1_2.x = -72;
a1_2.y = -122;

a1_2.cache(0, 0, 144, 135);
a1_group.addChild(a1_2);

a1_3 = new createjs.Shape();
a1_3.graphics.f("rgba(96,255,0,254)").p("AWWTYIvAAAIB4jSIHgAAIFoDS").cp();
a1_3.x = 100;
a1_3.y = 0;
a1_3.cache(0, 0, 150, 150);
a1_group.addChild(a1_3);

//define mask
a1_group.mask = a1_mask;
//add shape group to stage
stage.addChild(a1_group);
//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(a1_maskParent);

// END a.1


//l.1
l1_group = new createjs.Container();
l1_maskParent = new createjs.Container();

l1_mask = new createjs.Shape();
l1_mask.graphics.f("rgba(96,255,0,254)").p("AHCIIIJOQaIDwAAIpYwaIjmAA").cp().ef();
l1_mask.x = 55;
l1_mask.y = -34;
l1_mask.alpha = .3;
l1_mask.cache(0, 0, 150, 200);
l1_maskParent.addChild(l1_mask);

l1 = new createjs.Shape();
l1.graphics.f("rgba(96,255,0,254)").p("AHCIIIJOQaIDwAAIpYwaIjmAA").cp().ef();
l1.x = 55;
l1.y = -34;
l1.cache(0, 0, 150, 200);
l1_group.addChild(l1);

l1_group.mask = l1_mask;
stage.addChild(l1_group);
//END l.1

//e.1
e1_group = new createjs.Container();
e1_maskParent = new createjs.Container();

e1_mask = new createjs.Shape();
e1_mask.graphics.f("rgba(96,255,0,254)").p("AMWF8Ii+FKIhki0IEsoIIjIAAIleAAIj6AAIJYQaIGGqoIjIAA").cp().p("AEiC0IDSAAIhkC0Ihui0").cp().ef();
//e1_mask.alpha = .5;
e1_mask.cache(0, 0, 200, 200);
//e1_maskParent.addChild(e1_mask);

e1_1 = new createjs.Shape();
e1_1.graphics.f("rgba(96,255,0,254)").p("AMWF8Ii+FKIAAAAIAAFUIAAAKIGGqoIjIAA").cp().ef();
e1_1.x = 40;
e1_1.y = -72;
e1_1.cache(0, 0, 100, 110);
//el_1.alpha = 1;
e1_group.addChild(e1_1);

e1_2 = new createjs.Shape();
e1_2.graphics.f("rgba(96,255,0,254)").p("AEiC0IAAgKIkiiqIJYQaIAAlUIk2oS").cp().ef();
e1_2.x = 60;
e1_2.y = 105;
e1_2.cache(0, 0, 144, 135);
e1_group.addChild(e1_2);

e1_3 = new createjs.Shape();
e1_3.graphics.f("rgba(96,255,0,254)").p("AJYAKIleAAIj6AAIEiCqIDcAAIEsiqIjSAA").cp().ef();
e1_3.x = -82;
e1_3.y = 0;
e1_3.cache(0, 0, 150, 150);
e1_group.addChild(e1_3);

e1_4 = new createjs.Shape();
e1_4.graphics.f("rgba(96,255,0,254)").p("AJiAKIjSFoIAAFUIGQq8Ii+AA").cp().ef();
e1_4.x = 40;
e1_4.y = -70;
e1_4.cache(0, 0, 150, 150);
e1_group.addChild(e1_4);

e1_mask.x = e1_group.x = 150;
e1_mask.y = e1_group.y = 40;

//define mask
e1_group.mask = e1_mask;
//e1_group.x = 0;
//add shape group to stage
stage.addChild(e1_group);

//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(e1_maskParent);

// END e1


// x.1
x1_group = new createjs.Container();
x1_maskParent = new createjs.Container();

x1_mask = new createjs.Shape();
x1_mask.graphics.f("rgba(96,255,0,254)").p("AMgEYICqkYIjwAAIjmGGIAAAAIAAAKIhkigIjmAAIDSFyIl8KeIDmAAIEOnWICMD6IDmAAIj6nCIC0lK").cp().ef();
x1_mask.x = 0;
x1_mask.y = 0;
x1_mask.alpha = .5;
x1_mask.cache(0, 0, 200, 200);
x1_maskParent.addChild(x1_mask);


x1_1 = new createjs.Shape();
x1_1.graphics.f("rgba(96,255,0,254)").p("AGQDmIjmAAIHWM0IDmAAInWs0").cp().ef();
x1_1.x = -48;
x1_1.y = -84;
x1_1.cache(0, 0, 100, 110);
x1_group.addChild(x1_1);

x1_2 = new createjs.Shape();
x1_2.graphics.f("rgba(96,255,0,254)").p("APKAAIjwAAIjmGGIAAAAIn0N6IDmAAII6voICqkY").cp().ef();
x1_2.x = -75;
x1_2.y = 130;
x1_2.cache(0, 0, 100, 140);
x1_group.addChild(x1_2);

x1_mask.x = x1_group.x = 230;
x1_mask.y = x1_group.y = 18;

//define mask
x1_group.mask = x1_mask;

//add shape group to stage
stage.addChild(x1_group);

//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(x1_maskParent);

// END x1








//a.2
a2_group1 = new createjs.Container();
a2_group2 = new createjs.Container();
a2_maskParent1 = new createjs.Container();
a2_maskParent2 = new createjs.Container();

a2_mask1 = new createjs.Shape();
a2_mask1.graphics.f("rgba(86,251,164,254)").p("ALGGQIAAAAIAAmGIrGTOIGQAAIBujIIiqAAIFyqA").cp().ef();

a2_mask1.x = 0;
a2_mask1.y = 0;
//a2_mask1.alpha = .3;
a2_mask1.cache(0, 0, 800, 200);
a2_maskParent1.addChild(a2_mask1);

a2_mask2 = new createjs.Shape();
a2_mask2.graphics.f("rgba(86,251,164,254)").p("ABGGQIFyKAIlKAAIhuDIIMWAAIrQzYIAAAAIAAGQ").ef();
a2_mask2.x = 0;
a2_mask2.y = 0;
a2_mask2.alpha = .3;
a2_mask2.cache(0, 0, 800, 200);
a2_maskParent2.addChild(a2_mask2);

a2_1 = new createjs.Shape();
a2_1.graphics.f("rgba(96,255,0,254)").p("AFUQQIlUDIIAAAAIAAAAIGQAAIB4jIIi0AAIAAAA").cp().ef();

a2_1.x = 42;
a2_1.y = 0;
a2_1.cache(0, 0, 80, 135);
a2_group1.addChild(a2_1);

a2_2 = new createjs.Shape();
a2_2.graphics.f("rgba(96,255,0,254)").p("ALGGQIAAmQIrGTYIAAAAIFUjI").ef();
a2_2.x = -72;
a2_2.y = 125;
a2_2.cache(0, 0, 144, 135);
a2_group1.addChild(a2_2);

a2_3 = new createjs.Shape();
a2_3.graphics.f("rgba(96,255,0,254)").p("ALGGQIFyKAIFUC+IrGzOIAAAKIAAGGIAAAA").cp().ef();
a2_3.x = -68;
a2_3.y = -122;
//a2_3.alpha = .3;
a2_3.cache(0, 0, 150, 160);
a2_group2.addChild(a2_3);

a2_4 = new createjs.Shape();
a2_4.graphics.f("rgba(96,255,0,254)").p("ALuQQIhuDIIMWAAIlejI").ef();

a2_4.x = 80;
a2_4.y = 0;
a2_4.cache(0, 0, 150, 150);
a2_group2.addChild(a2_4);

a2_mask1.x = 304;
a2_group1.x = 304;
a2_mask1.y = a2_group1.y = 0;
a2_mask2.x = 368;
a2_group2.x = 304;
a2_mask2.y = a2_group2.y = 0;
//define mask
a2_group1.mask = a2_mask1;
a2_group2.mask = a2_mask2;
//add shape group to stage
stage.addChild(a2_group1);
stage.addChild(a2_group2);
//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(a2_maskParent1);
//stage.addChild(a2_maskParent2);

//END a.2



//l.2
l2_group = new createjs.Container();
l2_maskParent = new createjs.Container();

l2_mask = new createjs.Shape();
l2_mask.graphics.f("rgba(96,255,0,254)").p("AHCIIIJOQaIDwAAIpYwaIjmAA").cp().ef();
l2_mask.x = 0;
l2_mask.y = 0;
l2_mask.alpha = .3;
l2_mask.cache(0, 0, 150, 200);
l2_maskParent.addChild(l2_mask);

l2 = new createjs.Shape();
l2.graphics.f("rgba(96,255,0,254)").p("AHCIIIJOQaIDwAAIpYwaIjmAA").cp().ef();
l2.x = -60;
l2.y = -110;
l2.cache(0, 0, 150, 200);
l2_group.addChild(l2);

l2_mask.x = l2_group.x = 352;
l2_mask.y = l2_group.y = -34;

l2_group.mask = l2_mask;
stage.addChild(l2_group);
//stage.addChild(l2_maskParent);
//END l.2





//a.2
o1_group = new createjs.Container();
o1_maskParent = new createjs.Container();

o1_mask = new createjs.Shape();
o1_mask.graphics.f("red").p("AAABaIJiQaIJiwaIiqAAIwaAA").cp().p("AOOEYIksIIIk2oSIJsAAIgKAKIAAAA").cp().ef();
o1_mask.x = 0;
o1_mask.y = -18;
o1_mask.alpha = .3;
o1_mask.cache(0, 0, 800, 200);
o1_maskParent.addChild(o1_mask);

o1_1 = new createjs.Shape();
o1_1.graphics.f("rgba(96,255,0,254)").p("ADIBaIH+NwIhkCqIpiwaIDIAA").cp().ef();
o1_1.x = -62;
o1_1.y = -105;
o1_1.cache(0, 0, 150, 150);
o1_group.addChild(o1_1);

o1_2 = new createjs.Shape();
o1_2.graphics.f("rgba(96,255,0,254)").p("AH+PAIBkC0IJiwaIAAAAIi+AAIoINm").cp().ef();

o1_2.x = -62;
o1_2.y = 108;
o1_2.cache(0, 0, 150, 150);
o1_group.addChild(o1_2);

o1_3 = new createjs.Shape();
o1_3.graphics.f("rgba(96,255,0,254)").p("ARWEOIBki0IAAAAIigAAIwaAAIBuC0IPoAA").cp().ef();

o1_3.x = 122;
o1_3.y = 0;
o1_3.cache(0, 0, 150, 150);
o1_group.addChild(o1_3);

o1_mask.x = o1_group.x = 442;
o1_mask.y = o1_group.y = 31;

//define mask
o1_group.mask = o1_mask;
//add shape group to stage
stage.addChild(o1_group);
//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(o1_maskParent);

//END o1





//i.2
i1_group = new createjs.Container();
i1_maskParent = new createjs.Container();

i1_mask = new createjs.Shape();
i1_mask.graphics.f("rgba(96,255,0,254)").p("AHWDmInWM+IDwAAIHWs+IjwAA").cp().ef().f("rgba(96,255,0,254)").p("AJYAAIg8BuIDwAAIA8huIjwAA").cp().ef();
i1_mask.x = 0;
i1_mask.y = 0;
i1_mask.alpha = .3;
i1_mask.cache(0, 0, 150, 200);
i1_maskParent.addChild(i1_mask);

i1 = new createjs.Shape();
i1.graphics.f("rgba(96,255,0,254)").p("AHWDmInWM+IDwAAIHWs+IjwAA").cp().ef().f("rgba(96,255,0,254)").p("AJYAAIg8BuIDwAAIA8huIjwAA").cp().ef();
i1.x = -62;
i1.y = 110;
i1.cache(0, 0, 150, 200);
i1_group.addChild(i1);

i1_mask.x = i1_group.x = 525;
i1_mask.y = i1_group.y = 17;

i1_group.mask = i1_mask;
stage.addChild(i1_group);
//stage.addChild(i1_maskParent);
//END i.1




//a.3
a3_group1 = new createjs.Container();
a3_maskParent1 = new createjs.Container();
a3_group2 = new createjs.Container();
a3_maskParent2 = new createjs.Container();

a3_mask1 = new createjs.Shape();
a3_mask1.graphics.f("red").p("AWWTYIvAAAIB4jSIHgAAIFoDS").cp();
a3_mask1.x = -1;
a3_mask1.y = 0;
a3_mask1.alpha = .3;
a3_mask1.cache(0, 0, 800, 200);
a3_maskParent1.addChild(a3_mask1);

a3_mask2 = new createjs.Shape();
a3_mask2.graphics.f("red").p("ADwTYIjwAAILGzYILQTYIvAAAIB4jSIHgAAIlopsInWM+").cp();
a3_mask2.x = 0;
a3_mask2.y = -0;
a3_mask2.alpha = .3;
a3_mask2.cache(0, 0, 800, 200);
a3_maskParent2.addChild(a3_mask2);

a3_3 = new createjs.Shape();
a3_3.graphics.f("rgba(96,255,0,254)").p("AWWTYIvAAAIB4jSIHgAAIFoDS").cp();
a3_3.x = -95;
a3_3.y = 0;
a3_3.cache(0, 0, 150, 150);
a3_group1.addChild(a3_3);

a3_2 = new createjs.Shape();
a3_2.graphics.f("rgba(96,255,0,254)").p("AQuQGIlopsIAAmaILQTYIlojS").cp().ef();
a3_2.x = 73;
a3_2.y = 126;
a3_2.cache(0, 0, 144, 135);
a3_group2.addChild(a3_2);

a3_1 = new createjs.Shape();
a3_1.graphics.f("rgba(96,255,0,254)").p("ALGAAIrGTYIDwAAIHWs+IAAma").cp().ef();
a3_1.x = 72;
a3_1.y = -124;
a3_1.cache(0, 0, 80, 135);
a3_group2.addChild(a3_1);

a3_mask1.x = a3_group1.x = 700;
a3_mask1.y = a3_group1.y = 0;
a3_mask2.x = a3_group2.x = 700;
a3_mask2.y = a3_group2.y = 0;
a3_mask1.scaleX = a3_group1.scaleX = -1;
a3_mask2.scaleX = a3_group2.scaleX = -1;


//a3_mask.scaleY = a3_group.scaleY = 0.85;
//a3_group.scaleX = -1;

//define mask
a3_group1.mask = a3_mask1;
a3_group2.mask = a3_mask2;
//add shape group to stage
stage.addChild(a3_group1);
stage.addChild(a3_group2);
//cant add/render the mask to stage if you want it to work (comment out)
//stage.addChild(a3_maskParent1);
//stage.addChild(a3_maskParent2);

// END a.3



createjs.Ticker.addEventListener("tick", tick);
  animationTL();
}


function animationTL() {
	// create main timeline
	var logo_TL = new TimelineLite();
	logo_TL.pause();

	// a1 timeline
	var a1_TL = new TimelineLite();
	// a1 tweens
	a1_TL.add( TweenLite.from(a1_1, 0.5, {alpha:0, ease:Power2.easeIn}), 0);
	a1_TL.add( TweenLite.to(a1_1, 0.5, {x:0, y:0, ease:Power1.easeIn}), 0);
	a1_TL.add( TweenLite.to(a1_2, 0.5, {x:0, y:0}), 0.5);
	a1_TL.add( TweenLite.to(a1_3, 0.5, {x:1, y:0}), 1);

	// l1 timeline
	var l1_TL = new TimelineLite();
	// l1 tweens
	l1_TL.add( TweenLite.from(l1, 0.5, {alpha:0, ease:Power2.easeIn}), 0);
	l1_TL.add( TweenLite.from(l1, 0.6, {x:-4, y:-140, ease:Power1.easeIn}), 0);

	// e1 timeline
	var e1_TL = new TimelineLite();
	// e1 tweens
	e1_TL.add( TweenLite.from(e1_1, 0.4, {alpha:0, ease:Power2.easeIn}), 0);
	e1_TL.add( TweenLite.to(e1_1, .4, {x:0, y:0, ease:Power1.easeIn}), 0);

//	e1_TL.add( TweenLite.from(e1_2, 0.4, {alpha:0, ease:Power2.easeIn}), 0);
	e1_TL.add( TweenLite.to(e1_2, .5, {x:0, y:0}), 0.4);
	e1_TL.add( TweenLite.to(e1_3, .4, {x:0, y:0}), 0.7);
	e1_TL.add( TweenLite.to(e1_4, .4, {x:0, y:0}), 1.1);

	// x1 timeline
	var x1_TL = new TimelineLite();
	// x1 tweens
	x1_TL.add( TweenLite.from(x1_2, 0.5, {alpha:0, ease:Power2.easeIn}), 0);
	x1_TL.add( TweenLite.to(x1_2, 0.6, {x:0, y:0, ease:Power1.easeIn}), 0);

	x1_TL.add( TweenLite.from(x1_1, 0.5, {alpha:0, ease:Power2.easeIn}), 0);
	x1_TL.add( TweenLite.to(x1_1, 0.6, {x:0, y:1, ease:Power1.easeIn}), 0.4);

	// a2 timeline
	var a2_TL = new TimelineLite();
	// a2 tweens
	a2_TL.add( TweenLite.from(a2_1, 0.3, {alpha:0, ease:Power2.easeIn}), 0);
	a2_TL.add( TweenLite.to(a2_1, 0.3, {x:-1, y:0}), 0);
	a2_TL.add( TweenLite.to(a2_2, 0.5, {x:0, y:0}), 0.3);
	a2_TL.add( TweenLite.to(a2_3, 0.5, {x:0, y:0}), 0.8);
	a2_TL.add( TweenLite.to(a2_4, 0.5, {x:2, y:0}), 1.5);

	// l2 timeline
	var l2_TL = new TimelineLite();
	// l2 tweens
	l2_TL.add( TweenLite.from(l2, 0.3, {alpha:0, ease:Power2.easeIn}));
	l2_TL.insert( TweenLite.to(l2, 0.5, {x:0, y:0}));
	logo_TL.insert(l2_TL);

	// o1 timeline
	var o1_TL = new TimelineLite();
	// o1 tweens
	o1_TL.add( TweenLite.to(o1_1, 0.4, {x:0, y:0}), 0);
	o1_TL.add( TweenLite.to(o1_2, 0.5, {x:0, y:0}), .5);
	o1_TL.add( TweenLite.to(o1_3, 0.5, {x:0, y:0}), 1);

	// i1 timeline
	var i1_TL = new TimelineLite();
	// i1 tweens
	i1_TL.add( TweenLite.from(i1, 0.3, {alpha:0, ease:Power2.easeIn}), 0);
	i1_TL.insert( TweenLite.to(i1, 0.5, {x:0, y:0}));

	// a3 timeline
	var a3_TL = new TimelineLite();
	// a3 tweens
	a3_TL.add( TweenLite.from(a3_3, 0.5, {alpha:0, ease:Power2.easeIn}), 0);
	a3_TL.add( TweenLite.to(a3_3, 0.5, {x:0, y:0}), 0);
	a3_TL.add( TweenLite.to(a3_2, 0.5, {x:0, y:1}), .5);
	a3_TL.add( TweenLite.to(a3_1, 0.5, {x:0, y:0}), 1);

	// play MAIN timeline
	logo_TL.insert([a1_TL], 0);
	logo_TL.insert([l1_TL], 1);
	logo_TL.insert([e1_TL], 2);
	logo_TL.insert([x1_TL], 3);
	logo_TL.insert([a2_TL], 4);
	logo_TL.insert([l2_TL], 5);
	logo_TL.insert([o1_TL], 6);
	logo_TL.insert([i1_TL], 7);
	logo_TL.insert([a3_TL], 8);

	logo_TL.play();

}

function tick(event) {
		stage.update(event);
	    //container.update(event);
	    //e1.updateCache();
}




window.onload = function() {
	  handleAnimation();
}





/* (function() {
	var canvas = this.__canvas = new fabric.StaticCanvas('c');

	  canvas.add(
	    new fabric.Rect({ top: 100, left: 100, width: 50, height: 50, fill: '#f55' }),
	    new fabric.Circle({ top: 140, left: 230, radius: 75, fill: 'green' }),
	    new fabric.Triangle({ top: 300, left: 210, width: 100, height: 100, fill: 'blue' })
	  );

	  function animate() {
	    canvas.item(3).animate('top', canvas.item(0).getTop() === 500 ? '100' : '500', {
	      duration: 1000,
	      onChange: canvas.renderAll.bind(canvas),
	      onComplete: animate
	    });
	  }
	  animate();
	})(); */


</script>



<? //php get_footer(); ?>