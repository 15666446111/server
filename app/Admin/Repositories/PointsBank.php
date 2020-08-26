<?php

namespace App\Admin\Repositories;

use App\PointsBank as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PointsBank extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
