<?php


namespace App\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function update(array $attributes): bool
    {
        return $this->model->update($attributes);
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function delete(): ?bool
    {
        return $this->model->delete();
    }


    /**
     * @param int $id
     * @return $this
     */
    public function find(int $id): BaseRepository
    {
        $this->model = $this->model->find($id);

        return $this;
    }

    /**
     * @param string $condition
     * @param string $operator
     * @param $value
     * @return $this
     */
    public function where(string $condition, string $operator, $value): BaseRepository
    {
        $this->model = $this->model->where($condition, $operator, $value);

        return $this;
    }

    /**
     * @param array $atts
     * @return mixed
     */
    public function get(array $atts = ['*'])
    {
        return $this->model->get($atts);
    }


    public function all()
    {
        return $this->model->all();
    }

    public function getPaginatedData($search, $order, $per_page, $data, $page)
    {
        $query = $this->model;

        if($search)
        {
            $query = $this->search($search);
        }

        $pagination = $query
            ->orderBy($order, 'DESC')
            ->paginate($per_page, $data, 'page', $page);

        $this->model->setPaginationData($pagination);

        $results = new \stdClass();

        $results->results = $pagination->all();

        $results->search = $search;

        $results->pagination_data = $this->model->getPaginationData();

        return $results;
    }

    public function search(string $search)
    {
        $searchable = $this->model->getSearchable();

        $query = $this->model->where($searchable[0], "like", "%$search%");

        array_shift($searchable);

        foreach ($searchable as $attribute)
        {
            $query = $query->orWhere($attribute, "like", "%$search%");
        }

        return $query;
    }

    public function syncModel(array $request)
    {
        $types = $request['options'];
        $types_ids = [];

        foreach ($types as $type)
        {
            if(!$this->model->where('id', $type['id'])->exists())
            {
                $this->model->create($type);
            }

            $types_ids[] = $type['id'];
        }

        $all_ids = $this->model->all()->pluck('id');

        foreach ($all_ids as $id)
        {
            if(!in_array($id, $types_ids))
            {
                $this->model->find($id)->delete();
            }
        }
    }
}
