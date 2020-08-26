<?php

namespace App\Admin\Repositories;

use App\BankCard as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BankCard extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
