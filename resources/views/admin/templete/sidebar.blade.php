<div class="sidebar-content py-2">
    @if (!empty($title->title))
        <div class="heading text-start mb-2" style="font-size: 15px; font-weight: 600; color: #222222;">
            {{ $title->title }}:
        </div>
    @endif
    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
        @foreach ($associates as $item)
            @php
                $url = $item->link;
                if ($url && !str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, '//')) {
                    $url = 'https://' . $url;
                }
            @endphp
            <div class="associate-card bg-white rounded px-2 py-1 shadow-sm d-inline-flex align-items-center justify-content-center" style="height: 44px; min-width: 80px; border: 1px solid #d4e6e3;">
                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center w-100 h-100">
                    <img src="{{ vasset($item->image) }}" alt="" style="max-height: 32px; max-width: 110px; object-fit: contain;">
                </a>
            </div>
        @endforeach
    </div>
    <div class="issn-info text-start mt-2" style="font-size: 14px; font-weight: 600; color: #333333;">
        e-ISSN: 2091-234X | p-ISSN: 2091-2331 | ISSN-L: 2091-2331
    </div>
</div>
