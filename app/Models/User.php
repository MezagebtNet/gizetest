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
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Jenssegers\Date\Date;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use LogsActivity;

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
        'updated' => \App\Events\UserUpdatedEvent::class,
    ];

    protected static $logName = 'user_account';

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
        // self::created(function (User $user) {
        // });
    }

    /**
     * The gize_channels that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function gize_channels()
    {
        return $this->belongsToMany(GizeChannel::class, 'gize_channel_user', 'user_id', 'gize_channel_id');
    }


    public function renderedNotificationDropdownData($dropdown_state=false){
        $user = $this;
        $user_unreadNotifications = $user->unreadNotifications->all();

        $notification_count = count($user_unreadNotifications);

        $renderd_data = '';

        $renderd_data .= '<a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        '.(($notification_count!=0)?'<span class="badge badge-warning navbar-badge">'.$notification_count.'</span>':'').'
      </a>';
      $show_hide = ($dropdown_state==true)?'': '';
      $renderd_data .= '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right '.$show_hide.'">';

      if($notification_count > 0){
        $renderd_data .= '<span class="dropdown-item dropdown-header ">'.$notification_count.'  Notification'.(($notification_count==1)?'':'s').'';
        $renderd_data .= '<span class="float-right position-relative "><button class="btn btn-xs btn-mark-all btn-outline-secondary align-right"><i class="fa fa-check"></i> Read All</button></span></span>';
        for ($i=0; $i < $notification_count ; $i++) {

            $notification = $user->unreadNotifications[$i];
            $type = $notification->data['type'].' ';

            if(strcmp($type, "user_welcome") == 1){
                $notification_item_user_id = $notification->data['user_id'];

                $notification_item_user_data = User::find($notification_item_user_id);

                $renderd_data .= '<div class="dropdown-divider"></div>
                <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img style="width:45px;" src="'.$notification_item_user_data->profile_photo_url.'" alt="User Avatar" class="img-size-30 img-circle mr-2">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                '.'Welcome'.'
                                </h3>
                                <p class="text-sm">'.$notification->data['message'].'</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans().'</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right"><button notification_id = "'.$notification->id.'" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> Read</button></span>

                        </div>
                        <!-- Message End -->
                    </span>';
            }
            elseif(strcmp($type, "admin_user_account") == 1) {
                $notification_item_user_id = $notification->data['user_id'];

                $notification_item_user_data = User::find($notification_item_user_id);

                $renderd_data .= '<div class="dropdown-divider"></div>
                <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fa fa-envelope p-2 mr-2" style="font-size: 30px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                '.'New User'.'
                                </h3>
                                <p class="text-sm">'.$notification_item_user_data->name.' has created an account.</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans().'</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right"><button notification_id = "'.$notification->id.'" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> Read</button></span>

                        </div>
                        <!-- Message End -->
                    </span>';
            }
            else {
                $renderd_data .= '<span class="dropdown-header">There are no Notifications</span>
                <div class="dropdown-divider"></div>';
            }

        }
      }

        $renderd_data .= '<div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>';

      return $renderd_data;
    }


    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'firstname', 'lastname'])
            ->logFillable()
            ->logOnlyDirty();
            // ->dontLogIfAttributesChangedOnly(['password']);
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

    public function isSystemAdmin(): bool
    {
        // return $this->roles()->get()->contains(self::ADMIN);
        return $this->hasRole('system-admin');
    }

    public function isChannelAdmin(): bool
    {
        // return $this->roles()->get()->contains(self::ADMIN);
        return $this->hasRole('channel-admin');
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

    /**
     * The batches that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_user', 'user_id', 'batch_id')
        ->withPivot('approved', 'active')
        ->as ('subscription')
        ->withTimestamps();
    }

}
