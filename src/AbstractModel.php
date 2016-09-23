<?php

namespace Delta\DeltaVerification;

use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model
{
    protected $connection = 'delta_verification';
}
