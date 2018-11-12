<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CustomResetPassword;
use App\Notifications\WelcomeEmail;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'workshop_id',
        'client_id',
        'role',
        'first_name',
        'last_name',
        'username',
        'pic_url',
        'gender',
        'identification',
        'birth_date',
        'cellphone_number',
        'homephone_number',
        'email',
        'password',
        'verified',
        'language',
        'status'
    ];

    protected $dates = ['birth_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function hasRole($role)
    {
        if (is_array($role)) {
            return in_array($this->attributes['role'], $role);
        }

        return $this->attributes['role'] == $role;
    }

    public function isAdministrator()
    {
        return $this->attributes['role'] == 'admin';
    }

    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function allowChangeState()
    {
        return (in_array($this->attributes['role'], ['manager','admin','analist','workshop']));
    }

    public function allowDeleteState()
    {
        return (in_array($this->attributes['role'], ['manager','admin','analist']));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function sendWelcomeEmail($username, $password)
    {
        $config_email = EmailTemplate::with(['country'])->where('code','welcome')->byCountry($this->country_id)->first();
                        $data['username'] = $username;
                        $data['password'] = $password;
                        $data['message_email'] = $config_email->body_message;
        $this->notify(new WelcomeEmail($data));
    }
}
