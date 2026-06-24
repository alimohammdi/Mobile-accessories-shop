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
