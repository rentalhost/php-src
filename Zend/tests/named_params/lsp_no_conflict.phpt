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
echo "\n";

interface U {
    public function test($foo, $bar);
}
class V implements U {
    public function test($a, $b) {
        echo __METHOD__ . ": $a, $b\n";
    }
}

(new V)->test(a: "foo", b: "bar");
(new V)->test(foo: "foo", bar: "bar");
// Weird, but works:
(new V)->test(a: "foo", bar: "bar");
echo "\n";

trait T {
    abstract public function method($t);
}
class X {
    public function method($x) {
        echo __METHOD__ . ": $x\n";
    }
}
class Y extends X {
    use T;

    public function method($y) {
        echo __METHOD__ . ": $y\n";
    }
}

(new Y)->method(t: 42);
(new Y)->method(x: 42);
(new Y)->method(y: 42);
echo "\n";

// TODO: This case currently leaks.
/*trait T2 {
    public function method($t) {
        echo __METHOD__ . ": $t\n";
    }
}
class Z extends X {
    use T2;
}

(new Z)->method(x: 42);
(new Z)->method(t: 42);*/

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

V::test: foo, bar
V::test: foo, bar
V::test: foo, bar

Y::method: 42
Y::method: 42
Y::method: 42
