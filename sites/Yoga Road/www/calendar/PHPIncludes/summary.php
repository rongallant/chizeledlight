<?PHP
$tables = array();
$tables[0] = array($table[4][0], $table[4][4], $table[4][5], $table[4][1][0], $table[4][1][1], $table[4][1][2], $table[4][1][3], $table[4][1][4]);
$tables[1] = array($table[0][0], $table[0][4], $table[0][5], $table[0][1][0], $table[0][1][1], $table[0][1][3], $table[0][1][5], $table[0][1][9]);
$tables[2] = array($table[2][0], $table[2][4], $table[2][5], $table[2][1][0], $table[2][1][1], $table[2][1][2], $table[2][1][3]);

include("PHPIncludes/functions.php");

$t = time();
$w = $t+($table[4][6]*86400);

echo '
    <table border="0" cellpadding="0" cellspacing="2" width="100%">
      <tr>
        <td' . $class[1] . ' width="10">&nbsp;</td>
        <td' . $class[3] . '>
          <h1>' . $table[4][5] . '</h1>
        </td>
      </tr>
      <tr>
        <td width="10"></td>
        <td>Following is a list of news and events occurring on or before ' . date( "l, F-d-Y", $w) . '</td>
      </tr>
    </table>';

$a=0;
while($a < count($tables)){
  $query = "select * from " .$tables[$a][0];
  $result = mysql($database, $query);
  $n = mysql_numrows($result);
  $empty = 1;
  $b = 0;
  echo '
    <table border="0" cellpadding="0" cellspacing="2" width="100%">
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="2" width="100%">
            <tr>
              <td' . $class[1] . ' width="10">&nbsp;</td>
              <td' . $class[3] . '>' . $tables[$a][2] . '</td>
            </tr>';
  while ($b<$n){
    if($a == 1){
      $occure = explode("%", mysql_result($result,$b,$tables[$a][7]));
      $occure[0] = explode("-", $occure[0]);
    }
    if (($a == 1 &&  $occure[0][2] == "no") || $a != 1){
      $sd = explode("-", mysql_result($result,$b,$tables[$a][4]));
      $s = mktime(0, 0, 0, $sd[1], $sd[2], $sd[0]);
      $ed = explode("-", mysql_result($result,$b,$tables[$a][5]));
      $e = mktime(0, 0, 0, $ed[1], $ed[2], $ed[0]);
      if ($sd[0] != $ed[0]){
        $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, F dS Y", $e);
      } else {
        if ($sd[1] != $ed[1]){
          $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, F dS", $e);
        } else {
          if ($sd[2] != $ed[2]){
            $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, dS", $e);
          } else {
            $date = date("l, F dS Y", $s);
          }
        }
      }
      if(($s>=$t || $e>=$t) && ($s<=$w || $e<=$w)){
        if($a != 0){
          echo '
            <tr>
              <td width="10">&nbsp;</td>
              <td><b>' . html(mysql_result($result,$b,$tables[$a][6]), $html) . '</b>: <i>' . $date . '</i></td>
            </tr>';
        } else {
          echo '
            <tr>
              <td width="10">&nbsp;</td>
              <td><b>' . html(mysql_result($result,$b,$tables[$a][6]), $html) . '</b>:<br>' . html(mysql_result($result,$b,$tables[$a][7]), $html) . '</td>
            </tr>';
        }
        $empty=0;
      }
    } else {
      $sy = date(Y, $t);
      $sm = date(n, $t);
      $sd = date(j, $t);
      $id = mysql_result($result,$b,$tables[$a][3]);
      $querya = "select * from " . $table[1][0] . " where ";
      $queryb = $table[1][1][1] . "='" . $sy . "-" . $sm . "-" . $sd . "'";
      $subrslt = mysql($database, $querya.$queryb);
      if (mysql_numrows($subrslt)){
        $queryb = $table[1][1][0] . ">='" . mysql_result($subrslt,0,$table[1][1][0]) . "' limit " . $table[4][6];
        $subrslt = mysql($database, $querya.$queryb);
        $i = mysql_numrows($subrslt);
        $c = 0;
        unset($sd);
        unset($s);
        while($c < $i){
          $event = explode("-", substr(mysql_result($subrslt,$c,$table[1][1][4]), 0 ,strlen(mysql_result($subrslt,$c,$table[1][1][4]))-1));
          while (list(,$val) = each($event)){
            if ($id == $val){
              if (!isset($sd)) $sd = explode("-", mysql_result($subrslt,$c,$table[1][1][1]));
              if (!isset($s)) $s = mktime(0, 0, 0, $sd[1], $sd[2], $sd[0]);
              $ed = explode("-", mysql_result($subrslt,$c,$table[1][1][1]));
              $e = mktime(0, 0, 0, $ed[1], $ed[2], $ed[0]);
            }
          }
        $c++;}
        if (isset($s)){
          if ($sd[0] != $ed[0]){
            $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, F dS Y", $e);
          } else {
            if ($sd[1] != $ed[1]){
              $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, F dS", $e);
            } else {
              if ($sd[2] != $ed[2]){
                $date = date("l, F dS Y", $s) . '</i> to <i>' . date("l, dS", $e);
              } else {
                $date = date("l, F dS Y", $s);
              }
            }
          }
          echo '
            <tr>
              <td width="10">&nbsp;</td>
              <td><b>' . html(mysql_result($result,$b,$tables[$a][6]), $html) . '</b>: <i>' . $date . '</i></td>
            </tr>';
          $empty=0;
        }
      }
    }
  $b++;}
  if ($empty){
      echo '
            <tr>
              <td width="10">&nbsp;</td>
              <td>Currently, there are no upcoming events within the next ' . $table[4][6] . ' days.</td>
            </tr>';
  }
  if ($a != 0){
      echo '
            <tr>
              <td width="10">&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td width="10">&nbsp;</td>
              <td>To see the complete list, <a href="' . $tables[$a][1] . '">click here</a>.</td>
            </tr>';
  }
  echo '
          </table>
        </td>
      </tr>
    </table>';
$a++;}
echo '
    <table border="0" cellpadding="0" cellspacing="2" width="100%">
      <tr>
        <td align="center" colspan="3"' . $class[7] . '><a href="http://www.lightwavesgraphics.com" target="_blank">Multifunction Calendar ' . $version . '</a></td>
      </tr>
    </table>' . "\n";

?>
