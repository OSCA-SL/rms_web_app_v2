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

    const { dt } = require('datatables.net-bs4');
    require('datatables.net-responsive-bs4/js/responsive.bootstrap4.min');

    $(document).ready(function () {

        $("#artists-table").DataTable({
            paging: true,
            responsive: true,
            autoWidth: false,
            processing: true,
            searching: true,
            columnDefs: [
                { orderable: false, targets: [6] }
            ],
            language:{
                emptyTable: 'There are no Artists. Try adding a new artist.!'
            }
        });

    });

} catch (e) {
    console.log("error: ",e)
}
