<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = "clients";
    
    protected $fillable = [
        'name',
        'description',
        'contact_name',
        'contact_email',
        'contact_phone',
    ];

    /**
     * Get the cost type for this cost.
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * Get the project this cost belongs to.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Projects\Project');
    }

}
