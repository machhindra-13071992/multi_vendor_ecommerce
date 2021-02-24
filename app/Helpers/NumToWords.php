<?php
namespace App\Helpers;

class NumToWords {

	private static $arr_ones = array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
	private static $arr_tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

	public static function convertToAmount(&$aInputArr, $sAmountKey) {
		$aInputArr[$sAmountKey.'_display'] = number_format($aInputArr[$sAmountKey] , 2);
		$aInputArr[$sAmountKey.'_words'] = self::getAmountInRupees($aInputArr[$sAmountKey]);
	}

	public static function getAmountInRupees($sInputStr) {
		$value = str_replace(',', '', $sInputStr);
		$split = explode(".", $value);
		$rspart = "Rupees " . self::convertToWords($split[0]);
		$pspart = "";
		if (count($split) == 2) {
			$pspart = ($split[1] > 0) ? " and " . self::convertToWords($split[1], $amountType='paise') . " Paise" : "";
		}
		return $rspart . $pspart . ' Only';
	}

	public static function convertToWords($number, $amountType = 'rupees') {
		$arab = floor($number / 1000000000);  /* arab (giga) */
		$number -= $arab * 1000000000;
		$crores = floor($number / 10000000);  /* crore (giga) */
		$number -= $crores * 10000000;
		$lakhs = floor($number / 100000);  /* lakhs (giga) */
		$number -= $lakhs * 100000;
		$thousands = floor($number / 1000);	 /* Thousands (kilo) */
		$number -= $thousands * 1000;
		$hundreds = floor($number / 100);	  /* Hundreds (hecto) */
		$number -= $hundreds * 100;
		$tens = floor($number / 10);	   /* Tens (deca) */
		$ones = $number % 10;			   /* Ones */
		$res = "";
		if ($arab) {
			$res .= self::convertToWords($arab);
			$res.=($arab > 10) ? " Arabs " : " Arab ";
		}
		if ($crores) {
			$res .= self::convertToWords($crores);
			$res.=($crores > 10) ? " Crores " : " Crore ";
		}
		if ($lakhs) {
			$res .= self::convertToWords($lakhs);
			$res.=($lakhs > 10) ? " Lakhs" : " Lakh";
		}
		if ($thousands) {
			$res .= (empty($res) ? "" : " ") . self::convertToWords($thousands) . " Thousand";
		}

		if ($hundreds) {
			$res .= (empty($res) ? "" : " ") . self::convertToWords($hundreds) . " Hundred";
		}


		if ($tens || $ones) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($tens < 2) {
				$res .= self::$arr_ones[$tens * 10 + $ones];
			} else {
				$res .= self::$arr_tens[$tens];
				if ($ones) {
					//$res .= "-" . self::$arr_ones[$ones];
					$res .= " " . self::$arr_ones[$ones];
				}
			}
		}

		if (empty($res)) {
			$res = "zero";
		}
		return $res;
	}

    public static function getWordsArray($number, $amountType = 'rupees') {
		$crores = floor($number / 10000000);  /* crore (giga) */
		$number -= $crores * 10000000;
		$lakhs = floor($number / 100000);  /* lakhs (giga) */
		$number -= $lakhs * 100000;
		$thousands = floor($number / 1000);	 /* Thousands (kilo) */
		$number -= $thousands * 1000;
		$hundreds = floor($number / 100);	  /* Hundreds (hecto) */
		$number -= $hundreds * 100;
		$tens = floor($number / 10);	   /* Tens (deca) */
		$ones = $number % 10;			   /* Ones */
		$res = "";
		//$res['arab'] = ucfirst(self::convertToWords($arab));
        $res['crore'] = ucfirst(self::convertToWords($crores));
        $res['lakh'] = ucfirst(self::convertToWords($lakhs));
        $res['thousand'] = ucfirst(self::convertToWords($thousands));
        $res['hundred'] = ucfirst(self::convertToWords($hundreds));
        $res['tens'] = ucfirst(self::convertToWords($tens));
        $res['unit'] = ucfirst(self::convertToWords($ones));
		return $res;
	}
}

?>