<?php

namespace Devio\Eavquent\Attribute;

class Repository
{
    public $model;

    public function __construct()
    {
        $modelClass = config('eavquent.attribute_model');
        $this->model = new $modelClass;
    }

    /**
     * Will return all attributes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }
}
