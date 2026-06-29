{{--  <div class="products-topbar">
              <div class="products-topbar__left">
                <button class="mobile-filter-btn" id="filterToggle">
                  <i class="ti ti-adjustments-horizontal"></i> فیلترها
                </button>
                <span class="products-count"><b id="productCount">۲۴۸</b> محصول یافت شد</span>
              </div>

              <div class="products-controls">
                <select class="sort-select" id="sortSelect">
                  <option value="default">مرتب‌سازی: پیش‌فرض</option>
                  <option value="popular">محبوب‌ترین</option>
                  <option value="newest">جدیدترین</option>
                  <option value="price-asc">ارزان‌ترین</option>
                  <option value="price-desc">گران‌ترین</option>
                  <option value="rating">بهترین امتیاز</option>
                </select>
              </div>
            </div>  --}}
{{-- تاپ‌بار: تعداد + تگ فیلتر فعال + مرتب‌سازی --}}
<div class="products-topbar">
    <div class="products-topbar__left">


        <span class="products-count">
            <b>{{ number_format($products->total()) }}</b> محصول یافت شد
        </span>

        {{-- تگ‌های فیلتر فعال --}}
        <div class="active-filters">
            @if(request('brand'))
                <a href="{{ route('products.index', request()->except(['brand', 'page'])) }}"
                   class="filter-tag">
                    {{ request('brand') }} <i class="ti ti-x"></i>
                </a>
            @endif

            @if(request('cat'))
                <a href="{{ route('products.index', request()->except(['cat', 'page'])) }}"
                   class="filter-tag">
                    {{ request('cat') }} <i class="ti ti-x"></i>
                </a>
            @endif

            @if(request('min_price') || request('max_price'))
                <a href="{{ route('products.index', request()->except(['min_price', 'max_price', 'page'])) }}"
                   class="filter-tag">
                    محدوده قیمت <i class="ti ti-x"></i>
                </a>
            @endif
        </div>
    </div>

    {{-- مرتب‌سازی --}}
    <div class="sort-wrapper" id="sortWrapper">
    <button type="button" class="sort-trigger" id="sortTrigger">
        <span class="sort-trigger__icon"><i class="ti ti-arrows-sort"></i></span>
        <span class="sort-trigger__label" id="sortLabel">پیش‌فرض</span>
        <i class="ti ti-chevron-down sort-trigger__arrow"></i>
    </button>
    <div class="sort-dropdown" id="sortDropdown">
        <div class="sort-option {{ request('sort','default')==='default' ? 'active' : '' }}"
             data-value="default" data-label="پیش‌فرض">
            <span class="sort-option__dot"><i class="ti ti-layout-grid"></i></span>
            پیش‌فرض
            <i class="ti ti-check sort-option__check"></i>
        </div>
        <div class="sort-option {{ request('sort')==='newest' ? 'active' : '' }}"
             data-value="newest" data-label="جدیدترین">
            <span class="sort-option__dot"><i class="ti ti-sparkles"></i></span>
            جدیدترین
            <i class="ti ti-check sort-option__check"></i>
        </div>
        <div class="sort-option {{ request('sort')==='popular' ? 'active' : '' }}"
             data-value="popular" data-label="محبوب‌ترین">
            <span class="sort-option__dot"><i class="ti ti-flame"></i></span>
            محبوب‌ترین
            <i class="ti ti-check sort-option__check"></i>
        </div>
        <div class="sort-option {{ request('sort')==='price-asc' ? 'active' : '' }}"
             data-value="price-asc" data-label="ارزان‌ترین">
            <span class="sort-option__dot"><i class="ti ti-trending-down"></i></span>
            ارزان‌ترین
            <i class="ti ti-check sort-option__check"></i>
        </div>
        <div class="sort-option {{ request('sort')==='price-desc' ? 'active' : '' }}"
             data-value="price-desc" data-label="گران‌ترین">
            <span class="sort-option__dot"><i class="ti ti-trending-up"></i></span>
            گران‌ترین
            <i class="ti ti-check sort-option__check"></i>
        </div>
    </div>

    {{-- input مخفی برای submit فرم --}}
    <input type="hidden" name="sort" id="sortInput"
           value="{{ request('sort', 'default') }}">
</div>
</div>
<script>
    // Sort dropdown سفارشی
const sortTrigger = document.getElementById('sortTrigger');
const sortDropdown = document.getElementById('sortDropdown');
const sortLabel = document.getElementById('sortLabel');
const sortInput = document.getElementById('sortInput');

if (sortTrigger) {
    // label اولیه بر اساس مقدار فعلی
    const activeOpt = sortDropdown?.querySelector('.sort-option.active');
    if (activeOpt) sortLabel.textContent = activeOpt.dataset.label;

    sortTrigger.addEventListener('click', () => {
        sortTrigger.classList.toggle('open');
        sortDropdown.classList.toggle('open');
    });

    sortDropdown.querySelectorAll('.sort-option').forEach(opt => {
        opt.addEventListener('click', () => {
            sortDropdown.querySelectorAll('.sort-option').forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
            sortLabel.textContent = opt.dataset.label;
            sortInput.value = opt.dataset.value;
            sortTrigger.classList.remove('open');
            sortDropdown.classList.remove('open');
            // submit فرم
            sortTrigger.closest('form')?.submit();
        });
    });

    document.addEventListener('click', e => {
        if (!document.getElementById('sortWrapper')?.contains(e.target)) {
            sortTrigger.classList.remove('open');
            sortDropdown.classList.remove('open');
        }
    });
}

</script>
