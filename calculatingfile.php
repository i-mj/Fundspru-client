<?php
	// echo json_encode($_POST);

	$year=$_POST['year'];
	$amount=$_POST['sipamount']+$_POST['npsamount'];
	$totalamount=$_POST['sipamount']+$_POST['npsamount'];

	if($_POST['siprate']!=0)
		$rate=($_POST['siprate']+$_POST['npsrate'])/2;
	else
		$rate=$_POST['npsrate'];
	$stepup=$_POST['stepuprate'];
	$total=$amount;
	$totalinvestment=0;
	$totalinterest=0;

	for($i=($year*12);$i>=1;$i--)
	{

		$interest=($total*$rate/100)*1/12;
		if($i%12==0&&($year*12)!=$i)
		{
			$amount+=($amount*$stepup/100);
		}
		$total+=$amount;
		$total+=$interest;
		$totalinvestment+=$amount;
		$totalinterest+=$interest;
	}
	$total-=$amount;
	$total=intval($total);
	$totalinvestment=intval($totalinvestment);
	$totalinterest=intval($totalinterest);
	$annuity=intval($total*40/100);
	$retirement=intval($total*60/100);

	$cvretirement=intval($retirement/((1+($_POST['inflationrate']/100))**$year));

	$pension=intval($annuity*($_POST['annuityrate']/100)/12);
	$cvpension=intval($pension/((1+($_POST['inflationrate']/100))**$year));



	echo json_encode('{"totalamount":'.$totalamount.',"totalinvestment":'.$totalinvestment.',"totalinterest":'.$totalinterest.',"maturityvalue":'.$total.',"rate":'.$rate.',"pension":'.$pension.',"cvretirement":'.$cvretirement.',"cvpension":'.$cvpension.',"retirement":'.$retirement.',"annuity":'.$annuity.'}');

?>