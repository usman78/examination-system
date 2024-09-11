@extends('layout/admin-layout')

@section('space-work')
<h2 class="mb-4">Add Q&A</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
  Add Q&A
</button>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#importQnaModal">
  Import Q&A
</button>
<table class="table my-2">
  <thead>
    <tr>
      <th>Q #</th>
      <th>Question</th>
      <th>Answer</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    @if(count($questions) > 0)
    @foreach($questions as $question)
    <tr>
      <td>{{$question->id}}</td>
      <td>{{$question->question}}</td>
      <td>
        <a href="#" class='ansButton' data-id="{{ $question->id }}" data-toggle="modal" data-target="#showQnaModal">
          See Answer</a>
      </td>
      <td><button class="btn btn-primary editButton" data-id="{{ $question->id }}" data-toggle="modal"
          data-target="#editQnaModal">Edit</button></td>
          <td><button class="btn btn-danger deleteButton" data-id="{{ $question->id }}" data-toggle="modal"
          data-target="#deleteQnaModal">Delete</button></td>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="3"></td>
    </tr>
    @endif
  </tbody>
</table>
<!--import Q&A Modal-->
<div class="modal fade" id="importQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Import Q&A</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="importQna">
        <div class="modal-body">

          
          <input type="file" name="file" id="fileupload" class="form-control" accept=".xlsx , .xls , .csv"  />

        </div>
        <div class="modal-footer">
          <span class="editError text-danger text-right"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitBtn">Import Q&A</button>
        </div>


    </div>
    </form>
  </div>
</div>
<!-- Add Q&A Modal -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Q&A</h5>
        <button class="btn btn-info ml-5" id="addAnswers">Add Answers</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addQna">
        <div class="modal-body addModalAnswers">

          @csrf
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="col-form-label text-dark">Question</label>
                <input type="text" name="question" placeholder="Enter Question" class="form-control bg-light" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <span class="error text-danger text-right"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitBtn">Add Q&A</button>
        </div>


    </div>
    </form>
  </div>
</div>
<!-- Edit Q&A Modal -->
<div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Q&A</h5>
        <button class="btn btn-info ml-5" id="addEditAnswer">Add Answers</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editQna">
        <div class="modal-body editModalAnswers">

          @csrf
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="col-form-label text-dark">Question</label>
                <input type="hidden" name="question_id" id="question_id">
                <input type="text" name="question" id="question" placeholder="Enter Question"
                  class="form-control bg-light" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <span class="editError text-danger text-right"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitBtn">Update Q&A</button>
        </div>


    </div>
    </form>
  </div>
</div>
<!-- show Q&A Modal -->
<div class="modal fade" id="showQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Answer</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Answer</th>
              <th>Is Correct</th>
            </tr>
          </thead>
          <tbody class="showAnswer">

          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <span class="error text-danger text-right"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>


    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Q&A</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteQna">
        <div class="modal-body">

          @csrf
          <input type="hidden" name="question_id" id="delete_question_id">
                
            <p>Are you Sure you want to delete Question no <span id="show_delete_qid"></span></p>
            
        </div>
        <div class="modal-footer">
          <span class="editError text-danger text-right"></span>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="submitBtn">Delete Q&A</button>
        </div>


    </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function () {
    $("#addQna").submit(function (e) {
      e.preventDefault();
      if ($(".answers").length < 2) {
        $(".error").text("Add Minimun 2 Answers");
        setTimeout(function () {
          $(".error").text("");
        }, 2000);

      } else {
        var checkIsCorrect = false;
        for (let i = 0; i < $(".is_correct").length; i++) {
          if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
            checkIsCorrect = true;
            $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find('input').val());

          }
        }
        if (checkIsCorrect) {
          var formData = $(this).serialize();
          $.ajax({

            url: "{{ route('addQna') }}",
            method: "POST",
            data: formData,
            success: function (data) {
              
              console.log(data);
              if (data.success == true) {
                $('#submitBtn').prop('disabled', true);
                location.reload();
              } else {
                alert(data.msg);
              }

            }
          });
        } else {
          $(".error").text("Please Check anyone Correct Answers");
          setTimeout(function () {
            $(".error").text("");
          }, 2000);
        }
      }
    });
    //add answer btn for adding Q&A
    $("#addAnswers").click(function () {
      if ($(".answers").length >= 6) {
        $(".error").text("You can Add Maximum Six Answers");
        setTimeout(function () {
          $(".error").text("");
        }, 2000);
      } else {
        var html = `
   <div class ="row  answers">
   <input type="radio" name="is_correct" class="is_correct" class="form-control">
   <div class="col">
   <input type="text" name="answers[]" placeholder="Enter Answer">
   </div>
   <button class="btn btn-danger my-2 removebtn">Remove</button>
   
   </div>`;
        $(".addModalAnswers").append(html);
      }
    });
    //add in edit answer btn for adding Q&A in edit
    $("#addEditAnswer").click(function () {
      if ($(".editAnswers").length >= 6) {
        $(".editError").text("You can Add Maximum Six Answers");
        setTimeout(function () {
          $(".editError").text("");
        }, 2000);
      } else {
        var html = `
   <div class ="row  editAnswers">
   <input type="radio" name="is_correct" class="edit_is_correct" class="form-control">
   <div class="col">
   <input type="text" class="w-100" name="new_answers[]" placeholder="Enter Answer">
   </div>
   <button class="btn btn-danger my-2 removebtn">Remove</button>
   
   </div>`;
        $(".editModalAnswers").append(html);
      }
    });
    $(document).on("click", ".removebtn", function () {
      $(this).parent().remove();
    });
    //show answer code
    $(".ansButton").click(function () {
      var questions = @json($questions);
      var qid = $(this).attr('data-id');
      var html = '';
      // console.log(questions);
      for (let i = 0; i < questions.length; i++) {
        if (questions[i]['id'] == qid) {
          var answersLength = questions[i]['answers'].length;

          for (let j = 0; j < answersLength; j++) {
            let is_correct = 'No';
            if (questions[i]['answers'][j]['is_correct'] == 1) {
              is_correct = 'Yes';
            }
            html += `
          <tr>
          <td>`+ (j + 1) + `</td>
          <td>`+ questions[i]['answers'][j]['answer'] + `</td>
          <td>`+ is_correct + `</td>
          </tr>`;
          }
          break;
        }
      }
      $(".showAnswer").html(html);
    });
    //show editable data of questions 
    $(".editButton").click(function () {

      var qid = $(this).attr('data-id');
      console.log(qid)
      $.ajax({

        url: "{{ route('getQnaDetails') }}",
        method: "GET",
        data: { qid: qid },
        success: function (data) {
          console.log(data);
          var qna = data.data[0];
          $("#question_id").val(qna['id']);
          $("#question").val(qna['question']);
          console.log(qna['answers'].length);
          $(".editAnswers").remove();
          var html = '';
          for (let i = 0; i < qna['answers'].length; i++) {
            var checked = '';
            if (qna['answers'][i]['is_correct'] === 1) {
              checked = 'checked';
            }
            html += `
         <div class ="row editAnswers">
             <input type="radio" name="is_correct" class="edit_is_correct" class="form-control" `+ checked + `>
            <div class="col">
        <input type="text" class="w-100" name="answers[`+ qna['answers'][i]['id'] + `]" placeholder="Enter Answer" value="` + qna['answers'][i]['answer'] + `">
              </div>
             <button class="btn btn-danger my-2 removebtn removeAnswer" data-id="`+ qna['answers'][i]['id'] + `">Remove</button>
   
            </div>`;

          }
          $(".editModalAnswers").append(html);
        }
      });
    });

    //update qna sumission
    $("#editQna").submit(function (e) {
      e.preventDefault();
      if ($(".editAnswers").length < 2) {
        $(".editError").text("Add Minimun 2 Answers");
        setTimeout(function () {
          $(".editError").text("");
        }, 2000);

      } else {
        var checkIsCorrect = false;
        for (let i = 0; i < $(".edit_is_correct").length; i++) {
          if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
            checkIsCorrect = true;
            $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")").next().find('input').val());

          }
        }
        if (checkIsCorrect) {
          var formData = $(this).serialize();
          $.ajax({

            url: "{{ route('updateQna') }}",
            method: "GET",
            data: formData,
            success: function (data) {
              
              
              if (data.success == true) {
                $('#submitBtn').prop('disabled', true);
                location.reload();
              } else {
                alert(data.msg);
              }

            }
          });
        } else {
          $(".editError").text("Please Check anyone Correct Answers");
          setTimeout(function () {
            $(".editError").text("");
          }, 2000);
        }
      }
    });
    //removeanswers from database
    $(document).on("click", ".removeAnswer", function () {
      var ansId = $(this).attr('data-id');
      $.ajax({

        url: "{{ route('deleteAns') }}",
        method: "GET",
        data: {id:ansId},
        success: function (data) {
          
          if (data.success == true) {
            console.log(data);
          } else{
            console.log(data);
          }

        }
      });
    });
    //get delete qid
    $(".deleteButton").click(function () {

  var qid = $(this).attr('data-id');
   $("#delete_question_id").val(qid);
   $("#show_delete_qid").text(qid);
    });
    //delete q&A from database
    
    $("#deleteQna").submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      console.log(formData);
      $.ajax({

     url: "{{ route('deleteQna') }}",
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
    $("#importQna").submit(function(e) {
      e.preventDefault();
    
      let formData = new FormData();
      formData.append("file",fileupload.files[0]);
      console.log(formData);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      });
      $.ajax({

     url: "{{ route('importQna') }}",
     method :"POST",
     data:formData,
     processData:false,
     contentType:false,
     success:function(data){
       
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


