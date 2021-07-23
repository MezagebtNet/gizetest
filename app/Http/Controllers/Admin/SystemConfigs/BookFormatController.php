<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\BookFormat;
use Illuminate\Http\Request;

class BookFormatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_formats = BookFormat::orderBy('id', 'ASC')->get();
        // $books = Book::orderBy('id','DESC')->get();
        return view('admin.system_configs.book_formats.index', compact('book_formats'));
    }

    public function addBookFormat(Request $request)
    {
        $book_format = new BookFormat();
        $book_format->name = $request->name;
        $validated = $request->validate([
            'name' => 'required|max:255|unique:book_formats,name',
        ]);

        $book_format->save();
        return response()->json($book_format);
    }

    public function updateBookFormat(Request $request)
    {

        $book_format = BookFormat::find($request->id);

        $book_format->name = $request->name;
        $validated = $request->validate([
            'name' => 'required|max:255|unique:book_formats,name,' . $request->id . ',id',
        ]);

        $book_format->save();
        return response()->json($book_format);
    }

    public function getBookFormatById($id)
    {
        $book_format = BookFormat::find($id);
        return response()->json($book_format);
    }

    public function deleteBookFormat($id)
    {

        $book_format = BookFormat::find($id);

        $book_format->delete();

        return response()->json(['success' => 'Recored has been deleted.'], 200);
    }

    public function deleteCheckedBookFormats(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = BookFormat::find($id);

            }
            //delete all records of $ids..
            BookFormat::whereIn('id', $ids)->delete();

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
     * @param  \App\Models\BookFormat  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function show(BookFormat $bookFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookFormat  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function edit(BookFormat $bookFormat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookFormat  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookFormat $bookFormat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookFormat  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookFormat $bookFormat)
    {
        //
    }
}
