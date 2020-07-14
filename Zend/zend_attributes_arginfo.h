/* This is a generated file, edit the .stub.php file instead.
 * Stub hash: 59e49a64d9ef3814513d84094652742261f94468 */

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_Attribute___construct, 0, 0, 0)
	ZEND_ARG_TYPE_INFO_WITH_DEFAULT_VALUE(0, flags, IS_LONG, 0, "Attribute::TARGET_ALL")
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_NameAlias___construct, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, alias, IS_STRING, 0)
ZEND_END_ARG_INFO()


ZEND_METHOD(Attribute, __construct);
ZEND_METHOD(NameAlias, __construct);


static const zend_function_entry class_Attribute_methods[] = {
	ZEND_ME(Attribute, __construct, arginfo_class_Attribute___construct, ZEND_ACC_PUBLIC)
	ZEND_FE_END
};


static const zend_function_entry class_NameAlias_methods[] = {
	ZEND_ME(NameAlias, __construct, arginfo_class_NameAlias___construct, ZEND_ACC_PUBLIC)
	ZEND_FE_END
};
