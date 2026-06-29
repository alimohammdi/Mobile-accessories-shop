<!doctype html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="محصولات فروشگاه غباس - لوازم جانبی موبایل با بهترین قیمت" />
    <title>غباس | محصولات</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net/"/>
    <link rel="preconnect" href="https://images.unsplash.com" />
    <link rel="preconnect" href="https://cdn.jsdelivr.net" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="{{  asset('front/css/style.css') }}" />
    <style>
      /* ===== BREADCRUMB ===== */
      .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--c-muted);
        padding: 14px 0 0;
      }
      .breadcrumb a { color: var(--c-muted); transition: color .2s; }
      .breadcrumb a:hover { color: var(--c-green); }
      .breadcrumb i { font-size: 11px; }

      /* ===== PAGE LAYOUT ===== */
      .products-page {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 28px;
        padding: 20px 0 48px;
        align-items: start;
      }

      /* ===== SIDEBAR ===== */
      .sidebar {
        position: sticky;
        top: 80px;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }
      .filter-box {
        background: var(--c-surface);
        border: 1px solid var(--c-border);
        border-radius: 16px;
        padding: 18px;
        overflow: visible;
        box-sizing: border-box;
        width: 100%;
      }
      .filter-box__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
      }
      .filter-box__title {
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--c-ink);
      }
      .filter-box__title i { color: var(--c-green); font-size: 16px; }
      .filter-box__clear {
        font-size: 12px;
        color: var(--c-muted);
        cursor: pointer;
        transition: color .2s;
      }
      .filter-box__clear:hover { color: var(--c-red); }

      /* Category filter */
      .cat-filter { display: flex; flex-direction: column; gap: 4px; }
      .cat-filter__item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 12px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13.5px;
        font-weight: 500;
        transition: all .2s;
        color: var(--c-ink);
      }
      .cat-filter__item:hover { background: var(--c-bg); }
      .cat-filter__item.active {
        background: linear-gradient(120deg, rgba(47,184,117,.12), rgba(46,143,230,.08));
        color: var(--c-green);
        font-weight: 700;
      }
      .cat-filter__count {
        font-size: 12px;
        color: var(--c-muted);
        background: var(--c-bg);
        padding: 2px 8px;
        border-radius: 20px;
        font-weight: 600;
      }
      .cat-filter__item.active .cat-filter__count {
        background: rgba(47,184,117,.15);
        color: var(--c-green);
      }

      /* Price range */
      .price-range { display: flex; flex-direction: column; gap: 12px; width: 100%; }
      .price-range__inputs { display: flex; gap: 6px; align-items: center; width: 100%; }
      .price-range__inputs input {
        flex: 1;
        min-width: 0;
        max-width: calc(50% - 16px);
        padding: 8px 4px;
        border: 1.5px solid var(--c-border);
        border-radius: 10px;
        font-family: inherit;
        font-size: 11.5px;
        background: var(--c-bg);
        color: var(--c-ink);
        text-align: center;
        outline: none;
        transition: border-color .2s;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .price-range__inputs input:focus { border-color: var(--c-green); }
      .price-range__sep { color: var(--c-muted); font-size: 14px; flex-shrink: 0; }
      .price-range__slider {
        width: 100%;
        max-width: 100%;
        display: block;
        accent-color: var(--c-green);
        box-sizing: border-box;
      }
      .price-range__labels { display: flex; justify-content: space-between; font-size: 11px; color: var(--c-muted); }

      /* Brand filter */
      .brand-checks { display: flex; flex-direction: column; gap: 8px; }
      .brand-check {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 4px 0;
      }
      .brand-check input[type="checkbox"] { accent-color: var(--c-green); width: 16px; height: 16px; }
      .brand-check__label { font-size: 13.5px; flex: 1; }
      .brand-check__count { font-size: 12px; color: var(--c-muted); }

      /* Rating filter */
      .rating-filter { display: flex; flex-direction: column; gap: 6px; }
      .rating-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 10px;
        cursor: pointer;
        transition: background .2s;
      }
      .rating-item:hover { background: var(--c-bg); }
      .rating-item input[type="radio"] { accent-color: var(--c-amber); }
      .rating-item__stars { color: var(--c-amber); font-size: 13px; }
      .rating-item__label { font-size: 13px; color: var(--c-muted); }
      .rating-item__label b { color: var(--c-ink); }

      /* ===== PRODUCTS AREA ===== */
      .products-area { min-width: 0; }

      /* Top bar */
      .products-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
      }
      .products-topbar__left {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .products-count {
        font-size: 14px;
        color: var(--c-muted);
      }
      .products-count b { color: var(--c-ink); }

      /* Active filter tags */
      .active-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
      }
      .filter-tag {
        display: flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(120deg, rgba(47,184,117,.1), rgba(46,143,230,.07));
        border: 1px solid rgba(47,184,117,.25);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        color: var(--c-green);
        cursor: pointer;
        transition: all .2s;
      }
      .filter-tag:hover { background: rgba(229,72,77,.08); border-color: rgba(229,72,77,.25); color: var(--c-red); }
      .filter-tag i { font-size: 11px; }

      /* Sort and view controls */
      .products-controls {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .sort-select {
        padding: 9px 14px;
        border: 1.5px solid var(--c-border);
        border-radius: 12px;
        font-family: inherit;
        font-size: 13px;
        background: var(--c-surface);
        color: var(--c-ink);
        outline: none;
        cursor: pointer;
        transition: border-color .2s;
      }
      .sort-select:focus { border-color: var(--c-green); }

      .view-toggle { display: flex; gap: 4px; }
      .view-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 1.5px solid var(--c-border);
        background: var(--c-surface);
        color: var(--c-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .2s;
        font-size: 16px;
      }
      .view-btn.active, .view-btn:hover {
        background: var(--c-green);
        border-color: var(--c-green);
        color: #fff;
      }

      /* ===== QUICK FILTER CHIPS ===== */
      .quick-filters {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--c-border);
      }
      .quick-filters-wrap {
        overflow: hidden;
      }
      /* Mobile: horizontal scroll for quick filters */
      @media (max-width: 768px) {
        .quick-filters-wrap {
          overflow: visible;
        }
        .quick-filters {
          flex-wrap: nowrap;
          overflow-x: auto;
          overflow-y: hidden;
          -webkit-overflow-scrolling: touch;
          scrollbar-width: none;
          padding-bottom: 12px;
          margin-bottom: 12px;
          gap: 6px;
        }
        .quick-filters::-webkit-scrollbar { display: none; }
        .quick-chip {
          flex-shrink: 0;
          font-size: 12.5px;
          padding: 6px 14px;
        }
      }
      .quick-chip {
        padding: 7px 16px;
        border-radius: 24px;
        border: 1.5px solid var(--c-border);
        background: var(--c-surface);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
        color: var(--c-ink);
        white-space: nowrap;
      }
      .quick-chip:hover { border-color: var(--c-green); color: var(--c-green); }
      .quick-chip.active {
        background: var(--grad);
        border-color: transparent;
        color: #fff;
      }

      /* ===== PRODUCTS GRID ===== */
      .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
      }
      .products-grid.list-view {
        grid-template-columns: 1fr;
        gap: 12px;
      }
      .products-grid.list-view .product-card {
        flex-direction: row;
        height: 150px;
      }
      .products-grid.list-view .product-card__media {
        width: 150px;
        min-width: 150px;
        flex-shrink: 0;
        aspect-ratio: unset;
        height: 150px;
        border-radius: var(--radius-card) 0 0 var(--radius-card);
        padding: 16px;
      }
      .products-grid.list-view .product-card__media img {
        width: 100%;
        height: 100%;
        object-fit: contain;
      }
      .products-grid.list-view .product-card__badge {
        top: 8px;
        right: 8px;
        font-size: 11px;
        padding: 2px 7px;
      }
      .products-grid.list-view .product-card__fav {
        top: 8px;
        left: 8px;
        width: 28px;
        height: 28px;
        font-size: 12px;
      }
      .products-grid.list-view .product-card__compare {
        display: none;
      }
      .products-grid.list-view .product-card__body {
        padding: 14px 16px;
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
        justify-content: center;
      }
      .products-grid.list-view .product-card__cat {
        font-size: 11px;
      }
      .products-grid.list-view .product-card__title {
        font-size: 14px;
        min-height: unset;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
      }
      .products-grid.list-view .product-card__rating {
        font-size: 11.5px;
      }
      .products-grid.list-view .product-card__stock {
        font-size: 11px;
      }
      .products-grid.list-view .product-card__footer {
        margin-top: auto;
        padding-top: 6px;
        align-items: center;
      }
      .products-grid.list-view .product-card__price .new {
        font-size: 14px;
      }
      .products-grid.list-view .product-card__add {
        width: 34px;
        height: 34px;
        font-size: 15px;
        border-radius: 10px;
      }
      .products-grid.list-view .products-banner {
        height: auto;
        min-height: unset;
      }

      /* Enhanced product card extras */
      .product-card__compare {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(255,255,255,0.9);
        border: 1px solid var(--c-border);
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 600;
        color: var(--c-muted);
        cursor: pointer;
        opacity: 0;
        transition: all .2s;
        display: flex;
        align-items: center;
        gap: 4px;
      }
      .product-card:hover .product-card__compare { opacity: 1; }
      .product-card__compare:hover { color: var(--c-blue); border-color: var(--c-blue); }

      body.dark .product-card__compare {
        background: rgba(22,36,42,0.9);
      }

      .product-card__badge.green {
        background: var(--c-green);
      }
      .product-card__badge.blue {
        background: var(--c-blue);
      }

      .product-card__stock {
        font-size: 11.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
      }
      .product-card__stock.in { color: var(--c-green); }
      .product-card__stock.low { color: var(--c-amber); }
      .product-card__stock.out { color: var(--c-red); }
      .stock-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        display: inline-block;
      }

      /* Unavailable overlay */
      .product-card.unavailable .product-card__media::after {
        content: 'ناموجود';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.35);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 16px;
        border-radius: 0;
      }
      .product-card.unavailable .product-card__add {
        opacity: .4;
        cursor: not-allowed;
        pointer-events: none;
      }

      /* ===== PAGINATION ===== */
      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 36px;
      }
      .page-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: 1.5px solid var(--c-border);
        background: var(--c-surface);
        color: var(--c-ink);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all .2s;
        font-family: inherit;
      }
      .page-btn:hover { border-color: var(--c-green); color: var(--c-green); }
      .page-btn.active {
        background: var(--grad);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 14px rgba(47,184,117,.3);
      }
      .page-btn.arrow { font-size: 17px; }

      /* ===== BANNER STRIP inside products ===== */
      .products-banner {
        grid-column: 1 / -1;
        background: linear-gradient(120deg, var(--c-green) 0%, var(--c-blue) 100%);
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        color: #fff;
      }
      .products-banner__text h3 { font-size: 16px; font-weight: 800; }
      .products-banner__text p { font-size: 13px; opacity: .85; margin-top: 4px; }
      .products-banner__btn {
        white-space: nowrap;
        background: rgba(255,255,255,.18);
        border: 1.5px solid rgba(255,255,255,.4);
        color: #fff;
        padding: 9px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        font-family: inherit;
      }
      .products-banner__btn:hover { background: rgba(255,255,255,.3); }

      /* ===== MOBILE FILTER TOGGLE ===== */
      .mobile-filter-btn {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: var(--c-surface);
        border: 1.5px solid var(--c-border);
        border-radius: 12px;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--c-ink);
        cursor: pointer;
      }
      .mobile-filter-btn i { color: var(--c-green); }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.5);
        z-index: 200;
      }
      .sidebar-overlay.open { display: block; }

      /* ===== RESPONSIVE ===== */
      @media (max-width: 1024px) {
        .products-grid { grid-template-columns: repeat(2, 1fr); }
      }

      @media (max-width: 768px) {
        .products-page {
          grid-template-columns: 1fr;
          padding: 16px 0 80px;
          gap: 16px;
        }
        .sidebar {
          position: fixed;
          top: 0;
          right: -100%;
          width: 290px;
          height: 100vh;
          overflow-y: auto;
          background: var(--c-surface);
          z-index: 500;
          padding: 20px 16px;
          transition: right .3s cubic-bezier(.4,0,.2,1);
          border-radius: 0;
          box-shadow: -4px 0 24px rgba(0,0,0,.15);
        }
        .sidebar.open { right: 0; }
        .sidebar-overlay {
          display: none;
          position: fixed;
          inset: 0;
          background: rgba(0,0,0,.5);
          z-index: 499;
          backdrop-filter: blur(2px);
        }
        .sidebar-overlay.open { display: block !important; }
        .mobile-filter-btn { display: flex !important; }
        .view-toggle { display: none; }
        .products-topbar { gap: 8px; }
        .products-banner { display: none; }
      }

      /* ===== Mobile list mode ===== */
      #productsGrid.mobile-list {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
      }
      #productsGrid.mobile-list .products-banner {
        display: none !important;
      }
      #productsGrid.mobile-list > a.product-card {
        flex-direction: row !important;
        height: 110px !important;
        min-height: unset !important;
      }
      #productsGrid.mobile-list > a.product-card:hover {
        transform: none !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__media {
        width: 110px !important;
        min-width: 110px !important;
        max-width: 110px !important;
        height: 110px !important;
        flex-shrink: 0 !important;
        aspect-ratio: unset !important;
        padding: 10px !important;
        border-radius: 0 !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__media img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__badge {
        top: 6px !important;
        right: 6px !important;
        font-size: 10px !important;
        padding: 2px 6px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__fav {
        top: 6px !important;
        left: 6px !important;
        width: 26px !important;
        height: 26px !important;
        font-size: 11px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__compare {
        display: none !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__body {
        padding: 10px 12px !important;
        flex: 1 !important;
        min-width: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
        justify-content: center !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__cat {
        font-size: 10px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__title {
        font-size: 13px !important;
        font-weight: 700 !important;
        min-height: unset !important;
        line-height: 1.4 !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__rating {
        font-size: 11px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__stock {
        font-size: 10.5px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__footer {
        margin-top: auto !important;
        padding-top: 4px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__price .old {
        font-size: 10px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__price .new {
        font-size: 13px !important;
      }
      #productsGrid.mobile-list > a.product-card .product-card__add {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        font-size: 14px !important;
        border-radius: 9px !important;
      }

      /* ===== DARK MODE extras ===== */
      body.dark .filter-box { border-color: var(--c-border); }
      body.dark .sort-select { background: var(--c-surface); border-color: var(--c-border); }
      body.dark .view-btn { background: var(--c-surface); border-color: var(--c-border); color: var(--c-muted); }
      body.dark .view-btn.active { background: var(--c-green); border-color: var(--c-green); color: #fff; }
      body.dark .quick-chip { background: var(--c-surface); border-color: var(--c-border); }
      body.dark .page-btn { background: var(--c-surface); border-color: var(--c-border); }
      body.dark .cat-filter__item:hover { background: rgba(255,255,255,.05); }
      body.dark .price-range__inputs input { background: var(--c-bg); }
      body.dark .sidebar { background: var(--c-surface); }

      /* ===== OVERRIDE: فایل CSS اصلی در موبایل گرید رو به اسکرول افقی تبدیل می‌کنه
             اینجا با specificity بالاتر آن رو لغو می‌کنیم ===== */
      @media (max-width: 768px) {
        #productsGrid {
          display: grid !important;
          grid-template-columns: 1fr 1fr !important;
          overflow-x: visible !important;
          overflow: visible !important;
          flex-wrap: unset !important;
          flex-direction: unset !important;
          gap: 8px !important;
          padding-bottom: 0 !important;
          scroll-snap-type: none !important;
        }
        #productsGrid .products-banner { display: none !important; }

        #productsGrid > a.product-card {
          flex: unset !important;
          min-width: unset !important;
          width: 100% !important;
          flex-direction: column !important;
          height: auto !important;
          scroll-snap-align: none !important;
        }
        #productsGrid > a.product-card:hover { transform: none !important; }
        #productsGrid > a.product-card .product-card__compare { display: none !important; }
        #productsGrid > a.product-card .product-card__media {
          width: 100% !important;
          min-width: unset !important;
          max-width: unset !important;
          height: auto !important;
          aspect-ratio: 4/3 !important;
          flex-shrink: unset !important;
          padding: 10px !important;
        }
        #productsGrid > a.product-card .product-card__body {
          padding: 8px 10px !important;
          gap: 3px !important;
        }
        #productsGrid > a.product-card .product-card__cat {
          font-size: 10px !important;
        }
        #productsGrid > a.product-card .product-card__title {
          font-size: 12px !important;
          min-height: unset !important;
          line-height: 1.35 !important;
          display: -webkit-box !important;
          -webkit-line-clamp: 2 !important;
          -webkit-box-orient: vertical !important;
          overflow: hidden !important;
        }
        #productsGrid > a.product-card .product-card__rating {
          font-size: 10.5px !important;
        }
        #productsGrid > a.product-card .product-card__stock {
          font-size: 10px !important;
        }
        #productsGrid > a.product-card .product-card__footer {
          padding-top: 4px !important;
        }
        #productsGrid > a.product-card .product-card__price .old {
          font-size: 10px !important;
        }
        #productsGrid > a.product-card .product-card__price .new {
          font-size: 12.5px !important;
        }
        #productsGrid > a.product-card .product-card__add {
          width: 30px !important;
          height: 30px !important;
          min-width: 30px !important;
          font-size: 14px !important;
          border-radius: 8px !important;
        }
      }

      @media (max-width: 480px) {
        #productsGrid {
          grid-template-columns: 1fr 1fr !important;
          gap: 6px !important;
        }
        #productsGrid > a.product-card {
          flex: unset !important;
          min-width: unset !important;
        }
        #productsGrid > a.product-card .product-card__media {
          aspect-ratio: 4/3 !important;
          padding: 8px !important;
        }
        #productsGrid > a.product-card .product-card__body { padding: 7px 8px !important; }
        #productsGrid > a.product-card .product-card__title { font-size: 11.5px !important; }
        #productsGrid > a.product-card .product-card__price .new { font-size: 12px !important; }
      }
    </style>
  </head>
  <body>

    <!-- Topbar -->
    <div class="topbar">
      🎉 جشنواره زمستانی: تا <strong>۵۰٪</strong> تخفیف روی تمام لوازم جانبی موبایل | کد تخفیف: <strong>WINTER2026</strong>
    </div>

    <!-- Header -->
    <header class="header">
      <div class="container header__row">
        <a href="index_production_responsive.html" class="logo">
          <span class="logo__mark">
            <img src="assets/images/logo.png" alt="لوگو غباس"
              onerror="this.style.display='none';this.parentElement.innerHTML='<i class=\'ti ti-bolt\'></i>';" />
          </span>
          <span>
            <span class="logo__text">غباس</span>
            <span class="logo__sub">GHABOS.IR</span>
          </span>
        </a>

        <div class="search">
          <input type="text" placeholder="جستجوی سراسری در محصولات، برندها و دسته‌بندی‌ها..." />
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
          <a href="wishlist.html" class="icon-btn" aria-label="علاقه‌مندی‌ها">
            <i class="ti ti-heart"></i>
            <span class="badge">۲</span>
          </a>
          <a href="cart.html" class="icon-btn cart" aria-label="سبد خرید">
            <i class="ti ti-shopping-bag"></i>
            <span class="badge">۳</span>
          </a>
        </div>
      </div>

      <nav class="nav">
        <div class="container nav__row">
          <button class="mobile-menu-toggle" aria-label="منو">
            <i class="ti ti-menu-2"></i>
          </button>
          <button class="nav__cats"><i class="ti ti-menu-2"></i> همه دسته‌بندی‌ها</button>
          <a href="products.html" class="active">محصولات</a>
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
            <div class="filter-box">
              <div class="filter-box__head">
                <span class="filter-box__title">
                  <i class="ti ti-category"></i> دسته‌بندی
                </span>
              </div>
              <div class="cat-filter">
                <div class="cat-filter__item active" data-cat="all">
                  <span>همه محصولات</span>
                  <span class="cat-filter__count">۲۴۸</span>
                </div>
                <div class="cat-filter__item" data-cat="headphone">
                  <span>هندزفری و اسپیکر</span>
                  <span class="cat-filter__count">۶۱</span>
                </div>
                <div class="cat-filter__item" data-cat="charger">
                  <span>شارژر و کابل</span>
                  <span class="cat-filter__count">۴۷</span>
                </div>
                <div class="cat-filter__item" data-cat="case">
                  <span>قاب و محافظ</span>
                  <span class="cat-filter__count">۵۸</span>
                </div>
                <div class="cat-filter__item" data-cat="powerbank">
                  <span>پاوربانک</span>
                  <span class="cat-filter__count">۳۲</span>
                </div>
                <div class="cat-filter__item" data-cat="watch">
                  <span>ساعت هوشمند</span>
                  <span class="cat-filter__count">۲۹</span>
                </div>
                <div class="cat-filter__item" data-cat="memory">
                  <span>حافظه و فلش</span>
                  <span class="cat-filter__count">۲۱</span>
                </div>
              </div>
            </div>

            <!-- Price Range -->
            <div class="filter-box">
              <div class="filter-box__head">
                <span class="filter-box__title">
                  <i class="ti ti-coin"></i> محدوده قیمت
                </span>
                <span class="filter-box__clear" onclick="resetPrice()">پاک کردن</span>
              </div>
              <div class="price-range">
                <input type="range" class="price-range__slider" min="0" max="50000000" value="50000000" id="priceSlider" />
                <div class="price-range__inputs">
                  <input type="text" id="priceMin" value="۰" placeholder="از" />
                  <span class="price-range__sep">—</span>
                  <input type="text" id="priceMax" value="۵۰,۰۰۰,۰۰۰" placeholder="تا" />
                </div>
                <div class="price-range__labels">
                  <span>رایگان</span>
                  <span>۵۰ میلیون تومان</span>
                </div>
              </div>
            </div>

            <!-- Brands -->
            <div class="filter-box">
              <div class="filter-box__head">
                <span class="filter-box__title">
                  <i class="ti ti-building-store"></i> برند
                </span>
                <span class="filter-box__clear" onclick="resetBrands()">پاک کردن</span>
              </div>
              <div class="brand-checks">
                <label class="brand-check">
                  <input type="checkbox" checked />
                  <span class="brand-check__label">Apple</span>
                  <span class="brand-check__count">۴۸</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">Samsung</span>
                  <span class="brand-check__count">۳۷</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">Anker</span>
                  <span class="brand-check__count">۲۹</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">Xiaomi</span>
                  <span class="brand-check__count">۲۲</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">Baseus</span>
                  <span class="brand-check__count">۱۸</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">JBL</span>
                  <span class="brand-check__count">۱۴</span>
                </label>
              </div>
            </div>

            <!-- Rating -->
            <div class="filter-box">
              <div class="filter-box__head">
                <span class="filter-box__title">
                  <i class="ti ti-star"></i> امتیاز
                </span>
              </div>
              <div class="rating-filter">
                <label class="rating-item">
                  <input type="radio" name="rating" value="4" />
                  <span class="rating-item__stars">★★★★★</span>
                  <span class="rating-item__label"><b>۴</b> و بالاتر</span>
                </label>
                <label class="rating-item">
                  <input type="radio" name="rating" value="3" />
                  <span class="rating-item__stars">★★★★☆</span>
                  <span class="rating-item__label"><b>۳</b> و بالاتر</span>
                </label>
                <label class="rating-item">
                  <input type="radio" name="rating" value="2" />
                  <span class="rating-item__stars">★★★☆☆</span>
                  <span class="rating-item__label"><b>۲</b> و بالاتر</span>
                </label>
              </div>
            </div>

            <!-- Availability -->
            <div class="filter-box">
              <div class="filter-box__head">
                <span class="filter-box__title">
                  <i class="ti ti-package"></i> موجودی
                </span>
              </div>
              <div class="brand-checks">
                <label class="brand-check">
                  <input type="checkbox" checked />
                  <span class="brand-check__label">فقط کالاهای موجود</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">ارسال فوری</span>
                </label>
                <label class="brand-check">
                  <input type="checkbox" />
                  <span class="brand-check__label">دارای تخفیف</span>
                </label>
              </div>
            </div>

          </aside>

          <!-- ===== PRODUCTS AREA ===== -->
          <div class="products-area">

            <!-- Top bar -->
            <div class="products-topbar">
              <div class="products-topbar__left">
                <button class="mobile-filter-btn" id="filterToggle">
                  <i class="ti ti-adjustments-horizontal"></i> فیلترها
                </button>
                <span class="products-count"><b id="productCount">۲۴۸</b> محصول یافت شد</span>
              </div>

              <div class="products-controls">
                <div class="active-filters" id="activeTags">
                  <span class="filter-tag">Apple <i class="ti ti-x"></i></span>
                </div>
                <select class="sort-select" id="sortSelect">
                  <option value="default">مرتب‌سازی: پیش‌فرض</option>
                  <option value="popular">محبوب‌ترین</option>
                  <option value="newest">جدیدترین</option>
                  <option value="price-asc">ارزان‌ترین</option>
                  <option value="price-desc">گران‌ترین</option>
                  <option value="rating">بهترین امتیاز</option>
                </select>
                <div class="view-toggle">
                  <button class="view-btn active" id="gridViewBtn" title="نمای شبکه‌ای">
                    <i class="ti ti-layout-grid"></i>
                  </button>
                  <button class="view-btn" id="listViewBtn" title="نمای لیستی">
                    <i class="ti ti-layout-list"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Quick filter chips -->
            <div class="quick-filters">
              <button class="quick-chip active" data-quick="all">همه</button>
              <button class="quick-chip" data-quick="new">تازه‌وارد 🆕</button>
              <button class="quick-chip" data-quick="sale">تخفیف‌دار 🔥</button>
              <button class="quick-chip" data-quick="bestseller">پرفروش ⭐</button>
              <button class="quick-chip" data-quick="fast">ارسال فوری ⚡</button>
              <button class="quick-chip" data-quick="exclusive">اکسکلوسیو 💎</button>
            </div>

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
              <div class="products-banner">
                <div class="products-banner__text">
                  <h3>⚡ ارسال فوری در کمتر از ۴ ساعت</h3>
                  <p>برای سفارش‌های بالای ۵۰۰ هزار تومان در تهران</p>
                </div>
                <button class="products-banner__btn">خرید با ارسال فوری</button>
              </div>

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

    <!-- Footer -->
    <footer class="footer">
      <div class="container footer__grid">
        <div class="footer__about">
          <div class="footer__logo">
            <span class="logo__mark">
              <img src="assets/images/logo.png" alt="لوگو غباس"
                onerror="this.style.display='none';this.parentElement.innerHTML='<i class=\'ti ti-bolt\'></i>';" />
            </span>
            <span class="logo__text" style="background:var(--grad);-webkit-background-clip:text;background-clip:text;color:transparent;">غباس</span>
          </div>
          <p>غباس، مرجع تخصصی فروش گوشی موبایل و لوازم جانبی اصل با گارانتی معتبر و ارسال سریع به سراسر ایران.</p>
          <div class="footer__socials">
            <a href="#" aria-label="اینستاگرام"><i class="ti ti-brand-instagram"></i></a>
            <a href="#" aria-label="تلگرام"><i class="ti ti-brand-telegram"></i></a>
            <a href="#" aria-label="واتس‌اپ"><i class="ti ti-brand-whatsapp"></i></a>
          </div>
        </div>
        <div>
          <h4>دسترسی سریع</h4>
          <ul>
            <li><a href="index_production_responsive.html">صفحه اصلی</a></li>
            <li><a href="products.html">محصولات</a></li>
            <li><a href="about.html">درباره ما</a></li>
            <li><a href="contact.html">تماس با ما</a></li>
          </ul>
        </div>
        <div>
          <h4>حساب کاربری</h4>
          <ul>
            <li><a href="login.html">ورود / ثبت‌نام</a></li>
            <li><a href="profile.html">پروفایل من</a></li>
            <li><a href="orders.html">سفارش‌های من</a></li>
            <li><a href="wishlist.html">علاقه‌مندی‌ها</a></li>
          </ul>
        </div>
        <div>
          <h4>ارتباط با ما</h4>
          <ul>
            <li><i class="ti ti-map-pin"></i> تهران، سعادت‌آباد</li>
            <li><i class="ti ti-phone"></i> ۰۲۱-۱۲۳۴۵۶۷۸</li>
            <li><i class="ti ti-mail"></i> support@ghabos.ir</li>
          </ul>
        </div>
      </div>
      <div class="container footer__bottom">
        <span>© ۱۴۰۵ غباس - تمامی حقوق محفوظ است.</span>
        <div class="footer__payments">
          <i class="ti ti-credit-card"></i>
          <i class="ti ti-shield-check"></i>
          <i class="ti ti-truck-delivery"></i>
        </div>
      </div>
    </footer>

    <!-- Mobile bottom nav -->
    <nav class="bottom-nav">
      <div class="bottom-nav__row">
        <a href="index_production_responsive.html"><i class="ti ti-home"></i> خانه</a>
        <a href="categories.html"><i class="ti ti-category"></i> دسته‌ها</a>
        <a href="cart.html" class="center"><i class="ti ti-shopping-bag"></i><span class="badge">۳</span></a>
        <a href="wishlist.html"><i class="ti ti-heart"></i> علاقه‌مندی</a>
        <a href="profile.html"><i class="ti ti-user"></i> پروفایل</a>
      </div>
    </nav>

    <script>
      document.addEventListener('DOMContentLoaded', () => {

      // Dark mode
      const themeToggle = document.getElementById('themeToggle');
      const savedTheme = localStorage.getItem('ghabos-theme');
      if (savedTheme === 'dark') {
        document.body.classList.add('dark');
        if (themeToggle) themeToggle.querySelector('i').className = 'ti ti-sun';
      }
      themeToggle?.addEventListener('click', () => {
        const isDark = document.body.classList.toggle('dark');
        themeToggle.querySelector('i').className = isDark ? 'ti ti-sun' : 'ti ti-moon';
        localStorage.setItem('ghabos-theme', isDark ? 'dark' : 'light');
      });

      // Mobile filter sidebar toggle
      const filterToggle = document.getElementById('filterToggle');
      const filterSidebar = document.getElementById('filterSidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');

      filterToggle?.addEventListener('click', () => {
        filterSidebar?.classList.toggle('open');
        sidebarOverlay?.classList.toggle('open');
      });
      sidebarOverlay?.addEventListener('click', () => {
        filterSidebar?.classList.remove('open');
        sidebarOverlay?.classList.remove('open');
      });

      // Category filter
      document.querySelectorAll('.cat-filter__item').forEach(item => {
        item.addEventListener('click', () => {
          document.querySelectorAll('.cat-filter__item').forEach(i => i.classList.remove('active'));
          item.classList.add('active');
        });
      });

      // Quick filter chips
      document.querySelectorAll('.quick-chip').forEach(chip => {
        chip.addEventListener('click', () => {
          document.querySelectorAll('.quick-chip').forEach(c => c.classList.remove('active'));
          chip.classList.add('active');
        });
      });

      // View toggle
      const productsGrid = document.getElementById('productsGrid');
      document.getElementById('gridViewBtn').addEventListener('click', function() {
        productsGrid.classList.remove('list-view');
        this.classList.add('active');
        document.getElementById('listViewBtn').classList.remove('active');
      });
      document.getElementById('listViewBtn').addEventListener('click', function() {
        productsGrid.classList.add('list-view');
        this.classList.add('active');
        document.getElementById('gridViewBtn').classList.remove('active');
      });

      // Add to cart animation
      function addToCart(btn) {
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check"></i>';
        btn.style.background = 'var(--c-green)';
        setTimeout(() => {
          btn.innerHTML = orig;
          btn.style.background = '';
        }, 900);
      }

      function resetPrice() {
        document.getElementById('priceMin').value = '۰';
        document.getElementById('priceMax').value = '۵۰,۰۰۰,۰۰۰';
        document.getElementById('priceSlider').value = 50000000;
      }

      function resetBrands() {
        document.querySelectorAll('.brand-check input').forEach(cb => cb.checked = false);
      }

      // Pagination
      document.querySelectorAll('.page-btn:not(.arrow)').forEach(btn => {
        btn.addEventListener('click', () => {
          document.querySelectorAll('.page-btn:not(.arrow)').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        });
      });

      // Lazy load images
      document.querySelectorAll('img').forEach(img => img.loading = 'lazy');

      }); // end DOMContentLoaded
    </script>

  </body>
</html>
