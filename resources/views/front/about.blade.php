@extends('front.layouts.master')
@section('content')
    <!-- Topbar -->
    @include('front/Partials/Topbar/topbar')

    <!-- Header -->
    @include('front/Partials/Header/header')
    </header>

     <main>
      <!-- About hero -->
      <section class="container" style="padding: 32px 24px 0">
        <div class="about-hero">
          <img
            loading="eager"
            decoding="async"
            fetchpriority="high"
            class="about-hero__bg"
            src="https://images.unsplash.com/photo-1556740758-90de374c12ad?q=80&w=1400&auto=format&fit=crop"
            alt="تیم قابوس در حال کار"
          />
          <div class="about-hero__content">
            <span class="about-hero__eyebrow"
              ><i class="ti ti-building-store"></i> درباره قابوس</span
            >
            <h1 class="about-hero__title">
              همراه شما در انتخاب درست لوازم جانبی موبایل
            </h1>
            <p class="about-hero__desc">
              از یک فروشگاه کوچک محلی تا یک فروشگاه آنلاین معتبر؛ ماجرای ما
              همیشه درباره یک چیز بوده: کیفیت اصل، قیمت منصفانه و اعتماد
              مشتری.
            </p>
          </div>
        </div>
      </section>

      <!-- Story -->
      <section class="container section">
        <div class="story">
          <div class="story__media">
            <img
              loading="lazy"
              decoding="async"
              src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=900&auto=format&fit=crop"
              alt="فروشگاه لوازم جانبی موبایل قابوس"
            />
          </div>
          <div class="story__content">
            <h2 class="section__title">داستان <span>قابوس</span></h2>
            <p>
              غباس کار خودش را در سال ۱۳۹۹ با یک ویترین کوچک در سعادت‌آباد
              تهران شروع کرد؛ جایی که هدف ساده بود: فروش لوازم جانبی اصل،
              بدون واسطه‌های غیرضروری و با قیمتی که مشتری حس نکند سرش کلاه
              رفته.
            </p>
            <p>
              امروز قابوس به یک فروشگاه آنلاین تبدیل شده که هزاران محصول از
              برندهای معتبر را با گارانتی واقعی به سراسر ایران ارسال می‌کند،
              اما همان نگاه اول هنوز پایه کارمان است.
            </p>
            <div class="story__list">
              <div class="story__list-item">
                <i class="ti ti-shield-check"></i>
                <div>
                  <b>اصالت تضمینی</b>
                  <span>تمام محصولات با گارانتی اصلی و قابل استعلام</span>
                </div>
              </div>
              <div class="story__list-item">
                <i class="ti ti-truck-delivery"></i>
                <div>
                  <b>ارسال سریع</b>
                  <span>تحویل به سراسر کشور در کمترین زمان ممکن</span>
                </div>
              </div>
              <div class="story__list-item">
                <i class="ti ti-headset"></i>
                <div>
                  <b>پشتیبانی واقعی</b>
                  <span>پاسخ‌گویی توسط افرادی که خودشان مشتری بوده‌اند</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Stats -->
      <section class="container section">
        <div class="section__head">
          <h2 class="section__title">قابوس در <span>اعداد</span></h2>
        </div>
        <div class="stats">
          <div class="stat-card">
            <div class="stat-card__icon"><i class="ti ti-calendar"></i></div>
            <span class="stat-card__num" data-count="6">۰</span>
            <div class="stat-card__label">سال تجربه</div>
          </div>
          <div class="stat-card">
            <div class="stat-card__icon"><i class="ti ti-users"></i></div>
            <span class="stat-card__num" data-count="48000">۰</span>
            <div class="stat-card__label">مشتری راضی</div>
          </div>
          <div class="stat-card">
            <div class="stat-card__icon">
              <i class="ti ti-package"></i>
            </div>
            <span class="stat-card__num" data-count="3200">۰</span>
            <div class="stat-card__label">محصول متنوع</div>
          </div>
          <div class="stat-card">
            <div class="stat-card__icon"><i class="ti ti-star"></i></div>
            <span class="stat-card__num" data-count="4.8" data-decimal="1"
              >۰</span
            >
            <div class="stat-card__label">امتیاز رضایت از ۵</div>
          </div>
        </div>
      </section>

      <!-- Team -->
      <section class="container section">
        <div class="section__head">
          <h2 class="section__title">با <span>تیم ما</span> آشنا شوید</h2>
        </div>
        <div class="team">
          <div class="team-card">
            <div class="team-card__photo">
              <img
                loading="lazy"
                decoding="async"
                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=300&auto=format&fit=crop"
                alt="مدیرعامل قابوس"
              />
            </div>
            <div class="team-card__name">امیر رضایی</div>
            <div class="team-card__role">مدیرعامل و بنیان‌گذار</div>
            <div class="team-card__socials">
              <a href="#" aria-label="لینکدین"
                ><i class="ti ti-brand-linkedin"></i
              ></a>
              <a href="#" aria-label="اینستاگرام"
                ><i class="ti ti-brand-instagram"></i
              ></a>
            </div>
          </div>
          <div class="team-card">
            <div class="team-card__photo">
              <img
                loading="lazy"
                decoding="async"
                src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=300&auto=format&fit=crop"
                alt="مدیر فروش قابوس"
              />
            </div>
            <div class="team-card__name">سارا احمدی</div>
            <div class="team-card__role">مدیر فروش</div>
            <div class="team-card__socials">
              <a href="#" aria-label="لینکدین"
                ><i class="ti ti-brand-linkedin"></i
              ></a>
              <a href="#" aria-label="اینستاگرام"
                ><i class="ti ti-brand-instagram"></i
              ></a>
            </div>
          </div>
          <div class="team-card">
            <div class="team-card__photo">
              <img
                loading="lazy"
                decoding="async"
                src="https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?q=80&w=300&auto=format&fit=crop"
                alt="مدیر پشتیبانی قابوس"
              />
            </div>
            <div class="team-card__name">رضا کریمی</div>
            <div class="team-card__role">مدیر پشتیبانی مشتریان</div>
            <div class="team-card__socials">
              <a href="#" aria-label="لینکدین"
                ><i class="ti ti-brand-linkedin"></i
              ></a>
              <a href="#" aria-label="اینستاگرام"
                ><i class="ti ti-brand-instagram"></i
              ></a>
            </div>
          </div>
          <div class="team-card">
            <div class="team-card__photo">
              <img
                loading="lazy"
                decoding="async"
                src="https://images.unsplash.com/photo-1601412436009-d964bd02edbc?q=80&w=300&auto=format&fit=crop"
                alt="مدیر فنی قابوس"
              />
            </div>
            <div class="team-card__name">نگار حسینی</div>
            <div class="team-card__role">مدیر فنی و توسعه</div>
            <div class="team-card__socials">
              <a href="#" aria-label="لینکدین"
                ><i class="ti ti-brand-linkedin"></i
              ></a>
              <a href="#" aria-label="اینستاگرام"
                ><i class="ti ti-brand-instagram"></i
              ></a>
            </div>
          </div>
        </div>
      </section>

      <!-- Newsletter -->
      @include('front.Partials.NewsLatter.newsLatter')

  @include('front.partials.Footer.footer')
@endsection
