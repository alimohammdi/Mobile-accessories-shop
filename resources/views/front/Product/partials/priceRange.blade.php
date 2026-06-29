            {{--  <div class="filter-box">
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
            </div>  --}}
{{-- محدوده قیمت --}}
        <div class="filter-box">
            <div class="filter-box__title"><i class="ti ti-coin"></i> محدوده قیمت</div>
            <div class="price-range">
                <input type="range" class="price-range__slider" name="max_price"
                    min="0" max="50000000"
                    value="{{ request('max_price', 50000000) }}"
                    id="priceSlider" />
                <div class="price-range__inputs">
                    <input type="text" name="min_price" id="priceMin"
                        value="{{ number_format(request('min_price', 0)) }}"
                        placeholder="از" />
                    <span>—</span>
                    <input type="text" name="max_price" id="priceMax"
                        value="{{ number_format(request('max_price', 50000000)) }}"
                        placeholder="تا" />
                </div>
                <button type="submit" class="btn-apply-price" id="applyPrice">اعمال</button>
            </div>
        </div>
