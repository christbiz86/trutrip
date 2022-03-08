<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'origin',
        'destination',
        'type',
        'start_date',
        'end_date',
        'description',
        'users_id'
    ];

    public function users() {
        return $this->belongsToMany(User::Class);
    }

}
