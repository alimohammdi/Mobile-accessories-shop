/* Extracted from login.html */

// Tab switching
document.querySelectorAll("[data-target]").forEach((el) => {
    el.addEventListener("click", () => {
        const target = el.getAttribute("data-target");

        document
            .querySelectorAll(".auth-tab")
            .forEach((t) => t.classList.remove("active"));
        document
            .querySelectorAll(".auth-form")
            .forEach((f) => f.classList.remove("active"));

        document
            .querySelector(`.auth-tab[data-target="${target}"]`)
            .classList.add("active");
        document.getElementById(target).classList.add("active");
    });
});

// Show/hide password
document.querySelectorAll(".toggle-pass").forEach((btn) => {
    btn.addEventListener("click", () => {
        const input = document.getElementById(btn.dataset.for);
        const icon = btn.querySelector("i");
        if (input.type === "password") {
            input.type = "text";
            icon.className = "ti ti-eye-off";
        } else {
            input.type = "password";
            icon.className = "ti ti-eye";
        }
    });
});

// ===================== OTP verification step =====================
const faDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
function toFa(str) {
    return String(str).replace(/[0-9]/g, (d) => faDigits[d]);
}

const authCard = document.querySelector(".auth-card");
const otpBoxes = Array.from(document.querySelectorAll(".otp-box"));
const otpTimerEl = document.getElementById("otpTimer");
const otpResendBtn = document.getElementById("otpResend");

let otpContext = "register"; // 'register' | 'login'
let otpTimerInterval = null;
const OTP_DURATION = 120; // seconds

function showForm(id) {
    document
        .querySelectorAll(".auth-form")
        .forEach((f) => f.classList.remove("active"));
    document.getElementById(id).classList.add("active");
}

function setOtpBoxesDisabled(disabled) {
    otpBoxes.forEach((b) => {
        b.disabled = disabled;
        b.style.opacity = disabled ? "0.45" : "";
        b.style.cursor = disabled ? "not-allowed" : "";
        if (disabled) b.style.borderColor = "";
    });
}

function startOtpTimer() {
    clearInterval(otpTimerInterval);
    let remaining = OTP_DURATION;
    otpResendBtn.disabled = true;
    setOtpBoxesDisabled(false);

    const render = () => {
        const m = Math.floor(remaining / 60);
        const s = remaining % 60;
        otpTimerEl.innerHTML = `<i class="ti ti-clock"></i> ${toFa(String(m).padStart(2, "0"))}:${toFa(String(s).padStart(2, "0"))}`;
        otpTimerEl.classList.remove("warn", "danger");
        if (remaining <= 20) otpTimerEl.classList.add("danger");
        else if (remaining <= 60) otpTimerEl.classList.add("warn");
    };
    render();

    otpTimerInterval = setInterval(() => {
        remaining--;
        render();
        if (remaining <= 0) {
            clearInterval(otpTimerInterval);
            otpResendBtn.disabled = false;
            setOtpBoxesDisabled(true);
            otpTimerEl.innerHTML = `<i class="ti ti-clock"></i> کد منقضی شد`;
            otpTimerEl.classList.add("danger");
        }
    }, 1000);
}

function resetOtpBoxes() {
    otpBoxes.forEach((b) => {
        b.value = "";
        b.disabled = false;
        b.style.opacity = "";
        b.style.cursor = "";
        b.classList.remove("filled");
        b.style.borderColor = "";
    });
}

function goToOtp(phone, context) {
    const phoneClean = (phone || "").trim();
    if (phoneClean.length < 10) {
        const targetInput =
            context === "register"
                ? document.getElementById("reg-phone")
                : document.getElementById("login-phone");
        targetInput.focus();
        targetInput.style.borderColor = "var(--c-red)";
        setTimeout(() => {
            targetInput.style.borderColor = "";
        }, 1200);
        return;
    }

    otpContext = context;
    document.getElementById("otpPhoneNumber").textContent = toFa(phoneClean);
    authCard.classList.add("no-tabs");
    showForm("otp");

    resetOtpBoxes();
    otpBoxes[0].focus();
    startOtpTimer();
}

function goBackFromOtp() {
    clearInterval(otpTimerInterval);
    authCard.classList.remove("no-tabs");

    document
        .querySelectorAll(".auth-tab")
        .forEach((t) => t.classList.remove("active"));

    if (otpContext === "register") {
        document
            .querySelector('.auth-tab[data-target="register"]')
            .classList.add("active");
        showForm("register");
    } else {
        document
            .querySelector('.auth-tab[data-target="login"]')
            .classList.add("active");
        showForm("login");
    }
}

// Triggers that open the OTP step
document.getElementById("registerSubmitBtn").addEventListener("click", () => {
    goToOtp(document.getElementById("reg-phone").value, "register");
});
document.getElementById("registerOtpBtn").addEventListener("click", () => {
    goToOtp(document.getElementById("reg-phone").value, "register");
});
document.getElementById("loginOtpBtn").addEventListener("click", () => {
    goToOtp(document.getElementById("login-phone").value, "login");
});

// Edit phone number -> go back without refresh
document.getElementById("otpEditBtn").addEventListener("click", goBackFromOtp);

// Resend code
otpResendBtn.addEventListener("click", () => {
    if (otpResendBtn.disabled) return;
    resetOtpBoxes();
    otpBoxes[0].focus();
    startOtpTimer();
});

// OTP input behavior: auto-advance, backspace, paste
otpBoxes.forEach((box, idx) => {
    box.addEventListener("input", () => {
        const val = box.value.replace(/[^0-9۰-۹]/g, "").slice(-1);
        box.value = val;
        box.classList.toggle("filled", !!val);
        box.style.borderColor = "";
        if (val && idx < otpBoxes.length - 1) otpBoxes[idx + 1].focus();
    });

    box.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !box.value && idx > 0) {
            otpBoxes[idx - 1].focus();
            otpBoxes[idx - 1].value = "";
            otpBoxes[idx - 1].classList.remove("filled");
        }
    });

    box.addEventListener("paste", (e) => {
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData)
            .getData("text")
            .replace(/[^0-9۰-۹]/g, "");
        text.split("").forEach((ch, i) => {
            if (otpBoxes[idx + i]) {
                otpBoxes[idx + i].value = ch;
                otpBoxes[idx + i].classList.add("filled");
            }
        });
        const nextIdx = Math.min(idx + text.length, otpBoxes.length - 1);
        otpBoxes[nextIdx].focus();
    });
});

// Submit OTP
document.getElementById("otp").addEventListener("submit", (e) => {
    e.preventDefault();
    const allFilled = otpBoxes.every((b) => b.value !== "");
    if (!allFilled) {
        otpBoxes.forEach((b) => {
            if (!b.value) {
                b.style.borderColor = "var(--c-red)";
            }
        });
        return;
    }

    clearInterval(otpTimerInterval);
    authCard.classList.add("no-tabs");

    const title = document.getElementById("successTitle");
    const desc = document.getElementById("successDesc");

    if (otpContext === "register") {
        title.textContent = "عضویت شما با موفقیت تکمیل شد!";
        desc.textContent =
            "به خانواده غباس خوش آمدید 🎉 اکنون می‌توانید خریدتان را شروع کنید.";
    } else {
        title.textContent = "ورود با موفقیت انجام شد!";
        desc.textContent = "خوشحالیم که دوباره می‌بینیمت 👋";
    }

    showForm("success");
});
