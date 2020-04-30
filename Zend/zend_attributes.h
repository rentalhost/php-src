#ifndef ZEND_ATTRIBUTES_H
#define ZEND_ATTRIBUTES_H

#define ZEND_ATTRIBUTE_TARGET_CLASS			1
#define ZEND_ATTRIBUTE_TARGET_FUNCTION		2
#define ZEND_ATTRIBUTE_TARGET_METHOD		4
#define ZEND_ATTRIBUTE_TARGET_PROPERTY		8
#define ZEND_ATTRIBUTE_TARGET_CLASS_CONST	16
#define ZEND_ATTRIBUTE_TARGET_PARAMETER		32
#define ZEND_ATTRIBUTE_TARGET_ALL			63

zend_class_entry *zend_ce_php_attribute;
zend_class_entry *zend_ce_php_compiler_attribute;

typedef struct _zend_attribute {
	zend_string *name;
	zend_string *lcname;
	uint32_t offset;
	uint32_t argc;
	zval argv[1];
} zend_attribute;

static zend_always_inline zend_bool zend_has_attribute(HashTable *attributes, zend_string *name, uint32_t offset)
{
	if (attributes) {
		zend_attribute *attr;

		ZEND_HASH_FOREACH_PTR(attributes, attr) {
			if (attr->offset == offset && zend_string_equals(attr->lcname, name)) {
				return 1;
			}
		} ZEND_HASH_FOREACH_END();
	}

	return 0;
}

static zend_always_inline zend_bool zend_has_attribute_str(HashTable *attributes, const char *str, size_t len, uint32_t offset)
{
	zend_bool result = 0;

	if (attributes) {
		zend_string *name = zend_string_init(str, len, 0);
		result = zend_has_attribute(attributes, name, offset);
		zend_string_release(name);
	}

	return result;
}

typedef void (*zend_attributes_internal_validator)(zend_attribute *attr, int target);
HashTable zend_attributes_internal_validators;

void zend_compiler_attribute_register(zend_class_entry *ce, zend_attributes_internal_validator validator);
void zend_register_attribute_ce(void);
#endif
