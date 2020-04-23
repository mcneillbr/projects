<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);

if (!function_exists('dd')) {
 function dd()
  {
      echo '<pre>';
      array_map(function($x) { var_dump($x); }, func_get_args());
     echo '</pre>';
      die;
   }
 }


function strNormalize ($string) {
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'd'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'R'=>'R', 'r'=>'r',
        );
        $v = ($string);
        return strtr($v, $table);
    }


$parseMoneyToFloat = (function($value, $decimals = 2, $dec_point = '.' , $thousands_sep = ',') {

$re = '/^([^0-9-,.]{1,})([0-9-,.]{1,})([^0-9-,.]{1,}|)$/m';
$matches = array();

if(preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0)){
    $number = preg_replace('/[^0-9-]{1,}/', '', $matches[0][2]);
    $base = substr($number, 0, (strlen($number) - $decimals));
    $decValue = substr($number, (strlen($number) - $decimals), $decimals);
    // normalizae number
    //echo "number [$number], base [$base], dec [$decValue], \n";
    //echo "num $base.$decValue \n" . number_format("$base.$decValue", 2, '.', ',') . "\n\n"; 
    return floatval("$base.$decValue");
}
return 0.0;
});

echo $parseMoneyToFloat("R$ -555652,56");


htmlentities($item, ENT_COMPAT | ENT_HTML401, 'cp1252');


$re = '/^([^0-9-,.]{1,})([0-9-,.]{1,})([^0-9-,.]{1,}|)$/m';
$str = 'R$ -5.1234,09';

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
var_dump($matches);



/**
     * Aplicar utf8_encode a todos os elementos e níveis de um array.
     * @param mixed $array Array a ser processado
     * @return mixed Array com utf8_encode aplicado
     */
    private static function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'UTF-8', true)) {
                $item = (mb_convert_encoding($item, "UTF-8", mb_detect_encoding($item, "UTF-8, ISO-8859-1, ISO-8859-15, CP1251, CP1252", true)));
            }
        });
        return $array;
    }

$getJsonString = (function($subject) 
{
   $pattern = '/(^\{\".+\:.*:.+\"\})/mi';
   $matches = array();
   if(preg_match ($pattern, $subject, $matches, PREG_OFFSET_CAPTURE) === 1) {
      return $matches[1][0];
   }
   return $subject;
});



function json_parse($jsonString, $is_array = true) {

    $elm = @json_decode($jsonString, $is_array);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        return $elm;
    }

    throw new InvalidArgumentException(json_last_error_msg(), json_last_error());
}

function test_fail_json($str, $isArray = true) {
    try {
        print_r( json_parse($str, $isArray) );
    } catch (Exception $e) {
        print ("erro json \n code [{$e->getCode()}] \n message [{$e->getMessage()}]");
    }
}

