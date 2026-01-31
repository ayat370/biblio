<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:update-covers', function () {
    $mapping = [
        1 => 'h1.jpg',
        2 => 'H2.jpg',
        3 => 'H3.jpg',
        4 => 'H4.jpg',
        5 => 'H5.jpg',
        6 => 'H6.jpg',
        7 => 'H7.jfif',
        8 => 'H8.jpg',
        9 => 'H9.jpg',
        10 => 'H10.png',
    ];

    foreach ($mapping as $id => $filename) {
        $book = \App\Models\Livre::find($id);
        if ($book) {
            $path = 'covers/' . $filename;
            $book->update(['couverture_path' => $path]);
            $this->info("Updated Book {$id}: {$book->titre} -> {$path}");
        } else {
            $this->warn("Book ID {$id} not found.");
        }
    }
    $this->info('Cover update complete!');
})->purpose('Update book covers from local storage');
