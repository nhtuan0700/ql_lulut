<?php

if (!function_exists('formatCurrency')) {
    function formatCurrency($currency)
    {
        if ($currency) {
            return number_format($currency) . " đ";
        }
        return '0 đ';
    }
}