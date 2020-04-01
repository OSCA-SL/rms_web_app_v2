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
    const Swal = require('sweetalert2');
    let bsCustomFileInput = require('bs-custom-file-input');
    let {autocomplete} = require('../../plugins/autocomplete/autocomplete');

    $(document).ready(function () {

        bsCustomFileInput.init();
        $.ajax({
            type: 'GET',
            url: '/songs/titles',
            success: function (song_titles) {
                let titles_array = [];
                song_titles.forEach(function (item, index) {
                    titles_array.push(item.title);
                });

                autocomplete(document.getElementById("title"), titles_array);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
            }
        });

        $('.select2').select2();

        $('#create-song').on('reset', function (e) {
            $('.select2').val(null).trigger('change');
        });

        $('#released_at').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('#create-song-form').on('submit',(function(event) {
            event.preventDefault();
            let fm = this;

            Swal.fire({
                icon: 'info',
                title: 'Song is Uploading!',
                allowOutsideClick: false,
                showConfirmButton: false,
                html: getSwalHtml(),
                onOpen: function () {
                    $.ajax({
                        xhr: function() {
                            let xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(evt) {
                                if (evt.lengthComputable) {
                                    let percentComplete = evt.loaded / evt.total;
                                    let progressBar = $('.progress-bar');
                                    percentComplete = Math.round(percentComplete*100);
                                    progressBar.css('width',percentComplete+"%");
                                    progressBar.html(percentComplete+"%");

                                    if (percentComplete === 100){
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Song is uploaded!',
                                            text: 'Sending Song Info',
                                            allowOutsideClick: false,
                                            onBeforeOpen: function () {
                                                Swal.showLoading();
                                            },
                                        });
                                    }
                                }
                            }, false);
                            return xhr;
                        },
                        url: '/songs',
                        type: 'POST',
                        data: new FormData(fm),
                        // Tell jQuery not to process data or worry about content-type
                        // You *must* include these options!
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire(
                                'Good job!',
                                'Song Has Been Upload to the Cloud Server!',
                                'success'
                            ).then(()=>{
                                window.location.href = "/home";
                            });
                        },
                        error: function (response) {
                            console.log("error! : ",response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response,
                            })
                        }
                    });
                }
            });
        }));

        $('[data-toggle="tooltip"]').tooltip();
    });

    function getSwalHtml() {
        let progressElement = document.createElement('DIV');
        let progressBar = document.createElement('DIV');
        progressElement.className = 'progress';
        progressElement.style.height = '32px';
        progressBar.style.fontSize = '21px';
        progressBar.className = 'progress-bar bg-success progress-bar-striped progress-bar-animated';
        progressBar.setAttribute('role', 'progressbar');
        progressBar.setAttribute('aria-valuemin', '0');
        progressBar.setAttribute('aria-valuemax', '100');
        progressBar.setAttribute('aria-valuenow', '0');
        progressBar.style.width = '0%';
        progressBar.innerHTML = '0%';

        progressElement.appendChild(progressBar);
        return progressElement.outerHTML;
    }

} catch (e) {
    console.log("error: ",e)
}
