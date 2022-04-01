<?php
namespace App\Exceptions;
use Exception;
use Throwable;

// Custom exception
class NotFoundException extends Exception {
    public function __contstruct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // public function error404 {
        // http_response_code(404);
    //     // require the layout and set $content to "Page Introuvable"
    // or require new views/error/404.php
    // }
}