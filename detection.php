<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML><HEAD>

<TITLE>Browser Detection</TITLE>

<?PHP include("parts/header.inc"); ?>

<SCRIPT LANGUAGE="JavaScript">
<!--
  var Bname = navigator.appName;
  var Bver = navigator.appVersion;
  if (Bname == "Microsoft Internet Explorer" && Bver >= "3.0") location.href = "console/index.html";
  if (Bname == "Microsoft Internet Explorer" && Bver < "4.0") location.href = "index2.html";
  if (Bname == "Netscape" && Bver >= "3.0") location.href = "console/index.html";
  if (Bname == "Netscape" && Bver <= "3.0") location.href = "console/index.html";
//-->
</SCRIPT>
</BODY></HTML>