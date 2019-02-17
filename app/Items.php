<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    /**
     * Field to be mass-assigned.
     *
     * @var array
     */
    protected $fillable = ['value', 'computer_id', 'is_checked'];
}
