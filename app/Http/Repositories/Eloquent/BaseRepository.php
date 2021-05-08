<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 9.4.2021
 * Time: 15:50
 */

namespace App\Http\Repositories\Eloquent;

use App\Contracts\BaseInterface;
use App\Enums\v1\GlobalEnum;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    /**
     * @var Model
     */
    protected $model;
    protected $filters = [];
    protected $validFilterableFields;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->validFilterableFields = $this->model->filterableFields();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->paginate(GlobalEnum::PerPage);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    protected function applyFiltersToQuery($query)
    {
        foreach ($this->filters as $field => $value) {
            $query->where($field, $value);
        }
        return $query;
    }
}
