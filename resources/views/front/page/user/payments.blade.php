@extends('front.layouts.app')

@section('title', ' | Ödənişlər')

@section('content')
    <div class="container content-page">
        @include('front.page.user.navbar')

        <div class="row py-3">
            <div class="card w-100">
                <div class="card-body table-responsive">
                    <table id="table" class="table table-bordered table-striped table-hover display w-100">
                        <thead>
                            <tr>
                                <th>Ödəniş məbləği</th>
                                <th>Ödəniş tarixi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(() => {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                paging: true,
                ajax: '{{ route('payments.index_data') }}',
                columns: [
                    {
                        data: 'amount',
                    },
                    {
                        data: 'created_at',
                    },
                ],
                // language: {
                //     "sEmptyTable": "{{ __('admin.No data available in table') }}",
                //     "sInfo": "{{ __('admin.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                //     "sInfoEmpty": "{{ __('admin.Showing 0 to 0 of 0 entries') }}",
                //     "sInfoFiltered": "({{ __('admin.filtered from _MAX_ total entries') }})",
                //     "sInfoPostFix": "",
                //     "sInfoThousands": ",",
                //     "sLengthMenu": "{{ __('admin.Show _MENU_ entries') }}",
                //     "sLoadingRecords": "{{ __('admin.Loading...') }}",
                //     "sProcessing": "{{ __('admin.Processing...') }}",
                //     "sSearch": "{{ __('admin.Search:') }}",
                //     "sZeroRecords": "{{ __('admin.No matching records found') }}",
                //     "oPaginate": {
                //         "sFirst": "{{ __('admin.First') }}",
                //         "sLast": "{{ __('admin.Last') }}",
                //         "sNext": "{{ __('admin.Next') }}",
                //         "sPrevious": "{{ __('admin.Previous') }}"
                //     },
                //     "oAria": {
                //         "sSortAscending": "{{ __('admin.: activate to sort column ascending') }}",
                //         "sSortDescending": "{{ __('admin.: activate to sort column descending') }}"
                //     }
                // }
            });
        });
    </script>
@endsection
