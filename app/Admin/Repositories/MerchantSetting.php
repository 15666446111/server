<?php

namespace App\Admin\Repositories;

use App\MerchantSetting as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MerchantSetting extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
