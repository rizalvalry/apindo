@if(count($all_categories) > 0)
    <section class="category-section">
        <div class="container">
            <div class="row g-3 g-lg-4">
                @forelse($allListingsAndCategory as $category)
                    <div class="col-xl-3 col-md-6 col-6">
                        <a href="{{ route('listing', [slug(optional($category->details)->name), $category->id]) }}">
                            <div class="category-box">
                                <div class="icon-box">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <div>
                                    <h5>@lang(optional($category->details)->name)</h5>
                                    <span>{{ $category->getCategoryCount() }} @lang('Listings')</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="listing-not-found">
                        <h5 class="text-center m-0">@lang("No Data Found")</h5>
                        <p class="text-center not-found-times">
                            <i class="fad fa-file-times not-found-times"></i>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endif
