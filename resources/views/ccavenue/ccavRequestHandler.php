<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	// $merchant_data='2';
	// $working_key='4591A342C9B00199D927970038116060';//Shared by CCAVENUES
	// $access_code='AVTD18KJ61AM26DTMA';//Shared by CCAVENUES

	$merchant_data='2';
	$working_key='06C5566552E469E01561F97954CBB8F9';//Shared by CCAVENUES
	$access_code='AVNQ71LC32BC61QNCB';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=pgencrypt($merchant_data,$working_key); // Method for encrypting the data.
?>
<form method="POST" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect .submit();</script>
</body>
</html>

