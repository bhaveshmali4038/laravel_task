<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<h1><b>Company Details</b></h1>
<form action="{{ route('filter')}}" method="post" >
    {!! csrf_field() !!}
<label><strong>Filter By Country Name :</strong></label>
<select name='country_id' class="form-control" style="width: 200px">
    <option value="">All</option>
    @foreach (App\Models\Country::get() as $value)
    <option value="{{$value->id}}">{{$value->name}}</option>
    @endforeach   

</select>
<button id='btnFilter' type="submit">Go</button>
</form><br><br>
<table>
    <thead>
        <tr>
            <th>Company Name</th>
            <th>User Name</th>
            <th>Country Name</th>
            <th>Date</th>
        </tr>
    </thead>
    @if(!empty($data))
    @foreach ($data as $data)
    <tbody>
             <td>{{$data['company_name']}}</td>
             <td>{{$data['country_name']}}</td>
             <td>{{$data['user_name']}}</td>
             <td>{{$data['date']}}</td>
    </tbody>
    @endforeach
    @else    
    <tr>No Record Found</tr>
    @endif 
</table>