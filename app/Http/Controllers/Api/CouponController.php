<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CurrencyCollection;
use App\Models\Currency;

class CouponController extends Controller
{
    public function index()
    {
        return new CurrencyCollection(Currency::all());
    }
}
