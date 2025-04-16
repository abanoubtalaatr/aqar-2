<?php

namespace App\Services\Builders;

use App\Models\Ad;

// Here we are using Builder pattern to handle complex creation of object of model
interface AdBuilderInterface
{
    public function setCategory($categoryId): self;
    public function setAdData($request): self;
    public function createAdableEntity($request): self;
    public function create(): Ad;
}
