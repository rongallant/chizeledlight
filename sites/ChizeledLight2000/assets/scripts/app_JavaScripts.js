
function popupPage(page, s, l, t, w, h) {
	var windowprops = "location=no,menubars=no,toolbars=no,resizable=yes" +	",scrollbars=" + s + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
	var URL = page;
		popup = window.open(URL,"MenuPopup",windowprops);
	}

function cursor() {
	document.sform.input.focus();
	}
