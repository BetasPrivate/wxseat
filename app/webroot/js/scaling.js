$(document).ready(function(){
	
setTimeout(function(){
	$(".seat").height($(".home").innerHeight());
	var reqAnimationFrame = (function () {
        return window[Hammer.prefixed(window, 'requestAnimationFrame')] || function (callback) {
            window.setTimeout(callback, 1000/60);
        };
    })();
	var el = document.getElementById("home");
	var ma = document.getElementById("seat");
    var START_X = Math.round((ma.offsetWidth - el.offsetWidth) / 2);
    var START_Y = Math.round((ma.offsetHeight - el.offsetHeight) / 2);
    var ticking = false;
    var transform;
    var timer;
    var mc = new Hammer.Manager(el);
    mc.add(new Hammer.Pan({ threshold: 0, pointers: 0 }));
    mc.add(new Hammer.Swipe()).recognizeWith(mc.get('pan'));
    mc.add(new Hammer.Rotate({ threshold: 0 })).recognizeWith(mc.get('pan'));
    mc.add(new Hammer.Pinch({ threshold: 0 })).recognizeWith([mc.get('pan'), mc.get('rotate')]);
    mc.add(new Hammer.Tap({ event: 'doubletap', taps: 2 }));
    mc.add(new Hammer.Tap());
    mc.on("panstart panmove", onPan);
    mc.on("pinchstart pinchmove", onPinch);
    function resetElement() {
        el.className = 'animate';
        transform = {
            translate: { x: START_X, y: START_Y },
            scale: 1,
            angle: 0,
            rx: 0,
            ry: 0,
            rz: 0
        };

        requestElementUpdate();
    }
    function updateElementTransform() {

        var value = [

                    'translate3d(' + transform.translate.x + 'px, ' + transform.translate.y + 'px, 0)',

                    'scale(' + transform.scale + ', ' + transform.scale + ')',

                    'rotate3d('+ transform.rx +','+ transform.ry +','+ transform.rz +','+  transform.angle + 'deg)'

        ];



        value = value.join(" ");

        el.style.webkitTransform = value;

        el.style.mozTransform = value;

        el.style.transform = value;

        ticking = false;
        

    }	
    function requestElementUpdate() {	
        if(!ticking) {

            reqAnimationFrame(updateElementTransform);

            ticking = true;	
        }

    }
    function logEvent(str) {

        //log.insertBefore(document.createTextNode(str +"\n"), log.firstChild);

    }
	var tx=0;//最初偏移量x
	var ty=0;//最初偏移量y
    function onPan(ev) {
		if(initScale==1){
			return;
		}
						
		var START_X_1 = Math.round((ma.offsetWidth - el.offsetWidth*2) / 2);
		var START_Y_1 = Math.round((ma.offsetHeight - el.offsetHeight*2) / 2);
		var x=START_X_1;
		var y=START_Y_1;
		tx=tx+ev.deltaX;
		ty=ty+ev.deltaY;
		if(tx<x){
			tx=x;
		}
		if(tx>-x){
			tx=-x;
		}
		if(ty<y){
			ty=y;
		}
		if(ty>-y){
			ty=-y;
		}
        transform.translate = {
            x: tx,
            y: ty
        };
		if(initScale!=2){
			transform.translate = {
            x: START_X,
            y: START_Y
        }
			return;
		}
        requestElementUpdate();
        logEvent(ev.type);
    }   
	var initScale = 1;
    function onPinch(ev) {
        if(ev.type == 'pinchstart') {
            initScale = transform.scale || 1;
        }
        el.className = '';
        var sca=initScale * ev.scale;
        if(sca<=1){
        	sca=1;
        	initScale = 1;
        	transform.translate = {
            x: START_X,
            y: START_Y
        }
        }
        if(sca<=2&&sca>1){
        	sca=2;
        }
        if(sca>2){
        	sca=2;
        }
		transform.scale = sca;
		initScale = sca;
        requestElementUpdate();
        logEvent(ev.type);
    }
    resetElement();
},200);

})

