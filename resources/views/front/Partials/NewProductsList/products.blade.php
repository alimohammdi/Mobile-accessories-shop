
<section class="container section">
        <div class="section__head">
          <h2 class="section__title">تازه‌های <span>فروشگاه</span></h2>
          <a href=" {{  route('all-products') }} " class="section__more"
            >مشاهده همه <i class="ti ti-chevron-left"></i
          ></a>
        </div>
        <div class="products">
          @foreach ($products as  $product)
              <a href="product.html" class="product-card">
            <div class="product-card__media">
                @if ($product->discount > 0 )
                                  <span class="product-card__badge">{{  Number::percentage($product->discount) }} </span>
                @endif
              <span class="product-card__fav"><i class="ti ti-heart"></i></span>
              <img
                src="{{  asset('storage/'.$product->image1) }}"
                alt="{{  $product->name }}"   />
            </div>
            <div class="product-card__body">
              <span class="product-card__cat"> {{ $product->category->name }}</span>
              <h3 class="product-card__title">
               {{ $product->name}}
              </h3>
              {{--  <div class="product-card__rating">
                <i class="ti ti-star-filled"></i> ۴.۸ <span>(۱۲۴)</span>
              </div>  --}}
              <div class="product-card__footer">
                <div class="product-card__price">
                     @php
                         if($product->discount > 0 ){
                            $end_price = ceil( $product->price - ($product->price * $product->discount /  100)  );

                         }else{
                            $end_price = $product->price;
                         }
                     @endphp
                     @if ($product->discount > 0)
                         <span class="old">{{  Number::format($product->price, locale: 'fa') }}</span>
                         <span class="new">{{ Number::format( $end_price , locale: 'fa') }}<small>تومان</small></span>
                    @else
                          <span class="new">  {{ Number::format((int) $product->price, locale: 'fa') }}  <small>تومان</small></span>
                     @endif       </div>
                <span class="product-card__add"
                  ><i class="ti ti-plus"></i
                ></span>
              </div>
            </div>
          </a>
          @endforeach

        </div>
      </section>
