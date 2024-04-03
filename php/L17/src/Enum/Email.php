<?php

namespace ssnd\Enum;

use ssnd\Validator\EmailValidator;

class Email
{
    /**
     * @var string
     */
    private string $email;
    
    private EmailValidator $validator;
    
    /**
     * @param string $email
     * @param bool $checkMX
     */
    public function __construct(string $email, bool $checkMX = false)
    {
        $this->validator = new EmailValidator();
        
        if ($this->validator->validate($email) === false) {
            throw new InvalidArgumentException('Invalid email address ' . $email);
        }
        
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
    
    public function get(): string
    {
        return $this->email;
    }
    
    public function getName(): string
    {
        return explode('@',$this->email)[0];
    }
    
    public function getDomain(): string
    {
        return explode('@',$this->email)[1];
    }
}