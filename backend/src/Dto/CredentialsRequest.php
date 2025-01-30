<?php

namespace App\Dto;



class CredentialsRequest
{
    /**
     * @Assert\NotBlank
     */
    public string $username;


    /**
     * @Assert/NotBlank
    */
    public string $password;
}