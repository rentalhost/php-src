--TEST--
attributes: docblocks
--FILE--
<?php

/** foo */
<<Foo>>
/** Bar */
class Baz
{
}

/** foo */
<<Foo>>
class Boing
{
}

$reflection = new ReflectionClass(Baz::class);
var_dump(count($reflection->getAttributes()));
var_dump($reflection->getDocComment());

$reflection = new ReflectionClass(Boing::class);
var_dump(count($reflection->getAttributes()));
var_dump($reflection->getDocComment());

--EXPECTF--
int(0)
string(10) "/** Bar */"
int(1)
string(10) "/** foo */"
