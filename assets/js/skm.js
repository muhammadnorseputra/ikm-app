$(document).ready(function() {
    // back to top
    var btn = $('#btn-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    $("form#f_print_formulir").on('submit', function(e) {
        e.preventDefault();
        let $this = $(this);
        let $selected = $this[0][0].value;
        let $name = $this[0][0].name;
        let sel = $("select[name='jns_layanan_print']").attr('data-url');
        let $url = `${sel}cetak?f=${$selected}`;
        if ($selected === '0') {
            $.notify({
                message: 'Silahkan pilih layanan terlebih dahulu.',
            }, {
                type: 'warning',
                allow_dismiss: false,
                showProgressbar: false,
                z_index: 1051,
                placement: {
                    from: "bottom",
                    align: "left"
                },
            });
        } else {
            window.open($url, '_blank', '', true);
        }
    });
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})