{{--
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
            </div>  --}}
         {{-- دسته‌بندی --}}
        <div class="filter-box">
            <div class="filter-box__title"><i class="ti ti-category"></i> دسته‌بندی</div>
            <div class="cat-filter">
                <label class="cat-filter__item {{ !request('cat') ? 'active' : '' }}">
                    <input type="radio" name="cat" value=""
                        {{ !request('cat') ? 'checked' : '' }}
                        onchange="this.form.submit()" hidden />
                    <span>همه محصولات</span>
                    <span class="cat-filter__count">{{ $totalCount }}</span>
                </label>
                @foreach($categories as $cat)
                    <label class="cat-filter__item {{ request('cat') === $cat->slug ? 'active' : '' }}">
                        <input type="radio" name="cat" value="{{ $cat->slug }}"
                            {{ request('cat') === $cat->slug ? 'checked' : '' }}
                            onchange="this.form.submit()" hidden />
                        <span>{{ $cat->name }}</span>
                        <span class="cat-filter__count">{{ $cat->products_count }}</span>
                    </label>
                @endforeach
            </div>
        </div>
