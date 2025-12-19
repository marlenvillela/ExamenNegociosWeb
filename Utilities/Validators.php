<?php


namespace Utilities;


class Validators
{

    public static function IsEmpty($value): bool
    {
        return !isset($value) || trim((string)$value) === "";
    }
}



