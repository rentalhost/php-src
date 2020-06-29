--TEST--
Behavior of call_user_func_array() with named parameters
--FILE--
<?php

function test($a, $b) {
    var_dump($a, $b);
}

// Keys are ignored by call_user_func_array().
// Use "..." if you want named params support!

call_user_func_array('test', [0 => 'a', 1 => 'b']);
call_user_func_array('test', [1 => 'a', 0 => 'b']);
call_user_func_array('test', ['b' => 'a', 'a' => 'b']);
call_user_func_array('test', ['c' => 'a', 'd' => 'b']);

?>
--EXPECT--
string(1) "a"
string(1) "b"
string(1) "a"
string(1) "b"
string(1) "a"
string(1) "b"
string(1) "a"
string(1) "b"
