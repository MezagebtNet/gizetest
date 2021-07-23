<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookable;
use App\Models\BookFormat;

// use App\Models\BookAuthor;
// use App\Models\BookGenre;
// use App\Models\BookLanguage;
use App\Models\Currency;
use Carbon\Carbon;

// use App\Models\BookSeries;
// use App\Models\BookType;

class TestsController extends Controller
{
    public function index()
    {
        // $customers = Customer::select(['cliente'])
        //     ->withCount(['refunds' => function ($query) {
        //         $query->whereHas('services', function ($query) {
        //             $query->where('services.id', 2);
        //         });
        //     }])

        //     ->get()
        //     ->where('refunds_count', '>', 0);

        // $customers = Customer::select(['cliente', 'email'])
        //     ->withCount('refunds')
        //     ->whereHas('refunds.services', function ($query) {
        //         $query->where('services.id', 1);
        //     })
        //     ->get();

        // foreach ($customers as $customer) {

        //     echo 'cliente - ' . $customer->cliente . '<br/> ' . 'email - ' . $customer->email . '<br/> ' . 'Refunds Count - ' . $customer->refunds_count . '<br/> ';
        //     echo '<hr/>';
        // }

        return view('tests.index');

        // $book_types = BookGenre::select(['name'])
        //     ->with('book_genres')
        // // ->withCount('book_genres')
        //     ->get();
        // ->withCount('refunds')
        // ->whereHas('refunds.services', function ($query) {
        //     $query->where('services.id', 1);
        // })
        // ->get();

        // $this->getAllBooksWithDetails();
        $this->getAllBooksWithDetails();

        // $rate = new BookFormat();

        //Select BookFOrmat 1 currencies for Book 1
        // $books = Book::with(
        //     [
        //         'bookable.book_author',
        //         'bookable.book_genre',
        //         'book_format',
        //     ]
        // )->get();

        // $currencies = BookFormat::find(1)
        //     ->currencies()
        //     ->orderBy('currency_name')
        //     ->addSelect([
        //         'book' => Bookable::select('title')
        //             ->where('id', 1),
        //     ])
        //     ->addSelect([
        //         'book' => Bookable::select('title')
        //             ->where('id', 1),
        //     ])
        //     ->get();
        // ::currentRoyaltyRating();
        // currentRoyaltyRating();

        // foreach ($books as $book) {

        //     echo 'Book_Format - ' . $book->book_format->name . '<br/>';
        //     echo 'Rate - ' . $book->book_format->pivot->rate . '<br/>';
        //     echo 'published_at - ' . $book->book_format->pivot->published_at . '<br/>';
        //     // echo 'Currencies - ' . $book->currency->currency_name . '<br/>';

        //     echo '<hr/>';
        // }

    }

    public function getBookRoyaltyRate()
    {
        $rate = BookFormat::find(1);
        // currentRoyaltyRating();

        echo 'Latest Rate - ' . $rate->currentRoyaltyRating->rate(1) . '<hr/>';
    }

    public function getAllBooksWithDetails()
    {
        //Get All books with their details..
        $dayAfter = Carbon::now()->modify('+1 day')->format('Y-m-d');
        $currency_id = 1; //ETB | USD

        $books = Book::with(
            [
                'bookable.book_author',
                'bookable.book_genre',
                'book_format',
            ]
        )
            ->addSelect([
                // 'latest_price' => BookPrice::select('price')
                //     ->whereColumn('book_id', 'books.id')
                //     ->where('published_at', '<', $dayAfter)
                //     ->where('currency_id', $currency_id)
                //     ->orderByDesc('published_at')
                //     ->limit(1),

                'currency_code' => Currency::select('currency_code')
                    ->where('id', $currency_id)
                    ->limit(1)])

            ->get();

        foreach ($books as $book) {
            $book_price = $book->latest_price ? $book->latest_price['price'] : '~';
            echo 'Title - ' . $book->bookable->title . '<br/>'
            . ' Author - ' . $book->bookable->book_author->name . '<br/>'
            . ' Genre - ' . $book->bookable->book_genre->name . '<br/>'
            . ' Format - ' . $book->book_format->name . '<br/>'
            . 'Price - ' . $book_price . ' ' . $book->currency_code . '<br/>';
            // . $book->series_no? ' Series Count - ' . $book_type->book_genres_count;
            echo '<hr/>';
        }
    }
}
