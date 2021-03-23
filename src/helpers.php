<?php

if (!function_exists('isset_recursive')) {
    /**
     * Вложенная проверка существования ключей массива
     *
     * @param string|array  $keys
     * @param array         $array
     *
     * @return bool
     */
    function isset_recursive(string|array $keys, array $array): bool
    {
        if (is_array($keys) && count($keys) === 1) {
            $keys = array_pop($keys);
        }
        if (!is_array($keys)) {
            return isset($array[$keys]);
        }

        $key = array_shift($keys);

        return isset($array[$key]) && isset_recursive($keys, $array[$key]);
    }
}
