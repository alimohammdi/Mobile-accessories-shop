@extends('front.layouts.master')
@section('content')
 <!-- Topbar -->
    @include('front/Partials/Topbar/topbar')

    <!-- Header -->
    @include('front/Partials/Header/header')
    </header>

    <!-- Mobile sidebar overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main>
      <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
          <a href="index_production_responsive.html">خانه</a>
          <i class="ti ti-chevron-left"></i>
          <span>محصولات</span>
        </nav>

        <div class="products-page">

          <!-- ===== SIDEBAR FILTERS ===== -->
          <aside class="banner-col">

            <!-- بنر ۱: ارسال فوری -->
            <div class="side-banner green">
              <img loading="lazy" src="https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=600&auto=format&fit=crop" alt="ارسال فوری" />
              <div class="side-banner__body">
                <span class="side-banner__tag"><i class="ti ti-bolt"></i> ارسال فوری</span>
                <div class="side-banner__title">تحویل در کمتر از ۴ ساعت در تهران</div>
                <div class="side-banner__desc">برای سفارش‌های بالای ۵۰۰ هزار تومان ارسال رایگان است</div>
                <button class="side-banner__btn">خرید با ارسال فوری</button>
              </div>
            </div>

            <!-- بنر ۲: تخفیف ویژه -->
            <div class="side-banner blue">
              <img loading="lazy" src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=600&auto=format&fit=crop" alt="تخفیف ویژه" />
              <div class="side-banner__body">
                <span class="side-banner__tag"><i class="ti ti-tag"></i> پیشنهاد ویژه</span>
                <div class="side-banner__title">کد تخفیف ۱۰٪ برای اولین خرید</div>
                <div class="side-banner__desc">با کد <b>GHABOS10</b> روی تمام محصولات تخفیف بگیر</div>
                <button class="side-banner__btn">دریافت کد تخفیف</button>
              </div>
            </div>

          </aside>

          <!-- ===== PRODUCTS AREA ===== -->
          <form class="products-area">

            <!-- Top bar -->
            @include('front.product.partials.topbar')
            <!-- Quick filter chips -->
            @include('front.product.partials.quickfilter')

            <!-- Products Grid -->
   {{-- گرید محصولات --}}
    <div class="products-grid" id="productsGrid">
        @forelse($products as $product)
            <a href="{{ route('product-show', $product->id) }}" class="product-card">
                <div class="product-card__media">
                    <img loading="lazy" src="{{ $product->image }}" alt="{{ $product->title }}" />
                    @if($product->discount)
                        <span class="product-card__badge">{{ number_format($product->discount) }}٪</span>
                    @endif
                    <button class="product-card__fav" onclick="event.preventDefault()">
                        <i class="ti ti-heart"></i>
                    </button>
                </div>
                <div class="product-card__body">
                    <span class="product-card__cat">{{ $product->category->name }}</span>
                    <h3 class="product-card__title">{{ $product->title }}</h3>
                    <div class="product-card__rating">
                        ★ {{ $product->rating }}
                        <span>({{ number_format($product->reviews_count) }} نظر)</span>
                    </div>
                    <span class="product-card__stock {{ $product->stock > 0 ? 'in' : 'out' }}">
                        <span class="stock-dot"></span>
                        {{ $product->stock > 0 ? 'موجود' : 'ناموجود' }}
                    </span>
                    <div class="product-card__footer">
                        <div class="product-card__price">
                            @if($product->old_price)
                                <span class="old">
                                    {{ number_format($product->old_price) }}
                                </span>
                            @endif
                            <span class="new">
                                {{ number_format($product->price) }} <small>تومان</small>
                            </span>
                        </div>
                        <button class="product-card__add" onclick="event.preventDefault()">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
            </a>
        @empty
            <div class="products-empty">
                <i class="ti ti-search-off"></i>
                <p>محصولی یافت نشد</p>
                <a href="{{ route('products.index') }}">پاک کردن فیلترها</a>
            </div>
        @endforelse
    </div>

              {{-- صفحه‌بندی --}}
              {{ $products->links('components.pagination') }}
        </form>
          </div>
        </div>
      </div>
    </main>
 @include('front.partials.Footer.footer')
@endsection
