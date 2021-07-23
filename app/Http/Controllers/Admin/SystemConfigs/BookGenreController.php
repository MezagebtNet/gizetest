<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\BookGenre;
use Illuminate\Http\Request;

class BookGenreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $book_genres = BookGenre::orderBy('id', 'ASC')->get();
        // // $books = Book::orderBy('id','DESC')->get();
        // return view('admin.system_configs.book_types.index', compact('book_genres'));
        // return view('admin.system_configs.book_types.edit', compact('book_type'));
    }

    public function addBookGenre(Request $request)
    {
        $book_genre = new BookGenre();
        $book_genre->name = $request->name;
        $book_genre->book_type_id = $request->book_type_id;
        $validated = $request->validate([
            'name' => 'required|unique:book_genres,name|max:255',
            'book_type_id' => 'required',
        ]);

        $book_genre->save();
        return response()->json($book_genre);
    }

    public function updateBookGenre(Request $request)
    {

        $book_genre = BookGenre::find($request->id);

        $book_genre->name = $request->name;

        $validated = $request->validate([
            'name' => 'required|max:255|unique:book_genres,name,' . $request->id . ',id',
        ]);

        $book_genre->save($validated);

        // $book_genre->save();
        return response()->json($book_genre);
    }

    public function getBookGenreById($id)
    {
        $book_genre = BookGenre::find($id);
        return response()->json($book_genre);
    }

    public function deleteBookGenre($id)
    {

        $book_genre = BookGenre::find($id);

        $book_genre->delete();

        return response()->json(['success' => 'Recored has been deleted.']);
    }

    public function deleteCheckedBookGenres(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = BookGenre::find($id);

            }
            //delete all records of $ids..
            BookGenre::whereIn('id', $ids)->delete();

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."]);
    }

}
