@extends('layout/admin-layout')

@section('space-work')
<h2 class="mb-4">Subject</h2>
       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsubjectModel">
 Add Subject
</button>


<!-- Add Subject Modal -->


<div class="modal fade" id="addsubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addSubject">
       @csrf
      <div class="modal-body">
      
      <div class="form-group">
       <label class="col-form-label text-dark">Subject Name</label>
       <input type="text"  name="subject" placeholder="Enter Subject Name" class="form-control bg-light" >
       </div>
       
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>

<!--Edit Subject Modal -->
<div class="modal fade" id="editsubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="editSubject">
       @csrf
      <div class="form-group">
       <label class="col-form-label text-dark">Subject Name</label>
       <input type="hidden"  name="id" id="edit_subject_id">
       <input type="text"  name="subject" id="edit_subject">
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

<div class="modal fade" id="deletesubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="deleteSubject">
       @csrf
      <div class="form-group">
       <label class="col-form-label text-dark">Are you sure want to delete this subject?</label>
       <input type="hidden"  name="id" id="delete_subject_id">
       
       </div>
      
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>


<table class="table my-3">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    @if(count($subjects) > 0)
    @foreach($subjects as $subject)
    <tr>
    <td>{{ $subject->id}}</td>
    <td>{{ $subject->subject}}</td>
    <td>
      <button class="btn btn-primary editButton" data-toggle="modal" data-target="#editsubjectModel" data-id="{{ $subject->id}}" data-subject="{{ $subject->subject }}">Edit</button>
  </td>
    <td>
    <button class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deletesubjectModel" data-id="{{ $subject->id}}">Delete</button>
    </td>
    </tr>
    @endforeach
    @else
    <tr><td colspan="4">No Subjects Found</td></tr>
    @endif
  </tbody>
</table>
<script>
  $(document).ready(function(){
   $("#addSubject").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({

     url: "{{ route('addSubject') }}",
     method :"POST",
     data:formData,
     success:function(data){
      if(data.success == true){
        location.reload();
      }else{
        alert(data.msg);
      }
     }
    });
   });
   $(".editButton").click(function(){
    var subject_id = $(this).attr('data-id');
    var subject = $(this).attr('data-subject');
    $("#edit_subject").val(subject);
    $("#edit_subject_id").val(subject_id);
   });
   $(".deleteButton").click(function(){
    var subject_id = $(this).attr('data-id');
    $("#delete_subject_id").val(subject_id);
   });
   
   $("#editSubject").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({

     url: "{{ route('editSubject') }}",
     method :"POST",
     data:formData,
     success:function(data){
      if(data.success == true){
        location.reload();
      }else{
        alert(data.msg);
      }
      
     }
    });
   });
   $("#deleteSubject").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({

     url: "{{ route('deleteSubject') }}",
     method :"POST",
     data:formData,
     success:function(data){
      console.log(data);
      if(data.success == true){
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