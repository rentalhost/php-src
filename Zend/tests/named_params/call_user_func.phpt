--TEST--
call_user_func() and friends with named parameters
--FILE--
<?php

$test = function($a = 'a', $b = 'b', $c = 'c') {
    echo "a = $a, b = $b, c = $c\n";
};
$test_variadic = function(...$args) {
    var_dump($args);
};
$test_ref = function(&$ref) {
    $ref++;
};

call_user_func($test, 'A', c: 'C');
call_user_func($test, c: 'C', a: 'A');
call_user_func($test, c: 'C');
call_user_func($test_variadic, 'A', c: 'C');
call_user_func($test_ref, ref: null);
var_dump(call_user_func('call_user_func', $test, c: 'D'));
var_dump(call_user_func('array_slice', [1, 2, 3, 4, 5], length: 2));
echo "\n";

$test->__invoke('A', c: 'C');
$test_variadic->__invoke('A', c: 'C');
$test->call(new class {}, 'A', c: 'C');
$test_variadic->call(new class {}, 'A', c: 'C');

?>
--EXPECTF--
a = A, b = b, c = C
a = A, b = b, c = C
a = a, b = b, c = C
array(2) {
  [0]=>
  string(1) "A"
  ["c"]=>
  string(1) "C"
}

Warning: {closure}(): Argument #1 ($ref) must be passed by reference, value given in %s on line %d
a = a, b = b, c = D
NULL
array(2) {
  [0]=>
  int(1)
  [1]=>
  int(2)
}

a = A, b = b, c = C
array(2) {
  [0]=>
  string(1) "A"
  ["c"]=>
  string(1) "C"
}
a = A, b = b, c = C
array(2) {
  [0]=>
  string(1) "A"
  ["c"]=>
  string(1) "C"
}
