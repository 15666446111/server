<?php

namespace App\Admin\Repositories;

use App\Mcc as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Mcc extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
