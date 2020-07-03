--TEST--
Named params on internal functions: Variadic functions
--FILE--
<?php

array_merge([1, 2], a: [3, 4]);

?>
--EXPECT--

