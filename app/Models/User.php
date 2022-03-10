<?php

namespace App\Models;

use App\Controllers\UserPreferencesController;
use App\Models\BookAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Date\Date;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

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
        'firstname',
        'lastname',
        'phone_number',
        'address',
        'email',
        'password',
        'password_confirmation',
        'country_id',
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
        'country_code',
        'currency_code'
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

    public function getCountryCodeAttribute($value){
        if($this->country_id !=null){
            $country = Country::find($this->country_id);
            return $country->code;
        }
        return 'ET'; //default
    }

    public function getCurrencyCodeAttribute($value){
        if($this->country_id !=null){
            $country = Country::find($this->country_id);
            return $country->currency_code;
        }
        return 'ETB'; //default
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
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

    /**
     * Get the country that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * all gize_channels super admin can manage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function all_gize_channels()
    {
        if (!$this->hasRole('super-admin')) {
            return collect([]);
        };
        return GizeChannel::all();
    }

    public function renderedNotificationDropdownData($dropdown_state = false)
    {
        $user = $this;
        $user_unreadNotifications = $user->unreadNotifications->all();

        $notification_count = count($user_unreadNotifications);

        $renderd_data = '';

        $renderd_data .= '<a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        ' . (($notification_count != 0) ? '<span class="animate__animated animate__rubberBand badge badge-warning navbar-badge">' . $notification_count . '</span>' : '') . '
      </a>';
        $show_hide = ($dropdown_state == true) ? '' : '';
        $renderd_data .= '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ' . $show_hide . '">';

        if ($notification_count > 0) {
            $renderd_data .= '<span class="dropdown-item dropdown-header ">'. trans_choice(  'notifications',  $notification_count, ['count' => $notification_count ]) . '';
            $renderd_data .= '<span class="float-right position-relative "><button class="btn btn-xs btn-mark-all btn-outline-secondary align-right"><i class="fa fa-check"></i> '. __('Read All') .'</button></span></span>';
            $renderd_data .= '<div class="scroll scroll4" style="max-height:185px; overflow: hidden; overflow-y: scroll;">';

            for ($i = 0; $i < $notification_count; $i++) {

                $notification = $user->unreadNotifications[$i];

                $type = isset($notification->data['type'])?$notification->data['type']:'';
                $link = isset($notification->data['link'])?$notification->data['link']:'';
                $user_name = isset($notification->data['user_name'])?$notification->data['user_name']:'';
                $message = isset($notification->data['message'])?$notification->data['message']:'';
                $user_id  = isset($notification->data['user_id'])?$notification->data['user_id']:'';
                $channelvideo_id = isset($notification->data['channelvideo_id'])?$notification->data['channelvideo_id']:'';
                $video_title = isset($notification->data['video_title'])?$notification->data['video_title']:'';
                $video_thumb_image = isset($notification->data['video_thumb_image'])?$notification->data['video_thumb_image']:'';
                $video_available_from = isset($notification->data['video_available_from'])?$notification->data['video_available_from']:'';
                $video_available_until = isset($notification->data['video_available_until'])?$notification->data['video_available_until']:'';
                $batch_id = isset($notification->data['batch_id'])?$notification->data['batch_id']:'';
                $batch_name = isset($notification->data['batch_name'])?$notification->data['batch_name']:'';
                $gize_channel_id = isset($notification->data['gize_channel_id'])?$notification->data['gize_channel_id']:'';
                $gize_channel_name = isset($notification->data['gize_channel_name'])?$notification->data['gize_channel_name']:'';


                if ($type == "user_welcome") {
                    $notification_item_user_id = $notification->data['user_id'];
                    $message = __('Hello') . ' ' . $user_name. __(', Welcome.');

                    $notification_item_user_data = User::find($notification_item_user_id);

                    $renderd_data .= '<div class="dropdown-divider"></div>
                        <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img style="width:45px;" src="' . $notification_item_user_data->profile_photo_url . '" alt="User Avatar" class="img-size-30 img-circle mr-2">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ' . 'Welcome' . '
                                </h3>
                                <p class="text-sm">' . $message . '</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' . Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() . '</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right"><button notification_id = "' . $notification->id . '" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> '.__('Read').'</button></span>

                        </div>
                        <!-- Message End -->
                    </span>';
                } elseif ($type == "admin_user_account") {
                    $notification_item_user_id = $notification->data['user_id'];
                    $message = $user_name . ' ' . __('has just registered.');

                    $notification_item_user_data = User::find($notification_item_user_id);

                    $renderd_data .= '<div class="dropdown-divider"></div>
                        <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fa fa-envelope p-2 mr-2" style="font-size: 30px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ' . __('New User') . '
                                </h3>
                                <p class="text-sm">' . $message .'</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' . Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() . '</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right">
                                '. ( $link !='' ? '
                                    <a notification_id = "' . $notification->id . '" href="'.$link.'" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-eye"></i> '.__('View').'</a>' : '').'
                                <button notification_id = "' . $notification->id . '" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> '.__('Read').'</button>
                            </span>
                        </div>
                        <!-- Message End -->
                    </span>';
                }  elseif ($type == "admin_user_account_updated") {
                    $notification_item_user_id = $notification->data['user_id'];
                    $message = $user_name.' '.__('has updated user details.');

                    $notification_item_user_data = User::find($notification_item_user_id);

                    $renderd_data .= '<div class="dropdown-divider"></div>
                        <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fa fa-envelope p-2 mr-2" style="font-size: 30px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ' . __('Account Update') . '
                                </h3>
                                <p class="text-sm">' . $message . '</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' . Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() . '</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right">
                                '.( $link !='' ? '
                                    <a notification_id = "' . $notification->id . '" href="'.$link.'" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-eye"></i> '.__('View').'</a>' : '').'
                                <button notification_id = "' . $notification->id . '" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> '.__('Read').'</button>
                            </span>
                        </div>
                        <!-- Message End -->
                    </span>';
                }  elseif ($type == "user_user_account_updated") {
                    $notification_item_user_id = $notification->data['user_id'];
                    $message = __('Your Account Details updated successfully.');

                    $notification_item_user_data = User::find($notification_item_user_id);

                    $renderd_data .= '<div class="dropdown-divider"></div>
                        <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fa fa-envelope p-2 mr-2" style="font-size: 30px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ' . __('Account Update') . '
                                </h3>
                                <p class="text-sm">'. $message .'</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' . Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() . '</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right"><button notification_id = "' . $notification->id . '" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> '.__('Read').'</button></span>

                        </div>
                        <!-- Message End -->
                    </span>';
                } elseif ($type == "admin_batch_streaming") {
                    $notification_item_user_id = $notification->data['user_id'];
                    $notification_item_user_data = User::find($notification_item_user_id);


                    $renderd_data .= '<div class="dropdown-divider"></div>
                        <span class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fa fa-calendar p-2 mr-2" style="font-size: 30px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ' . __('Scheduled Video Now Available') . ' - ' . $gize_channel_name . '
                                </h3>


                                <p class="text-sm">' . $video_title . '</p>
                                <p class="text-sm">' . $video_title . '</p>
                                <p class="text-sm">'. __('Available From') . ': ' . ($video_available_from!=''?Date::createFromFormat('Y-m-d H:i:s', $video_available_from):'') . '</p>
                                <p class="text-sm">'. __('Until') . ': ' . ($video_available_until!=''?Date::createFromFormat('Y-m-d H:i:s', $video_available_until):'') . '</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' . Date::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() . '</p>
                            </div>
                            <span class="mark-read mt-1 align-middle float-right"><button notification_id = "' . $notification->id . '" class="btn btn-xs btn-mark-read btn-outline-secondary align-right"><i class="fa fa-check"></i> '.__('Read').'</button></span>

                        </div>
                        <!-- Message End -->
                    </span>';
                }
                else {

                    $renderd_data .= '<span class="dropdown-header">There are no Notifications</span>
                        <div class="dropdown-divider"></div>';
                }

            }
            $renderd_data .= '</div>';

        } else {
            $renderd_data .= '
                    <span class="dropdown-item dropdown-footer">'. trans_choice(  'notifications',  $notification_count, ['count' => $notification_count ]) .'</span>
                </div>';

        }

        // $renderd_data .= '<div class="dropdown-divider"></div>
        //     <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        // </div>';

        return $renderd_data;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'firstname', 'lastname', 'phone_number'])
            ->logFillable()
            ->logOnlyDirty();
        // ->dontLogIfAttributesChangedOnly(['password']);
    }

    public function availablePackages(){
        $user_gize_packages = UserGizePackage::where('user_id', $this->id)->get();

        $now = \Carbon\Carbon::now();


        $available_packages = collect([]);

        //filter active , not-expired
        foreach($user_gize_packages as $package){

            $gize_package_month = GizePackage::where('id', $package->gize_package_id)->value('months');
            $months = $gize_package_month;
            $start_date = $package->start_date;
            $package->expires_at = Date::createFromFormat('Y-m-d H:i:s', $package->start_date)->addMonths($months)->addDays($package->extended_days)->setTimezone(\Config::get('app.timezone'))->diffForHumans();
            $package->expires_at_formated = Date::createFromFormat('Y-m-d H:i:s', $package->start_date)->addMonths($months)->addDays($package->extended_days)->setTimezone(\Config::get('app.timezone'))->format('M d, Y (D)');

            $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addMonths($months)->addDays($package->extended_days);

            $check = $now->between($start_date, $end_date);

            if ($check) {
                $package->status = 1; //active
            }
            else {
                $package->status = 0; //expired
            }

            if($package->gize_package->active && $package->status){
                $available_packages = $available_packages->add($package);
            }
        }

        return response()->json($available_packages);

    }

    // public function setProfilePhotoUrlAttribute()
    // {
    //     return substr($this->firstname, 0, 1).substr($this->lastname, 0, 1).'.png';

    //     if($this->profile_photo_path!=null){
    //         return $this->profile_photo_path;
    //     }

    //     return substr($this->firstname, 0, 1).substr($this->lastname, 0, 1).'.png';
    // }

    // public function setNameAttribute()
    // {
    //     return $this->firstname.' '.$this->lastname;
    // }
    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function setFullNameFirstCharsAttribute()
    {
        return substr($this->firstname, 0, 1) . ' ' . substr($this->lastname, 0, 1);
    }
    public function getFullNameFirstCharsAttribute()
    {
        return substr($this->firstname, 0, 1) . ' ' . substr($this->lastname, 0, 1);
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
            ->as('subscription')
            ->withTimestamps();
    }

    public function changeLanguagePreference($lang)
    {

        return UserPreferencesController::changeLanguagePreference($this->id, $lang);

    }

    public function changeThemePreference($theme)
    {

        return UserPreferencesController::changeThemePreference($this->id, $theme);

    }

    /**
     * The channelvideos that belong to the ChannelvideoRental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function channelvideos($status = null)
    {
        if ($status != null) { //started_watching, completed..
            //0 - filter rentals user not watched
            //1 - filter rentals user started watching
            //2 - filter rentals user completed watching
            return $this->belongsToMany(Channelvideo::class, 'channelvideo_rentals', 'user_id', 'channelvideo_id')
                ->withPivot('id', 'status', 'within_days', 'for_hours', 'started_at', 'published_at')
                ->wherePivot('status', $status)
                ->as('rental_detail')
                ->withTimestamps();
        }

        return $this->belongsToMany(Channelvideo::class, 'channelvideo_rentals', 'user_id', 'channelvideo_id')
            ->withPivot('id', 'status', 'within_days', 'for_hours', 'started_at', 'published_at')
            ->as('rental_detail')
            ->withTimestamps();
    }

    /*
     * This function is used to validate rental video streaming
     */

    public function isWatchingActiveRentalVideo($channelvideo_id)
    {
        return true;
        // if($user->hasRole('super-admin')){
        //     return true;
        // }
        // elseif($this->users()->get()->contains($user) && $user->hasRole('channel-admin')){
        //     return true;
        // }
        return false; //or abort(403);
    }

    /**
     * The batch_channelvideos that belong to the BatchChannelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function batch_channelvideos()
    {
        return $this->belongsToMany(BatchChannelvideo::class, 'batch_video_activity', 'user_id', 'batch_channelvideo_id')
            ->withPivot([
                'status',
                'started_at',
                'ip_address',
                'user_agent',
                'view_count'
            ])
            ->withTimestamps();
    }

    /**
     * The gize_packages that belong to the GizePackage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function gize_packages()
    {
        return $this->belongsToMany(User::class, 'user_gize_package', 'user_id', 'gize_package_id')
            ->withPivot([
                'user_id',
                'gize_package_id',
                'unit_values_balance',
                'start_date',
                'payment_method',
            ])
            ->withTimestamps();
    }

}
