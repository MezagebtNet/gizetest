<?php

use App\Http\Controllers\Admin\SystemConfigs\BookFormatController;
use App\Http\Controllers\Admin\SystemConfigs\BookGenreController;
use App\Http\Controllers\Admin\SystemConfigs\BookLanguageController;
use App\Http\Controllers\Admin\SystemConfigs\BookRoyaltyRateController;
use App\Http\Controllers\Admin\SystemConfigs\BookTypeController;
use App\Http\Controllers\PaymentController;
use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('website.home');
    // return view('layouts.admin');
})->name('website.home');

Route::get('/search', function (Request $request) {
    return BookAuthor::search($request->search)->get();
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::resource('tasks', \App\Http\Controllers\TasksController::class);

Route::post('/user/payment-ipn', [PaymentController::class, 'postIPN'])->name('payment.ipn');


Route::group(['middleware' => 'auth'], function () {

    //ROUTE GROUP::SUPER-ADMIN
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin|super-admin', 'as' => 'admin.'], function () {

        //DASHBOARD
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::post('/mark-as-read', [\App\Http\Controllers\Admin\HomeController::class, 'markNotification'])->name('markNotification');

        //NOTIFICATIONS
        Route::get('/notifications', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications');
        Route::post('/notifications/mark-as-read', [\App\Http\Controllers\Admin\NotificationController::class, 'markNotification'])->name('notifications.markNotification');

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
            Route::resource('users', \App\Http\Controllers\UsersController::class);

        });

        // Route::resource('tests', \App\Http\Controllers\TestsController::class);
        Route::get('/tests', function () {
            return view('tests.index');
        })->name('tests');

    });

    //USER PROFILE
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    //ROUTE GROUP::USER (AUTHOR OR SHOP)
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
        Route::get('/payment-log', function(){
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
