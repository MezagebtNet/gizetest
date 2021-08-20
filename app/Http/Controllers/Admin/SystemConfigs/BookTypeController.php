<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\BookGenre;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_types = BookType::withCount(['book_genres'])->orderBy('id', 'ASC')->get();

        foreach ($book_types as $key => $value) {

        }
        // $books = Book::orderBy('id','DESC')->get();
        return view('admin.system_configs.book_types.index', compact('book_types'));
    }

    public function showBookTypeDetails($id)
    {
        $book_genres = BookGenre::where('book_type_id', $id)->get();
        // $bookables = Bookable::whereHas('book_genres', function ($query) {
        //     $query->where('book_type_id', $id);
        // });

        // $bookables = Bookable::select('bookables.*')
        //     ->join('book_genres', 'bookables.book_genres_id', '=', 'book_genres.id')
        //     ->where('book_genres.book_type_id');

        // dd($bookables);

        $book_type = Booktype::find($id);
        $book_type->book_genres = $book_genres;
        // $book_type = BookType::with(['book_genres'])
        return view('admin.system_configs.book_types.show', compact('book_type'));
    }

    public function addBookTypeForm()
    {
        return view('admin.system_configs.book_types.create');
    }

    public function addBookType(Request $request)
    {
        $book_type = new BookType();
        $book_type->name = $request->name;
        $validated = $request->validate([
            'name' => 'required|unique:book_types,name|max:255',
        ]);

        $book_type->save();
        return response()->json($book_type);
    }

    public function editBookTypeForm($id)
    {
        $book_type = BookType::find($id);
        $book_genres = BookGenre::where('book_type_id', $id)->get();
        $book_type->book_genres = $book_genres;

        return view('admin.system_configs.book_types.edit', compact('book_type'));
    }

    public function updateBookType(Request $request)
    {

        $book_type = BookType::find($request->id);

        $validated = $request->validate([
            'name' => 'required|max:255|unique:book_types,name,' . $request->id . ',id',
        ]);

        $book_type->name = $request->name;



        $book_type->save($validated);

        // $book_type->save();
        return response()->json($book_type);
    }

    public function getBookTypeById($id)
    {
        $book_type = BookType::find($id);
        return response()->json($book_type);
    }

    public function deleteBookType($id)
    {

        $book_type = BookType::find($id);

        $book_type->delete();

        return response()->json(['success' => 'Recored has been deleted.']);
    }

    public function deleteCheckedBookTypes(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = BookType::find($id);

            }
            //delete all records of $ids..
            BookType::whereIn('id', $ids)->delete();

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
     * @param  \App\Models\book_type  $book_type
     * @return \Illuminate\Http\Response
     */
    public function show(book_type $book_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book_type  $book_type
     * @return \Illuminate\Http\Response
     */
    public function edit(book_type $book_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\book_type  $book_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book_type $book_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_type  $book_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(book_type $book_type)
    {
        //
    }
}
