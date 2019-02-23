<?php

namespace Nayourown;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $guarded = [];

    /**  Returns the user model of the owner of claim */
    public function owner()
    {
        return $this->belongsTo(User::class, 'claimant_id');
    }
}
