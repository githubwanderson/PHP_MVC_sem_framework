<?php

namespace app\helpers;

class inputHelper
{
    public static function filterCustum(int $inputType, string $fieldName, string $type = 'text'): ?string {
        $value = filter_input($inputType, $fieldName);
    
        if ($value === null || $value === false) {
            return null;
        }
    
        switch ($type) {
            case 'email':
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
    
            case 'url':
                $value = filter_var($value, FILTER_SANITIZE_URL);
                break;
    
            case 'text':
            default:
                $value = htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
                break;
        }
    
        return $value;      
    }
}