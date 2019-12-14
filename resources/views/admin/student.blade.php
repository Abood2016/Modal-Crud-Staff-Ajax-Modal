<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AJAX CRUD</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
      </head>
<body>

      <!--start store modal -->
<div class="modal fade" id="studentaddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create  Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
  <form id="addStudent">
    <div class="modal-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="form-group">
         <label for="fname">First Name</label>
         <input type="text" name ="fname" class="form-control" aria-describedby="fname">
        </div>
      
        <div class="form-group">
         <label for="lname">Last Name</label>
          <input type="text" name = "lname" class="form-control" aria-describedby="lname">
        </div>

        <div class="form-group">
           <label for="lname">Course</label>
           <input type="text" name = "course" class="form-control" aria-describedby="address">
        </div>

        <div class="form-group">
          <label for="lname">Section</label>
          <input type="text" name = "section" class="form-control" aria-describedby="course">
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
<div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
  <form id="EditStudent">
    <div class="modal-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
          {{ method_field('PUT') }}
        <input type="hidden" name="id" id="id">
      <div class="form-group">
         <label for="fname">First Name</label>
         <input type="text" name ="fname" class="form-control" id="fname" aria-describedby="fname">
        </div>
      
        <div class="form-group">
         <label for="lname">Last Name</label>
          <input type="text" name = "lname" class="form-control" id="lname" aria-describedby="lname">
        </div>

        <div class="form-group">
           <label for="lname">Course</label>
           <input type="text" name = "course" class="form-control"  id="course" aria-describedby="address">
        </div>

        <div class="form-group">
          <label for="lname">Section</label>
          <input type="text" name = "section" class="form-control" id="section" aria-describedby="course">
        </div>
        
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit changes</button>
      </div>
    </form>

    </div>
  </div>
</div>
  <!-- end edit modal -->

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
  <form action="/students" method="post" id="deleteForm">
    
    @csrf
    {{method_field('DELETE')}}
    
    <div class="modal-body">
      <input type="hidden" name="_method" id="delete_id" value="DELETE">
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
        
        <div class="jumbotron">
            <div class="row">
                <h1>Modal CRUD with Ajax</h1>
               
              </div><br>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddModal">
                    Create Student
                </button>
<br>
<br>
  <table  id="datatable" class="table table-bordered table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name </th>
              <th scope="col">course</th>
              <th scope="col">section</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name </th>
              <th scope="col">course</th>
              <th scope="col">section</th>
              <th scope="col">Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($students as $student)
                
            <tr>
              <th>{{$student->id}}</th>
              <td>{{$student->fname}}</td>
              <td>{{$student->lname}}</td>
              <td>{{$student->course}}</td>
              <td>{{$student->section}}</td>
              <td>
                  <a href="#" class= "btn btn-success editbtn">Edit</a>
                  <a href="#" class= "btn btn-danger delete">Delete</a>
              </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
        </div>
    </div>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



<script>

$(document).ready(function(){


  

  $('.editbtn').on('click',function() {
    $('#studentEditModal').modal('show');
    var table = $('#datatable').DataTable();



      //start edit with class edit
    table.on('click','.editbtn',function () {
      $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
       
     var data  = table.row($tr).data();  

    console.log(data);

    $('#id').val(data[0]);
    $('#fname').val(data[1]);
    $('#lname').val(data[2]);
    $('#course').val(data[3]);
    $('#section').val(data[4]);
  });

  $('#EditStudent').on('submit',function(e){
    e.preventDefault();

    var id = $('#id').val();

      $.ajax({
            type: "PUT",
            url:"/studentUpdate/"+id,
             headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $('#EditStudent').serialize(),
            success: function (response){
                console.log(response)
                $('#studentEditModal').modal('hide');
                alert('Updated Successfully');
              window.location.reload();
            },
            error: function(error){
                console.log(error);
                alert('Error in Saving Data');
            }
        });



  });


  //start Delete with class delete
    table.on('click','.delete',function () {
      $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
       
     var data  = table.row($tr).data();   
     console.log(data);

     $('#deleteForm').attr('action', '/students/' +data[0]);
     $('#deleteModal').modal('show');   
    });
    //end delete with class edit


  });

  
});

</script>


<script type="text/javascript">

  $(document).ready(function(){

    var table = $('#datatable').DataTable();
    
    $('#addStudent').on('submit',function(e){
        e.preventDefault();

          $.ajax({
            type: 'POST',
            url:"{{route('student.store')}}",
             headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $('#addStudent').serialize(),
            success: function (response){
                console.log(response)
                $('#studentaddModal').modal('hide');
                alert('Add Saved Successfully');

            },
            error: function(error){
                console.log(error);
                alert('Error in Saving Data');
            }
        });
    });
  });


</script>

</body>
</html>