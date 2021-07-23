<?php

namespace App\Http\Controllers;

use App\Models\BookAuthor;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookAuthor extends Controller
{

    /**
     * Get all of the bookables for the BookAuthor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookables(): HasMany
    {
        return $this->hasMany(Bookable::class);//, 'foreign_key', 'local_key');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\BookAuthor  $bookAuthor
     * @return \Illuminate\Http\Response
     */
    public function show(BookAuthor $bookAuthor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookAuthor  $bookAuthor
     * @return \Illuminate\Http\Response
     */
    public function edit(BookAuthor $bookAuthor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookAuthor  $bookAuthor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookAuthor $bookAuthor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookAuthor  $bookAuthor
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookAuthor $bookAuthor)
    {
        //
    }
}
