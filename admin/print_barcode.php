<?php
include 'db_connect.php';
require 'assets/barcode/vendor/autoload.php';
extract($_POST);

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
// $ids = implode(",",$ids);
$qry = $conn->query("SELECT * FROM $tbl where id in ($ids) ");
?>
<div class="container-fluid" id="toPrint">
<style type="text/css">
	#bcode-field{
		width:calc(100%) ;
    	align-items: center;

	}
	#bcode{
		max-height: inherit;
		max-width: inherit;
		width:calc(100%) ;
		height: 10vh;
	}
	#bcode-label {
   font-weight: 700;
    font-size: 17px;
    text-align: justify;
    text-align-last: justify;
    text-justify: inter-word;
	}
	#dfield p{
		margin: unset
	}
	.text-center{
		text-align:center;
	}
</style>
	<div class="" id="bcode-field">
		<?php
		while($row=$qry->fetch_assoc()):
		?>
		<img id="bcode" src="data:image/png;base64,<?php echo base64_encode($generator->getBarcode($row['id_no'], "C128")) ?>">
		<div id="bcode-label"><?php echo preg_replace('/([0-9])/s','$1 ', $row['id_no']); ?></div>
		<div style="clear:both"></div>
		<hr>
		<?php
		endwhile;
		?>
	</div>
</div>
<br>
<br>