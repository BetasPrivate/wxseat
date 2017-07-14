(function(doc, win) {
	var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function() {
			var clientWidth = docEl.clientWidth;
			if (!clientWidth) return;
			if (clientWidth >= 750) {
				clientWidth = 750;
			} else if (clientWidth <= 320) {
				clientWidth = 320;
			} else {}
			docEl.style.fontSize = 20 * (clientWidth / 375) + 'px';
			$(".seat").height($("#home").height());
		};
	if (!doc.addEventListener) return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);