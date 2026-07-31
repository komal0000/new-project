@php
    $book = DB::table('books')->where('iscurrent', 1)->first();
    $articles = [];
    if ($book) {
        $articles = \App\Models\BookArtical::where('book_id', $book->id)->get();
    }
@endphp

@if ($book)
    <div class="banner">
        <div class="books">
            <div class="row">
                <div class="col-md-4">
                    <div class="bookimage">
                        <a href="#">
                            <img src="{{ asset($book->image) }}" alt="book-cover">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="banner-inner">
                        <h1 style="color: var(--text)">
                            {{ $book->title }} {{ $book->volume }}
                        </h1>
                        <div class="description">
                            {{ $book->s_description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="article">
        @foreach ($articles->groupBy('artical_type_id') as $key => $articles)
            <div class="container p-0 mt-3 mb-3 mt-md-2">
                <div class="article-type">
                    <h5>
                        {{ DB::table('artical_types')->where('id', $key)->first('name')->name }}
                    </h5>
                </div>
                <hr class="mt-0">
                @php
                    $articlesLen = $articles->count();
                @endphp
                @foreach ($articles->sortBy('en_page_no')->values() as $articleKey => $item)
                    @php
                        $authors = DB::table('book_artical_authors')
                            ->join('authors', 'authors.id', '=', 'book_artical_authors.author_id')
                            ->where('book_artical_id', $item->id)
                            ->get(['authors.name']);

                    @endphp

                    <div class="data">
                        <div class="head">
                            <h3 class="d-flex justify-content-between">
                                <a href="{{ route('articleSingle', ['article' => $item->slug??$item->id]) }}">{{ $item->title }}</a>
                                <div class="page_no">
                                    {{ $item->st_page_no }} - {{ $item->en_page_no }}
                                </div>
                            </h3>

                            @if($authors->count()>0)
                            <div class="authorname">
                                <i class="fa-regular fa-user"></i>
                                @foreach ($authors as $author)
                                    <a href="">{{ $author->name }}@if(!$loop->last),@endif  </a>
                                @endforeach
                            </div>
                            @endif

                            <div class="mt-3">
                                <button>
                                    <i class="fa-regular fa-file-pdf"></i> <a
                                        href="{{ vasset($item->file) }}">PDF</a>
                                </button>
                            </div>
                        </div>
                        {{-- <div class="bottom">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="short_desc">
                                        <p>
                                            @if(strlen($item->abstract)>160)
                                                {{ substr($item->abstract,0,160)."..." }}
                                            @else
                                                {{ $item->abstract }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <div class="page_no">
                                        {{ $item->st_page_no }} - {{ $item->en_page_no }}
                                    </div>
                                </div>
                                <div class="col-md-2">

                                </div>
                            </div>
                        </div> --}}

                    </div>
                    @if ($articlesLen - 1 > $articleKey)
                        <hr>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endif
