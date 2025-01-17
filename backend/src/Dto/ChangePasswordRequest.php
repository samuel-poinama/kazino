<?php

namespace App\Dto;



class ChangePasswordResquest
{
    /**
     * @Assert\NotBlank
     */
    public string $password;
}