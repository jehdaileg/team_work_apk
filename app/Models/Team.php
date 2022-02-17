<?php

namespace App\Models;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function avatar()
    {
        return $this->morphOne(Photo::class, 'photo');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::lower($value);
    }




}
