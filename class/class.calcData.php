<?php
class calcData{
	public static function dataDif($data1, $data2, $intervalo){
		switch($intervalo){
			case 'y':
				$Q = 86400*365;
			break;
			
			case 'm':
				$Q = 2592000;
			break;
			
			case 'd':
				$Q = 86400;
			break;
			
			case 'h':
				$Q = 3600;
			break;
			
			case 'n':
				$Q = 60;
			break;
			
			default :
				$Q = 1;
			break;			
			}
		return round((strtotime($data2) - strtotime($data1))/$Q);	
		}
	}
?>