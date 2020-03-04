--TEST--
Redclare resolved attribute errors
--FILE--
<?php

use Test\Attr;

<<Attr>>
<<\Test\Attr>>
function foo() {}
--EXPECTF--
Fatal error: Redeclared attribute Test\Attr in %s on line %d
