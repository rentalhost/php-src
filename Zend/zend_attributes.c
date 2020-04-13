#include "zend.h"
#include "zend_API.h"
#include "zend_attributes.h"

void zend_attribute_validate_phpattribute(zval *attribute)
{
}

void zend_attribute_validate_phpcompilerattribute(zval *attribute)
{
	zend_error(E_COMPILE_ERROR, "The PhpCompilerAttribute can only be used by internal classes, use PhpAttribute instead");
}

void zend_register_attribute_ce(void)
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

void zend_compiler_attribute_register(zend_class_entry *ce, zend_attributes_internal_validator *validator)
{
	zend_string *attribute_name = zend_string_tolower_ex(ce->name, 1);

	zend_hash_update_mem(&zend_attributes_internal_validators, attribute_name, validator, sizeof(zend_attributes_internal_validator));
}
