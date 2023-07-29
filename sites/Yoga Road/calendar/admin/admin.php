<?PHP
// Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.

require("../PHPIncludes/setup.php");
require("shared/functions.php");

if ($function == "calb"){
  include("calendarb/functions.php");
}
if ($function == "cala"){
  include("calendara/functions.php");
}
if ($function == "evnt"){
  include("eventlog/functions.php");
}
if ($function == "build"){
  include("calendara/rebuild.php");
}
if ($function == "news"){
  include("news/functions.php");
}

require("shared/action.php");
?>

<!--
  Multifunction Calendar
  Copyright © 2001 Light Wave Graphics. Coded by Greg Henle. All rights reserved.
  www.lightwavesgraphics.com
-->

<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <?PHP echo '<link href="../Style/' . $cssstyle . '" rel="stylesheet" rev="text/css">' . "\n"; ?>
    <title>Multifunction Calendar Admin</title>
  </head>

  <body bgcolor="#ffffff">
<?PHP
echo '
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td colspan="6"' . $class[8] . '>
          <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
              <td rowspan="2" width="75%"><img src="images/spacer.gif" width="1" height="60" border="0" align="left">
                <div' . $class[9] . '">' . $baseurl . '</div>
                <div' . $class[10] . '">' . $sitename . '</div>
              </td>
              <td align="right"' . $class[11] . ' nowrap>User ID: ' . getenv('REMOTE_USER') . '<br>Date: ' . date("D, d M Y H:i:s") . '</td>
              <td align="left" width="20"><img src="images/info.gif" width="22" height="22" border="0"></td>
            </tr>
            <tr>
              <td align="right"' . $class[11] . ' nowrap>' . $phone . '</td>
              <td align="left" width="20"><img src="images/phone.gif" width="22" height="22" border="0"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td' . $class[0] . ' colspan="2"><img src="images/spacer.gif" width="1" height="1" border="0"></td>
        <td' . $class[0] . ' width="15%"><img src="images/spacer.gif" width="1" height="1" border="0"><a href="http://' . $baseurl . '" target="_top">Main Site</a></td>
        <td' . $class[0] . ' width="15%"><img src="images/spacer.gif" width="1" height="1" border="0"><a href="mailto:' . $contact . '">Contact</a></td>
        <td' . $class[0] . ' width="15%"><img src="images/spacer.gif" width="1" height="1" border="0"><a href="' . $PHP_SELF . '?function=help">Help</a></td>
        <td' . $class[0] . ' width="15%"><img src="images/spacer.gif" width="1" height="1" border="0"><a href="' . $PHP_SELF . '">Home</a></td>
      </tr>
    </table>
    <table border="0" cellpadding="3" cellspacing="0" width="100%">
      <tr>
        <td' . $class[1] . ' colspan="5"><img src="images/spacer.gif" width="1" height="1" border="0"></td>
      </tr>
      <tr>
        <td width="50%"' . $class[12] . ' valign="top">
          <div' . $class[13] . '>';

if ($function == "cala" || $function == "build"){
  echo $table[0][5];
}
if ($function == "calb"){
  echo $table[2][5];
}
if ($function == "evnt"){
  echo $table[3][5];
}
if ($function == "help"){
  echo "Support";
}
if ($function == "news"){
  echo $table[4][5];
}
if ($function == "opt"){
  echo "Optimize Database";
}

echo '
          </div>
          <div' . $class[14] . '>';

if (!isset($action) || ($action != "new" && $action != "edit")) echo $sitename . " Admin";
if ($action == "new") echo "New Record";
if ($action == "edit") echo "Edit Record";

echo '
          </div>
        </td>
        <td width="1"' . $class[12] . ' valign="top"><img src="images/spacer.gif" width="1" height="100" border="0"></td>
        <td width="17%" ' . $class[15] . ' valign="top">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td ' . $class[18] . '>Status</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
            <tr>
              <td ' . $class[19] . '>' . $sysmsga . '</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
          </table>
        </td>
        <td width="16%" ' . $class[16] . ' valign="top">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td ' . $class[18] . '>Status</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
            <tr>
              <td ' . $class[19] . '>' . $sysmsgb . '</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
          </table>
        </td>
        <td width="17%" ' . $class[17] . ' valign="top">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td ' . $class[18] . '>Status</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
            <tr>
              <td ' . $class[19] . '>' . $sysmsgc . '</td>
              <td width="1"><img src="images/spacer.gif" width="1" height="20"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td' . $class[1] . ' colspan="5"><img src="images/spacer.gif" width="1" height="1" border="0"></td>
      </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td' . $class[6] . ' valign="top">';

if ($function == "calb"){
  include("calendarb/calendarb.php");
}
if ($function == "news"){
  include("news/news.php");
}
if ($function == "cala"){
  include("calendara/calendara.php");
}
if ($function == "build"){
  include("calendara/buildlog.php");
}
if ($function == "evnt"){
  include("eventlog/eventlog.php");
}
if ($function == "opt"){
  include("shared/optimize.php");
}
if ($function == "help"){
  echo '
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="2" width="100%">
                  <tr>
                    <td' . $class[1] . ' width="10">&nbsp;</td>
                    <td' . $class[3] . '>Support Information</td>
                  </tr>
                  <tr>
                    <td width="10"></td>
                    <td>';
  include ("help.php");
  echo '
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>';
}
if (!isset($function)){
  echo '
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="2" width="100%">
                  <tr>
                    <td' . $class[1] . ' width="10">&nbsp;</td>
                    <td' . $class[3] . '>Summary</td>
                  </tr>
                  <tr>
                    <td width="10"></td>
                    <td>
                      <p>There are currently ' . mysql_numrows(mysql($database, "select * from " . $table[0][0])) . ' records in ' . $table[0][5] . '.</p>
                      <p>There are currently ' . mysql_numrows(mysql($database, "select * from " . $table[2][0])) . ' records in ' . $table[2][5] . '.</p>
                      <p>There are currently ' . mysql_numrows(mysql($database, "select * from " . $table[3][0])) . ' records in ' . $table[3][5] . '.</p>
                      <p>There are currently ' . mysql_numrows(mysql($database, "select * from " . $table[4][0])) . ' records in ' . $table[4][5] . '.</p>';
  include ("intro.php");
  echo '
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>';
}
echo '
        </td>
        <td' . $class[12] . ' valign="top" width="20%">
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . '>' . $table[0][5] . '</td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=cala"><span ' . $class[20] . '>Edit ' . $table[0][5] . '</span></a></td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=build"><span ' . $class[20] . '>Rebuild ' . $table[0][5] . '</span></a></td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="../' . $table[0][4] . '" target="_blank"><span ' . $class[20] . '>Open ' . $table[0][5] . '</span></a></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . ' nowrap>' . $table[2][5] . '</td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=calb"><span ' . $class[20] . '>Edit ' . $table[2][5] . '</span></a></td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="../' . $table[2][4] . '" target="_blank"><span ' . $class[20] . '>Open ' . $table[2][5] . '</span></a></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . ' nowrap>' . $table[3][5] . '</td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=evnt"><span ' . $class[20] . '>Edit ' . $table[3][5] . '</span></a></td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="../' . $table[3][4] . '" target="_blank"><span ' . $class[20] . '>Open ' . $table[3][5] . '</span></a></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . ' nowrap>' . $table[4][5] . '</td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=news"><span ' . $class[20] . '>Edit ' . $table[4][5] . '</span></a></td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="../' . $table[4][4] . '" target="_blank"><span ' . $class[20] . '>Open ' . $table[4][5] . '</span></a></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . ' nowrap>Maintenance</td>
            </tr>
            <tr>
              <td width="10"><img src="images/spot.gif" width="14" height="14" border="0"></td>
              <td><a href="' . $PHP_SELF . '?function=opt"><span ' . $class[20] . '>Optimize Calendars</span></a></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
      </tr>
    </table>';
?>
  </body>

</html>