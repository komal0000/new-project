<div class="editorial-policy">
    <div class="container">
        @if (isset($editorialPolicy) && !empty($editorialPolicy->data))
            <div class="row m-0">
                <div class="col-md-12">
                    {!! $editorialPolicy->data !!}
                </div>
            </div>
        @endif
    </div>
</div>
