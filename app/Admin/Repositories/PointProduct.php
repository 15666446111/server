<?php

namespace App\Admin\Repositories;

use App\PointProduct as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PointProduct extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
