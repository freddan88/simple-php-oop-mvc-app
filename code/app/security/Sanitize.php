<?php

declare(strict_types=1);

class Sanitize {

    // Documentation: https://www.php.net/manual/en/filter.filters.sanitize.php

    public function sanitizeString($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_STRING, $options));
    }

    public function sanitizeNumber($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_NUMBER_INT));
    }

    public function sanitizeNumberFloat($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_NUMBER_FLOAT, $options));
    }

    public function sanitizeEmail($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_EMAIL));
    }

    public function sanitizeUrl($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_URL));
    }

    public function sanitizeUnsafe($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_UNSAFE_RAW, $options));
    }
}