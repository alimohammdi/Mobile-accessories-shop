 <section class="container section">
        <div class="section__head">
          <h2 class="section__title">دسته‌بندی‌های <span>محبوب</span></h2>
          <a href="categories.html" class="section__more"
            >مشاهده همه دسته‌ها <i class="ti ti-chevron-left"></i
          ></a>
        </div>
        <div class="cats">
          @foreach ($category as $cat)
           <a href="products.html?cat=charger" class="cat-card">
            <div class="cat-card__icon">
              <img
                src="{{  asset('storage/'.$cat->image) }}"
                alt=" {{  $cat->name }} "
                onerror="this.style.display = 'none'"
              />
            </div>
            <div class="cat-card__name"> {{  $cat->name }} </div>
          </a>
          @endforeach
        </div>
      </section>
