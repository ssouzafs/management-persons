<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guarded = 'admin';

    protected $fillable = [
        'name',
        'email',
        'active'
    ];

    /**
     * Retorna a data de criação já formatada no padrão brasileiro
     * @return false|string
     */
    public function getCreatedAtAttribute()
    {
        return date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    /**
     * Retorna a última atualização já formatada no padrão brasileiro
     * @return false|string
     */
    public function getUpdatedAtAttribute()
    {
        return date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**
     * @param $value
     * @return void
     */
    public function setActiveAttribute($value)
    {
        if ($value === 'on' || $value === true) {
            $this->attributes['active'] = true;
        } else {
            $this->attributes['active'] = false;
        }
    }

    /**
     * Verificar se usuário está ativo
     * @return bool
     */
    public function isActive()
    {
        return $this->attributes['active'] === true;
    }

    /**
     * Mostrar situação
     * @return string
     */
    public function status()
    {
        if ($this->isActive()) {
            return 'Ativo';
        }
        return 'Inativo';
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeQtdeActive($query)
    {
        return $query->where('active', true)->get()->count();
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeQtdeInactive($query)
    {
        return $query->where('active', false)->get()->count();
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function scopeTotal($query)
    {
        return $query->get()->count();
    }
}
