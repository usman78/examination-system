@extends('layout/admin-layout')

@section('space-work')
<h2 class="mb-4">Exam</h2>
       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamtModal">
 Add Exam
</button>

<table class="table my-3">
    <thead>
        <tr>
            <th>Id</th>
            <th>Exam Name</th>
            <th>Subject Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Add Questions</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @if(count($exams) > 0)
        @foreach($exams as $exam)
        <tr>
            <td>{{$exam->id}}</td>
            <td>{{$exam->exam_name}}</td>
            <td>{{$exam->subjects[0]['subject']}}</td>
            <td>{{$exam->date}}</td>
            <td>{{$exam->time}}</td>
            <td><a href="#" data-toggle="modal" data-target="#addQnaModal" class="addQna" data-id="{{$exam->id}}">
            Add Questions</a></td>
            <td> <button class="btn btn-primary editButton" data-toggle="modal" data-target="#editExamModal" data-id="{{ $exam->id}}">Edit</button>
            <td> <button class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteExamModal" data-id="{{ $exam->id}}">delete</button>
        </td>
        </tr>
        @endforeach
        @else
        @endif
    </thead>
</table>
<!-- Add Exam Modal -->
<div class="modal fade" id="addExamtModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addExam">
       @csrf
      <div class="form-group">
       <label class="col-form-label text-dark">Exam Name</label>
       <input type="text"  name="exam_name" placeholder="Enter Exam Name" class="form-control bg-light" required>
       </div>
       
      
      <div class="form-group">
       <label class="col-form-label text-dark">Subject</label>
       <select name="subject_id" class="form-control bg-light" required>
       <option value="">Select Subject</option>
       @if(count($subjects) > 0)
       @foreach($subjects as $subject)
       <option value="{{$subject->id}}">{{$subject->subject}}</option>
       @endforeach
              @endif
       </select>
      
       </div>
       <div class="form-group">
       <label class="col-form-label text-dark">Date</label>
        <input type="date" name="date" required class="form-control" min="@php echo date('Y-m-d'); @endphp">
       </div>
       <div class="form-group">
       <label class="col-form-label text-dark">Time</label>
        <input class="form-control" type="time" name="time" pattern="HH:MM"  required>
       </div>
      
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitBtn">Add</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>
<!-- Edit Exam Modal -->
<div class="modal fade" id="editExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="editExam">
       @csrf
       <input type="hidden" name="exam_id" id="exam_id">
      <div class="form-group">
       <label class="col-form-label text-dark">Exam Name</label>
       <input type="text"  name="exam_name" id="exam_name" placeholder="Enter Exam Name" class="form-control bg-light" required>
       </div>
       
      
      <div class="form-group">
       <label class="col-form-label text-dark">Subject</label>
       
       <select name="subject_id" id="subject_id"  class="form-control bg-light" required>
      
       <option value="">Select Subject</option>
       @if(count($subjects) > 0)
       @foreach($subjects as $subject)
       <option value="{{$subject->id}}">{{$subject->subject}}</option>
       @endforeach
              @endif
       </select>
      
       </div>
       <div class="form-group">
       <label class="col-form-label text-dark">Date</label>
        <input type="date" name="date" id="date" required class="form-control" min="@php echo date('Y-m-d'); @endphp">
       </div>
       <div class="form-group">
       <label class="col-form-label text-dark">Time</label>
        <input class="form-control" type="time" id="time" name="time" pattern="HH:MM"  required>
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

<!-- delete Exam Modal -->
<div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="deleteExam">
       @csrf
       <input type="hidden" name="exam_id" id="deleteExamId">
     
      <p>Are You Sure You Want to Delete this Exam?</p>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>
<!-- Add Qna Modal -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Question in Exams</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addQna">
       @csrf
      <div class="form-group">
        <input type="hidden" name="exam_id" id="addExamId">
        <input type="search" class="form-control">
        <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Question</th>
          </tr>
          
        </thead>
        <tbody>
          
        </tbody>
        </table>
       <!-- <label class="col-form-label text-dark">Select Questions</label>
       <select name="questions" multiple multiselect-search="true" multiselect-select-all="true" 
       onchange="console.log(this.selectedOptions)" class="form-control">
       <option value="1">Question 1</option>
       <option value="2">Question 2</option> 
       </select> -->
       </div>
       
      
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitBtn">Add</button>
      </div>
      </form>
   
   </div>
 
  </div>
</div>
<script>
  $(document).ready(function(){
   $("#addExam").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.ajax({

     url: "{{ route('addExam') }}",
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
    $(".editButton").click(function(){
    var id = $(this).attr('data-id');
    $("#exam_id").val(id);
    var url ='{{ route("getExamDetail","temp_id") }}';
    url = url.replace('temp_id',id);
    $.ajax({
        url:url,
        type:"GET",
        success:function(data){
            
            if(data.success == true){
             var exam =  data.data;
             $("#exam_name").val(exam[0].exam_name);
             $("#subject_id").val(exam[0].subject_id);
             $("#date").val(exam[0].date);
             $("#time").val(exam[0].time);
            }else{
                alert(data);
            }
        }
    });
   });
   $("#editExam").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.ajax({

     url: "{{ route('updateExam') }}",
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
    
    $(".deleteButton").click(function(){
    var exam_id = $(this).attr('data-id');
    $("#deleteExamId").val(exam_id);
   });
   
    $("#deleteExam").submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.ajax({

     url: "{{ route('deleteExam') }}",
     method :"POST",
     data:formData,
     success:function(data){
        // console.log(data);
      if(data.success == true){
        location.reload();
      }else{
        alert(data.msg);
      }
     }
    });
    });
    $(".addQna").click(function(){
    var id = $(this).attr('data-id');
    $("#addExamId").val(id);
    $.ajax({

url: "{{ route('getQuestions') }}",
method :"GET",
data:{exam_id:id},
success:function(data){
   console.log(data);
//  if(data.success == true){
//    location.reload();
//  }else{
//    alert(data.msg);
//  }
}
});
    });
});
   </script>
@endsection