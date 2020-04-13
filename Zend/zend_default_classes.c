/*
   +----------------------------------------------------------------------+
   | Zend Engine                                                          |
   +----------------------------------------------------------------------+
   | Copyright (c) Zend Technologies Ltd. (http://www.zend.com)           |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.00 of the Zend license,     |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.zend.com/license/2_00.txt.                                |
   | If you did not receive a copy of the Zend license and are unable to  |
   | obtain it through the world-wide-web, please send a note to          |
   | license@zend.com so we can mail you a copy immediately.              |
   +----------------------------------------------------------------------+
   | Authors: Sterling Hughes <sterling@php.net>                          |
   |          Marcus Boerger <helly@php.net>                              |
   +----------------------------------------------------------------------+
*/

#include "zend.h"
#include "zend_API.h"
#include "zend_attributes.h"
#include "zend_builtin_functions.h"
#include "zend_interfaces.h"
#include "zend_exceptions.h"
#include "zend_closures.h"
#include "zend_generators.h"
#include "zend_weakrefs.h"

void zend_attribute_validate_phpattribute(zval *attribute)
{
}

void zend_attribute_validate_phpcompilerattribute(zval *attribute)
{
	zend_error(E_COMPILE_ERROR, "The PhpCompilerAttribute can only be used by internal classes, use PhpAttribute instead");
}

static void zend_register_attribute_ce(void)
{
	zend_hash_init(&zend_attributes_internal_validators, 8, NULL, NULL, 1);

	zend_class_entry ce;
	zend_attributes_internal_validator cb;

	INIT_CLASS_ENTRY(ce, "PhpAttribute", NULL);
	zend_ce_php_attribute = zend_register_internal_class(&ce);
	zend_ce_php_attribute->ce_flags |= ZEND_ACC_FINAL;

	cb = zend_attribute_validate_phpattribute;
	zend_compiler_attribute_register(zend_ce_php_attribute, &cb);

	INIT_CLASS_ENTRY(ce, "PhpCompilerAttribute", NULL);
	zend_ce_php_compiler_attribute = zend_register_internal_class(&ce);
	zend_ce_php_compiler_attribute->ce_flags |= ZEND_ACC_FINAL;

	cb = zend_attribute_validate_phpcompilerattribute;
	zend_compiler_attribute_register(zend_ce_php_compiler_attribute, &cb);
}

ZEND_API void zend_register_default_classes(void)
{
	zend_register_interfaces();
	zend_register_default_exception();
	zend_register_iterator_wrapper();
	zend_register_closure_ce();
	zend_register_generator_ce();
	zend_register_weakref_ce();
	zend_register_attribute_ce();
}
