<?php

namespace App\Arcedi;

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
}