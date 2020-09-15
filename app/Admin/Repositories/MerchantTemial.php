<?php

namespace App\Admin\Repositories;

use App\MerchantTemial as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MerchantTemial extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
