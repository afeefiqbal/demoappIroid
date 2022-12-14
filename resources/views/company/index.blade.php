    @extends('layouts.app')

    @section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   
<div class="container">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{route('company.create')}}">
            <button type="button" class="btn btn-primary">Add</button>
        </a>
      </div>
    <table class="table company_datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Website</th>
            <th scope="col">logo</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
   
        </tbody>
      </table>
  </div>
  <script type="text/javascript">
    $(function () {
      var table = $('.company_datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('company.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'website', name: 'website'},
              {data: 'log', name: 'logo'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script>
@endsection