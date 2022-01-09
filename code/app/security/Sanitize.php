<?php

declare(strict_types=1);

class Sanitize {

    // Documentation: https://www.php.net/manual/en/filter.filters.sanitize.php

    public function string($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_STRING, $options));
    }

    public function number($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_NUMBER_INT));
    }

    public function floatNumber($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_NUMBER_FLOAT, $options));
    }

    public function email($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_EMAIL));
    }

    public function url($inputData)
    {
        return trim(filter_var($inputData, FILTER_SANITIZE_URL));
    }

    public function unsafe($inputData, $options = [])
    {
        return trim(filter_var($inputData, FILTER_UNSAFE_RAW, $options));
    }
}