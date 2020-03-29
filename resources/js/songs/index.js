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
    require('datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min');

    $(document).ready(function () {

        $("#songs-table").DataTable({
            paging: true,
            responsive: false,
            fixedHeader: true,
            autoWidth: false,
            processing: true,
            searching: true,
            order: [[ 0, 'desc' ]],
            columnDefs: [
                { orderable: false, targets: [ 2, 3, 7] },
                { searchable: false, targets: [ 0, 2, 3, 7 ]}
            ],
            language:{
                emptyTable: 'There are no Songs. Try adding a new Song.!'
            },
            ajax: {
                url : '/songs',
                type: 'GET',
                dataSrc : function (d) {
                    console.log(d);
                    return d;
                },
            },
            columns: [
                {
                    data: 'id',
                },
                {
                    data: 'title'
                },
                {
                    data: 'file_path',
                    render: function (data, type, row){
                        return render_song_file(data, type, row)
                    },
                },
                {
                    data: 'remote_file_path',
                    render: function (data, type, row){
                        return render_song_file(data, type, row)
                    },
                },
                {
                    data: 'singers',
                    render: function (data, type, row) {
                        return render_artists(data, type,row);
                    }
                },
                {
                    data: 'musicians',
                    render: function (data, type, row) {
                        return render_artists(data, type,row);
                    }
                },
                {
                    data: 'writers',
                    render: function (data, type, row) {
                        return render_artists(data, type,row);
                    }
                },
                {
                    data: 'released_at',
                },
                {
                    data: 'added_user',
                    render: function (data, type, row){
                        return render_added_user(data, type, row)
                    },
                },
                {
                    data: 'song_status',
                    render: function (data, type, row){
                        return render_song_status(data, type, row)
                    },
                },
                {
                    data: 'id',
                    render: function (data, type, row){
                        return render_actions(data, type, row)
                    },
                }
            ]
        });

        function render_song_file(data, type, row) {
            let audio = document.createElement('AUDIO');
            let source = document.createElement('SOURCE');
            audio.controls = 'true';
            audio.preload = 'none';
            source.src = data;
            source.type = 'audio/mpeg';
            audio.append(source);

            return audio.outerHTML;
        }

        function render_artists(data, type, row) {
            let list = document.createElement('UL');
            data.forEach(function (item, index) {
                let list_item = document.createElement('LI');
                list_item.innerHTML = item.user.first_name+' '+item.user.last_name;
                list.appendChild(list_item);
            });

            return list.outerHTML;
        }

        function render_added_user(data, type, row) {
            let anchor = document.createElement('A');
            anchor.href = '/users/'+data.id;
            anchor.innerHTML = data['first_name'] + ' ' + data['last_name'];

            return anchor.outerHTML;
        }

        function render_song_status(data, type, row) {
            if(row['hash_status'] < 3){
                let anchor = document.createElement('A');
                let badge = document.createElement('SPAN');
                anchor.href = '/song/rehash/'+row['id'];
                anchor.className = 'btn btn-danger';
                badge.className = 'badge bg-danger';
                badge.innerHTML = data;
                anchor.appendChild(badge);

                return anchor.outerHTML;
            }
            else {
                let badge = document.createElement('SPAN');
                badge.className = 'badge bg-success';
                badge.innerHTML = data;

                return badge.outerHTML;
            }
        }

        function render_actions(data, type, row) {
            let d = document.createElement('DIV');
            let viewButton = document.createElement('BUTTON');
            let editButton = document.createElement('BUTTON');
            let deleteButton = document.createElement('BUTTON');

            let viewIcon = document.createElement('I');
            let editIcon = document.createElement('I');
            let deleteIcon = document.createElement('I');

            viewButton.className = 'btn btn-primary';
            editButton.className = 'btn btn-warning';
            deleteButton.className = 'btn btn-danger';

            viewIcon.className = 'far fa-eye';
            editIcon.className = 'far fa-edit';
            deleteIcon.className = 'far fa-trash-alt';

            viewButton.appendChild(viewIcon);
            editButton.appendChild(editIcon);
            deleteButton.appendChild(deleteIcon);

            d.appendChild(viewButton);
            d.appendChild(editButton);
            d.appendChild(deleteButton);

            return d.innerHTML;
        }

    });

} catch (e) {
    console.log("error: ",e)
}
