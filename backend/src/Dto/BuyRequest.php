<?php

namespace App\Dto;



class BuyRequest
{
    /**
     * @Assert\NotBlank
     */
    public int $productId;
}