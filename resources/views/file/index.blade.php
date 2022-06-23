<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<form method="POST" action="{{route('pdf_upload')}}" enctype="multipart/form-data">
    @csrf    
        {{-- <input type="file" name="file" id="file" accept="application/pdf"> --}}
        <input type="file" name="file" id="file">
        <input type="submit" name="submit" class="btn btn-primary">
    </form><br><br>
    
    @if (\Session::has('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-body">
            <li>{!! \Session::get('success') !!}</li>
        </div>
    </div>
@endif

<h1><b>Uploaded Files Listing</b></h1><br>
    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>File Size</th>               
            </tr>
        </thead>
        @if(!empty($file_data))
        @foreach ($file_data as $data)
        <tbody>
                 <td>{{$data->name}}</td>
                 <td>{{$data->size}}</td>                 
        </tbody>
        @endforeach
        @else    
        <tr>No Record Found</tr>
        @endif 
        </table>