<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralInfo extends Model
{
    public function referral(){
        return $this->belongsTo(Referral::class);
    }
}
