
// Copyright 1999 Lori Barrett and Ron Gallant
// Please leave the credits in
// chizeledlight.com
function popupPage(page, s, l, t, w, h) {
var windowprops = "location=no,menubars=no,toolbars=no,resizable=yes" +
",scrollbars=" + s + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
var URL = page;
popup = window.open(URL,"MenuPopup",windowprops);
}

function cursor() {
	document.sform.input.focus();
}

function search(form) {
	if (form.engine[0].checked) {
		url = "http://search.go2net.com/crawler?general=" + form.input.value; }
	if (form.engine[1].checked) {
		url = "http://www.hotbot.com/?MT=" + form.input.value; }	
	if (form.engine[2].checked) {
		url = "http://www.altavista.com/cgi-bin/query?pg=q&q=" + form.input.value; }
	if (form.engine[3].checked) {
		url = "http://search.yahoo.com/bin/search?p=" + form.input.value; }
	if (form.engine[4].checked) {
		url = "http://search.excite.com/search.gw?search=" + form.input.value; }
	if (form.engine[5].checked) {
		url = "http://ftpsearch.lycos.com/cgi-bin/search?form=medium&query=" + form.input.value; }
	if (form.engine[6].checked) {
		url = "http://www.deja.com/[ST_rn=qs]/qs.xp?OP=dnquery.xp&QRY=" + form.input.value; }
		
	location.href = url;
}

function go1() {
	if (document.selecter1.select1.options[document.selecter1.select1.selectedIndex].value != "none") {
		location = document.selecter1.select1.options[document.selecter1.select1.selectedIndex].value
		}
	}
		
function go2(){
	if (document.selecter2.select1.options[document.selecter2.select1.selectedIndex].value != "none") {
		location = document.selecter2.select1.options[document.selecter2.select1.selectedIndex].value
		}
	}

function go3(){
	if (document.selecter3.select1.options[document.selecter3.select1.selectedIndex].value != "none") {
		location = document.selecter3.select1.options[document.selecter3.select1.selectedIndex].value
		}
	}
