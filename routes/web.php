<?php

use App\Http\Controllers\Admin\Channels\Batches\BatchController;
use App\Http\Controllers\Admin\Channels\Batches\BatchUserController;
use App\Http\Controllers\Admin\Channels\Channelvideos\ChannelvideoController;
use App\Http\Controllers\Admin\Channels\GizeChannelController;
// use App\Http\Controllers\Admin\Channels\GizeChannelController_;
use App\Http\Controllers\Admin\SystemConfigs\BookFormatController;
use App\Http\Controllers\Admin\SystemConfigs\BookGenreController;
use App\Http\Controllers\Admin\SystemConfigs\BookLanguageController;
use App\Http\Controllers\Admin\SystemConfigs\BookRoyaltyRateController;
use App\Http\Controllers\Admin\SystemConfigs\BookTypeController;
use App\Http\Controllers\Admin\Channels\Batches\BatchScheduleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserPreferencesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Utils\UploadController;
use App\Http\Controllers\Utils\FullCalendarController;
use App\Http\Controllers\Website\ChannelLandingPageController;
use App\Http\Controllers\Website\HomePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use ProtoneMedia\LaravelFFMpeg\Http\DynamicHLSPlaylist;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/{locale}', function ($locale) {
//     if (! in_array($locale, ['en', 'am'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     return view('website.home');

// });

// Route::redirect('/', '/en');




//ROUTE GROUP::LANGUAGE SELECTOR
// Route::group(['prefix' => '{language}'], function () {
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    //HOME
    Route::get('/', [HomePageController::class, 'index'])->name('home');




    //ROUTE GROUP::AUTH
    Route::group(['middleware' => 'auth'], function () {

        //CHANGE USER_LANGUAGE
        Route::get('/change-language/{user_id}/{lang}', [UserPreferencesController::class, 'changeLanguagePreference'])->name('changelanguage');

        //CHANGE USER_THEME
        Route::get('/change-theme/{user_id}/{theme}', [UserPreferencesController::class, 'changeThemePreference'])->name('changetheme');

        //USER PROFILE
        Route::get('/profile', function () {
            return view('profile.show');
        })->name('profile.show');





        //Route GROUP::WEBSITE Index page
        Route::group(['prefix' => 'web', 'middleware' => 'role:super-admin|user', 'as' => 'web.'], function () {

            //HOME
            Route::get('/', [HomePageController::class, 'index'])->name('home');

            //NOTIFICATIONS
            Route::post('/get-user-notifications/{dropdown_state?}', [UsersController::class, 'renderedNotificationDropdownData'])->name('rendernotifications');
            Route::post('/mark-user-notifications/{notification_id}/{dropdown_state?}', [UsersController::class, 'markNotificationAsRead'])->name('marknotification');
            Route::post('/markall-user-notifications/{dropdown_state?}', [UsersController::class, 'markAllNotificationAsRead'])->name('markallnotification');

        });




        //Route GROUP::VIDEOSTREAM
        Route::group(['prefix' => 'video', 'middleware' => 'role:super-admin|user|channel-admin|system-admin', 'as' => 'video.'], function () {

            Route::get('/gize_stream/{vid_id}/{playlist?}', 'App\Http\Controllers\Students\StudentVideoController@stream')->name('stream.playlist');

            Route::get('/{vid_id}/{playlist?}', function ( $vid_id, $playlist='plist.m3u8' ) {
                $DPL = new DynamicHLSPlaylist();
                return $DPL
                    ->fromDisk('public')
                    ->open('/hls/'.$vid_id.'/'.$playlist)
                    ->setKeyUrlResolver(function ($key) use($vid_id) {
                        return route('video.key', ['key' => $key, 'vid_id' => $vid_id]);
                    })
                    ->setMediaUrlResolver(function ($mediaFilename) use($vid_id) {
                        return Storage::disk('public')->url('/hls/'.$vid_id.'/'.$mediaFilename);
                    })
                    ->setPlaylistUrlResolver(function ($playlistFilename) use($vid_id) {
                        return route('video.playlist', ['vid_id' => $vid_id, 'playlist' => $playlistFilename]);
                    });
            })->name('playlist');

            Route::get('/key/{key}/{vid_id}', function($key, $vid_id) {
                abort_if(Auth::guest(), 403);
                return Storage::disk('hls_secrets')->download($vid_id.'/'.$key);
            })->name('key');
        });




        //Route GROUP::WEBSITE Channels Landing
        Route::group(['prefix' => 'channel', 'middleware' => 'role:super-admin|user', 'as' => 'channel.'], function () {

            Route::get('/{slug}', [ChannelLandingPageController::class, 'find_by_slug'])->name('landing');
            Route::get('/{slug}/active-videos', [ChannelLandidngPageController::class, 'getActiveChannelVideos'])->name('activevideos');



        });




        //ROUTE GROUP::SUPER-ADMIN
        Route::group(['prefix' => 'admin', 'middleware' => 'role:channel-admin|super-admin', 'as' => 'admin.'], function () {

            //DASHBOARD
            Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
            Route::post('/mark-as-read', [\App\Http\Controllers\Admin\HomeController::class, 'markNotification'])->name('markNotification');

            //NOTIFICATIONS
            Route::post('/get-user-notifications/{dropdown_state?}', [UsersController::class, 'renderedNotificationDropdownData'])->name('rendernotifications');
            Route::post('/mark-user-notifications/{notification_id}/{dropdown_state?}', [UsersController::class, 'markNotificationAsRead'])->name('marknotification');
            Route::post('/markall-user-notifications/{dropdown_state?}', [UsersController::class, 'markAllNotificationAsRead'])->name('markallnotification');

            //ROUTE GROUP::ADMIN/SYSTEM_CONFIGS
            Route::group(['prefix' => 'system_configs', 'as' => 'system_configs.'], function () {

                //BOOK_CURRENCIES
                Route::resource('currencies', \App\Http\Controllers\Admin\SystemConfigs\CurrencyController::class);
                // Route::resource('currency', \App\Http\Livewire\Currencies::class);
                // Route::resource('book_formats', \App\Http\Controllers\Admin\BookFormatController::class);

                //BOOK_FORMATS
                Route::group(['prefix' => 'book-formats', 'as' => 'bookformat.'], function () {
                    //Get All
                    Route::get('/', [BookFormatController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                    //add
                    Route::post('/book-format-add', [BookFormatController::class, 'addBookFormat'])->name('add');
                    //update
                    Route::post('/book-format-update', [BookFormatController::class, 'updateBookFormat'])->name('update');
                    //get
                    Route::get('/book-formats/{id}', [BookFormatController::class, 'getBookFormatById'])->name('get');
                    //delete
                    Route::delete('/book-formats/{id}', [BookFormatController::class, 'deleteBookFormat'])->name('delete');
                    //delete selected
                    Route::delete('/book-formats-del-selected', [BookFormatController::class, 'deleteCheckedBookFormats'])->name('deleteSelected');
                });

                //BOOK_LANGUAGES
                Route::group(['prefix' => 'book-languages', 'as' => 'booklanguage.'], function () {
                    //Get All
                    Route::get('/', [BookLanguageController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                    //add
                    Route::post('/book-language-add', [BookLanguageController::class, 'addBookLanguage'])->name('add');
                    //update
                    Route::post('/book-language-update', [BookLanguageController::class, 'updateBookLanguage'])->name('update');
                    //get
                    Route::get('/book-languages/{id}', [BookLanguageController::class, 'getBookLanguageById'])->name('get');
                    //delete
                    Route::delete('/book-languages/{id}', [BookLanguageController::class, 'deleteBookLanguage'])->name('delete');
                    //delete selected
                    Route::delete('/book-languages-del-selected', [BookLanguageController::class, 'deleteCheckedBookLanguages'])->name('deleteSelected');
                });

                //BOOK_TYPES
                Route::group(['prefix' => 'book-types', 'as' => 'booktype.'], function () {
                    //Get All
                    Route::get('/', [BookTypeController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                    //Detsils
                    Route::get('/details/{id}', [BookTypeController::class, 'showBookTypeDetails'])->name('details');
                    //add form
                    Route::get('/create', [BookTypeController::class, 'addBookTypeForm'])->name('addform');
                    //add
                    Route::post('/book-type-add', [BookTypeController::class, 'addBookType'])->name('add');
                    //edit form
                    Route::get('/edit/{id}', [BookTypeController::class, 'editBookTypeForm'])->name('editform');
                    //update
                    Route::post('/book-type-update', [BookTypeController::class, 'updateBookType'])->name('update');
                    //get
                    Route::get('/book-types/{id}', [BookTypeController::class, 'getBookTypeById'])->name('get');
                    //delete
                    Route::delete('/del/{id}', [BookTypeController::class, 'deleteBookType'])->name('delete');
                    //delete selected
                    Route::delete('/del-selected', [BookTypeController::class, 'deleteCheckedBookTypes'])->name('deleteSelected');
                });

                //BOOK_GENRES
                Route::group(['prefix' => 'book-genres', 'as' => 'bookgenre.'], function () {
                    //Get All
                    // Route::get('/', [BookGenreController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                    //add
                    Route::post('/book-genre-add', [BookGenreController::class, 'addBookGenre'])->name('add');
                    //update
                    Route::post('/book-genre-update', [BookGenreController::class, 'updateBookGenre'])->name('update');
                    //get
                    Route::get('/book-genres/{id}', [BookGenreController::class, 'getBookGenreById'])->name('get');
                    //delete
                    Route::delete('/book-genres/{id}', [BookGenreController::class, 'deleteBookGenre'])->name('delete');
                    //delete selected
                    Route::delete('/book-genres-del-selected', [BookGenreController::class, 'deleteCheckedBookGenres'])->name('deleteSelected');
                });

                //BOOK_ROYALTIES
                Route::group(['prefix' => 'book-royalties', 'as' => 'bookroyalty.'], function () {
                    //Get All
                    Route::get('/', [BookRoyaltyRateController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                    //add
                    // Route::post('/book-genre-add', [BookGenreController::class, 'addBookGenre'])->name('add');
                    // //update
                    // Route::post('/book-genre-update', [BookGenreController::class, 'updateBookGenre'])->name('update');
                    // //get
                    // Route::get('/book-genres/{id}', [BookGenreController::class, 'getBookGenreById'])->name('get');
                    // //delete
                    // Route::delete('/book-genres/{id}', [BookGenreController::class, 'deleteBookGenre'])->name('delete');
                    // //delete selected
                    // Route::delete('/book-genres-del-selected', [BookGenreController::class, 'deleteCheckedBookGenres'])->name('deleteSelected');
                });

            });

            //ROUTE GROUP::ADMIN/MANAGE
            Route::group(['prefix' => 'manage', 'as' => 'manage.'], function () {

                //SYSTEM_USERS
                Route::resource('users', \App\Http\Controllers\UsersController::class)->names([
                    'index' => 'user.index',
                    'store' => 'user.store',
                    'create' => 'user.create',
                    'edit' => 'user.edit',
                    'update' => 'user.update',
                    'destroy' => 'user.destroy',
                    'show' => 'user.show',
                ]);

                //GIZE_CHANNELS
                Route::resource('gize_channel', \App\Http\Controllers\Admin\Channels\GizeChannelController::class);

                //GIZE_CHANNELS_
                /*
                Route::group(['prefix' => 'gize_channels_', 'as' => 'gize_channels_.'], function () {
                //Get All
                Route::get('/', [GizeChannelController_::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                //add
                Route::post('/add', [GizeChannelController_::class, 'addGizeChannel'])->name('add');
                //update
                Route::post('/update', [GizeChannelController_::class, 'updateGizeChannel'])->name('update');
                //get
                Route::get('/{id}', [GizeChannelController_::class, 'getGizeChannelById'])->name('get');
                //delete
                Route::delete('/{id}', [GizeChannelController_::class, 'deleteGizeChannel'])->name('delete');
                //delete selected
                Route::delete('/del-selected', [GizeChannelController_::class, 'deleteCheckedGizeChannels'])->name('deleteSelected');
                //check slug
                Route::get('/check_slug', [GizeChannelController_::class, 'checkSlug'])->name('checkslug');
                });
                 */

                //CHANNELVIDEOS (ADDMES)
                Route::group(['prefix' => 'channelvideos', 'as' => 'channelvideo.'], function () {

                    Route::get('/{gize_channel_id}/channelvideo', [ChannelvideoController::class, 'index'])->name('index');
                    Route::post('/{gize_channel_id}/channelvideo', [ChannelvideoController::class, 'index']);

                    Route::post('/{gize_channel_id}/add-channelvideo', [ChannelvideoController::class, 'addChannelvideo'])->name('add');
                    Route::get('/{gize_channel_id}/channelvideos/{id}', [ChannelvideoController::class, 'getChannelvideoById'])->name('getById');

                    Route::post('/{gize_channel_id}/channelvideo', [ChannelvideoController::class, 'updateChannelvideo'])->name('update');
                    Route::put('/{gize_channel_id}/deactivate-channelvideo', [ChannelvideoController::class, 'deactivateChannelvideo'])->name('deactivate');
                    Route::put('/{gize_channel_id}/activate-channelvideo', [ChannelvideoController::class, 'activateChannelvideo'])->name('activate');

                    Route::delete('/{gize_channel_id}/channelvideos/{id}', [ChannelvideoController::class, 'deleteChannelvideo'])->name('delete');
                    Route::delete('/{gize_channel_id}/del-selected-channelvideos', [ChannelvideoController::class, 'deleteCheckedChannelvideos'])->name('deleteSelected');

                    Route::delete('/{gize_channel_id}/del-channelvideo-cover-image/{id}', [ChannelvideoController::class, 'deleteChannelvideoImageFiles'])->name('deleteImage');
                    Route::delete('/{gize_channel_id}/del-channelvideo-file/{id}', [ChannelvideoController::class, 'deleteChannelvideoFiles'])->name('deleteFile');

                    // Route::get('file-upload', [ChannelvideoController::class, 'fileUpload'])->name('channelvideo.upload');
                    Route::post('/{gize_channel_id}/channelvideo-file-upload', [ChannelvideoController::class, 'fileUploadPost'])->name('upload.post');
                    // Route::post('channelvideo-file-delete', [ChannelvideoController::class, 'fileDeletePost'])->name('channelvideo.delete.post');
                    Route::post('/{gize_channel_id}/channelvideo-file-read', [ChannelvidjeoController::class, 'fileRead'])->name('read');

                    Route::post('/{gize_channel_id}/video-access-list', [ChannelvideoAccessByAppUserController::class, 'video_access_list'])->name('accesslist');
                    Route::post('/{gize_channel_id}/channelvideo-revoke', [ChannelvideoAccessByAppUserController::class, 'revoke_video_access'])->name('revokeaccess');
                    Route::post('/{gize_channel_id}/channelvideo-allow', [ChannelvideoAccessByAppUserController::class, 'allow_video_access'])->name('allowaccess');

                    Route::get('/{gize_channel_id}/my-channelvideos', [ChannelvideoAccessByAppUserController::class, 'my_video_list'])->name('channelvideo.myvideos');

                    Route::post('/{gize_channel_id}/uploadhlschunk', [UploadController::class, 'uploadHLSChunk'])->name('uploadhlschunk');
                    Route::post('/{gize_channel_id}/uploadkeyschunk', [UploadController::class, 'uploadKeysChunk'])->name('uploadkeyschunk');

                    Route::delete('/{gize_channel_id}/del-hls-files/{id}', [UploadController::class, 'deleteHLSFiles'])->name('deletehls');
                    Route::delete('/{gize_channel_id}/del-keys-files/{id}', [UploadController::class, 'deleteKeysFiles'])->name('deletekeys');

                    Route::post('/{gize_channel_id}/extract', [UploadController::class, 'extract'])->name('extract');

                });

                //BATCHES
                Route::group(['prefix' => 'batches', 'as' => 'batch.'], function () {
                    //Get All
                    Route::get('/{gize_channel_id}', [BatchController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);

                    //add form
                    Route::get('/{gize_channel_id}/create', [BatchController::class, 'addBatchForm'])->name('addform');
                    //add
                    Route::post('/{gize_channel_id}/batch-add', [BatchController::class, 'addBatch'])->name('add');
                    //edit form
                    Route::get('/{gize_channel_id}/edit/{id}', [BatchController::class, 'editBatchForm'])->name('editform');
                    //update
                    Route::post('/{gize_channel_id}/batch-update', [BatchController::class, 'updateBatch'])->name('update');

                    //    //add
                    //     Route::post('/batch-add', [BatchController::class, 'addBatch'])->name('add');
                    //     //update
                    //     Route::post('/batch-update', [BatchController::class, 'updateBatch'])->name('update');

                    //get
                    Route::get('/{gize_channel_id}/batches/{id}', [BatchController::class, 'getBatchById'])->name('get');
                    //delete
                    Route::delete('/{gize_channel_id}/batches/{id}', [BatchController::class, 'deleteBatch'])->name('delete');
                    //delete selected
                    Route::delete('/{gize_channel_id}/batches-del-selected', [BatchController::class, 'deleteCheckedBatches'])->name('deleteSelected');

                    //add subscription period
                    Route::post('/{gize_channel_id}/create-period', [BatchController::class, 'addPeriod'])->name('addperiod');

                    //edit subscription period
                    Route::post('/{gize_channel_id}/edit-period', [BatchController::class, 'editPeriod'])->name('editperiod');

                    //BATCH_SUBSCRIPTIONS
                    Route::group(['prefix' => 'subscriptions', 'as' => 'subscription.'], function () {
                        //Get All
                        Route::get("/{gize_channel_id}/{batch_id?}", [BatchUserController::class, 'index'])->name('index'); //->middleware(['auth:web', 'scope:read-ebook']);
                        // Route::get("/{batch}", [BatchUserController::class, 'index'])->name('index.batch'); //->middleware(['auth:web', 'scope:read-ebook']);

                        //get unsubscribed users list
                        Route::get("/{gize_channel_id}/{batch_id}/unsubscribed-users-list", [BatchUserController::class, 'unsubscribedUsersList'])->name('unsubscribedlist'); //->middleware(['auth:web', 'scope:read-ebook']);
                        //add
                        Route::post('/{gize_channel_id}/subscriber-add', [BatchUserController::class, 'addSubscriber'])->name('add');

                        Route::put('/{gize_channel_id}/deactivate-subscription', [BatchUserController::class, 'deactivateBatchUser'])->name('deactivate');
                        Route::put('/{gize_channel_id}/activate-subscription', [BatchUserController::class, 'activateBatchUser'])->name('activate');
                        Route::put('/{gize_channel_id}/approve-subscription', [BatchUserController::class, 'approveBatchUser'])->name('approve');

                        //add form
                        Route::get('/{gize_channel_id}/create', [BatchUserController::class, 'addBatchForm'])->name('addform');
                        //edit form
                        Route::get('/{gize_channel_id}/edit/{id}', [BatchUserController::class, 'editBatchForm'])->name('editform');
                        //update
                        Route::post('/{gize_channel_id}/batch-update', [BatchUserController::class, 'updateBatch'])->name('update');

                        //add payment detail
                        Route::post('/{gize_channel_id}/create-payment', [BatchUserController::class, 'addPaymentDetail'])->name('addpayment');
                        //edit payment detial
                        Route::post('/{gize_channel_id}/edit-payment', [BatchUserController::class, 'editPaymentDetail'])->name('editpayment');
                        //delete payment detail
                        Route::delete('/{gize_channel_id}/delete-payment/{batch_user_id}/{subscription_period_id}', [BatchUserController::class, 'deletePaymentDetail'])->name('deletepayment');

                        //    //add
                        //     Route::post('/batch-add', [BatchController::class, 'addBatch'])->name('add');
                        //     //update
                        //     Route::post('/batch-update', [BatchController::class, 'updateBatch'])->name('update');

                        // //get
                        // Route::get('/batches/{id}', [BatchUserController::class, 'getBatchById'])->name('get');
                        // //delete
                        // Route::delete('/batches/{id}', [BatchUserController::class, 'deleteBatch'])->name('delete');
                        // //delete selected
                        // Route::delete('/batches-del-selected', [BatchUserController::class, 'deleteCheckedBatchs'])->name('deleteSelected');
                    });

                    //BATCH_SCHEDULES
                    Route::group(['prefix' => 'schedules', 'as' => 'schedule.'], function () {
                        //Get All
                        Route::get("/{gize_channel_id}/{batch_id?}", [BatchScheduleController::class, 'index'])->name('index');
                        //Get All
                        Route::get("/{gize_channel_id}/{batch_id}/load", [BatchScheduleController::class, 'loadEvent'])->name('load');
                        //CRUD
                        Route::post("/{gize_channel_id}/{batch_id}/ajax", [BatchScheduleController::class, 'crudCalendarEvents'])->name('crud_calendarevents');

                    });

                });

            });

            // Route::resource('tests', \App\Http\Controllers\TestsController::class);
            Route::get('/tests', function () {
                return view('tests.index');
            })->name('tests');

        });




        //ROUTE GROUP::USER
        Route::group(['prefix' => 'user', 'middleware' => 'role:super-admin|user', 'as' => 'user.'], function () {

            //MY HOME
            Route::get('/', function () {
                return view('website.user.home');
            })->name('home');

            //PAYMENT
            Route::get('/payment', [PaymentController::class, 'index']);
            Route::get('/payment-process', [PaymentController::class, 'performPayment'])->name('payment.process');
            Route::get('/payment-checkout', [PaymentController::class, 'performCheckout'])->name('payment.checkout');
            Route::get('/payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
            Route::get('/payment-fail', [PaymentController::class, 'paymentFail'])->name('payment.fail');
            Route::get('/payment-log', function () {
                \Log::channel('codecheef')->info('This is testing for codecheef.org!');
                dd('done');
            })->name('payment.log');

            // GROUP::USER_AUTHOR
            Route::group(['prefix' => 'author', 'middleware' => 'role:super-admin|user', 'as' => 'author.'], function () {

                //DASHBOARD
                Route::get('/', function () {
                    return view('website.user.author.home');
                })->name('home');

                //MY BOOKS
                Route::get('/books', function () {
                    return view('website.user.author.books.index');
                })->name('book');

                //MY BOOK PRICES
                Route::get('/book-prices', function () {
                    return view('website.user.author.book_prices.index');
                })->name('bookprice');

                //MY LINKED SHOPS
                Route::get('/link-shops', function () {
                    return view('website.user.author.link_shops.index');
                })->name('linkshop');

            });
        });




        Route::get('/logout', function (Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        })->name('logout');

        Route::resource('tasks', \App\Http\Controllers\TasksController::class);

    });

});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
//

Route::post('/user/payment-ipn', [PaymentController::class, 'postIPN'])->name('payment.ipn');
