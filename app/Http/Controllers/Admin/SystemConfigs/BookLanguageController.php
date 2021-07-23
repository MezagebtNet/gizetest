<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use Illuminate\Http\Request;

class BookLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_languages = BookLanguage::orderBy('id', 'ASC')->get();
        // $books = Book::orderBy('id','DESC')->get();
        return view('admin.system_configs.book_languages.index', compact('book_languages'));
    }

    public function addBookLanguage(Request $request)
    {
        $book_language = new BookLanguage();
        $book_language->language_name = $request->language_name;
        $book_language->language_native_name = $request->language_native_name;
        $book_language->language_code = $request->language_code;
        $validated = $request->validate([
            'language_name' => 'required|unique:book_languages,language_name|max:255',
            'language_native_name' => 'required|unique:book_languages,language_native_name|max:255',
            'language_code' => 'required|unique:book_languages,language_code|max:5',
        ]);

        $book_language->save();
        return response()->json($book_language);
    }

    public function updateBookLanguage(Request $request)
    {

        $book_language = BookLanguage::find($request->id);

        $book_language->language_name = $request->language_name;
        $book_language->language_native_name = $request->language_native_name;
        $book_language->language_code = $request->language_code;

        $validated = $request->validate([
            'language_name' => 'required|max:255|unique:book_languages,language_name,' . $request->id . ',id',
            'language_native_name' => 'required|max:255|unique:book_languages,language_native_name,' . $request->id . ',id',
            'language_code' => 'required|max:5|unique:book_languages,language_code,' . $request->id . ',id',
        ]);

        $book_language->save($validated);

        // $book_language->save();
        return response()->json($book_language);
    }

    public function getBookLanguageById($id)
    {
        $book_language = BookLanguage::find($id);
        return response()->json($book_language);
    }

    public function deleteBookLanguage($id)
    {

        $book_language = BookLanguage::find($id);

        $book_language->delete();

        return response()->json(['success' => 'Recored has been deleted.'], 200);
    }

    public function deleteCheckedBookLanguages(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = BookLanguage::find($id);

            }
            //delete all records of $ids..
            BookLanguage::whereIn('id', $ids)->delete();

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."], 200);
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
     * @param  \App\Models\BookLanguage  $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function show(BookLanguage $bookLanguage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookLanguage  $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function edit(BookLanguage $bookLanguage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookLanguage  $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookLanguage $bookLanguage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookLanguage  $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookLanguage $bookLanguage)
    {
        //
    }
}
