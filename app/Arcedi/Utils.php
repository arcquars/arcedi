<?php

namespace App\Arcedi;

use App\Models\Contract;
use App\Models\PaymentA;
use App\Models\PaymentM;

class Utils {
	public static function formatTimes($string) {
		$times = explode( "-", $string );
		$string = "";
		for($i = 0; $i < count ( $times ); $i ++) {
			if($string == ""){
				$string = Utils::getFormatByTime($times[$i]);
			}else{
				$string = $string." | ".Utils::getFormatByTime($times[$i]);
			}
		}
		
		return $string;
	}
	public static function getFormatByTime($time) {
		$string = "";
		switch ($time) {
			case 1 :
				$string = "01:00 a 02:00";
				break;
			case 2 :
				$string = "02:00 a 03:00";
				break;
			case 3 :
				$string = "03:00 a 04:00";
				break;
			case 4 :
				$string = "04:00 a 05:00";
				break;
			case 5 :
				$string = "05:00 a 06:00";
				break;
			case 6 :
				$string = "06:00 a 07:00";
				break;
			case 7 :
				$string = "07:00 a 08:00";
				break;
			case 8 :
				$string = "08:00 a 09:00";
				break;
			case 9 :
				$string = "09:00 a 10:00";
				break;
			case 10 :
				$string = "10:00 a 11:00";
				break;
			case 11 :
				$string = "11:00 a 12:00";
				break;
			case 12 :
				$string = "12:00 a 13:00";
				break;
			case 13 :
				$string = "13:00 a 14:00";
				break;
			case 14 :
				$string = "14:00 a 15:00";
				break;
			case 15 :
				$string = "15:00 a 16:00";
				break;
			case 16 :
				$string = "16:00 a 17:00";
				break;
			case 17 :
				$string = "17:00 a 18:00";
				break;
			case 18 :
				$string = "18:00 a 19:00";
				break;
			case 19 :
				$string = "19:00 a 20:00";
				break;
			case 20 :
				$string = "20:00 a 21:00";
				break;
			case 21 :
				$string = "21:00 a 22:00";
				break;
			case 22 :
				$string = "22:00 a 23:00";
				break;
			case 23 :
				$string = "23:00 a 24:00";
				break;
			case 25 :
				$string = "00:00 a 01:00";
				break;
			case 26 :
				$string = "01:00 a 02:00";
				break;
			default :
				$string = "";
		}
		return $string;
	}

	public static function viewEnvImages($envImages){
		$colum=0;
		$html = "";
		foreach($envImages as $envIMage){
			if($colum == 0){
				$html .= "<div class='row'>";
				$html .= "<div class='col-md-4'>";
				$html .= "<a href='#' onclick='openViewDeleteEnvImage(".$envIMage->env_image_id."); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
				$html .= "<img class='img-thumbnail' style='width: 140px;' src='".url('/')."/assets/images/".$envIMage->url_image."'>";
				$html .= "</div>";
				$colum++;
			}else{
				if($colum == 2){
					$html .= "<div class='col-md-4'>";
					$html .= "<a href='#' onclick='openViewDeleteEnvImage(".$envIMage->env_image_id."); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
					$html .= "<img class='img-thumbnail' style='width: 140px;' src='".url('/')."/assets/images/".$envIMage->url_image."'>";
					$html .= "</div>";
					$html .= "</div>";
					$colum=0;
				}else{
					$html .= "<div class='col-md-4'>";
					$html .= "<a href='#' onclick='openViewDeleteEnvImage(".$envIMage->env_image_id."); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
					$html .= "<img class='img-thumbnail' style='width: 140px;' src='".url('/')."/assets/images/".$envIMage->url_image."'>";
					$html .= "</div>";
					$colum++;
				}
			}
		}

		return $html;
	}

	public static function getDiasRetrazadosContratoMes(){
		$enviroments1 = Contract::getAllContractMonthVigente();

		$env_late = array();
		foreach($enviroments1 as $env){
			//echo $env->code.'; ';
			$dataPaymentMonth = Contract::getDataPaymentMonth ( $env->env_id );
			$lastPaymentM = PaymentM::getMaxPaymentByContractId ( $dataPaymentMonth->rental_m_id );
			$fee = "0";

			$dateNow = new \DateTime ();
			if (isset ( $lastPaymentM )) {
				$dateAux = new \DateTime ( $lastPaymentM->date_end );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = Utils::diffdates( $lastPaymentM->date_end );
			} else {
				$dateAux = new \DateTime ( $dataPaymentMonth->date_admission );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = Utils::diffdates ( $dataPaymentMonth->date_admission );
			}

			if($fee > 0){
				array_push($env_late, array('env_id' => $env->env_id, 'code' => $env->code, 'rental_m_id' => $env->rental_m_id, 'fee' => $fee));
			}
		}


		return $env_late;
	}

	public static function getDiasRetrazadosContratoAnti(){
		$enviroments1 = Contract::getAllContractAntiVigente();

		$env_late = array();
		foreach($enviroments1 as $env){
			//echo $env->code.'; ';
			$dataPaymentAnti = Contract::getDataPaymentAnti( $env->env_id );

			$lastPaymentA = PaymentA::getMaxPaymentByContractId( $dataPaymentAnti->ra_id );
			$fee = "0";

			$dateNow = new \DateTime ();
			if (isset ( $lastPaymentA )) {
				$dateAux = new \DateTime ( $lastPaymentA->date_end );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = Utils::diffdates( $lastPaymentA->date_end );
			} else {
				$dateAux = new \DateTime ( $dataPaymentAnti->date_admission );
				if ($dateNow < $dateAux) {
					$dateNow = $dateAux;
				}
				$fee = Utils::diffdates ( $dataPaymentAnti->date_admission );
			}

			if($fee > 0){
				array_push($env_late, array('env_id' => $env->env_id, 'code' => $env->code, 'rental_a_id' => $env->anticrisis_id, 'fee' => $fee));
			}
		}


		return $env_late;
	}

	public static function diffdates($date_2) {
		$date = new \DateTime ();
		$date2 = new \DateTime ( $date_2 );
		$date2->modify ( '+6 day' );
		if ($date <= $date2) {
			return 0;
		} else {
			$interval = $date->diff ( $date2 ); // Restamos la Fecha1 menos la Fecha2
			$seg = $date->getTimestamp () - $date2->getTimestamp ();

			// return $interval->d;
			return floor ( $seg / (60 * 60 * 24) );
		}
	}
}