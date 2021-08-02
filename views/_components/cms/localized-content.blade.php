<ul class="nav nav-tabs" id="localized" role="tablist">
    @foreach($languages as $language)
        <?php /** @var  Arcanesoft\Foundation\Cms\Models\Language  $language */ ?>
        @if($loop->first)
            <li class="nav-item" role="presentation">
                <button class="nav-link small active" id="{{ $language->code }}-tab"
                        data-bs-toggle="tab" data-bs-target="#{{ $language->code }}" type="button" role="tab"
                        aria-controls="{{ $language->code }}" aria-selected="true">{{ $language->name }}</button>
            </li>
        @else
            <li class="nav-item" role="presentation">
                <button class="nav-link small" id="{{ $language->code }}-tab"
                        data-bs-toggle="tab" data-bs-target="#{{ $language->code }}" type="button" role="tab"
                        aria-controls="{{ $language->code }}" aria-selected="false">{{ $language->name }}</button>
            </li>
        @endif
    @endforeach
</ul>
<div class="tab-content" id="localizedContent">{{ $slot }}</div>
