<?php


namespace Utilities;


class Site
{
    /**
     * Redirige a una página con mensaje (simple)
     */
    public static function redirectToWithMsg(string $url, string $message = ""): void
    {
        if (!empty($message)) {
            $_SESSION["flash_msg"] = $message;
        }
        header("Location: " . $url);
        exit();
    }
}


