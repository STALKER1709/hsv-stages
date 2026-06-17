<?php

namespace App\Support;

class WhatsAppLink
{
    public static function make(string $numero, string $message = ''): string
    {
        $numero = preg_replace('/[^0-9]/', '', $numero);

        $url = "https://wa.me/{$numero}";

        if ($message !== '') {
            $url .= '?text=' . rawurlencode($message);
        }

        return $url;
    }
}
