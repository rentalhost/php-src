--TEST--
Check that __invoke() works with named parameters
--FILE--
<?php

class Test {
    public function __call(string $method, array $args) {
        $this->{'_'.$method}(...$args);
    }

    private function _method($a = 'a', $b = 'b') {
        echo "a: $a, b: $b\n";
    }
}

$test = new Test;
$test->method('A', 'B');
$test->method(a: 'A', b: 'B');

?>
--EXPECTF--
a: A, b: B

Fatal error: Uncaught Error: Unknown named parameter $a in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
