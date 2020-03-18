/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    require('@coreui/coreui/dist/js/coreui.bundle.min');
    require('@coreui/icons');
    require('@fortawesome/fontawesome-free/js/all');
} catch (e) {
    console.log("error: ",e)
}
