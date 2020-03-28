<?php

namespace Core;

class Error
{

    public static function errorHandler($severity, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        }
    }

    public static function exceptionHandler($exception)
    {

        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (\App\Config::SHOW_ERROR) {
            echo "<h1>Fatal Error</h1>";
            echo "<p>Uncaught Exception " . get_class($exception) . "</p>";
            echo "<p>Message : " . $exception->getMessage()  . "</p>";
            echo "<p>Stack tree: <pre>" . $exception->getTraceAsString().
                "</pre></p>";
            echo "<p>Thrown in : " . $exception->getFile() . " on Line " .
                $exception->getLine() . "</p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "<h1>Fatal Error</h1>";
            $message .= "<p>Uncaught Exception " . get_class($exception) .
                        "</p>";
            $message .= "<p>Message : " . $exception->getMessage()  .
                        "</p>";
            $message .= "<p>Stack tree: <pre>" . $exception->getTraceAsString()
                         . "</pre></p>";
            $message .= "<p>Thrown in : " . $exception->getFile() . 
                        " on Line " .
            $exception->getLine() . "</p>";

            error_log($message);

            View::renderTemplate("$code.html");
        }
    }
}
