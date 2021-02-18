<?php

namespace App\Traits;

trait isAdmin
{
    /**
     * @return bool
     */
    public function getAdminAttribute(): bool
    {
       return $this->roles()->where('name', 'admin')->exists();
    }
}
