<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\BookFormat;
use App\Models\BookRoyaltyRate;
use App\Models\Currency;
use Illuminate\Http\Request;

class BookRoyaltyRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $book_royalty = DB::table('book_royalty_rates')
        //     ->join('book_formats', 'book_royalty_rates.book_format_id', '=', 'book_formats.id')
        //     ->join('currencies', 'book_royalty_rates.currency_id', '=', 'currencies.id')
        //     ->select('book_royalty_rates.*', 'book_formats.name', 'currencies.currency_code')
        //     ->get();

        $book_royalty_formats = BookFormat::with('currencies')->get();

        foreach ($book_royalty_formats as $book_royalty) {
            // $book_royalty->status = $book_royalty->currency->id;
            // foreach($book_royalty as $currencies){
            // $currency_id = $book_royalty->currency_id;
            // $book_format_id = $book_royalty->book_format_id;
            //     $book_royalty->status = $currency_id . '-' . $book_format_id;
            // }
            // $book_royalty->status = $book_format_id;

        }

        // ->addSelect(['latest_rate_id' => BookRoyaltyRate::select('id')
        //     ->whereColumn('published_at', '<', now())
        //     ->orderByDesc('id')
        //     ->limit(1)
        // ])->get();

        // //for each currencies..
        // $latestRates = DB::table('book_royalty_rates')
        // ->select('id', DB::raw('MAX(published_at) as last_rate_published_at'))
        // ->where('currency_id', 1) //currency
        // ->groupBy('id');

        // $currencies = DB::table('currencies')
        // ->joinSub($latestRates, 'latest_rates', function ($join) {
        //     $join->on('currency.id', '=', 'book_royalty_rates.currency_id');
        // })->get();

        // $book_royalty =  DB::table('book_royalty_rates')
        //     ->join('book_formats', 'book_royalty_rates.book_format_id', '=', 'book_formats.id')
        //     ->join('currencies', 'book_royalty_rates.currency_id', '=', 'currencies.id')
        //     ->select('book_royalty_rates.*', 'book_formats.name', 'currencies.*')

        // ->select('currency_id', DB::raw('published_at < now() as status'))
        // ->groupBy('currency_id')
        // ->havingRaw('SUM(price) > ?', [2500])
        // ->get();

        // dd($book_royalty);
        // foreach ($book_royalty as $royalty) {
        //     $rate = BookFormat::find($royalty->id);

        //     $rate_status_for_currency_id = $book_royalty->where('published_at', '<', now())->where('currency_id', '=', 1)
        //     $royalty->status = ($rate->currentRating($royalty->currency_id)->id == $royalty->id) ? 'current' : '';
        // }

        // currentRoyaltyRating();

        // $book_royalties_per_book_format -> =

        // $book_royalty_rates = BookRoyaltyRate::select('book_royalty_rates.*, book_formats.*, currencies.*')
        //     ->with(['book_formats', 'currencies'])->orderBy('id', 'ASC')->get();

        // echo count(array_unique($rates->currency_code));

        $currency_codes = [];
        $book_formats = [];
        // foreach ($book_royalty as $rates) {
        //     // echo $rates->rate;
        //     array_push($currency_codes, $rates->currency_code);
        //     array_push($book_formats, $rates->name);
        // }

        // $currencies_count = count(array_unique($currency_codes));
        // $book_formats_count = count(array_unique($book_formats));

        $unique_book_formats = array_unique($book_formats);
        $unique_currencies = array_unique($currency_codes);

        $book_formats = BookFormat::all();
        $currencies = Currency::all();

        // foreach ($unique_currencies as $value) {
        //     // echo $rates->rate;
        //     echo $value;
        // }

        // echo $currencies_count . " Types of currencies and " . $book_formats_count . " types of book formats";

        return view('admin.system_configs.book_royalty_rates.index',
            compact(
                'book_royalty_formats',
                // 'book_royalty',
                // 'currencies_count',
                // 'book_formats_count',
                'unique_book_formats',
                'unique_currencies',
                'currencies',
                'book_formats'
            ));
    }

    public function showBookRoyaltyRateDetails($id)
    {
        $book_genres = BookGenre::where('book_royalty_rate_id', $id)->get();
        // $bookables = Bookable::whereHas('book_genres', function ($query) {
        //     $query->where('book_royalty_rate_id', $id);
        // });

        // $bookables = Bookable::select('bookables.*')
        //     ->join('book_genres', 'bookables.book_genres_id', '=', 'book_genres.id')
        //     ->where('book_genres.book_royalty_rate_id');

        // dd($bookables);

        $book_royalty_rate = Booktype::find($id);
        $book_royalty_rate->book_genres = $book_genres;
        // $book_royalty_rate = BookRoyaltyRate::with(['book_genres'])
        return view('admin.system_configs.book_royalty_rates.show', compact('book_royalty_rate'));
    }

    public function addBookRoyaltyRateForm()
    {
        return view('admin.system_configs.book_royalty_rates.create');
    }

    public function addBookRoyaltyRate(Request $request)
    {
        $book_royalty_rate = new BookRoyaltyRate();
        $book_royalty_rate->name = $request->name;
        $validated = $request->validate([
            'name' => 'required|unique:book_royalty_rates,name|max:255',
        ]);

        $book_royalty_rate->save();
        return response()->json($book_royalty_rate);
    }

    public function editBookRoyaltyRateForm($id)
    {
        $book_royalty_rate = BookRoyaltyRate::find($id);
        $book_genres = BookGenre::where('book_royalty_rate_id', $id)->get();
        $book_royalty_rate->book_genres = $book_genres;

        return view('admin.system_configs.book_royalty_rates.edit', compact('book_royalty_rate'));
    }

    public function updateBookRoyaltyRate(Request $request)
    {

        $book_royalty_rate = BookRoyaltyRate::find($request->id);

        $book_royalty_rate->name = $request->name;

        $validated = $request->validate([
            'name' => 'required|max:255|unique:book_royalty_rates,name,' . $request->id . ',id',
        ]);

        $book_royalty_rate->save($validated);

        // $book_royalty_rate->save();
        return response()->json($book_royalty_rate);
    }

    public function getBookRoyaltyRateById($id)
    {
        $book_royalty_rate = BookRoyaltyRate::find($id);
        return response()->json($book_royalty_rate);
    }

    public function deleteBookRoyaltyRate($id)
    {

        $book_royalty_rate = BookRoyaltyRate::find($id);

        $book_royalty_rate->delete();

        return response()->json(['success' => 'Recored has been deleted.']);
    }

    public function deleteCheckedBookRoyaltyRates(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = BookRoyaltyRate::find($id);

            }
            //delete all records of $ids..
            BookRoyaltyRate::whereIn('id', $ids)->delete();

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book_royalty_rate  $book_royalty_rate
     * @return \Illuminate\Http\Response
     */
    public function show(book_royalty_rate $book_royalty_rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book_royalty_rate  $book_royalty_rate
     * @return \Illuminate\Http\Response
     */
    public function edit(book_royalty_rate $book_royalty_rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book_royalty_rate  $book_royalty_rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book_royalty_rate $book_royalty_rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_royalty_rate  $book_royalty_rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(book_royalty_rate $book_royalty_rate)
    {
        //
    }
}
