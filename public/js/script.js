function reportAccordion() {
	new Fx.Accordion($$('h2'), $$('.assertion'));
	new Fx.Accordion($$('h4.toggle'), $$('ol.box'));
}

function layoutManager() {
	if(undefined != $('layerManager')) {
		var container = $('layerManager');
		container.setStyles({
			position : 'fixed',
			left : 0,
			top : 0,		
		});
	}
}

window.addEvent('domready', function() {
	reportAccordion();
	//layoutManager();
});