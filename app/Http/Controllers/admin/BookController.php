<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookArtical;
use App\Models\BookArticalAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('admin.book.index');
    }

    public function list()
    {
        $books = DB::table(t_books)->get(['id', 'title', 'volume', 'issue', 'issue_name', 'published_date', 'iscurrent']);

        return response()->json($books);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.book.add');
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->eng_title = $request->title;
            $book->volume = $request->volume ?? '';

            $book->slug = $this->getSlug('books', $book->title.', '.$book->volume, null);

            $book->issn = $request->issn ?? '';
            $book->doi = $request->doi ?? '';
            $book->website = $request->website ?? '';
            $book->issue_name = $request->issue_name ?? '';
            $book->language_of_publication = $request->language_of_publication ?? '';
            $book->issue = $request->issue ?? '';
            $book->published_date = $request->published_date;

            $book->description = $request->description ?? '';
            $book->s_description = $request->s_description ?? '';

            $book->image = $request->file('image')->store('uploads/image');
            // $book->file = $request->file('file')->store('uploads/file');
            $book->file = '';
            $book->iscurrent = $request->filled('iscurrent') ? true : false;
            $book->save();
            if ($book->iscurrent) {
                Book::where('id', '<>', $book->id)->update(['iscurrent' => 0]);
            }
            $this->render();

            return redirect()->back()->with('success', 'succesfully added');
        }
    }

    public function edit(Request $request, $book_id)
    {
        $book = Book::where('id', $book_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.book.edit', compact('book'));
        } else {

            $book->title = $request->title;
            $book->volume = $request->volume;
            $book->slug = $this->getSlug('books', $book->title.', '.$book->volume, $book->id);

            $book->eng_title = $request->eng_title ?? '';
            $book->issn = $request->issn ?? '';
            $book->doi = $request->doi ?? '';
            $book->website = $request->website ?? '';
            $book->issue_name = $request->issue_name ?? '';

            $book->language_of_publication = $request->language_of_publication;
            $book->issue = $request->issue;
            $book->published_date = $request->published_date;

            $book->description = $request->description ?? '';
            $book->s_description = $request->s_description ?? '';

            if ($request->hasFile('image')) {
                $book->image = $request->file('image')->store('uploads/image');
            }
            // if ($request->hasFile('file')) {
            //     $book->file = $request->file('file')->store('uploads/file');
            // }
            $book->iscurrent = $request->iscurrent ? true : false;
            $book->save();

            if ($book->iscurrent) {
                Book::where('id', '<>', $book->id)->update(['iscurrent' => 0]);
            }

            $this->render();

            return redirect()->back()->with('success', 'Successfully updated');
        }
    }

    public function getSlug($table, $text, $id)
    {
        $increment = 1;
        $slug = str($text)->slug();
        $originalSlug = $slug;
        if ($id == null) {
            while (DB::table($table)->where('slug', $slug)->count() > 0) {
                $slug .= $originalSlug.'-'.$increment;
                $increment += 1;
            }
        } else {
            while (DB::table($table)->where('id', '<>', $id)->where('slug', $slug)->count() > 0) {
                $slug .= $slug.'-'.$increment;
                $increment += 1;
            }
        }

        return $slug;

    }

    public function del($book_id)
    {
        $articles = BookArtical::where('book_id', $book_id)->get();
        if ($articles->count() == 0) {
            Book::where('id', $book_id)->delete();
        } else {
            BookArticalAuthor::whereIn('book_artical_id', $articles->pluck('id'))->delete();
            BookArtical::where('book_id', $book_id)->delete();
            Book::where('id', $book_id)->delete();

        }
        $this->render();

        return redirect()->back()->with('success', 'successfully deleted');
    }

    public function render()
    {

        $books = DB::table('books')->get();
        $bookArticles = DB::table('book_articals')->orderBy('en_page_no')->get();
        $authors = DB::table('authors')->get();
        $bookArticlesAuthors = DB::table('book_artical_authors')->orderBy('id')->get();
        $types = DB::table('artical_types')->get();

        file_put_contents(resource_path('views/front/cache/archive.blade.php'), view('admin.templete.archive.index', [
            'books' => $books->where('iscurrent', 0)->values(), 'bookArticles' => $bookArticles,
        ])->render());

        foreach ($books as $key => $book) {
            file_put_contents(resource_path('views/front/cache/archive_header_link_'.($book->slug ?? $book->id).'.blade.php'), view('admin.templete.archive.single_book_header_link', compact('book'))->render());
            file_put_contents(resource_path('views/front/cache/archive_meta_'.($book->slug ?? $book->id).'.blade.php'), view('admin.templete.archive.single_book_meta', compact('book'))->render());
            file_put_contents(resource_path('views/front/cache/archive_single_'.($book->slug ?? $book->id).'.blade.php'), view('admin.templete.archive.single_book', compact('book', 'authors', 'bookArticlesAuthors', 'bookArticles', 'types'))->render());
        }

        file_put_contents(resource_path('views/front/cache/home.blade.php'), view('admin.templete.home')->render());

        foreach ($bookArticles as $key => $article) {
            $book = $books->where('id', $article->book_id)->first();
            file_put_contents(resource_path('views/front/cache/article_header_'.($article->slug ?? $article->id).'.blade.php'), view('admin.templete.article.header', compact('book', 'article'))->render());
            file_put_contents(resource_path('views/front/cache/article_title_'.($article->slug ?? $article->id).'.blade.php'), view('admin.templete.article.title', compact('book', 'article'))->render());
            file_put_contents(resource_path('views/front/cache/article_meta_'.($article->slug ?? $article->id).'.blade.php'), view('admin.templete.article.meta', compact('book', 'article'))->render());
            $localArticleAuthors = $bookArticlesAuthors->where('book_artical_id', $article->id)->values();
            $type = $types->where('id', $article->artical_type_id)->first();
            file_put_contents(
                resource_path('views/front/cache/article_index_'.($article->slug ?? $article->id).'.blade.php'),
                view('admin.templete.article.index',
                    [
                        'book' => $book,
                        'article' => $article,
                        'authors' => $localArticleAuthors,
                        'allAuthors' => $authors,
                        'articleType' => $type,
                    ]
                )->render());
        }
    }

    public function indexArticle($book_id)
    {
        $book = DB::table(t_books)->where('id', $book_id)->first(['id', 'title']);

        return view('admin.book.artical.index', compact('book'));
    }

    public function listArticle(Request $request)
    {
        $articles = BookArtical::select('book_articals.*', 'artical_types.name as artical_type_name')
            ->join('artical_types', 'book_articals.artical_type_id', '=', 'artical_types.id')
            ->where('book_id', $request->book_id)
            ->get();

        return response()->json($articles);
    }

    public function addArticle(Request $request, $book_id)
    {

        if ($request->getMethod() == 'GET') {
            $authors = DB::table('authors')->get();
            $book = DB::table(t_books)->where('id', $book_id)->first(['id', 'title']);
            $articalTypes = DB::table('artical_types')->get();

            return view('admin.book.artical.add', compact('book', 'articalTypes', 'authors'));
        } else {
            $artical = new BookArtical();
            $artical->title = $request->title;
            $artical->slug = $this->getSlug('book_articals', $artical->title, null);

            $artical->doi = $request->doi ?? '';
            $artical->tags = $request->tags ?? '';
            $artical->abstract = $request->abstract ?? '';

            $artical->st_page_no = $request->starting_page;
            $artical->en_page_no = $request->ending_page;
            $artical->book_id = $request->book_id;
            $artical->artical_type_id = $request->artical_type_id;
            $artical->file = $request->file('file')->store('uploads/artical');
            $artical->save();

            $authorArticle = new BookArticalAuthor();
            $article_id = $artical->id;
            $book_id = $request->input('book_id');

            if ($request->filled('author_ids')) {
                $author_ids = explode(',', $request->author_ids);
                foreach ($author_ids as $author_id) {
                    $author = Author::where('id', $author_id)->first();
                    $authorArticle = new BookArticalAuthor();
                    $authorArticle->author_name = $author->name;
                    $authorArticle->book_artical_id = $article_id;
                    $authorArticle->book_id = $book_id;
                    $authorArticle->author_id = $author_id;
                    $authorArticle->save();
                }
            }
            $this->render();

            return redirect()->back()->with('success', 'Successfully added');
        }
    }

    public function editArticle(Request $request, $book_id, $artical_id)
    {
        $artical = BookArtical::where('id', $artical_id)->first();
        if ($request->getMethod() == 'GET') {
            $articalAuthors = DB::table('book_artical_authors')->where('book_artical_id', $artical_id)->orderBy('id')->get();
            $book = Book::where('id', $book_id)->first();
            $articalTypes = DB::table('artical_types')->get();

            return view('admin.book.artical.edit', compact('book', 'artical', 'articalTypes', 'articalAuthors'));
        } else {
            $artical->title = $request->title;
            $artical->slug = $this->getSlug('book_articals', $artical->title, $artical->id);
            $artical->doi = $request->doi ?? '';
            $artical->tags = $request->tags ?? '';
            $artical->abstract = $request->abstract ?? '';

            $artical->st_page_no = $request->starting_page;
            $artical->en_page_no = $request->ending_page;
            $artical->artical_type_id = $request->artical_type_id;
            if ($request->hasFile('file')) {
                $artical->file = $request->file('file')->store('uploads/artical');
            }
            $artical->save();

            if ($request->filled('author_ids')) {
                if ($request->author_ids) {
                    $author_ids = explode(',', $request->author_ids);

                    $existingAuthors = DB::table('book_artical_authors')->where('book_artical_id', $artical_id)->pluck('author_id')->toArray();
                    $newAuthors = $author_ids;
                    $duplicateAuthors = array_intersect($existingAuthors, $newAuthors);
                    if (! empty($duplicateAuthors)) {
                    } else {
                        $article_id = $artical->id;
                        $book_id = $request->input('book_id');
                        foreach ($author_ids as $author_id) {
                            $author = Author::where('id', $author_id)->first();
                            $authorArticle = new BookArticalAuthor();
                            $authorArticle->author_name = $author->name;
                            $authorArticle->book_artical_id = $article_id;
                            $authorArticle->book_id = $book_id;
                            $authorArticle->author_id = $author_id;
                            $authorArticle->save();
                        }
                    }
                }
            }
            $this->render();

            return redirect()->back()->with('success', 'Successfully updated');
        }
    }

    public function delArticle($artical_id)
    {
        BookArticalAuthor::where('book_artical_id', $artical_id)->delete();
        BookArtical::where('id', $artical_id)->delete();
        $this->render();

        return redirect()->back()->with('success', 'succesfully deleted');
    }

    public function listAuthor()
    {
        $authors = DB::table('authors')->get(['id', 'name', '']);

        return response()->json($authors);
    }

    public function indexAuthor($book_id, $article_id)
    {
        $book = Book::where('id', $book_id)->first();
        $article = BookArtical::where('id', $article_id)->first();
        $authors = BookArticalAuthor::where('book_artical_id', $article_id)->get(['id', 'author_id']);

        return view('admin.book.artical.author.index', compact('article', 'book', 'authors'));
    }

    public function addAuthor(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $authorArticle = new BookArticalAuthor();
            $author_ids = $request->input('author_ids');
            $article_id = $request->input('article_id');
            $book_id = $request->input('book_id');
            foreach ($author_ids as $authorId) {
                $author = Author::where('id', $authorId)->first();
                $authorArticle = new BookArticalAuthor();
                $authorArticle->author_name = $author->name;
                $authorArticle->book_artical_id = $article_id;
                $authorArticle->book_id = $book_id;
                $authorArticle->author_id = $authorId;
                $authorArticle->save();
            }
            $this->render();

        }
    }

    public function delAuthor($articleAuthor_id)
    {
        BookArticalAuthor::where('id', $articleAuthor_id)->delete();
        $this->render();

        return redirect()->back()->with('success', 'successfully deleted');
    }

    public function delAuthorAll($artical_id)
    {
        BookArticalAuthor::where('book_artical_id', $artical_id)->delete();
        $this->render();

        return redirect()->back()->with('success', 'successfully deleted');
    }

    public function saveAuthor($article_id, Request $request)
    {
        $author = new Author();
        $author->name = $request->input('name');
        $author->link = $request->input('link');
        $author->designation = $request->input('designation');
        $author->organization = $request->input('organization');
        $this->render();

        $author->save();
    }
}
