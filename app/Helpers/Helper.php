<?php 
// Code within app\Helpers\Helper.php

namespace App\Helpers;
use Auth;
use App\User;
use App\Publishing;
use App\Pitch;
use DB;

class Helper
{
	private static $arr_ones = array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
	private static $arr_tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

    public static function user_roles()
    {	$userRoles = array();
        $userRoles['super_config'] = false;
        $userid =  Auth::user()->id;
        $data = User::with('roles')->where('id', $userid)->orderBy('id', 'DESC')->first(); 
        if($data->roles){
            foreach($data->roles as $key=>$multiple_roles){
                if($multiple_roles['super_config'] == true){
                    $userRoles['super_config'] = true;
                }
            }
        }

        return $userRoles;
    }
	
	
public static function update_user_transaction_details($tData=array()){
	$userid =  Auth::user()->id;
	$dataArr = array('user_id'=>$userid,
			'program_name'=>isset($tData['program_name']) ? $tData['program_name'] : null,
			'login_datetime'=>isset($tData['login_datetime']) ? $tData['login_datetime'] : null,
			'logout_datetime'=>isset($tData['logout_datetime']) ? $tData['logout_datetime'] : null,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'created_by'=>$userid,
			'updated_by'=>$userid);
			DB::table('user_transaction_details')->insert($dataArr);
}

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