<?php

/** @generate-function-entries */

class ResourceBundle implements Traversable
{
    public function __construct(?string $locale, ?string $bundlename, bool $fallback = true) {}

    /**
     * @return ResourceBundle|null
     * @alias resourcebundle_create
     */
    public static function create(?string $locale, ?string $bundlename, bool $fallback = true) {}

    /**
     * @param string|int $index
     * @return mixed
     * @alias resourcebundle_get
     */
    public function get($index, bool $fallback = true) {}

    /**
     * @return int
     * @alias resourcebundle_count
     */
    public function count() {}

    /**
     * @return array|false
     * @alias resourcebundle_locales
     */
    public static function getLocales(string $bundlename) {}

    /**
     * @return int
     * @alias resourcebundle_get_error_code
     */
    public function getErrorCode() {}

    /**
     * @return string
     * @alias resourcebundle_get_error_message
     */
    public function getErrorMessage() {}
}
