<?php


namespace Utilities;


class Validators
{
    /**
     * Valida si un valor está vacío
     */
    public static function IsEmpty($value): bool
    {
        return !isset($value) || trim((string)$value) === "";
    }
}



