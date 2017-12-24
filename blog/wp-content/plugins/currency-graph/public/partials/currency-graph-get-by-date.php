 <?php 
 	$date = $_GET['date'];
 	$currency = $_GET['currency'];

 	// $data = json_encode(file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date='.$date.'&json'));
 	$data = json_encode(file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=' . $currency . '&date=' . $date . '&json'));
 	echo $data;
 ?>

