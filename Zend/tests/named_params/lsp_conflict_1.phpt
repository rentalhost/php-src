--TEST--
Parameter name conflict: Direct inheritance conflict
--FILE--
<?php

class A {
    public function method($a, $b) {}
}
class B extends A {
    public function method($b, $a) {}
}

?>
--EXPECTF--
Fatal error: Parameter $a of B::method() at position #2 conflicts with parameter $a of A::method() at position #1 in %s on line %d
