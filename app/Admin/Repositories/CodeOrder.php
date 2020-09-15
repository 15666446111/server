<?php

namespace App\Admin\Repositories;

use App\CodeOrder as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CodeOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
