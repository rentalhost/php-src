--TEST--
Reserved keywords can be used with named parameters
--FILE--
<?php

function test($array) {
    var_dump($array);
}

test(array => []);

?>
--EXPECTF--
Fatal error: Uncaught Error: Unknown named parameter $=> in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
