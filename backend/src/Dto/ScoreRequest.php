<?php

namespace App\Dto;



class ScoreRequest
{
    /**
     * @Assert\NotBlank
     */
    public string $points;
}