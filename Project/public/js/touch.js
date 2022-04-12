// this function handles scaling features for touch screen devices
// default behaviour is overridden to provide font scaling rather than
// screen scaling on main div element.
function prepareDoc() {
	// Older browser compatibility / error prevention, if the browser 
	// does not support getting the current computed style create 
	// a method which performs the same function as newer browsers
	if (!window.getComputedStyle) {
		window.getComputedStyle = function(myElement, parTwo) {
			this.myElement = myElement;
			this.getPropertyValue = function(theProperty) {
				let re = /(\-([a-z]){1})/g;
				if (theProperty == 'float') theProperty = 'styleFloat';
				if (re.test(theProperty)) {
					theProperty = theProperty.replace(re, function () {
						return arguments[2].toUpperCase();
					});
				}
				return myElement.currentStyle[theProperty] ? myElement.currentStyle[theProperty] : null;
			}
			return this;
		}
	}
	// setup screen objects to handle scaling

	let maincontent = document.getElementsByTagName("body");
	// retrieve cookie of previously set touch scaling
	if(getCookie('fontsize')!= null) {
		cookiesize=getCookie('fontsize');
		maincontent.style.setProperty("font-size",cookiesize+"px",null);
	}
	let mainstyle=window.getComputedStyle(maincontent);
	let mainfont=mainstyle.getPropertyValue("font-size");
	let statuss=document.getElementById("statuss");
	// IE 8 support not required for narrow screens as IE 8 uses single
	// interface option from stylesheet and conditional comment due 
	// to lack of support of metrics based media queries
	if(window.addEventListener) {
		// At the start of a multitouch event record the starting distance
		// between the first two touch reference points where there are more than
		// one touch instances
		let sx1,sy1,sx2,sy2,cx1,cy1,cx2,cy2,linestart,linecurrent=0;
		let multitouch=false;
		let previoussize=parseInt(mainfont);
		document.addEventListener('touchstart', function(e) {
			if(e.touches.length>1) {
				multitouch=true;
				mainstyle=window.getComputedStyle(maincontent);
				mainfont=mainstyle.getPropertyValue("font-size");
				previoussize=parseInt(mainfont);
				sx1=e.touches[0].clientX;
				sy1=e.touches[0].clientY;
				sx2=e.touches[1].clientX;
				sy2=e.touches[1].clientY
				linestart=Math.sqrt(Math.pow(Math.abs(sx1-sx2),2)+Math.pow(Math.abs(sy1-sy2),2));
				stopDefaultAction(e);
			}
		},false);
		// when there is a change in the x,y position of a touch, scale the base font size
		// on the change of the length of the distance between the first two touch points
		// based on (current length - starting length)/10 the positive or negative change
		// is then added to the previous font size
		document.addEventListener('touchmove', function(e) {
			if(e.touches.length>1) {
				cx1=e.changedTouches[0].clientX;
				cy1=e.changedTouches[0].clientY;
				cx2=e.changedTouches[1].clientX;
				cy2=e.changedTouches[1].clientY;
				linecurrent=Math.sqrt(Math.pow(Math.abs(cx1-cx2),2)+Math.pow(Math.abs(cy1-cy2),2));
				linechange=Math.round((linecurrent-linestart)/10);
				newsize=previoussize+linechange;
				if(newsize<6){newsize=6;}
				maincontent.style.setProperty("font-size",newsize+"px",null);
				stopDefaultAction(e);
			}
		},false);
		// when a touch point is released store the font size into a cookie
		// this cookie is used to maintain base font size between different pages
		document.addEventListener('touchend', function(e) {
			if(multitouch) {
				mainstyle=window.getComputedStyle(maincontent);
				fontsize=parseInt(mainstyle.getPropertyValue("font-size"));
				setCookie("fontsize",fontsize,28);
				multitouch=false;
			}
		},false);
	}
}
