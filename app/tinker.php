<?php

Book::with(
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
