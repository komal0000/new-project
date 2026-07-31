<div class="archiveSingle">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="bookimage" >
                    <a href="#">
                        <img src="{{ asset($book->image) }}" alt="book-cover">
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="banner">
                    <h1 style="color: var(--text)">
                        {{ $book->title }} {{$book->volume}}
                    </h1>
                    <div class="description">
                        {{ $book->s_description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($bookArticles->where('book_id',$book->id)->sortBy('en_page_no')->groupBy('artical_type_id') as $key=>$articles)
        <div class="container_b p-0">
            <div class="editorial">
                <h5>
                    {{$types->where('id',$key)->first()->name}}
                </h5>
            </div>
            <hr>


            @foreach ($articles->sortBy('en_page_no') as $item)
                <div class="data">
                    <div class="head">
                        <div class="title">
                            <h3>
                                <a href="{{ route('articleSingle', ['article' => $item->slug??$item->id]) }}">{{ $item->title }}</a>
                            </h3>
                            <div class="page_no">
                                {{ $item->st_page_no }} - {{ $item->en_page_no }}
                            </div>

                        </div>
                        @php
                            $bas = $bookArticlesAuthors->where('book_artical_id',$item->id);
                        @endphp
                        @if ($bas->count()>0)
                            <div class="authorname">
                                <i class="fa-regular fa-user"></i>
                                @foreach ($bas as $ba)
                                    <a href="">{{ $authors->where('id',$ba->author_id)->first()->name }}@if(!$loop->last),@endif </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="bottom">
                        {{-- <div class="short_desc">
                            @if(strlen($item->abstract)>160)
                                {{ substr($item->abstract,0,160)."..." }}
                            @else
                                {{ $item->abstract }}
                            @endif
                        </div> --}}

                        <div >
                            <button>
                                <i class="fa-regular fa-file-pdf"></i> <a
                                    href="{{ vasset($item->file) }}">PDF</a>
                            </button>
                        </div>

                    </div>
                </div>
                @if(!$loop->last)<hr/>@endif
            @endforeach
        </div>
    @endforeach
</div>
