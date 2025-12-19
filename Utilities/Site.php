<?php

namespace Utilities;

class Site
{
   
    public static function redirectToWithMsg(string $url, string $message = ""): void
    {
        if (!empty($message)) {
            $_SESSION["flash_msg"] = $message;
        }
        header("Location: " . $url);
        exit();
    }
}
