<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);


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


