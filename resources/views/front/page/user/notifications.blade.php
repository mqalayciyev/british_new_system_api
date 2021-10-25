@extends('front.layouts.app')

@section('title', ' | Account')

@section('content')
    <div class="container">
        @include('front.page.user.navbar')

        <div class="row content-page">
            <div class="col-12 p-3">
                {{-- <table id="table" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>

@endsection

@section('script')
    {{-- <script>
        $(() => {
            $('#table').DataTable({
                order: [
                    [6, "desc"]
                ],
                processing: true,
                serverSide: true,
                ordering: true,
                paging: true,
                ajax: '{{ route('payments.index_data') }}',
                columns: [{
                        data: 'image_name',
                        name: 'product_image.image_name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'product_name',
                        name: 'product.product_name'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name',
                        searchable: false
                    },
                    // {data: 'supplier_name', name: 'supplier_name', searchable:false},
                    {
                        data: 'sale_price',
                        name: 'product.sale_price'
                    },
                    {
                        data: 'stok_piece',
                        name: 'product.stok_piece'
                    },
                    {
                        data: 'updated_at',
                        name: 'product.updated_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                ],
                language: {
                    "sEmptyTable": "{{ __('admin.No data available in table') }}",
                    "sInfo": "{{ __('admin.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    "sInfoEmpty": "{{ __('admin.Showing 0 to 0 of 0 entries') }}",
                    "sInfoFiltered": "({{ __('admin.filtered from _MAX_ total entries') }})",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "{{ __('admin.Show _MENU_ entries') }}",
                    "sLoadingRecords": "{{ __('admin.Loading...') }}",
                    "sProcessing": "{{ __('admin.Processing...') }}",
                    "sSearch": "{{ __('admin.Search:') }}",
                    "sZeroRecords": "{{ __('admin.No matching records found') }}",
                    "oPaginate": {
                        "sFirst": "{{ __('admin.First') }}",
                        "sLast": "{{ __('admin.Last') }}",
                        "sNext": "{{ __('admin.Next') }}",
                        "sPrevious": "{{ __('admin.Previous') }}"
                    },
                    "oAria": {
                        "sSortAscending": "{{ __('admin.: activate to sort column ascending') }}",
                        "sSortDescending": "{{ __('admin.: activate to sort column descending') }}"
                    }
                }
            });
        });
    </script> --}}
@endsection
