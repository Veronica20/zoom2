$(document).ready(function(){
    $('.currency_radio input').on('change', function (e) {

        $('.currency_radio input').prop('checked', false);
        $(this).prop('checked', true);

        var currency = $(this).attr('name');
        $('[name="currency"]').val(currency);

    });

    $('.sex_radio input').on('change',function (e) {

        $('.sex_radio input').prop('checked', false);
        $(this).prop('checked', true);

        var sex = $(this).attr('name');
        $('[name="sex"]').val(sex);

    });

    $('.identity_type_radio input').on('change',function (e) {

        $('.identity_type_radio input').prop('checked', false);
        $(this).prop('checked', true);

        var identity_type = $(this).attr('name');
        $('[name="identity_type"]').val(identity_type);

    });



    function datepicker(year, month, day) {

        function disabledChecker() {
            day.prop('disabled', !(year.val() && month.val()));
        }

        function handler() {
            if (!(year.val() && month.val())) {
                return;
            }
            day.empty();
            for (let i = 1; i <= new Date(year.val(), month.val(), 0).getDate(); i++) {
                $("<option>").val(i).text(i).appendTo(day);
            }

            disabledChecker()
        }

        disabledChecker();
        year.change(handler);
        month.change(handler);
    }

    datepicker($('#year'), $('#month'), $('#day'));

    datepicker($('#given_year'), $('#given_month'), $('#given_day'));



    $('.FormDiv input[type!="file"]').on('click',function (e) {
       const placeholder = $(this).attr('placeholder');
       $(this).prev().html(placeholder);
    })
});