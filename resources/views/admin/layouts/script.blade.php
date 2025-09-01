<!-- Persian Date Libraries -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" />
<script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

<script>
    $(document).ready(function () {
        $("#birthday_view").persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false,
            onSelect: function (unix) {
                // ذخیره تاریخ به فرمت میلادی در hidden input
                let gregorian = new persianDate(unix).toGregorian();
                let formatted = gregorian.year + "-" +
                    ("0"+gregorian.month).slice(-2) + "-" +
                    ("0"+gregorian.day).slice(-2);
                $("#birthday").val(formatted);
            }
        });
    });
</script>

<!-- Popper JS -->
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>

<!-- Bootstrap JS -->
<script src="{{asset('assets/admin/js/bootstrap.bundle.min.js')}}"></script>

<!-- Defaultmenu JS -->
<script src="{{asset('assets/admin/js/defaultmenu.js')}}"></script>

<!-- Node Waves JS -->
<script src="{{asset('assets/admin/js/waves.min.js')}}"></script>

<!-- Sticky JS -->
<script src="{{asset('assets/admin/js/sticky.js')}}"></script>

<!-- Simplebar JS -->
<script src="{{asset('assets/admin/js/simplebar.min.js')}}"></script>

<!-- Auto Complete JS -->
<script src="{{asset('assets/libs/tarekraafat/autocomplete.js/autoComplete.min.js')}}"></script>

<!-- Color Picker JS -->
<script src="{{asset('assets/libs/simonwep/pickr/pickr.es5.min.js')}}"></script>

<!-- Date & Time Picker JS -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- ApexCharts JS -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Custom-Switcher JS -->
<script src="{{asset('assets/admin/js/custom-switcher.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('assets/admin/js/custom.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // ===== SimpleBar =====
        document.querySelectorAll(".scrollable").forEach(el => {
            if (el) new SimpleBar(el);
        });

        // ===== Choices =====
        const choicesEl = document.querySelector('#choices-single-default');
        if (choicesEl && window.Choices) {

            const choices = new Choices(choicesEl, {
                allowHTML: true,
                searchEnabled: false,
                shouldSort: false,
                itemSelectText: '',
                placeholder: true,
                placeholderValue: 'مرتب‌سازی بر اساس'
            });
            if (choicesEl) {
                choicesEl.addEventListener('change', function () {
                    if (this.form) this.form.submit();
                });
            }
        }

        // ===== ApexCharts =====
        const charts = document.querySelectorAll(".apex-chart");
        charts.forEach(chartEl => {
            if (chartEl) {
                const options = chartEl.dataset.options ? JSON.parse(chartEl.dataset.options) : {};
                const chart = new ApexCharts(chartEl, options);
                chart.render();
            }
        });

        // ===== Popper Example =====
        const popperRefs = document.querySelectorAll("[data-popper-ref]");
        popperRefs.forEach(ref => {
            const targetId = ref.getAttribute("data-popper-target");
            const popperEl = document.getElementById(targetId);
            if (popperEl) {
                Popper.createPopper(ref, popperEl, {
                    placement: 'bottom'
                });
            }
        });

    });
</script>
