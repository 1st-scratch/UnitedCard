@extends('admin.layouts.default')

@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>ユーザーリスト
                    <div class="page-title-subheading">
                        システムに登録されているすべてのユーザーを確認できます。
                    </div>
                </div>
            </div>
            <div class="page-title-actions"></div>
        </div>
    </div>
    <div class="page-content">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ユニークキー</th>
                            <th class="center">名前</th>
                            <th class="center">Eメール</th>
                            <th class="center">リンク</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var data_table;

        $(document).ready(function() {
            data_table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 100,
                language: {
                    url: getLanguage()
                },
                ajax: {
                    url: "{{ route('admin.user.list.data') }}",
                    type: "POST",
                    data: function (d) {
                        d._token = '{{csrf_token()}}'
                    }
                },
                order: [[ 0, "asc" ]],
                columns: [
                    {data: 'united_key', name: 'united_key'},
                    {data: 'name', orderable: false, className: 'center', name: 'name'},
                    {data: 'email', orderable: false, name: 'email'},
                    {
                        orderable: false,
                        className: 'center',
                        render: function (data, type, row) {
                            return `<a target="_blank" href="`+row.link+`">`+row.link+`</a>`;
                        }
                    },
                    {
                        orderable: false,
                        className: 'center',
                        render: function (data, type, row) {
                            return `<button class="btn btn-danger delete-user" data-id="`+row.united_key+`">Delete</button>`;
                        }
                    }
                ],
                initComplete : function() {
                    var input = $('.dataTables_filter input').unbind(),
                        self = this.api(),
                        $searchButton = $('<button class="d-tbl-filter btn btn-success">')
                                .text('検索')
                                .click(function() {
                                    self.search(input.val()).draw();
                                });
                    $('.dataTables_filter').append($searchButton);
                }
            });
    });

    function getLanguage() {
        return '//cdn.datatables.net/plug-ins/1.10.7/i18n/Japanese.json'
    }

    $(document).on('click', '.delete-user', function(){
        let key = $(this).attr('data-id');

        showLoader();

        jQuery.ajax({
            url: "{{ route('admin.user.delete') }}",
            dataType: 'json',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "key": key,
            },
            method: "POST",
            success: function(response) {
                data_table.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('ajax error');
            },
            complete: function() {
                hideLoader();
            }
        });
    });

    
    function showLoader() {
        $(".loader").css("display", "block");
    }

    function hideLoader() {
        $(".loader").css("display", "none");
    }
    </script>
@endsection