// Cross platform support for the total inner width of the window
function getWinWidth() {
	let w=window, d=document, e=d.documentElement,g=d.getElementsByTagName('body')[0],
	x = w.innerWidth || e.clientWidth || g.clientWidth;
	return x;
}

//Cross platform support for the total height of the document
function getDocHeight() {
	let d=document, b = d.body, e=d.documentElement;
	return Math.max(
	b.scrollHeight, e.scrollHeight,	b.offsetHeight, e.offsetHeight,	b.clientHeight, e.clientHeight
	);
}

// Cross platform support for the inner height of the client window
function getWinHeight() {
	let w=window, d=document, e=d.documentElement,g=d.getElementsByTagName('body')[0],
	y = w.innerHeight || e.clientHeight || g.clientHeight;
	return y;
}

// Cross platform support to get the Y coordinate of the top of the visible part of the page
function getScrollPosition() {
	let w=window, d=document, e=d.documentElement;
	let scrollposition = (w.pageYOffset || e.scrollTop)  - (e.clientTop || 0);
	return scrollposition;
}

// prevent the default action of a form or link tag with browser support for
// IE8, IE9+ and other browsers
function stopDefaultAction(e) {
	if(e.preventDefault) {
		e.preventDefault();
	} else {
		e.returnValue=false;
	}
}

// create an XMLHTTP object with browser support for IE8, IE9 and others
function createXHR() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

// Cross browser compatible event target
function getTargetElement(e) {
	let targetelement=null;
	targetelement=(e.target || e.srcElement || e.toElement)
	return targetelement;
}

