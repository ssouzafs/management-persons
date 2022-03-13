<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = 'web';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'rg',
        'genre',
        'date_of_birth',
        'zipcode',
        'address',
        'neighborhood',
        'complement',
        'number',
        'cell_phone',
        'phone',
        'active'
    ];

    /**
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = convert_string_to_date($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setCellPhoneAttribute($value)
    {
        $this->attributes['cell_phone'] = get_clear_field($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = get_clear_field($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->first();
    }

    /**
     * @return string
     */
    public function getCellPhoneAttribute()
    {
        if (is_null($this->attributes['cell_phone'])) {
            return '';
        }
        $toFmt = $this->attributes['cell_phone'];
        $phone = '(' . substr($toFmt, 0, 2) . ') ' . substr($toFmt, 3, 1);
        $phone .= substr($toFmt, 3, 4) . '-' . substr($toFmt, 7, 4);
        return $phone;
    }

    /**
     * @return string
     */
    public function getPhoneAttribute()
    {
        if (empty($this->attributes['phone'])) {
            return '';
        }
        $toFmt = $this->attributes['phone'];
        $phone = '(' . substr($toFmt, 0, 2) . ') ' . substr($toFmt, 3, 1);
        $phone .= substr($toFmt, 3, 4) . '-' . substr($toFmt, 7, 4);
        return $phone;
    }

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

    /**
     * @return false|string
     */
    public function getDateOfBirthAttribute()
    {
        if (is_null($this->attributes['date_of_birth'])) {
            return null;
        }
        return date('d/m/Y', strtotime($this->attributes['date_of_birth']));
    }

    /**
     * @return string
     */
    public function getCpfAttribute()
    {
        if (empty($this->attributes['cpf'])) {
            return 'Documento não Informado!';
        }
        $toFmt = $this->attributes['cpf'];
        $document = substr($toFmt, 0, 3) . '.' . substr($toFmt, 3, 3) . '.';
        $document .= substr($toFmt, 6, 3) . '-' . substr($toFmt, 9, 2);
        return $document;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        switch ($this->attributes['genre']) {
            case 'female':
                return 'Feminino';
            case 'male':
                return 'Masculino';
            default:
                return 'Gênero não Informado';
        }
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
