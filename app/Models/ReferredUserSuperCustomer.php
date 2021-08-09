<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferredUserSuperCustomer extends Model
{
    protected $fillable = ['user_id', 'links_id', 'status'];
}
