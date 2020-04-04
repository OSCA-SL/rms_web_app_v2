/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
try {
    require('bootstrap');
    require('@coreui/coreui/dist/js/coreui.bundle.min');
    require('@coreui/icons');
    require('@fortawesome/fontawesome-free/js/all.min');
    require('select2');
    require('../../plugins/bootstrap-datepicker/js/bootstrap-datepicker');
    let {autocomplete} = require('../../plugins/autocomplete/autocomplete');

    $(document).ready(function () {

        $.ajax({
            type: 'GET',
            url: '/artists/create',
            success: function (artists) {
                console.log(artists);
                let membership_number_array = [];
                let names_array = [];
                artists.forEach(function (item, index) {
                    let first_name = item.user.first_name;
                    let last_name = item.user.last_name;
                    names_array.push(first_name+' '+last_name);
                    membership_number_array.push(item.membership_number);
                });

                autocomplete(document.getElementById("membership_number"), membership_number_array);
                autocomplete(document.getElementById("first_name"), names_array);
                autocomplete(document.getElementById("last_name"), names_array);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
            }
        });

        $('.select2').select2({
            placeholder: "Please Select (Required)",
            allowClear: true
        });

        $('#create-artists-form').on('reset', function (e) {
            $('.select2').val(null).trigger('change');
        });

        $('#dob').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('[data-toggle="tooltip"]').tooltip();
    });

} catch (e) {
    console.log("error: ",e)
}
