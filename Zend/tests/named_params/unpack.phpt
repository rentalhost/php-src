--TEST--
Unpacking named parameters
--FILE--
<?php

function test($a, $b, $c) {
    echo "a = $a, b = $b, c = $c\n";
}

function test2($a = null, &$b = null) {
    $b++;
}

test(...['a' => 'a', 'b' => 'b', 'c' => 'c']);

test(...['a', 'b' => 'b', 'c' => 'c']);

try {
    test(...['a', 'b' => 'b', 'c']);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

try {
    test(...['a', 'a' => 'a']);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

$ary = ['b' => 0];
$ary2 = $ary;
test2(...$ary);
var_dump($ary, $ary2);

?>
--EXPECT--
a = a, b = b, c = c
a = a, b = b, c = c
Cannot use positional argument after named argument during unpacking
Named parameter $a overwrites previous argument
array(1) {
  ["b"]=>
  int(1)
}
array(1) {
  ["b"]=>
  int(0)
}
