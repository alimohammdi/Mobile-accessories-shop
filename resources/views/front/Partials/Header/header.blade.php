
 <header class="header">
      <div class="container header__row">
        <a href="index.html" class="logo">
          <span class="logo__mark"
            ><img loading="eager" decoding="async" fetchpriority="high"
              src="assets/images/logo.png"
              alt="لوگو غباس"
              onerror="
                this.style.display = 'none';
                this.parentElement.innerHTML = '<i class=\'ti ti-bolt\'></i>';
              "
          /></span>
          <span>
            <span class="logo__text">غباس</span>
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
          <a href="login.html" class="auth-pill">
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
