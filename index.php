<html>
<head>
    <title>Generate QR Code</title>
</head>
  <body align="center">
    <h1>Generate QR Code</h1>
    <form method="post" id="from-qrcode" onSubmit="return validate();">
        <div >
            Your Text: <input id="field_name"  type="text" name="field_name"  />
			<input type="submit" name="generate" value="Generate QR Code" />
        </div>
    </form>  
  </body>
</html>
  <?php
   if (! empty($_POST["field_name"])) {
    require ('vendor/autoload.php');

    $barcode = new \Com\Tecnick\Barcode\Barcode();
    $targetPath = "qrcode/";
    
    if (! is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }
    $barcodeObj = $barcode->getBarcodeObj('QRCODE,H', $_POST["field_name"], - 16, - 16, 'black', 
	                   array(- 2,- 2,- 2,- 2))->setBackgroundColor('#fff');
    
    $imageData = $barcodeObj->getPngData();
    $timestamp = time();
    
    file_put_contents($targetPath . $timestamp . '.png', $imageData);
    ?>
     <div>QRCODE</div> 
     <img src="<?php echo $targetPath . $timestamp ; ?>.png" width="200px" height="200px">
    <?php
    }
    ?>