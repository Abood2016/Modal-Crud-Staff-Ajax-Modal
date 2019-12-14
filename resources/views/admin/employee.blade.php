<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
      </head>
<body>

  <!--start store modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="{{route('employees.store')}}" method="post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
         <label for="fname">First Name</label>
         <input type="text" name = "fname" class="form-control" aria-describedby="fname">
        </div>
      
        <div class="form-group">
         <label for="lname">Last Name</label>
          <input type="text" name = "lname" class="form-control" aria-describedby="lname">

        </div>

        <div class="form-group">
           <label for="lname">Address</label>
           <input type="text" name = "address" class="form-control" aria-describedby="address">

        </div>

        <div class="form-group">
          <label for="lname">mobile</label>
          <input type="text" name = "mobile" class="form-control" aria-describedby="mobile">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>

    </div>
  </div>
</div>
  <!-- end store modal -->


  <!--start edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="/employees" method="post" id="editForm">
    @csrf
    {{method_field('PUT')}}
    <div class="modal-body">
        <div class="form-group">
         <label for="fname">First Name</label>
         <input type="text" name = "fname" id="fname" class="form-control" aria-describedby="fname">
        </div>
      
        <div class="form-group">
         <label for="lname">Last Name</label>
          <input type="text" name = "lname" id="lname" class="form-control" aria-describedby="lname">

        </div>

        <div class="form-group">
           <label for="lname">Address</label>
           <input type="text" name = "address" id="address" class="form-control" aria-describedby="address">

        </div>

        <div class="form-group">
          <label for="lname">mobile</label>
          <input type="text" name = "mobile" id="mobile" class="form-control" aria-describedby="mobile">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>

    </div>
  </div>
</div>
<!--end edit modal -->

<!--start delete modal -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="/employees" method="post" id="deleteForm">
    
    @csrf
    {{method_field('DELETE')}}
    
    <div class="modal-body">
      <input type="hidden" name="_method" value="DELETE">
      <p>Are you Sure ? You Want to delete data</p>
    </div>       

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes , Delete</button>
      </div>
    </form>

    </div>
  </div>
</div>

<!--end delete modal -->


<div class="container">
    <h1>Modal CRUD</h1>
    
  @if (count($errors)> 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
  @endif
      @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
              </div>
        @elseif(session('error'))
              <div class="alert alert-danger">
                  {{session('error')}}
              </div>
        @endif

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create
</button>
<br><br>
<table  id="datatable" class="table table-bordered table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name </th>
      <th scope="col">address</th>
      <th scope="col">mobile</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name </th>
      <th scope="col">address</th>
      <th scope="col">mobile</th>
      <th scope="col">Action</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach ($employess as $employee)
        
    <tr>
      <th>{{$employee->id}}</th>
      <td>{{$employee->fname}}</td>
      <td>{{$employee->lname}}</td>
      <td>{{$employee->address}}</td>
      <td>{{$employee->mobile}}</td>
      <td>
          <a href="#" class= "btn btn-success edit">Edit</a>
          <a href="#" class= "btn btn-danger delete">Delete</a>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    
    var table = $('#datatable').DataTable();

    //start edit with class edit
    table.on('click','.edit',function () {
      $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
       
     var data  = table.row($tr).data();   
     console.log(data);

     $('#fname').val(data[1]);
     $('#lname').val(data[2]);
     $('#address').val(data[3]);
     $('#mobile').val(data[4]);

     $('#editForm').attr('action', '/employees/' +data[0]);
     $('#editModal').modal('show');   
    });
    //end edit with class edit

    //start Delete with class delete
    table.on('click','.delete',function () {
      $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
       
     var data  = table.row($tr).data();   
     console.log(data);

     $('#deleteForm').attr('action', '/employees/' +data[0]);
     $('#deleteModal').modal('show');   
    });
    //end delete with class edit

});
</script>

</body>
</html>