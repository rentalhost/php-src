--TEST--
Can use parameter names from proto methods (variadic behavior)
--FILE--
<?php

class A {
    public function method($a) {
        echo __METHOD__ . ": $a\n";
    }
}
class B extends A {
    public function method(...$args) {
        echo __METHOD__ . ": " . json_encode($args) . "\n";
    }
}
class C extends B {
    public function method($c = null, ...$args) {
        echo __METHOD__ . ": " . json_encode($c) . ", " . json_encode($args) . "\n";
    }
}
class D extends B {
    // #2 $a does not conflict with #1 $a because it has been shadowed variadically
    public function method($c = null, $a = null, ...$args) {
        echo __METHOD__ . ": " . json_encode($c) . ", " . json_encode($a)
           . ", " . json_encode($args) . "\n";
    }
}

(new B)->method(a: 42);
(new B)->method(b: 42);
echo "\n";
(new C)->method(a: 42);
(new C)->method(b: 42);
(new C)->method(c: 42);
echo "\n";
(new D)->method(a: 42);
(new D)->method(b: 42);
(new D)->method(c: 42);

?>
--EXPECT--
B::method: {"a":42}
B::method: {"b":42}

C::method: null, {"a":42}
C::method: null, {"b":42}
C::method: 42, []

D::method: null, 42, []
D::method: null, null, {"b":42}
D::method: 42, null, []
