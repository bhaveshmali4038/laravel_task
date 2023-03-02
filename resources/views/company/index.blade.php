@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('company_detail')}}"><button type="submit" class="btn btn-primary">Company Details</button></a>
                        <a href="{{route('pdf_index')}}"><button type="submit" class="btn btn-primary" style="float: right;">File Details</button></a>                        
                    </div>
                    @include('errors.index')
                    <div class="card-body">
                        <section id="responsive-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">Comapny Details</h4>
                                                <select name="country_name" id="country_name" class="form-control">
                                                    <option value="" selected>---Select Country Name---</option>
                                                    @if (!empty($country))
                                                        @foreach ($country as $val)
                                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                                        @endforeach
                                                    @endif                                                    
                                                </select>   
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-responsive table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No</th>
                                                        <th>Company Name</th>
                                                        <th>User Name</th>
                                                        <th>Country</th>
                                                        <th>Date</th>
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
    var ajax_datatable = '{{route('company_ajax')}}';

    $(document).on('change','#country_name',function (e) {
        dTable.fnDraw(true);
    });

    var dTable = $('.dt-responsive').dataTable({
    processing: true,
    serverSide: true,
    searching: true,      
    scrollX:true,
    "lengthMenu": [[10, 25, 50,100 ,-1], [10, 25, 50,100,"All"]],
    "initComplete": function (settings, json) {
        $(".checkall").closest("th").removeClass("sorting_asc");
    },
    ajax: {
        url: ajax_datatable,
        type: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: function (d) {
            d.country = $('#country_name').val();
        }
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'company_name', name: 'company_name'},
        {data: 'user_name', name: 'user_name'},
        {data: 'country_name', name: 'country_name'},
        {data: 'date', name: 'date'},
    ],
    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
        var oSettings = dTable.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
        return nRow;
    },
});

</script>
@endpush
