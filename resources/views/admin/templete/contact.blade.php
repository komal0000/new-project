<div class="contact">
    <div class="container">
        <h1>
            Contact Us
        </h1>
        <div class="row m-0">
            @if (isset($contactSetting) && !empty($contactSetting->data))
                <div class="col-md-12">
                    {!! $contactSetting->data !!}
                </div>
            @endif
        </div>
    </div>
</div>
