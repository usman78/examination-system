<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Imports\QnaImport;
use App\Models\User;
use App\Models\QnaExam;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
class AdminController extends Controller
{
    //add subject
     public function addSubject(Request $request){
      try {
        Subject::insert([
          'subject' => $request->subject
        ]);
        return response()->json(['success' => true,'msg'=> 'Subject Added Successfully']);
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    //edit subject
    public function editSubject(Request $request){
      try {
        $subject = Subject::find($request->id);
        $subject->subject = $request->subject;
        $subject->save();
        return response()->json(['success' => true,'msg'=> 'Subject updated Successfully']);
        
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    //delete subject
    public function deleteSubject(Request $request){
      try {
        $subject = Subject::find($request->id);

        $subject->delete();
        return response()->json(['success' => true,'msg'=> 'Subject Deleted Successfully']);
        
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function examDashboard(){
      $subjects = Subject::all();
      $exams = Exam::with('subjects')->get();
      
      return view('admin.exam-dashboard',['subjects'=> $subjects ,'exams' => $exams]);
    }
    public function addExam(Request $request){
      try {
        Exam::insert([
          'exam_name' => $request->exam_name,
          'subject_id' => $request->subject_id,
          'date' => $request->date,
          'time' => $request->time
        ]);
        return response()->json(['success' => true,'msg'=> 'Exam Added Successfully']);
        
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function getExamDetail($id){
      
      try {
        $exam = Exam::where('id',$id)->get();
        return response()->json(['success' => true,'data'=> $exam]);
        
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function updateExam(Request $request){
      
      try {
        $exam = Exam::find($request->exam_id);
        $exam->exam_name = $request->exam_name;
        $exam->subject_id = $request->subject_id;
        $exam->date = $request->date;
        $exam->time = $request->time;
        $exam->save();
        return response()->json(['success' => true,'msg'=> "Exam Updated Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function deleteExam(Request $request){
      
      try {
        $exam = Exam::where('id',$request->exam_id);
       
        $exam->delete();
        return response()->json(['success' => true,'msg'=> "Exam Deleted Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    //Q&A 
    public function qnDashboard(Request $request){
      $questions = Question::with('answers')->get();
      return view('admin.qnaDashboard',compact('questions'));
    }
    public function addQna(Request $request){
      try {
        $questionId = Question::insertGetId([
          'question' => $request->question
        ]);
        foreach($request->answers as $answer){
          $is_correct = 0;
          if($request->is_correct == $answer){
            $is_correct = 1;
          }
          Answer::insert([
          'question_id' => $questionId,
          'answer' => $answer,
          'is_correct' => $is_correct
          ]);
        }
        
        return response()->json(['success' => true,'msg'=> "Question Added Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function getQnaDetails(Request $request){
      $qna = Question::where('id',$request->qid)->with('answers')->get();
      return response()->json(['data'=> $qna]);
    }
    public function deleteAns(Request $request){
     Answer::where("id",$request->id)->delete();
    }
    public function updateQna(Request $request){
      try {
        Question::where('id',$request->question_id)->update([
           'question'=>$request->question  
        ]);
        //old answers update
          if(isset($request->answers)){
        foreach($request->answers as $key => $value){
          $is_correct = 0;
          if($request->is_correct == $value){
            $is_correct = 1;
          }
          Answer::where('id',$key)
          ->update([
          'question_id' => $request->question_id,
          'answer' => $value,
          'is_correct' => $is_correct
          ]);
        }
        }
      //new answer added
      if(isset($request->new_answers)){
        foreach($request->new_answers as $answer){
          $is_correct = 0;
          if($request->is_correct == $answer){
            $is_correct = 1;
          }
          Answer::where('id',$key)
          ->insert([
          'question_id' => $request->question_id,
          'answer' => $answer,
          'is_correct' => $is_correct
          ]);
        }
        }
        return response()->json(['success' => true,'msg'=> "Q&A updated Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function deleteQna(Request $request){
      try {
        Question::where('id',$request->question_id)->delete();
        Answer::where('question_id',$request->question_id)->delete();
        return response()->json(['success' => true,'msg'=> "Q&A Deleted Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function importQna(Request $request){
      try {
        Excel::import(new QnaImport,$request->file('file'));
        return response()->json(['success' => true,'msg'=> "Import Q&A Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function studentDashbaord(){
      $students = User::where('is_admin',0)->get();
      return view('admin.studentDashbaord',compact('students'));
    }
    public function addStudent(Request $request){
      try {
        $password = Str::random(8);
        User::insert([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($password)
        ]);
        $url= URL::to('/');
          
          $data['url'] = $url;
          $data['name'] = $request->name;
          $data['email'] = $request->email;
          $data['password'] = $password;
          $data['title'] = 'Student Registration on OES';
          
          Mail::send('registrationMail',['data'=>$data],function($message) use ($data){
           $message->to($data['email'])->subject($data['title']);
           });
        return response()->json(['success' => true,'msg'=> "Student add Successfully"]);
       
      } catch (\Exception $e) {
       return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    }
    public function getQuestions(Request $request){
      try {
        $questions = Question::all();
        if(count($questions)){
          $data = [];
          $counter = 0;
        foreach($questions as $question){
          $qnaExam = QnaExam::where(['exam_id' => $request->exam_id, ])->get();
          if(count($qnaExam) == 0){
           $data[$counter]['id'] = $question->id;
           $data[$counter]['question'] = $question->question;
           $counter++;
          }
        }
        return response()->json(['success' => true,'msg'=> "Question Data!", 'data'=> $data]);
        }else{
          return response()->json(['success' => false,'msg'=> "No Question Found"]);
        }
      } catch (\Exception $e) {
        return response()->json(['success' => false,'msg'=>$e->getMessage()]);
      }
    
    }
 
}
