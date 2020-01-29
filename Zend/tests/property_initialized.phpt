--TEST--
--FILE--
<?php

class Foo {
    private int $foo;

    public function propertyInitialized($name): bool
    {
        if (property_exists($this, $name)) {
             try {
                 return $this->$name === null || $this->$name !== null;
             } Catch(Error $e) {
                 return false;
             }
        } else {
            return false;
        }
    }
}

$s = microtime(true);
$foo = new Foo();
for ($i = 0; $i < 10000; $i++) {
    $foo->propertyInitialized('foo');
}

echo number_format(microtime(true) - $s, 6) . "\n";

$s = microtime(true);
$foo = new Foo();
for ($i = 0; $i < 10000; $i++) {
    property_initialized($foo, 'foo');
}

echo number_format(microtime(true) - $s, 6) . "\n";

?>
--EXPECTF--
