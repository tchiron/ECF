<?php

namespace App\Service;

use App\Entity\User;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordHash
 *
 * @author Thibaut
 */
class PasswordHash {
    
    private $passwordEncoder;

    public function __construct(\Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function hash(User $user) {
        return $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $user->getPassword()   
        ));
    }
}
