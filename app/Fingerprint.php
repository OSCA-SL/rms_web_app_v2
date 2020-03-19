<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_system';
}
