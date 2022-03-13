<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'city_id', 'id');
    }

    /**
     * @return mixed|string
     */
    public function getNameAttribute()
    {
        if (empty($this->attributes['name'])) {
            return 'Cliente ainda não Informou';
        }
        return $this->attributes['name'];
    }
}
