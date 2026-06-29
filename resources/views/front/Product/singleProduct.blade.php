@extends('front.layouts.master')
@section('content')
 <!-- Topbar -->
    @include('front/Partials/Topbar/topbar')

    <!-- Header -->
    @include('front/Partials/Header/header')
    </header>

<main>
<div class="container">

  <nav class="breadcrumb">
    <a href="index_production_responsive.html">خانه</a>
    <i class="ti ti-chevron-left"></i>
    <a href="products.html">محصولات</a>
    <i class="ti ti-chevron-left"></i>
    <a href="products.html?cat=headphone">هندزفری و اسپیکر</a>
    <i class="ti ti-chevron-left"></i>
    <span>هندزفری بی‌سیم بیتس Studio Buds</span>
  </nav>

  <div class="product-hero">

    <!-- Gallery -->
    <div class="gallery">
      <div class="gallery__stage">
        <span class="gallery__ribbon">۲۵٪ تخفیف</span>
        <img id="mainImg"
          src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=700&auto=format&fit=crop"
          alt="هندزفری بی‌سیم بیتس Studio Buds" fetchpriority="high"/>
        <div class="gallery__avail"><span class="avail-pulse"></span>موجود در انبار</div>
      </div>
      <div class="gallery__thumbs">
        <div class="gallery__thumb active" data-src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=500&auto=format&fit=crop">
          <img loading="lazy" src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=120&auto=format&fit=crop" alt=""/>
        </div>
        <div class="gallery__thumb" data-src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=500&auto=format&fit=crop">
          <img loading="lazy" src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=120&auto=format&fit=crop" alt=""/>
        </div>
        <div class="gallery__thumb" data-src="https://images.unsplash.com/photo-1609692814859-44520415e4b6?q=80&w=500&auto=format&fit=crop">
          <img loading="lazy" src="https://images.unsplash.com/photo-1609692814859-44520415e4b6?q=80&w=120&auto=format&fit=crop" alt=""/>
        </div>
        <div class="gallery__thumb" data-src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=500&auto=format&fit=crop">
          <img loading="lazy" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=120&auto=format&fit=crop" alt=""/>
        </div>
      </div>
    </div>

    <!-- Info -->
    <div class="product-info">
      <div class="product-info__brand">Beats by Dr. Dre</div>
      <h1 class="product-info__name">هندزفری بی‌سیم بیتس<br/>مدل Studio Buds</h1>

      <div class="product-info__meta">
        <div class="stars">★★★★★</div>
        <span class="rating-val">۴.۶</span>
        <span class="review-count">(۸۹ نظر)</span>
        <span class="meta-sep">|</span>
        <span class="sold-count"><b>۱٬۲۴۰</b> فروش</span>
        <span class="meta-sep">|</span>
        <span style="font-size:12px;color:var(--c-muted)">کد: BEAT-SB-BLK</span>
      </div>

      <div class="countdown-box">
        <div class="countdown-label"><i class="ti ti-flame"></i> پایان تخفیف:</div>
        <div class="countdown-digits">
          <div class="cd-block"><b id="cd-h">۰۸</b><small>ساعت</small></div>
          <span class="cd-sep">:</span>
          <div class="cd-block"><b id="cd-m">۴۳</b><small>دقیقه</small></div>
          <span class="cd-sep">:</span>
          <div class="cd-block"><b id="cd-s">۱۷</b><small>ثانیه</small></div>
        </div>
      </div>

      <div class="price-block">
        <div>
          <div class="price-block__old">۲,۴۰۰,۰۰۰ تومان</div>
          <div class="price-block__new">۱,۸۵۰,۰۰۰ <small>تومان</small></div>
        </div>
        <span class="price-block__badge">۲۵٪<br/>تخفیف</span>
      </div>

      <div>
        <div class="option-label">رنگ: <b style="color:var(--c-ink)" id="colorName">مشکی</b></div>
        <div class="color-picker">
          <button class="color-btn active" style="background:#1a1a1a" onclick="selectColor(this,'مشکی')"></button>
          <button class="color-btn" style="background:#f5f5f5;border-color:#ddd" onclick="selectColor(this,'سفید')"></button>
          <button class="color-btn" style="background:#c0392b" onclick="selectColor(this,'قرمز')"></button>
          <button class="color-btn" style="background:#2980b9" onclick="selectColor(this,'آبی')"></button>
        </div>
      </div>

      <div>
        <div class="option-label">سایز: <b style="color:var(--c-ink)" id="sizeName">S</b></div>
        <div class="size-picker">
          <button class="size-btn active" onclick="selectSize(this,'S')">S</button>
          <button class="size-btn" onclick="selectSize(this,'M')">M</button>
          <button class="size-btn" onclick="selectSize(this,'L')">L</button>
          <button class="size-btn" onclick="selectSize(this,'XL')">XL</button>
          <button class="size-btn disabled" disabled title="ناموجود">XXL</button>
        </div>
      </div>

      <!-- CTA row: wish | cart (large) | qty -->
      <div class="cta-row">
        <button class="btn-wish" id="wishBtn" onclick="toggleWish()">
          <i class="ti ti-heart"></i>
        </button>
        <button class="btn-cart" id="cartBtn" onclick="addToCart()">
          <i class="ti ti-shopping-bag"></i> افزودن به سبد خرید
        </button>
        <div class="qty-box">
          <button class="qty-btn" onclick="changeQty(1)"><i class="ti ti-plus"></i></button>
          <input class="qty-num" id="qtyNum" type="text" value="۱" readonly/>
          <button class="qty-btn" onclick="changeQty(-1)"><i class="ti ti-minus"></i></button>
        </div>
      </div>

      <!-- Mobile inline add-to-cart (below color/size) -->
      <button class="btn-cart-mobile" id="cartBtnMobile" onclick="addToCart()">
        <i class="ti ti-shopping-bag"></i> افزودن به سبد خرید
      </button>

      <div class="trust-row">
        <div class="trust-item"><i class="ti ti-shield-check"></i><span>گارانتی اصالت</span><small>کالای ۱۰۰٪ اصل</small></div>
        <div class="trust-item"><i class="ti ti-truck-delivery"></i><span>ارسال سریع</span><small>فوری در تهران</small></div>
        <div class="trust-item"><i class="ti ti-refresh"></i><span>۷ روز مرجوعی</span><small>بدون قید و شرط</small></div>
      </div>

      <div class="share-row">
        <span>اشتراک‌گذاری:</span>
        <button class="share-btn" title="تلگرام"><i class="ti ti-brand-telegram"></i></button>
        <button class="share-btn" title="واتس‌اپ"><i class="ti ti-brand-whatsapp"></i></button>
        <button class="share-btn" onclick="copyLink()" title="کپی لینک"><i class="ti ti-link"></i></button>
      </div>
    </div>
  </div>

  <!-- TABS -->
  <div class="tabs-section">
    <div class="tabs-nav">
      <button class="tab-btn active" data-tab="desc">توضیحات</button>
      <button class="tab-btn" data-tab="specs">مشخصات فنی</button>
      <button class="tab-btn" data-tab="reviews">نظرات (۸۹)</button>
    </div>

    <div class="tab-panel active" id="tab-desc">
      <div class="desc-grid">
        <div class="desc-body">
          <p>هندزفری <strong>Beats Studio Buds</strong> با طراحی فشرده و کاملاً بی‌سیم، تجربه‌ای بی‌نظیر از صدا را ارائه می‌دهد. با حذف نویز فعال (ANC) و حالت Transparency، کنترل کامل صدا در دست شماست.</p>
          <p>درایور ۸.۲ میلی‌متری اختصاصی با طراحی صوتی دو طرفه، باس عمیق، میانه‌های شفاف و <strong>تریبل‌های بلوری</strong> را تضمین می‌کند. سازگاری کامل با اپل و اندروید بدون نیاز به اپلیکیشن.</p>
          <p>با شارژ سریع ۵ دقیقه‌ای، یک ساعت موسیقی دارید. مقاومت در برابر آب و عرق با استاندارد <strong>IPX4</strong> این هندزفری را همراه ایده‌آل ورزش می‌کند.</p>
        </div>
        <div class="desc-features">
          <div class="feat-item"><i class="ti ti-wave-sine"></i><div><h4>حذف نویز فعال (ANC)</h4><p>کاهش ۹۰٪ صدای محیط با الگوریتم پیشرفته</p></div></div>
          <div class="feat-item"><i class="ti ti-battery-charging"></i><div><h4>۳۶ ساعت باتری</h4><p>۸ ساعت هندزفری + ۲۸ ساعت با کیس شارژ</p></div></div>
          <div class="feat-item"><i class="ti ti-droplet"></i><div><h4>مقاومت IPX4</h4><p>ضد عرق و پاشش آب برای استفاده ورزشی</p></div></div>
          <div class="feat-item"><i class="ti ti-brand-apple"></i><div><h4>سازگاری همه‌جانبه</h4><p>بلوتوث ۵.۲ با آیفون و اندروید</p></div></div>
        </div>
      </div>
    </div>

    <div class="tab-panel" id="tab-specs">
      <table class="specs-table">
        <tr><td>برند</td><td>Beats by Dr. Dre</td></tr>
        <tr><td>مدل</td><td>Studio Buds (2023)</td></tr>
        <tr><td>اتصال</td><td>بلوتوث ۵.۲</td></tr>
        <tr><td>درایور</td><td>۸.۲ میلی‌متر، دو طرفه</td></tr>
        <tr><td>حذف نویز</td><td>ANC + Transparency Mode</td></tr>
        <tr><td>باتری</td><td>۸ ساعت / ۳۶ ساعت با کیس</td></tr>
        <tr><td>شارژ</td><td>USB-C، شارژ سریع ۵ دقیقه = ۱ ساعت</td></tr>
        <tr><td>مقاومت</td><td>IPX4</td></tr>
        <tr><td>وزن</td><td>۵ گرم هر گوشی / ۴۵.۶ گرم کیس</td></tr>
        <tr><td>رنگ‌ها</td><td>مشکی، سفید، قرمز، آبی</td></tr>
        <tr><td>گارانتی</td><td>۱۸ ماه تعویض</td></tr>
      </table>
    </div>

    <div class="tab-panel" id="tab-reviews">
      <div class="reviews-header">
        <div class="rating-summary">
          <div class="rating-big">
            <b>۴.۶</b>
            <div class="stars">★★★★★</div>
            <small>از ۸۹ نظر</small>
          </div>
          <div class="rating-bars">
            <div class="bar-row"><span>۵★</span><div class="bar-track"><div class="bar-fill" style="width:72%"></div></div><span>۶۴</span></div>
            <div class="bar-row"><span>۴★</span><div class="bar-track"><div class="bar-fill" style="width:18%"></div></div><span>۱۶</span></div>
            <div class="bar-row"><span>۳★</span><div class="bar-track"><div class="bar-fill" style="width:6%"></div></div><span>۵</span></div>
            <div class="bar-row"><span>۲★</span><div class="bar-track"><div class="bar-fill" style="width:3%"></div></div><span>۳</span></div>
            <div class="bar-row"><span>۱★</span><div class="bar-track"><div class="bar-fill" style="width:1%"></div></div><span>۱</span></div>
          </div>
        </div>
        <button class="write-review-btn"><i class="ti ti-pencil"></i> ثبت نظر</button>
      </div>
      <div class="reviews-list">
        <div class="review-card">
          <div class="review-card__head">
            <div class="reviewer"><div class="reviewer__avatar">م</div><div><div class="reviewer__name">محمد ر.</div><div class="reviewer__date">۱۵ خرداد ۱۴۰۵</div></div></div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px"><div class="review-stars">★★★★★</div><span class="verified-badge"><i class="ti ti-check"></i> خرید تأیید شده</span></div>
          </div>
          <p class="review-card__text">کیفیت صدا فوق‌العاده‌ست! ANC عالی کار می‌کنه. باتری هم خیلی خوبه، تقریباً ۲ روز بدون شارژ کیس داشتم استفاده می‌کردم. پیشنهاد می‌کنم.</p>
          <div class="review-card__helpful"><span>مفید بود؟</span><button class="helpful-btn"><i class="ti ti-thumb-up"></i> بله (۱۲)</button><button class="helpful-btn"><i class="ti ti-thumb-down"></i> خیر (۱)</button></div>
        </div>
        <div class="review-card">
          <div class="review-card__head">
            <div class="reviewer"><div class="reviewer__avatar" style="background:linear-gradient(120deg,#e74c3c,#c0392b)">ز</div><div><div class="reviewer__name">زهرا م.</div><div class="reviewer__date">۳ اردیبهشت ۱۴۰۵</div></div></div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px"><div class="review-stars">★★★★☆</div><span class="verified-badge"><i class="ti ti-check"></i> خرید تأیید شده</span></div>
          </div>
          <p class="review-card__text">ارسال سریع بود و بسته‌بندی شیک. صدا خوبه ولی برای گوش‌های کوچیک‌تر ممکنه کمی ناراحت باشه. سه سایز ایرتیپ داره که خوبه. برای این قیمت ارزش داره.</p>
          <div class="review-card__helpful"><span>مفید بود؟</span><button class="helpful-btn"><i class="ti ti-thumb-up"></i> بله (۷)</button><button class="helpful-btn"><i class="ti ti-thumb-down"></i> خیر (۰)</button></div>
        </div>
        <div class="review-card">
          <div class="review-card__head">
            <div class="reviewer"><div class="reviewer__avatar" style="background:linear-gradient(120deg,#2980b9,#1a5276)">ع</div><div><div class="reviewer__name">علی ک.</div><div class="reviewer__date">۱۸ فروردین ۱۴۰۵</div></div></div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px"><div class="review-stars">★★★★★</div><span class="verified-badge"><i class="ti ti-check"></i> خرید تأیید شده</span></div>
          </div>
          <p class="review-card__text">دومین باری که این هندزفری رو می‌خرم. اولی رو گم کردم! کیفیتش واقعاً بی‌نظیره، مخصوصاً برای ورزش. ضدعرقه و توی تمرین اذیت نمی‌کنه.</p>
          <div class="review-card__helpful"><span>مفید بود؟</span><button class="helpful-btn"><i class="ti ti-thumb-up"></i> بله (۵)</button><button class="helpful-btn"><i class="ti ti-thumb-down"></i> خیر (۰)</button></div>
        </div>
      </div>
    </div>
  </div>

  <!-- RELATED -->
  <div class="related-section">
    <div class="section-head">
      <h2 class="section-title">محصولات مشابه</h2>
      <a href="products.html?cat=headphone" class="see-all">مشاهده همه <i class="ti ti-chevron-left"></i></a>
    </div>
    <div class="related-grid">
      <a href="product.html" class="product-card">
        <div class="product-card__media"><img loading="lazy" src="https://images.unsplash.com/photo-1609692814859-44520415e4b6?q=80&w=300&auto=format&fit=crop" alt=""/><span class="product-card__badge">۱۵٪</span><button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button></div>
        <div class="product-card__body"><span class="product-card__cat">هندزفری</span><h3 class="product-card__title">هندزفری Galaxy Buds 2 Pro سامسونگ</h3><div class="product-card__rating">★ ۴.۳ <span>(۷۷)</span></div><div class="product-card__footer"><div class="product-card__price"><span class="old">۳,۳۰۰,۰۰۰</span><span class="new">۲,۸۰۰,۰۰۰ <small>تومان</small></span></div><button class="product-card__add" onclick="event.preventDefault()"><i class="ti ti-plus"></i></button></div></div>
      </a>
      <a href="product.html" class="product-card">
        <div class="product-card__media"><img loading="lazy" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=300&auto=format&fit=crop" alt=""/><button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button></div>
        <div class="product-card__body"><span class="product-card__cat">هندزفری</span><h3 class="product-card__title">هدفون بی‌سیم سونی WH-1000XM5</h3><div class="product-card__rating">★ ۴.۹ <span>(۳۱۲)</span></div><div class="product-card__footer"><div class="product-card__price"><span class="new">۱۱,۲۵۰,۰۰۰ <small>تومان</small></span></div><button class="product-card__add" onclick="event.preventDefault()"><i class="ti ti-plus"></i></button></div></div>
      </a>
      <a href="product.html" class="product-card">
        <div class="product-card__media"><img loading="lazy" src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=300&auto=format&fit=crop" alt=""/><span class="product-card__badge green">جدید</span><button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button></div>
        <div class="product-card__body"><span class="product-card__cat">اسپیکر</span><h3 class="product-card__title">اسپیکر بلوتوث JBL Charge 5 ضدآب</h3><div class="product-card__rating">★ ۴.۷ <span>(۲۲۶)</span></div><div class="product-card__footer"><div class="product-card__price"><span class="old">۵,۲۰۰,۰۰۰</span><span class="new">۴,۱۶۰,۰۰۰ <small>تومان</small></span></div><button class="product-card__add" onclick="event.preventDefault()"><i class="ti ti-plus"></i></button></div></div>
      </a>
      <a href="product.html" class="product-card">
        <div class="product-card__media"><img loading="lazy" src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?q=80&w=300&auto=format&fit=crop" alt=""/><span class="product-card__badge blue">پرفروش</span><button class="product-card__fav" onclick="event.preventDefault()"><i class="ti ti-heart"></i></button></div>
        <div class="product-card__body"><span class="product-card__cat">هندزفری</span><h3 class="product-card__title">ایرپادز پرو نسل دوم اپل AirPods Pro 2</h3><div class="product-card__rating">★ ۴.۸ <span>(۴۵۱)</span></div><div class="product-card__footer"><div class="product-card__price"><span class="old">۱۸,۰۰۰,۰۰۰</span><span class="new">۱۵,۵۰۰,۰۰۰ <small>تومان</small></span></div><button class="product-card__add" onclick="event.preventDefault()"><i class="ti ti-plus"></i></button></div></div>
      </a>
    </div>
  </div>

</div>
</main>

<!-- Sticky CTA mobile -->
<div class="sticky-cta">
  <div class="sticky-cta__price">
    <div class="old">۲,۴۰۰,۰۰۰ تومان</div>
    <div class="new">۱,۸۵۰,۰۰۰ تومان</div>
  </div>
  <button class="sticky-cta__btn" id="stickyCartBtn" onclick="addToCart()">
    <i class="ti ti-shopping-bag"></i> افزودن به سبد
  </button>
</div>

 @include('front.partials.Footer.footer')
 <script>

const P = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
function tP(n) {
    return String(n)
        .split("")
        .map((d) => P[d] || d)
        .join("");
}

/* Gallery */
const mainImg = document.getElementById("mainImg");
mainImg.style.transition = "opacity .2s,transform .2s";
document.querySelectorAll(".gallery__thumb").forEach((th) => {
    th.addEventListener("click", () => {
        document
            .querySelectorAll(".gallery__thumb")
            .forEach((t) => t.classList.remove("active"));
        th.classList.add("active");
        mainImg.style.opacity = "0";
        mainImg.style.transform = "scale(.95)";
        setTimeout(() => {
            mainImg.src = th.dataset.src;
            mainImg.style.opacity = "1";
            mainImg.style.transform = "scale(1)";
        }, 200);
    });
});

/* Color */
function selectColor(btn, name) {
    document
        .querySelectorAll(".color-btn")
        .forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    document.getElementById("colorName").textContent = name;
}

/* Size */
function selectSize(btn, name) {
    document
        .querySelectorAll(".size-btn")
        .forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    document.getElementById("sizeName").textContent = name;
}

/* Qty */
let qty = 1;
function changeQty(d) {
    qty = Math.max(1, Math.min(10, qty + d));
    document.getElementById("qtyNum").value = tP(qty);
}

/* Cart */
let cartCount = 3;
function addToCart() {
    cartCount++;
    document.getElementById("cartBadge").textContent = tP(cartCount);
    const btns = [
        document.getElementById("cartBtn"),
        document.getElementById("stickyCartBtn"),
        document.getElementById("cartBtnMobile"),
    ];
    btns.forEach((b) => {
        if (!b) return;
        const orig = b.innerHTML;
        b.innerHTML = '<i class="ti ti-check"></i> اضافه شد!';
        b.style.background = "var(--c-green)";
        setTimeout(() => {
            b.innerHTML = orig;
            b.style.background = "";
        }, 1300);
    });
}

/* Wishlist */
function toggleWish() {
    const btn = document.getElementById("wishBtn");
    btn.classList.toggle("active");
    btn.querySelector("i").className = btn.classList.contains("active")
        ? "ti ti-heart-filled"
        : "ti ti-heart";
}

/* Copy link */
function copyLink() {
    navigator.clipboard.writeText(location.href).catch(() => {});
    const b = event.currentTarget;
    b.innerHTML = '<i class="ti ti-check"></i>';
    setTimeout(() => {
        b.innerHTML = '<i class="ti ti-link"></i>';
    }, 1500);
}

/* Tabs */
document.querySelectorAll(".tab-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        document
            .querySelectorAll(".tab-btn")
            .forEach((b) => b.classList.remove("active"));
        document
            .querySelectorAll(".tab-panel")
            .forEach((p) => p.classList.remove("active"));
        btn.classList.add("active");
        document
            .getElementById("tab-" + btn.dataset.tab)
            .classList.add("active");
    });
});

/* Countdown */
let total = 8 * 3600 + 43 * 60 + 17;
function tick() {
    if (total <= 0) return;
    const h = Math.floor(total / 3600),
        m = Math.floor((total % 3600) / 60),
        s = total % 60;
    document.getElementById("cd-h").textContent = tP(
        String(h).padStart(2, "0"),
    );
    document.getElementById("cd-m").textContent = tP(
        String(m).padStart(2, "0"),
    );
    document.getElementById("cd-s").textContent = tP(
        String(s).padStart(2, "0"),
    );
    total--;
}
tick();
setInterval(tick, 1000);

/* Lazy */
document.querySelectorAll("img[loading]").forEach((i) => (i.loading = "lazy"));

 </script>
@endsection

