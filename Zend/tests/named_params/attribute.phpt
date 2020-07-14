--TEST--
NameAlias Attribute
--FILE--
<?php

function test(<<NameAlias("bar")>> $foo) {
    echo $foo;
}

test(bar: "Hello World");
--EXPECT--
Hello World
