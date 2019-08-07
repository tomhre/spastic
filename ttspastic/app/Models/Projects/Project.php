<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
        'client_id',
        'manager_id',
    ];

    /**
     * Get the project this cost belongs to.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client\Client');
    }

}
