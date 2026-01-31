<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Livre;

class UpdateCovers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-covers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update book covers from local storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
            $book = Livre::find($id);
            if ($book) {
                // Ensure the path is relative to the storage public disk root
                // usually 'covers/filename' if the file is in storage/app/public/covers/
                $path = 'covers/' . $filename;
                $book->update(['couverture_path' => $path]);
                $this->info("Updated Book {$id}: {$book->titre} -> {$path}");
            } else {
                $this->warn("Book ID {$id} not found.");
            }
        }

        $this->info('Cover update complete!');
    }
}
