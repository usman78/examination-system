@extends('layout/admin-layout')

@section('space-work')
<h2 class="mb-4">Students</h2>
       <!-- Button trigger modal -->
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstudentModal">
 Add Student
</button>

<table class="table my-2">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
     
    </tr>
  </thead>
  <tbody>
    @if(count($students) > 0)
    @foreach($students as $student)
    <tr>
      <td>{{$student->id}}</td>
      <td>{{$student->name}}</td>
      <td>{{$student->email}}</td>
      
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="3">No Students Found</td>
    </tr>
    @endif
  </tbody>
</table>
<!-- Add Student Modal -->


<div class="modal fade" id="addstudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addStudent">
       @csrf
      <div class="modal-body">
      
      <div class="form-group">
       <label class="col-form-label text-dark">Student Name</label>
       <input type="text"  name="name" placeholder="Enter Student Name" class="form-control bg-light" required>
       </div>
       
      
      <div class="form-group">
       <label class="col-form-label text-dark">Email</label>
       <input type="email"  name="email" placeholder="Enter Student Email" class="form-control bg-light" required>
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitBtn">Add Student</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>
<script>
  $(document).ready(function(){
   $("#addStudent").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.ajax({

     url: "{{ route('addStudent') }}",
     method :"POST",
     data:formData,
     success:function(data){
      if(data.success == true){
        $('#submitBtn').prop('disabled', true);
        location.reload();
      }else{
        alert(data.msg);
      }
     }
    });
    });
});
</script> 
@endsection