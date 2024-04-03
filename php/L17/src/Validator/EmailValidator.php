<?php

namespace ssnd\Validator;
class EmailValidator
{
    private bool $checkMX;
    public function __construct(bool $checkMX = false)
    {
        $this->checkMX = $checkMX;
    }
    public function validate(string $email): bool
    {
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        
        if ($this->checkMX && $isValid) {
            $isValid = $this->checkMX($email);
        }
        
        return $isValid;
    }
    
    private function checkMX(): bool
    {
        $domain = explode('@', $email)[1];
        return checkdnsrr($domain, 'MX');
    }
    
}