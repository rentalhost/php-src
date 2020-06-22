--TEST--
Can use parameter names from proto methods
--FILE--
<?php

class A {
    public function method($a) {
        echo __METHOD__ . ": $a\n";
    }
}
class B extends A {
    public function method($b) {
        echo __METHOD__ . ": $b\n";
    }
}
class C extends B {
    public function method($c) {
        echo __METHOD__ . ": $c\n";
    }
}

(new B)->method(a: 42);
(new B)->method(b: 42);
(new C)->method(a: 42);
(new C)->method(b: 42);
(new C)->method(c: 42);
echo "\n";

interface I {
    public function method($i);
}
interface J {
    public function method($j);
}
interface K {
    public function method($k);
}
class D implements I, J, K {
    public function method($d) {
        echo __METHOD__ . ": $d\n";
    }
}

(new D)->method(i: 42);
(new D)->method(j: 42);
(new D)->method(k: 42);
(new D)->method(d: 42);

?>
--EXPECT--
B::method: 42
B::method: 42
C::method: 42
C::method: 42
C::method: 42

D::method: 42
D::method: 42
D::method: 42
D::method: 42
