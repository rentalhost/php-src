--TEST--
call_user_func() with named parameters
--FILE--
<?php

function test($a = 'a', $b = 'b') {
    var_dump($a, $b);
}

call_user_func('test', 'A', b: 'B');
call_user_func('test', b: 'B', a: 'A');
call_user_func('test', b: 'B');

?>
--EXPECT--
string(1) "A"
string(1) "B"
string(1) "A"
string(1) "B"
string(1) "a"
string(1) "B"
