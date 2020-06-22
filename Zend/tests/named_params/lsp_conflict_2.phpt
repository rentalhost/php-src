--TEST--
Parameter name conflict: Indirect conflict between two interfaces
--FILE--
<?php

interface I {
    public function method($a, $b);
}
interface J {
    public function method($b, $a);
}
class C implements I, J {
    public function method($x, $y) {}
}

?>
--EXPECTF--
Fatal error: Parameter $b of C::method() at position #2 (inherited from a different prototype method) conflicts with parameter $b of J::method() at position #1 in %s on line %d
