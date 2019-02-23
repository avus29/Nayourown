<?php

namespace Nayourown;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    
    /** Return string representation of the url path to this report */
    public function path()
    {
        return "/api/reports/{$this->category->slug}/{$this->id}";
    }

    /** Return the collection of claims associated with this Report */
    public function claims()
    {
        return $this->hasMany(Claim::class, 'report_id');
    }

    /** Return the User Model of the creator of a report */
    public function creator()
    {
        return $this->belongsTo(User::class,'finder_id');
    }

    /** Return the Category Model of the a report */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /** Add a claim to a report */
    public function addClaim($claim)
    {
        $this->claims()->create($claim);
    }
}
