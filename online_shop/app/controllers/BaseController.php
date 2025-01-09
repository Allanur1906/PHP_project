<?php

class  BaseController {

    public function __construct()
    {
        var_dump($_SESSION);
    }

    /**su bolum din e sql injection ucin
     * Anti-XSS Sanitization
     * Recursively sanitizes incoming data to make it safe for HTML output.
     * @param mixed $data Input data (string or array)
     * @return mixed Sanitized data
     */
    public static function xss($data)
    {
        if (is_array($data)) {
            $sanitized = [];
            foreach ($data as $key => $value) {
                $sanitized[$key] = self::xss($value); // Recursive sanitization
            }
            return $sanitized;
        }

        // Directly sanitize scalar data
        return trim(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
    }



}