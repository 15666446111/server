<?php

namespace App\Admin\Repositories;

use App\MerchantsImport as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MerchantsImport extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
