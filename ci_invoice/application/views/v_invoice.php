<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	<form action="<?php echo base_url().'index.php/invoice/simpan_invoice'?>" method="post">
		<input type="text" name="no_invoice" value="<?php echo $invoice;?>">
		<button type="submit">Simpan</button>
	</form>
</body>
</html>