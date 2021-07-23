<?php

namespace App\Models;

use App\Models\BookAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const DEFAULT_USER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'email', 'password', 'password_confirmation', 'lastname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'name',
        'full_name_first_chars',
    ];

    protected $dispatchesEvents = [
        'created' => \App\Events\UserCreatedEvent::class,
    ];

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
        // self::created(function (User $user) {
        // });
    }

    // public function setProfilePhotoUrlAttribute()
    // {
    //     return substr($this->firstname, 0, 1).substr($this->lastname, 0, 1).'.png';

    //     if($this->profile_photo_path!=null){
    //         return $this->profile_photo_path;
    //     }

    //     return substr($this->firstname, 0, 1).substr($this->lastname, 0, 1).'.png';
    // }


    public function setNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }
    public function getNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }


    public function setFullNameFirstCharsAttribute()
    {
        return substr($this->firstname, 0, 1).' '.substr($this->lastname, 0, 1);
    }
    public function getFullNameFirstCharsAttribute()
    {
        return substr($this->firstname, 0, 1).' '.substr($this->lastname, 0, 1);
    }



    // protected function defaultProfilePhotoUrl()
    // {
    //     return 'https://ui-avatars.com/api/?name='.urlencode($this->full_name_first_chars).'&color=424242&background=fff3dd';
    // }


    // /**
    //  * Add a mutator to ensure hashed passwords
    //  */
    //  public function setPasswordAttribute($password)
    //  {
    //      $this->attributes['password'] = bcrypt($password);
    //  }

    public function setPasswordAttribute($value)
    {
        // if(isset($this->attributes['password']) && $this->attributes['password'] != ''){
            return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
        // }
        // return $value;
    }


    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    /**
     * Get all of the book_authors for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book_authors(): HasMany
    {
        return $this->hasMany(BookAuthor::class);
    }

    public function isSuperAdmin(): bool
    {
        // return $this->roles()->get()->contains(self::SUPER_ADMIN);
        return $this->hasRole('super-admin');
    }

    public function isAdmin(): bool
    {
        // return $this->roles()->get()->contains(self::ADMIN);
        return $this->hasRole('admin');
    }

    public function isDefaultUser(): bool
    {
        // return $this->roles()->get()->contains(self::DEFAULT_USER);
        return $this->hasRole('user');
    }

    public function fullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}
