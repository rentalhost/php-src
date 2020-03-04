--TEST--
Redclare attribute errors
--FILE--
<?php

<<A>>
<<A>>
function foo() {}
--EXPECTF--
Fatal error: Redeclared attribute A in %s on line %d
