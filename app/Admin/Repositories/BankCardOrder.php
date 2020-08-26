<?php

namespace App\Admin\Repositories;

use App\BankCardOrder as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BankCardOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
