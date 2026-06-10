<?php

namespace App\Contracts;

interface LabeledEnum
{
    public function label(): string;

    public function color(): string;
}
