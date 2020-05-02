--TEST--
<<Deprecated>> attribute compile errors
--FILE--
<?php

<<Deprecated(1234)>>
function test() {
}
--EXPECTF--
Fatal error: <<Deprecated>> first argument $message must be a string in %s
