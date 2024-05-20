<meta property="og:title" content="{{ $book->title }},{{ $book->title }}">
<meta property="og:description" content="{{ $book->s_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('book.single', ['book_id' => $book->id]) }}">
<meta property="og:image" content="{{ asset($book->image) }}">
<meta property="og:site_name" content="{{ config('app.name') }}">