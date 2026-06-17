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
  <body>
    <!-- Topbar -->
   @include('front/Partials/Topbar/topbar')

    <!-- Header -->
    @include('front/Partials/Header/header')
    </header>

    <main>
      <!-- Hero -->
       @include('front.Partials.Banners.hero')

      <!-- Categories -->

      <!-- New products -->
       @include('front.Partials.NewProductsList.products')

      <!-- Promo banners -->
     @include('front.Partials.Banners.promo')

      <!-- Brands -->
     @include('front.Partials.Brands.brands')

      <!-- Newsletter -->
      @include('front.Partials.NewsLatter.newsLatter')

    <!-- Footer -->
     @include('front.partials.Footer.footer')
    </footer>

    <!-- Mobile bottom nav -->
       @include('front.Partials.Navbar.mobileNav')

    <!-- =================== CART MODAL =================== -->

     @include('front.partials.modal.cartModal')
    <!-- =================== WISHLIST MODAL =================== -->
      @include('front.partials.modal.wishlistModal')



