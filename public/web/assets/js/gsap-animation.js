gsap.registerPlugin(ScrollTrigger, SplitText);
gsap.config({
    nullTargetWarn: false,
    trialWarn: false
});

ScrollTrigger.matchMedia({
    "(max-width: 1200px)": function() {
        ScrollTrigger.getAll().forEach(t => t.kill());
    }
});



jQuery(document).ready(function() {
tm_verticalscoll_style();

}); 

function tm_verticalscoll_style() {

gsap.registerPlugin(ScrollTrigger);

	ScrollTrigger.matchMedia({
		"(min-width: 1199px)": function() {
var panels = gsap.utils.toArray(".tm-staticbox-style1 .tm-stepbox-content");

panels.pop(); // get rid of the last one (don't need it in the loop)
panels.forEach((panel, i) => {
  
  
  const cards = gsap.utils.toArray(".tm-staticbox-style1 .tm-stepbox-content");
	const spacer = 70;

cards.forEach((card, index) => {
  ScrollTrigger.create({
    trigger: card,
    start: `top-=${index * spacer} top+=20%`,
    endTrigger: '.tm-staticbox-style1',
    end: `bottom top+=${200 + (cards.length * spacer)}`,
    pin: true,
    pinSpacing: false,        
    invalidateOnRefresh: true,
  });
});
  


    
});
},
		"(max-width:1199px)": function() {
			ScrollTrigger.getAll().forEach(cards => cards.kill(true));
		}
	});

}