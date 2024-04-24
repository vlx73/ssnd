<?php

namespace l20\Validator;
/**
 *
 */
class EmailValidator
{
    /**
     * @var bool
     */
    private bool $checkMX;
    
    /**
     * @param bool $checkMX
     */
    public function __construct(bool $checkMX = false)
    {
        $this->checkMX = $checkMX;
    }
    
    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool
    {
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        
        if ($this->checkMX && $isValid) {
            $isValid = $this->checkMX($email);
        }
        
        return $isValid;
    }
    
    /**
     * @param string $email
     * @return bool
     */
    private function checkMX(string $email): bool
    {
        $domain = explode('@', $email)[1];
        return checkdnsrr($domain, 'MX');
    }
    
}