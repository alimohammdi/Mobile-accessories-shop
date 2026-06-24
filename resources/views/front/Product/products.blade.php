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
          <aside class="sidebar" id="filterSidebar">

           <!-- Categories -->
            @include('front.product.partials.categories')

            <!-- Price Range -->
              @include('front.product.partials.priceRange')

            <!-- Brands -->

             @include('front.product.partials.brands')

            <!-- Rating -->

             @include('front.product.partials.rating')

            <!-- Availability -->

             @include('front.product.partials.availability')

          </aside>

          <!-- ===== PRODUCTS AREA ===== -->
          <div class="products-area">

            <!-- Top bar -->
            @include('front.product.partials.topbar')
            <!-- Quick filter chips -->
            @include('front.product.partials.quickfilter')

            <!-- Products Grid -->
            <div class="products-grid" id="productsGrid">

              <!-- Card 1 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=400&auto=format&fit=crop" alt="هندزفری بلوتوث Studio Buds" />
                  <span class="product-card__badge">۲۵٪</span>
                  <button class="product-card__fav" onclick="event.preventDefault(); this.classList.toggle('active'); this.style.color = this.classList.contains('active') ? 'var(--c-red)' : ''"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">هندزفری و اسپیکر</span>
                  <h3 class="product-card__title">هندزفری بی‌سیم بیتس مدل Studio Buds</h3>
                  <div class="product-card__rating">
                    ★ ۴.۶ <span>(۸۹ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۲,۴۰۰,۰۰۰</span>
                      <span class="new">۱,۸۵۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 2 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=400&auto=format&fit=crop" alt="ساعت هوشمند سامسونگ" />
                  <span class="product-card__badge green">جدید</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">ساعت هوشمند</span>
                  <h3 class="product-card__title">ساعت هوشمند سامسونگ گلکسی واچ ۶</h3>
                  <div class="product-card__rating">
                    ★ ۴.۷ <span>(۱۵۲ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۳,۸۰۰,۰۰۰</span>
                      <span class="new">۳,۱۵۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 3 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1583863788434-e58a36330cf0?q=80&w=400&auto=format&fit=crop" alt="کابل شارژ انکر" />
                  <span class="product-card__badge">۱۵٪</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">شارژر و کابل</span>
                  <h3 class="product-card__title">کابل شارژ سریع تایپ‌سی انکر مدل PowerLine</h3>
                  <div class="product-card__rating">
                    ★ ۴.۸ <span>(۱۲۴ نظر)</span>
                  </div>
                  <span class="product-card__stock low"><span class="stock-dot"></span> تنها ۳ عدد باقی</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۲۶۰,۰۰۰</span>
                      <span class="new">۲۲۴,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Banner inside grid -->
              @include('front.product.partials.banner')

              <!-- Card 4 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?q=80&w=400&auto=format&fit=crop" alt="قاب آیفون" />
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">قاب و محافظ</span>
                  <h3 class="product-card__title">قاب ژله‌ای ضدضربه مناسب آیفون ۱۵ پرو مکس</h3>
                  <div class="product-card__rating">
                    ★ ۴.۵ <span>(۶۱ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="new">۱۸۵,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 5 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=400&auto=format&fit=crop" alt="پاوربانک شیائومی" />
                  <span class="product-card__badge">۳۰٪</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">پاوربانک</span>
                  <h3 class="product-card__title">پاوربانک ۲۰۰۰۰ میلی‌آمپر شیائومی فست شارژ</h3>
                  <div class="product-card__rating">
                    ★ ۴.۹ <span>(۲۰۳ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۱,۴۵۰,۰۰۰</span>
                      <span class="new">۱,۰۲۵,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 6 - unavailable -->
              <a href="product.html" class="product-card unavailable">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1609692814859-44520415e4b6?q=80&w=400&auto=format&fit=crop" alt="هندزفری سامسونگ" />
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">هندزفری و اسپیکر</span>
                  <h3 class="product-card__title">هندزفری بلوتوث سامسونگ Galaxy Buds 2</h3>
                  <div class="product-card__rating">
                    ★ ۴.۳ <span>(۷۷ نظر)</span>
                  </div>
                  <span class="product-card__stock out"><span class="stock-dot"></span> ناموجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="new">۲,۸۰۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 7 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1556656793-08538906a9f8?q=80&w=400&auto=format&fit=crop" alt="شارژر دیواری انکر" />
                  <span class="product-card__badge blue">پرفروش</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">شارژر و کابل</span>
                  <h3 class="product-card__title">شارژر دیواری ۶۵ واتی انکر مدل Nano Pro</h3>
                  <div class="product-card__rating">
                    ★ ۴.۸ <span>(۳۴۱ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۸۵۰,۰۰۰</span>
                      <span class="new">۶۹۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 8 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?q=80&w=400&auto=format&fit=crop" alt="گلس محافظ صفحه" />
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">قاب و محافظ</span>
                  <h3 class="product-card__title">گلس محافظ صفحه ۹H ضد اثر انگشت آیفون ۱۵</h3>
                  <div class="product-card__rating">
                    ★ ۴.۴ <span>(۱۱۸ نظر)</span>
                  </div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۱۲۰,۰۰۰</span>
                      <span class="new">۸۵,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 9 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=400&auto=format&fit=crop" alt="اسپیکر بلوتوث JBL" />
                  <span class="product-card__badge">۲۰٪</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">هندزفری و اسپیکر</span>
                  <h3 class="product-card__title">اسپیکر بلوتوث JBL Charge 5 ضدآب</h3>
                  <div class="product-card__rating">
                    ★ ۴.۷ <span>(۲۲۶ نظر)</span>
                  </div>
                  <span class="product-card__stock low"><span class="stock-dot"></span> تنها ۵ عدد باقی</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۵,۲۰۰,۰۰۰</span>
                      <span class="new">۴,۱۶۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 10 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=400&auto=format&fit=crop" alt="هدفون بی‌سیم سونی" />
                  <span class="product-card__badge">۱۰٪</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">هندزفری و اسپیکر</span>
                  <h3 class="product-card__title">هدفون بی‌سیم سونی WH-1000XM5 نویزکنسل</h3>
                  <div class="product-card__rating">★ ۴.۹ <span>(۳۱۲ نظر)</span></div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۱۲,۵۰۰,۰۰۰</span>
                      <span class="new">۱۱,۲۵۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 11 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1585771724684-38269d6639fd?q=80&w=400&auto=format&fit=crop" alt="ساعت هوشمند اپل" />
                  <span class="product-card__badge blue">پرفروش</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">ساعت هوشمند</span>
                  <h3 class="product-card__title">اپل واچ سری ۹ ۴۵ میلی‌متری آلومینیوم</h3>
                  <div class="product-card__rating">★ ۴.۸ <span>(۱۸۷ نظر)</span></div>
                  <span class="product-card__stock low"><span class="stock-dot"></span> تنها ۲ عدد باقی</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۲۲,۰۰۰,۰۰۰</span>
                      <span class="new">۱۹,۸۰۰,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

              <!-- Card 12 -->
              <a href="product.html" class="product-card">
                <div class="product-card__media">
                  <img loading="lazy" src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=400&auto=format&fit=crop" alt="فلش مموری سامسونگ" />
                  <span class="product-card__badge green">جدید</span>
                  <button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button>
                  <button class="product-card__compare" onclick="event.preventDefault()"><i class="ti ti-git-compare"></i> مقایسه</button>
                </div>
                <div class="product-card__body">
                  <span class="product-card__cat">حافظه و فلش</span>
                  <h3 class="product-card__title">فلش مموری USB-C سامسونگ ۱۲۸ گیگابایت</h3>
                  <div class="product-card__rating">★ ۴.۶ <span>(۹۴ نظر)</span></div>
                  <span class="product-card__stock in"><span class="stock-dot"></span> موجود</span>
                  <div class="product-card__footer">
                    <div class="product-card__price">
                      <span class="old">۴۸۰,۰۰۰</span>
                      <span class="new">۳۸۵,۰۰۰ <small>تومان</small></span>
                    </div>
                    <button class="product-card__add" onclick="event.preventDefault(); addToCart(this)"><i class="ti ti-plus"></i></button>
                  </div>
                </div>
              </a>

            </div>

            <!-- Pagination -->
            <div class="pagination">
              <button class="page-btn arrow"><i class="ti ti-chevron-right"></i></button>
              <button class="page-btn active">۱</button>
              <button class="page-btn">۲</button>
              <button class="page-btn">۳</button>
              <span style="color:var(--c-muted);padding:0 4px;">...</span>
              <button class="page-btn">۱۲</button>
              <button class="page-btn arrow"><i class="ti ti-chevron-left"></i></button>
            </div>

          </div>
        </div>
      </div>
    </main>
 @include('front.partials.Footer.footer')
@endsection
