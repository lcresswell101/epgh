<?php

namespace App\Traits;

use stdClass;

trait Frontend
{
    private function getHiddenFrontend()
    {
        return $this->hidden_frontend ?? [];
    }

    private function getSortableFrontend()
    {
        return $this->sortable_frontend  ?? [];
    }

    private function getImagesFrontend()
    {
        return $this->images_frontend  ?? [];
    }

    private function getDatesFrontend()
    {
        return $this->dates_frontend  ?? [];
    }

    public function getAttributesFrontend()
    {
        $attributes = new stdClass();

        $attributes->hidden = $this->getHiddenFrontend();
        $attributes->sortable = $this->getSortableFrontend();
        $attributes->images = $this->getImagesFrontend();
        $attributes->dates = $this->getDatesFrontend();

        return $attributes;
    }
}
