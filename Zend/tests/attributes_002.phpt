--TEST--
Doctrine-like attributes usage
--FILE--
<?php
namespace Doctrine\ORM {

	class Entity {
		private $name;
		public function __construct($name) {
			$this->name = $name;
		}
	}

	function GetClassAttributes($class_name) {
		$reflClass = new \ReflectionClass($class_name);
		$attrs = $reflClass->getAttributes();
        $values = [];
		foreach ($attrs as $attribute) {
            $class = $attribute->getName();
			$values[$attribute->getName()] = new $class(...$attribute->getArguments());
		}
		return $values;
	}
}

namespace Doctrine\ORM\Mapping {
    class Entity {
        public $tableName;
        public $repository;

        public function __construct(array $values)
        {
            foreach ($values as $k => $v) {
                $this->$k = $v;
            }
        }
    }
}

namespace {
    use Doctrine\ORM\Mapping as ORM;

	<<ORM\Entity(["tableName" => "user", "repository" => UserRepository::class])>>
	class User {}

	var_dump(Doctrine\ORM\GetClassAttributes("User"));
}
?>
--EXPECT--
array(1) {
  ["Doctrine\ORM\Mapping\Entity"]=>
  object(Doctrine\ORM\Mapping\Entity)#3 (2) {
    ["tableName"]=>
    string(4) "user"
    ["repository"]=>
    string(14) "UserRepository"
  }
}
