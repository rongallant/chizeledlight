function newImage(arg) {
	if (document.images) {
		rslt = new Image();
		rslt.src = arg;
		return rslt;
	}
}

function changeImages() {
	if (document.images && (preloadFlag == true)) {
		for (var i=0; i<changeImages.arguments.length; i+=2) {
			document[changeImages.arguments[i]].src = changeImages.arguments[i+1];
		}
	}
}

var preloadFlag = false;
function preloadImages() {
	if (document.images) {
		menu_belly_over = newImage("assets/images/menu_belly-over.gif");
		menu_mommy_over = newImage("assets/images/menu_mommy-over.gif");
		menu_daddy_over = newImage("assets/images/menu_daddy-over.gif");
		menu_babystuff_over = newImage("assets/images/menu_babystuff-over.gif");
		menu_home_over = newImage("assets/images/menu_home-over.gif");
		menu_baby_over = newImage("assets/images/menu_baby-over.gif");
		menu_big_sister_over = newImage("assets/images/menu_big_sister-over.gif");

		preloadFlag = true;
	}
}