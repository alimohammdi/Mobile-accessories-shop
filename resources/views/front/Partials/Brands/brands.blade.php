 <section class="container section">
        <div class="section__head">
          <h2 class="section__title">برندهای <span>ویژه</span> امروز</h2>
        </div>
        <div class="brands">
            @foreach ($brands as $brand)
                 <div class="brand-item">
            <div class="brand-item__icon">
              <img
                src="{{  asset('storage/'.$brand->logo) }}"
                alt="اپل"
                onerror="this.style.display = 'none'"
              />
            </div>
            <div class="brand-item__name">{{ $brand->name}}</div>
            </div>

            @endforeach

        </div>
      </section>
