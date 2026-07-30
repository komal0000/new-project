@if ($books->count() > 0)
    @php
        $len=$books->count()-1;
    @endphp
    @foreach ($books as $key=>$book)
    <div class="archive">
        <div class="row">
            <div class="col-md-2">
                <img src="{{vasset($book->image)}}" alt="{{$book->volume}}">
            </div>
            <div class="col-md-9">
                <a href="{{ route('book.single', ['book_id' => $book->slug??$book->id]) }}">
                    <div class="name">
                        {{ $book->title }}, {{ $book->volume }}
                    </div>
                    <div class="date">
                        Issued {{ $book->issue }}
                    </div>
                    <div class="desc">
                        {{ $book->s_description }}
                    </div>
                </a>
            </div>
        </div>

    </div>
    @if ($len>$key)
    <hr>
    @endif

    @endforeach
@else
    <h5>The journal doesn't have older issues.</h5>
@endif
