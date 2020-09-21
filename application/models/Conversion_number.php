<?php
class Conversion_number extends CI_Model{
	public function __construct()
	{
	
	}
// this is for form action method

//if(isset($_POST['send'])){
// this is for function call method
function convertToWord($x){
	global $all_value,$single_supix;

	$r=explode('.', $x);
	$n=$r['0'];

// take given number
//$n=$_POST['num'];
//echo $n;
// convert this number into an array
$stringto=array();
$stringto=str_split($n);

// count array value
 $c=count($stringto);

// all value of number as string from 1 to 99
	
	$all_value=array(
		'1'=>'এক',
		'2'=>'দুই',
		'3'=>'তিন',
		'4'=>'চার',
		'5'=>'পাঁচ',
		'6'=>'ছয়',
		'7'=>'সাত',
		'8'=>'আট',
		'9'=>'নয়',
		'01'=>'এক',
		'02'=>'দুই',
		'03'=>'তিন',
		'04'=>'চার',
		'05'=>'পাঁচ',
		'06'=>'ছয়',
		'07'=>'সাত',
		'08'=>'আট',
		'09'=>'নয়',
		'10'=>'দশ',
		'11'=>'এগার',
		'12'=>'বার',
		'13'=>'তের',
		'14'=>'চৌদ্দ',
		'15'=>'পনের',
		'16'=>'সতের',
		'17'=>'আঠার',
		'18'=>'ঊনিষ',
		'19'=>'বিশ'
		);

// this is for single supix of two value

$single_supix=array(
	'2'=>'বার',
	'3'=>'তের',
	'4'=>'চৌদ্দ',
	'5'=>'পনের',
	'6'=>'ষোল',
	'7'=>'সতের',
	'8'=>'আঠার',
	'9'=>'ঊনিষ'
	);

// all function


// one digit number 
	function basic_number($num){
		global $all_value;

		return $all_value[$num];
	}


// two digit number function
	function two_digit($num){
		global $single_supix,$all_value;

		if(array_key_exists($num,$all_value)){
			return $result=$all_value[$num];
		}else{

		
			// make array by this number
			$numToarray=str_split($num);

			//print_r($numToarray);

			// first digit
			$first_digit=$numToarray['0'];
			$prepix=$single_supix[$first_digit];
			
			// second digit
			$second_digit=$numToarray['1'];
			$supix=$all_value[$second_digit];

			return $numToString=$prepix.' '.$supix;
		}
	}

// this is three digit number conversion

	function three_digit($num){
		global $single_supix,$all_value; 
		$numToarray=str_split($num);

		if($numToarray['0']==0){
			$two_digit=$numToarray['1'].$numToarray['2'];

			// function calling two_digit 
				return $result=two_digit($two_digit);
		}else{

		$supix='hundred';
		

		// first digit
		$first_digit=$numToarray['0'];
		$first_value=$all_value[$first_digit];

		// rest two digit
		$two_digit=$numToarray['1'].$numToarray['2'];

		// call two digit function
		$r=two_digit($two_digit);

		// return all value
		return $result=$first_value.' '.$supix.' '.$r;
	}
	}

// this is four digit number conversion

	function four_digit($num){
		global $single_supix,$all_value; 

		$supix='thousand';
		$numToarray=str_split($num);

		if($numToarray['0']==0){
			$num=$numToarray['1'].$numToarray['2'].$numToarray['3'];
			return $forth_result=three_digit($num);
		}else{

		// first digit
		$fouth_digit=$numToarray['0'];
		$fourth_value=$all_value[$fouth_digit];

		// rest three digit
		$three_digit=$numToarray['1'].$numToarray['2'].$numToarray['3'];

		// call three digit function
		if($three_digit!='000'){
			$f_r=three_digit($three_digit);
		}
		// return all value
		return $forth_result=$fourth_value.' '.$supix.' '.$f_r;
		}

	}

// this is five digit number conversion

	function five_digit($num){
		$supix='thousand';

		$numToarray=str_split($num);

		// if first digit is zero
		if($numToarray['0']==0){

			// 
			$num=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'];
			return $fifthConversion=four_digit($num);
		}else{

		// first two digit
		$firstTwoDigit=$numToarray['0'].$numToarray['1'];

		// call two digit number function
		$firstPart=two_digit($firstTwoDigit);

		// last three digit
		$lastThreeDigit=$numToarray['2'].$numToarray['3'].$numToarray['4'];

		// call three digit function
			// three digit but not zero
		if($lastThreeDigit!=0){
			$lastPart=three_digit($lastThreeDigit);
		}

		return $fifthConversion=$firstPart.' '.$supix.' '.$lastPart;
		}
	}

	// this function is for six digit value
	function six_digit($num){
		$numToarray=str_split($num);
		$supix='lac';

		// if first value is zero

		if($numToarray['0']==0){
			$num=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'];
			return $result=five_digit($num);
		}else{
			$lakh=basic_number($numToarray['0']);

			// five digit number
			$num=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'];
			$r=five_digit($num);

			return $result=$lakh.' '.$supix.' '.$r;
		}

	}

	// seven digit function

	function seven_digit($num){
		$numToarray=str_split($num);
		$supix='lac';
		
		// first digit
		$firstDigit=$numToarray['0'];

			if($firstDigit==0){

				// rest six digit
				$lastSixDigit=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'];

				// calling six digit function
				return $result=six_digit($lastSixDigit);		
			}else{

				// first two digit
				$firstTwoDigit=$numToarray['0'].$numToarray['1'];

				// first two digit result
				$firstPart=two_digit($firstTwoDigit);

				// last five digit
				$lastFiveDigit=$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'];

				// five digit function calling
				$lastPart=five_digit($lastFiveDigit);

				// final result
				return $result=$firstPart.' '.$supix.' '.$lastPart;
			}

	}

	// eight digit function
	function eight_digit($num){
		
		// convert this into an array
		$numToarray=str_split($num);

		// supix of this number
		$supix='crore';

		if($numToarray['0']==0){
			$seven_digit=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'].$numToarray['7'];

			return $result=seven_digit($seven_digit);
		}else{
			$firstDigit=$numToarray['0'];

			// send this value into one number function
			$firstPart=basic_number($firstDigit);

			// rest seven digit
			$seven_digit=$numToarray['1'].$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'].$numToarray['7'];

			// send this into seven digit function
			$lastPart=seven_digit($seven_digit);

			// final result
			return $result=$firstPart.' '.$supix.' '.$lastPart;

		}

	}

	// nine digit function
	function nine_digit($num){
		
		// set supix for this number
		$supix='crore';

		// convert this into an array
		$numToarray=str_split($num);

		// take first two digit
		$firstTwoDigit=$numToarray['0'].$numToarray['1'];

		// rest seven digit
			$sevenDigit=$numToarray['2'].$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'].$numToarray['7'].$numToarray['8'];

		// test if first two digit is zero
		if($firstTwoDigit==0){

			// send this seven digit function
			return $result=seven_digit($sevenDigit);
		}else{

			// send first two digit into two_digit function
			$firstPart=two_digit($firstTwoDigit);

			// call seven digit function
			$lastPart=seven_digit($sevenDigit);

			return $result=$firstPart.' '.$supix.' '.$lastPart;
		}

	}

	// ten digit function
	function ten_digit($num){

		// supix of this number
		$supix='crore';

		// convert the value into an array
		$numToarray=str_split($num);

		// take first three digit
		$firstThreeDigit=$numToarray['0'].$numToarray['1'].$numToarray['2'];

		// rest seven digit
		$sevenDigit=$numToarray['3'].$numToarray['4'].$numToarray['5'].$numToarray['6'].$numToarray['7'].$numToarray['8'].$numToarray['9'];

		if($firstThreeDigit==0){
			// send this number into seven digit function
			return $result=seven_digit($sevenDigit);
		}else{
			// first three digit function
			$firstPart=three_digit($firstThreeDigit);

			// rest seven digit function
			$lastPart=seven_digit($sevenDigit);

			// final result
			return $result=$firstPart.' '.$supix.' '.$lastPart;
		}
	}

	// all logic


// if the numner is one digit value
	if($c==1){
		echo ucfirst(basic_number($n));
	}

	else if($c==2){
		echo ucfirst(two_digit($n));
		
	}
	else if($c==3){
		echo ucfirst(three_digit($n));
	}

	else if($c==4){
		echo ucfirst(four_digit($n));
	}

	else if($c==5){
		echo ucfirst(five_digit($n));
	}

	else if($c==6){
		echo six_digit($n);
	}

	else if($c==7){
		echo seven_digit($n);
	}

	else if($c==8){
		echo eight_digit($n);
	}

	else if ($c==9) {
		echo nine_digit($n);
	}

	else if($c==10){
		echo ten_digit($n);
	}

}
	//convertToWord(847);

}
?>
