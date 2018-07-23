$re = '/^([^0-9-,.]{1,})([0-9-,.]{1,})([^0-9-,.]{1,}|)$/m';
$str = 'R$ -5.1234,09';

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
var_dump($matches);
