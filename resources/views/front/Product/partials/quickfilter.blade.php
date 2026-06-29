{{--  <div class="quick-filters">
              <button class="quick-chip active" data-quick="all">همه</button>
              <button class="quick-chip" data-quick="new">تازه‌وارد 🆕</button>
              <button class="quick-chip" data-quick="sale">تخفیف‌دار 🔥</button>
              <button class="quick-chip" data-quick="bestseller">پرفروش ⭐</button>
              <button class="quick-chip" data-quick="fast">ارسال فوری ⚡</button>
              <button class="quick-chip" data-quick="exclusive">اکسکلوسیو 💎</button>
            </div>  --}}

 <form method="GET" action="{{ route('products.index') }}" id="filterForm">

    {{-- چیپ‌های quick filter --}}
    <div class="quick-filters">
        <button type="submit" name="quick" value=""
            class="quick-chip {{ !request('quick') ? 'active' : '' }}">همه</button>
        <button type="submit" name="quick" value="new"
            class="quick-chip {{ request('quick') === 'new' ? 'active' : '' }}">تازه‌وارد 🆕</button>
        <button type="submit" name="quick" value="sale"
            class="quick-chip {{ request('quick') === 'sale' ? 'active' : '' }}">تخفیف‌دار 🔥</button>
        <button type="submit" name="quick" value="bestseller"
            class="quick-chip {{ request('quick') === 'bestseller' ? 'active' : '' }}">پرفروش ⭐</button>
        <button type="submit" name="quick" value="fast"
            class="quick-chip {{ request('quick') === 'fast' ? 'active' : '' }}">ارسال فوری ⚡</button>
    </div>
