@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('company_detail') }}"><button type="submit" class="btn btn-primary">Company
                                Details</button></a>
                        <a href="{{ route('pdf_index') }}"><button type="submit" class="btn btn-primary"
                                style="float: right;">File Details</button></a>
                    </div>
                    @include('errors.index')
                    <div class="card-body">
                        <section id="responsive-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">PDF Details</h4>
                                            <form action="{{ route('pdf_upload') }}" method="POST"
                                                enctype="multipart/form-data" style="position: relative">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control" name="file"
                                                            accept="pdf" required>
                                                    </div>
                                                            <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary"
                                                            style="float: right;">Upload</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-responsive table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No</th>
                                                        <th>File Name</th>
                                                        <th>File Size</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        var ajax_datatable = '{{ route('file_pdf_ajax') }}';

        var dTable = $('.dt-responsive').dataTable({
            processing: true,
            serverSide: true,
            searching: true,
            scrollX: true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "initComplete": function(settings, json) {
                $(".checkall").closest("th").removeClass("sorting_asc");
            },
            ajax: {
                url: ajax_datatable,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function(d) {}
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'file_name',
                    name: 'file_name'
                },
                {
                    data: 'file_size',
                    name: 'file_size'
                },               
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                var oSettings = dTable.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow;
            },
        });
    </script>
@endpush
