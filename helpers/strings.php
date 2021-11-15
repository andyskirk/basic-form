<?php 
namespace helpers;
class strings {
	public static function cleanString($strString){
		return htmlspecialchars($strString);
	}
}