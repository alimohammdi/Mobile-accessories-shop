
<!doctype html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="فروشگاه موبایل و لوازم جانبی غباس با بهترین قیمت و ارسال سریع"
    />
    <meta property="og:title" content="غباس | فروشگاه موبایل و لوازم جانبی" />
    <meta
      property="og:description"
      content="خرید لوازم جانبی موبایل با بهترین قیمت"
    />
    <meta property="og:type" content="website" />
    <link rel="icon" href="favicon.ico" />
    <title>غباس | فروشگاه موبایل و لوازم جانبی</title>
    @verbatim
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Store",
        "name": "GHABOS",
        "url": "https://ghabos.ir",
        "description": "غباس، مرجع تخصصی فروش گوشی موبایل و لوازم جانبی اصل",
        "telephone": "021-12345678",
        "email": "support@ghabos.ir",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "تهران",
          "addressRegion": "سعادت‌آباد",
          "addressCountry": "IR"
        }
      }
    </script>

    @endverbatim

    <!-- Performance: warm up connections to external origins early -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net" />
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin />
    <link rel="dns-prefetch" href="https://images.unsplash.com" />

    <link rel="stylesheet" href="{{  asset('front/css/style.css') }}" />
    <link rel="stylesheet" href="{{  asset('front/css/product_style.css') }}" />
    <link rel="stylesheet" href="{{  asset('front/css/about.css') }}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css"
    />
  </head>
  <body>

 <header class="header">
      <div class="container header__row">
        <a href="{{ route('home') }}" class="logo">
          <span class="logo__mark"
            ><img loading="eager" decoding="async" fetchpriority="high"
              src="{{ asset('front/images/ghabos-logo.png') }}"
              alt="لوگو قابوس"
              onerror="
                this.style.display = 'none';
                this.parentElement.innerHTML = '<i class=\'ti ti-bolt\'></i>';
              "
          /></span>
          <span>
            <span class="logo__text">قابوس</span>
            <span class="logo__sub">GHABOS.IR</span>
          </span>
        </a>

        <div class="search">
          <input
            type="text"
            placeholder="جستجوی سراسری در محصولات، برندها و دسته‌بندی‌ها..."
          />
          <button aria-label="جستجو"><i class="ti ti-search"></i></button>
        </div>

        <div class="header__actions">
          <a href="{{  route('login') }}" class="auth-pill">
            <i class="ti ti-user"></i>
            <span>ورود | ثبت‌نام</span>
          </a>
          <button class="icon-btn" aria-label="حالت شب" id="themeToggle">
            <i class="ti ti-moon"></i>
          </button>
          <button class="icon-btn" aria-label="علاقه‌مندی‌ها" id="wishlistBtn">
            <i class="ti ti-heart"></i>
            <span class="badge" id="wishlistBadge">۲</span>
          </button>
          <button class="icon-btn cart" aria-label="سبد خرید" id="cartBtn">
            <i class="ti ti-shopping-bag"></i>
            <span class="badge" id="cartBadge">۳</span>
          </button>
        </div>
      </div>

      <nav class="nav">
        <div class="container nav__row">
          <button class="mobile-menu-toggle" aria-label="منو">
            <i class="ti ti-menu-2"></i>
          </button>
          <button class="nav__cats">
            <i class="ti ti-menu-2"></i> همه دسته‌بندی‌ها
          </button>
          <a href="products.html">پرفروش‌ترین‌ها</a>
          <a href="products.html?filter=hot" class="nav__hot">شگفت‌انگیزها</a>
          <a href="products.html">تازه‌های فروشگاه</a>
          <a href="blog.html">مجله غباس</a>
          <a href="{{  route('about') }}">درباره ما</a>

          <a href="faq.html">پرسش‌های متداول</a>
          <div class="nav__spacer"></div>
          <div class="nav__delivery">
            <i class="ti ti-map-pin"></i>
            ارسال به: <b>تهران، سعادت‌آباد</b>
          </div>
        </div>
      </nav>
      <div class="mega-overlay" id="megaOverlay"></div>
      <div class="mega-menu" id="megaMenu">
        <div class="mega-sidebar">
          <a class="active">📱 موبایل</a>
          <a>🔋 پاوربانک</a>
          <a>🎧 هندزفری</a>
          <a>⌚ ساعت هوشمند</a>
          <a>🔌 شارژر و کابل</a>
          <a>📱 قاب و گلس</a>
        </div>
        <div class="mega-content">
          <div class="mega-col">
            <h4>گوشی موبایل</h4>
            <a>آیفون</a>
            <a>سامسونگ</a>
            <a>شیائومی</a>
            <a>آنر</a>
          </div>
          <div class="mega-col">
            <h4>لوازم جانبی</h4>
            <a>شارژر</a>
            <a>کابل</a>
            <a>پاوربانک</a>
            <a>گلس</a>
          </div>
          <div class="mega-col">
            <h4>محبوب‌ترین‌ها</h4>
            <a>آیفون 16</a>
            <a>گلکسی S25</a>
            <a>ردمی نوت</a>
            <a>ایرپاد</a>
          </div>
        </div>
      </div>

      <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar__overlay"></div>
        <aside class="mobile-sidebar__panel">
          <button class="mobile-sidebar__close">&times;</button>
          <a href="index.html">خانه</a>
          <a href="products.html">محصولات</a>
          <a href="categories.html">دسته‌بندی‌ها</a>
          <a href="blog.html">مجله</a>
          <a href="contact.html">تماس با ما</a>
        </aside>
      </div>
