<?php

namespace App\Console\Commands;

use App\Http\Controllers\admin\BookController;
use App\Models\Book;
use App\Models\BookArtical;
use Illuminate\Console\Command;

class MakeSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $books = Book::all();
        foreach ($books as $key => $book) {
            $increment = 1;
            $original = str($book->title.','.$book->volume)->slug();
            $slug = $original;
            while (Book::where('id', '<>', $book->id)->where('slug', $slug)->count() > 0) {
                $slug = $original.'-'.$increment;
                $increment += 1;
            }
            $book->slug = $slug;
            $book->save();
        }

        $articles = BookArtical::all();
        foreach ($articles as $key => $article) {
            $increment = 1;
            $original = str($article->title)->slug();
            $slug = $original;
            while (BookArtical::where('id', '<>', $article->id)->where('slug', $slug)->count() > 0) {
                $slug = $original.'-'.$increment;
                $increment += 1;
            }
            $article->slug = $slug;
            $article->save();
        }

        (new BookController())->render();
    }
}
