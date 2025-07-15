<?php

use Illuminate\Support\Str;

if (!function_exists('get_initials')) {
    function get_initials(string $name): string
    {
        $nameArr = explode(' ', $name);

        $initials = array_map(function ($name) {
            return strtoupper(mb_substr($name, 0, 1));
        }, $nameArr);

        return implode('.', $initials);
    }

}

if (!function_exists('get_cpf_short')) {
    function get_cpf_short(string $cpf): string
    {
        $cpfClean = Str::replace(['.', '-'], '', $cpf);

        $cpfPart1 = Str::substr($cpfClean, '3', '3');
        $cpfPart2 = Str::substr($cpfClean, '6', '3');

        return 'XXX.' . $cpfPart1 . '.' . $cpfPart2 . '-XX';
    }
}
