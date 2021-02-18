<?php

namespace App\Traits;

trait Actions
{
    public function getActions()
    {
        return $this->actions ?? [];
    }
}
