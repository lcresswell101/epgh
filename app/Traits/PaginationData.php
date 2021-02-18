<?php

namespace App\Traits;

trait PaginationData
{
    protected $pagination_data;

    public function setPaginationData($data)
    {
        $this->pagination_data = new \stdClass();

        $this->pagination_data->per_page = $data->perPage();
        $this->pagination_data->last_page = $data->lastPage();
        $this->pagination_data->total = $data->total();
        $this->pagination_data->current_page = $data->currentPage();
        $this->pagination_data->posts_per_page = env('POSTS_PER_PAGE');
    }

    public function getPaginationData()
    {
        return $this->pagination_data;
    }
}
