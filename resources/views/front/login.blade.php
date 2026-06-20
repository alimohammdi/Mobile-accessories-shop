@extends('front.layouts.master')

@section('content')
 <!-- Topbar -->
    @include('front/Partials/Topbar/topbar')

    @include('front/Partials/Header/header')

<main>
      <!-- Auth -->
      <section class="container auth-page">
        <div class="auth-card">
          <div class="auth-tabs" id="authTabs">
            <button class="auth-tab active" data-target="login">
              ورود
              <small>به حساب کاربری</small>
            </button>
            <button class="auth-tab" data-target="register">
              ثبت‌نام
              <small>عضویت در غباس</small>
            </button>
          </div>

          <div class="auth-body">
            <!-- Login form -->
            <form class="auth-form active" id="login" onsubmit="return false;">
              <div class="auth-head">
                <div class="auth-head__icon">
                  <i class="ti ti-fingerprint"></i>
                </div>
                <h2>ورود به حساب کاربری</h2>
                <p>برای ادامه، شماره موبایل و رمز عبور خود را وارد کنید</p>
              </div>

              <div class="field">
                <label for="login-phone">شماره موبایل</label>
                <div class="input-wrap">
                  <i class="ti ti-device-mobile"></i>
                  <input
                    type="tel"
                    id="login-phone"
                    placeholder="09xxxxxxxxx"
                    inputmode="numeric"
                  />
                </div>
              </div>

              <div class="field">
                <label for="login-pass">رمز عبور</label>
                <div class="input-wrap">
                  <i class="ti ti-lock"></i>
                  <input
                    type="password"
                    id="login-pass"
                    placeholder="رمز عبور خود را وارد کنید"
                  />
                  <button
                    type="button"
                    class="toggle-pass"
                    data-for="login-pass"
                  >
                    <i class="ti ti-eye"></i>
                  </button>
                </div>
              </div>

              <div class="field-row">
                <label class="checkbox">
                  <input type="checkbox" /> مرا به خاطر بسپار
                </label>
                <a href="#">رمز را فراموش کرده‌اید؟</a>
              </div>

              <button type="submit" class="auth-submit">
                ورود به حساب کاربری <i class="ti ti-arrow-left"></i>
              </button>

              <div class="auth-divider">یا ورود با</div>
              <div class="auth-socials">
                <button type="button">
                  <i class="ti ti-brand-google"></i> گوگل
                </button>
                <button type="button" id="loginOtpBtn">
                  <i class="ti ti-message"></i> پیامک
                </button>
              </div>

              <div class="auth-switch">
                هنوز ثبت‌نام نکرده‌اید؟
                <button type="button" data-target="register">
                  ایجاد حساب کاربری
                </button>
              </div>
            </form>

                     {{--  Register form  --}}
            <form class="auth-form" id="register" onsubmit="return false;">
              <div class="auth-head">
                <div class="auth-head__icon">
                  <i class="ti ti-user-plus"></i>
                </div>
                <h2>ثبت‌نام در غباس</h2>
                <p>چند قدم تا خریدی آسان و سریع فاصله دارید</p>
              </div>

              <div class="field">
                <label for="reg-name">نام و نام خانوادگی</label>
                <div class="input-wrap">
                  <i class="ti ti-user"></i>
                  <input
                    type="text"
                    id="reg-name"
                    placeholder="نام کامل خود را وارد کنید"
                  />
                </div>
              </div>

              <div class="field">
                <label for="reg-phone">شماره موبایل</label>
                <div class="input-wrap">
                  <i class="ti ti-device-mobile"></i>
                  <input
                    type="tel"
                    id="reg-phone"
                    placeholder="09xxxxxxxxx"
                    inputmode="numeric"
                  />
                </div>
              </div>

              <div class="field">
                <label for="reg-pass">رمز عبور</label>
                <div class="input-wrap">
                  <i class="ti ti-lock"></i>
                  <input
                    type="password"
                    id="reg-pass"
                    placeholder="یک رمز عبور امن انتخاب کنید"
                  />
                  <button type="button" class="toggle-pass" data-for="reg-pass">
                    <i class="ti ti-eye"></i>
                  </button>
                </div>
              </div>

              <div class="field-row">
                <label class="checkbox">
                  <input type="checkbox" /> با
                  <a href="#">قوانین و مقررات</a> غباس موافقم
                </label>
              </div>

              <button type="submit" class="auth-submit" id="registerSubmitBtn">
                ثبت‌نام و ادامه <i class="ti ti-arrow-left"></i>
              </button>

              <div class="auth-divider">یا ثبت‌نام با</div>
              <div class="auth-socials">
                <button type="button">
                  <i class="ti ti-brand-google"></i> گوگل
                </button>
                <button type="button" id="registerOtpBtn">
                  <i class="ti ti-message"></i> پیامک
                </button>
              </div>

              <div class="auth-switch">
                قبلاً ثبت‌نام کرده‌اید؟
                <button type="button" data-target="login">
                  ورود به حساب کاربری
                </button>
              </div>
            </form>

           {{--     OTP verification form  --}}
            <form class="auth-form" id="otp" onsubmit="return false;">
              <div class="otp-phone-box">
                <p>
                  برای شماره همراه
                  <b id="otpPhoneNumber" dir="ltr">۰۹xxxxxxxxx</b> کد تایید
                  ارسال گردید
                </p>
                <button type="button" class="otp-edit-btn" id="otpEditBtn">
                  <i class="ti ti-edit"></i> ویرایش شماره همراه
                </button>
              </div>

              <div class="auth-head" style="margin-top: 28px">
                <div class="auth-head__icon">
                  <i class="ti ti-shield-lock"></i>
                </div>
                <h2>کد فعال‌سازی ارسال شده را وارد کنید</h2>
                <p>کد ۵ رقمی به شماره همراه شما پیامک شد</p>
              </div>

              <div class="otp-inputs" id="otpInputs" dir="ltr">
                <input
                  type="text"
                  class="otp-box"
                  inputmode="numeric"
                  maxlength="1"
                  autocomplete="one-time-code"
                />
                <input
                  type="text"
                  class="otp-box"
                  inputmode="numeric"
                  maxlength="1"
                />
                <input
                  type="text"
                  class="otp-box"
                  inputmode="numeric"
                  maxlength="1"
                />
                <input
                  type="text"
                  class="otp-box"
                  inputmode="numeric"
                  maxlength="1"
                />
                <input
                  type="text"
                  class="otp-box"
                  inputmode="numeric"
                  maxlength="1"
                />
              </div>

              <div class="otp-timer-row">
                <span class="otp-timer" id="otpTimer"
                  ><i class="ti ti-clock"></i> ۰۲:۰۰</span
                >
                <button
                  type="button"
                  class="otp-resend"
                  id="otpResend"
                  disabled
                >
                  ارسال مجدد کد
                </button>
              </div>

              <button type="submit" class="auth-submit" id="otpSubmitBtn">
                تایید و تکمیل ثبت‌نام <i class="ti ti-arrow-left"></i>
              </button>
            </form>

                         {{--  Success view  --}}
            <div class="auth-form" id="success">
              <div class="auth-success">
                <div class="auth-success__icon">
                  <i class="ti ti-check"></i>
                </div>
                <h2 id="successTitle">عضویت شما با موفقیت تکمیل شد!</h2>
                <p id="successDesc">
                  به خانواده غباس خوش آمدید 🎉 اکنون می‌توانید خریدتان را شروع
                  کنید.
                </p>
                <a href="index.html" class="auth-submit" id="successLink"
                  >رفتن به فروشگاه <i class="ti ti-arrow-left"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

   @include('front.partials.footer.simpleFooter')
<script src="{{ asset('front/js/ghabos.js') }}"></script>

@endsection

