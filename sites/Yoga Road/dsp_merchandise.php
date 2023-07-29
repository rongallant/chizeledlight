<? /*
<fusedoc fuse="order.php">
	<history email="ron@chizeledlight.com" date="2002-01-19" type="Create"/>
	<responsibilities>
		I am the Products page.
	</responsibilities>
</fusedoc>
*/

$Price="15";
$MainUrl="https://www.paypal.com/cart/add=";
$Attribs="toolbar=yes, directories=yes, location=yes, status=yes, menubar=yes, resizable=yes, scrollbars=yes, width=600, height=400";
$addVar="1";
$businessVar="yogaroad@mediaone.net";
$image_urlVar="http%3A//yogaroad.server101.com/assets/themes/images/pay_Logo.gif";

//$returnVar=rawurlencode('http://yogaroad.server101.com/index.php\?fuseaction=yoga.success');
//$cancel_returnVar=rawurlencode('http://yogaroad.server101.com/index.php?fuseaction=yoga.cancel');
//&return=$returnVar&cancel_return=$cancel_returnVar

$PayPalPath = "'$MainUrl$addVar&business=$businessVar&item_name='+item_nameVar+'&amount=$Price&image_url=$image_urlVar','cartwin','$Attribs'";

//$PayPalPath = "'$MainUrl$addVar&business=$businessVar&item_name='+item_nameVar+'&amount=$Price&image_url=$image_urlVar','cartwin','$Attribs'";
?>

<script language="JavaScript" type="text/javascript">
<!-- 

function PayPalPop(item_nameVar) {

	window.open(<?echo$PayPalPath;?>);

		}

function PayPalCart() {
		
	window.open('https://www.paypal.com/cart/display=1&business=<?echo$businessVar?>','cartwin','<?echo$Attribs;?>');
	
		}

 -->
</script>

<h1>Merchandise</h1>

<h5 align="right">All Shirts are $15.00 plus tax and shipping.<br>
Allow 4 - 6 weeks for delivery.</h5>
<h2>Ujjayi Tank</h2>

<p><b>Ujjayi</b> - Breathe some life into your practice.</p>


<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#F1E9D6" align="center">
	<tr>
		<td colspan="3" class="MerchHead">Women's</td>
	</tr>
	<tr bgcolor="#E1D1B0">
		<td><div class="MerchName">Front</div></td>
		<td><div class="MerchName">Back</div></td>
		<td><div class="MerchName">Style</div></td>
	</tr>
	<tr>
		<td><a href="<?echo$prods?>/women_ujjayi_front.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_women_ujjayi_front.jpg" width=150 style="color:black;"></a></td>
		<td><a href="<?echo$prods?>/women_ujjayi_back.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_women_ujjayi_back.jpg" width=150 style="color:black;"></a></td>
		<td>
			<form  action="javascript:PayPalPop(document.WUShirt.ShirtType.value)"  method=post name="WUShirt"  >
				<select name="ShirtType">
					<option value="WomenUjjayiSmallBlack">S - Black
					<option value="WomenUjjayiSmallGrey">S - Grey
					<option value="WomenUjjayiSmallIce">S - Ice Blue
					<option value="WomenUjjayiMediumBlack">M - Black
					<option value="WomenUjjayiMediumGrey">M - Grey
					<option value="WomenUjjayiMediumIce">M - Ice Blue
					<option value="WomenUjjayiLargeBlack">L - Black
					<option value="WomenUjjayiLargeGrey">L - Grey
					<option value="WomenUjjayiLargeIce">L - Ice Blue
				</select>
			<p>
			Small: (34-35)<br>
			Medium: (36)<br>
			Large: (37-38)
			</p>
					<input type="image" src="<?echo$images;?>/pay_Add.gif"  >
			</form>
			<input type="image" src="<?echo$images;?>/pay_View.gif" onclick="PayPalCart()">



		</td>
	</tr>
	<tr>
		<td colspan="3" class="MerchHead"><IMG border="0" height=1 src="<?echo$prodthumbs?>/pixel.gif" width="1"></td>
	</tr>
</table>

<p><i>Women's shirts - Close fitting, rib knit in ice blue (while supplies last), black and grey.</i></p>

<p>&nbsp;</p>

<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#F1E9D6" align="center">
	<tr>
		<td colspan="3" class="MerchHead">Men's</td>
	</tr>
	<tr bgcolor="#E1D1B0">
		<td><div class="MerchName">Front</div></td>
		<td><div class="MerchName">Back</div></td>
		<td><div class="MerchName">Style</div></td>
	</tr>
	<tr>
		<td><a href="<?echo$prods?>/men_ujjayi_front.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_men_ujjayi_front.jpg" width=150 style="color:black;"></a></td>
		<td><a href="<?echo$prods?>/men_ujjayi_back.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_men_ujjayi_back.jpg" width=150 style="color:black;"></a></td>
		<td>
			<form  action="javascript:PayPalPop(document.MUShirt.ShirtType.value)" method=post name="MUShirt">
				<select name="ShirtType">
				<option value="MenUjjayiMediumBlack">M - Black
				<option value="MenUjjayiLargeBlack">L - Black
				<option value="MenUjjayiXLargeBlack">XL - Black
			</select>
			<p>
			Med, Large, XL
			</p>
			<input type="image" src="<?echo$images;?>/pay_Add.gif"  >
			</form>
			<input type="image" src="<?echo$images;?>/pay_View.gif" onclick="PayPalCart()">


		</td>
	</tr>
	<tr>
		<td colspan="3" class="MerchHead"><IMG border="0" height=1 src="<?echo$prodthumbs?>/pixel.gif" width="1"></td>
	</tr>
</table>

<p><i>Men's shirts - Loose fitting, sport tank in black only.</i></p>

<p>&nbsp;</p>



<h2>Virabhadrasana Tank</h2>

<p><b>Virabhadrasdana</b> - Discover your inner warrior.</p>


<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#F1E9D6" align="center">
	<tr>
		<td colspan="3" class="MerchHead">Women's</td>
	</tr>
	<tr bgcolor="#E1D1B0">
		<td><div class="MerchName">Front</div></td>
		<td><div class="MerchName">Back</div></td>
		<td><div class="MerchName">Style</div></td>
	</tr>
	<tr>
		<td><a href="<?echo$prods?>/women_vira_front.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_women_vira_front.jpg" width=150 style="color:black;"></a></td>
		<td><a href="<?echo$prods?>/women_vira_back.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_women_vira_back.jpg" width=150 style="color:black;"></a></td>
		<td>
			<form action="javascript:PayPalPop(document.WVShirt.ShirtType.value)" method=post name="WVShirt">
				<select name="ShirtType">
					<option value="WomenViraSmallBlack">S - Black
					<option value="WomenViraSmallGrey">S - Grey
					<option value="WomenViraSmallIce">S - Ice Blue
					<option value="WomenViraMediumBlack">M - Black
					<option value="WomenViraMediumGrey">M - Grey
					<option value="WomenViraMediumIce">M - Ice Blue
					<option value="WomenViraLargeBlack">L - Black
					<option value="WomenViraLargeGrey">L - Grey
					<option value="WomenViraLargeIce">L - Ice Blue
				</select>
			<p>
			Small: (34-35)<br>
			Medium: (36)<br>
			Large: (37-38)
			</p>
			<input type="image" src="<?echo$images;?>/pay_Add.gif"  >
			</form>
			<input type="image" src="<?echo$images;?>/pay_View.gif" onclick="PayPalCart()">


		</td>
	</tr>
	<tr>
		<td colspan="3" class="MerchHead"><IMG border="0" height=1 src="<?echo$prodthumbs?>/pixel.gif" width="1"></td>
	</tr>
</table>

<p><i>Women's shirts - Close fitting, rib knit in ice blue (while supplies last), black and grey.</i></p>

<p>&nbsp;</p>

<table cellpadding="5" cellspacing="0" border="0" width="100%" bgcolor="#F1E9D6" align="center">
	<tr>
		<td colspan="3" class="MerchHead">Men's</td>
	</tr>
	<tr bgcolor="#E1D1B0">
		<td><div class="MerchName">Front</div></td>
		<td><div class="MerchName">Back</div></td>
		<td><div class="MerchName">Style</div></td>
	</tr>
	<tr>
		<td><a href="<?echo$prods?>/men_vira_front.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_men_vira_front.jpg" width=150 style="color:black;"></a></td>
		<td><a href="<?echo$prods?>/men_vira_back.jpg" target="_blank"><IMG align=left border="0" height=150 src="<?echo$prodthumbs?>/tmb_men_vira_back.jpg" width=150 style="color:black;"></a></td>
		<td>
			<form action="javascript:PayPalPop(document.MVShirt.ShirtType.value)" method=post name="MVShirt">
				<select name="ShirtType">
				<option value="MenViraMediumBlack">M - Black
				<option value="MenViraLargeBlack">L - Black
				<option value="MenViraXLargeBlack">XL - Black
			</select>
			<p>
			Med, Large, XL
			</p>
			<input type="image" src="<?echo$images;?>/pay_Add.gif"  >
			</form>
			<input type="image" src="<?echo$images;?>/pay_View.gif" onclick="PayPalCart()">

		</td>
	</tr>
	<tr>
		<td colspan="3" class="MerchHead"><IMG border="0" height=1 src="<?echo$prodthumbs?>/pixel.gif" width="1"></td>
	</tr>
</table>

<p><i>Men's shirts - Loose fitting, sport tank in black only.</i></p>

