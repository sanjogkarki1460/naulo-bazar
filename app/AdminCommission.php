<?php

namespace App;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class AdminCommission extends Model
{
    //
    protected $fillable = ['category_id', 'admin_commisson'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
