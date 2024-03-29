<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassExam;
use App\Models\ClassExamQuestion;
use App\Models\ClassExamChoice;
use App\Models\ClassExamCollection;
use App\Models\ClassExamCollectionAnswer;
use Validator;
use Alert;

class StudentClassExamController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id, $idc)
     {
       $check=ClassExam::where(['id' => $id, 'is_active' => TRUE])->count();
       if($check > 0){
         $user_id = auth()->user()->id;
         $data=ClassExam::where('id', $id)->first();
         $collection=ClassExamCollection::where(['user_id' => $user_id, 'meeting_exam_id' => $id])->first();
         return view('student/class/exam/show', compact('id', 'idc', 'data', 'collection'));
       }else{
         Alert::error('Gagal', 'Ujian Sudah Tidak Aktif!');
         return redirect()->back();
       }
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function startwork(Request $request, $id, $idc)
     {
         $user_id = auth()->user()->id;
         $check=ClassExamCollection::where(['meeting_exam_id' => $id, 'user_id' => $user_id, 'is_deleted' => FALSE])->count();
         if($check > 0){
           Alert::error('Gagal', 'Ujian Sudah Dikerjakan!');
           return redirect()->back();
         }else{
           $data = new ClassExamCollection;
           $data->meeting_exam_id = $id;
           $data->user_id = $user_id;
           $data->is_finished = FALSE;
           $data->is_scored = FALSE;
           $data->is_deleted = FALSE;
           $save = $data->save();

           $get=ClassExamCollection::where(['meeting_exam_id' => $id, 'user_id' => $user_id])->first();
           $questions=ClassExamQuestion::where(['meeting_exam_id' => $id, 'is_deleted' =>FALSE])->get();

           foreach($questions as $question){
             $data1 = new ClassExamCollectionAnswer;
             $data1->meeting_exam_collection_id = $get->id;
             $data1->meeting_exam_question_id = $question->id;
             $data1->is_multiple_choice = $question->is_multiple_choice;
             $data1->is_true = FALSE;
             $save1 = $data1->save();
           }

           $getqs=ClassExamCollectionAnswer::where('meeting_exam_collection_id', $get->id)->first();

           if($save1){
             $is_any = 1;
             Alert::success('Berhasil', 'Session Berhasil Dibuat, Silahkan Mengerjakan Ujian!');
             return redirect()->route('studentclassexamwork', array($id, $idc, $get->id, $getqs->id, $is_any));
           } else {
             Alert::error('Gagal', 'Gagal Membuat Session');
             return redirect()->back();
           }
         }
      }

    public function work($id, $idc, $idcol, $idqs, $is_any)
    {
        $user_id = auth()->user()->id;
        $data=ClassExamCollection::where(['meeting_exam_id' => $id, 'user_id' => $user_id, 'is_deleted' => FALSE])->first();
        $check_active=ClassExamCollection::where(['meeting_exam_id' => $id, 'user_id' => $user_id, 'is_finished' => TRUE])->count();
        if($check_active > 0){
          Alert::error('Gagal', 'Ujian Sudah Dikerjakan!');
          return redirect()->route('studentclassexamshow', array($id, $idc));
        }else{
          $check=ClassExam::where('id', $id)->first();
          $working_second=$check->working_time*60;
          $time = strtotime($data->created_at) + $working_second;
          $work_time=date('M j, Y H:i:s', $time);
          $questions=ClassExamCollectionAnswer::where('meeting_exam_collection_id', $idcol)->get();
          $ques=ClassExamCollectionAnswer::where('id', $idqs)->first();
          $choices=ClassExamChoice::where('meeting_exam_question_id', $ques->meeting_exam_question_id)->get();
          return view('student/class/exam/work', compact('id', 'idc', 'idcol', 'data', 'work_time', 'check', 'questions', 'ques', 'choices', 'is_any'));
        }
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, $id, $idc, $idcol, $idqs)
    {
        if($request->answer == NULL){
          Alert::error('Gagal', 'Jawaban Tidak Boleh Kosong');
          return redirect()->back();
        }else{
          $data = ClassExamCollectionAnswer::findOrFail($idqs);
          if($data->is_multiple_choice == TRUE){
            $choice = ClassExamChoice::where('id', $request->answer)->first();
            $data->update([
                'answer'    => $choice->choice,
                'is_true'   => $choice->is_answer
            ]);
          }else{
            $data->update([
                'answer'    => $request->answer
            ]);
          }
          $get=ClassExamCollectionAnswer::where(['meeting_exam_collection_id' => $idcol, 'answer' => NULL])->first();
          if($get != NULL){
            $is_any=1;
            Alert::success('Berhasil', 'Pertanyaan Berhasil Dijawab!');
            return redirect()->route('studentclassexamwork', array($id, $idc, $idcol, $get->id, $is_any));
          }else{
            $is_any=0;
            Alert::success('Berhasil', 'Semua Pertanyaan Sudah Dijawab, Silahkan Klik Tombol Selesai!');
            return redirect()->route('studentclassexamwork', array($id, $idc, $idcol, $idqs, $is_any));
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function finish(Request $request, $id, $idc, $idcol)
     {
        $score=0;
        $data = ClassExamCollection::findOrFail($idcol);
        $gets=ClassExamCollectionAnswer::where(['meeting_exam_collection_id' => $data->id, 'is_multiple_choice' => TRUE])->get();
        $count=ClassExamCollectionAnswer::where(['meeting_exam_collection_id' => $data->id, 'is_multiple_choice' => TRUE])->count();
        foreach ($gets as $get) {
          if($get->is_true == TRUE){
            $score=$score+1;
          }
        }
        $mcscore=$score/$count*100;
        $data->update([
            'multiple_choice_score'   => $mcscore,
            'is_finished'             => TRUE
        ]);
        Alert::success('Berhasil', 'Ujian Berhasil Dikerjakan, Silahkan Menunggu Penilaian Akhir!');
        return redirect()->route('studentclasshow', array($idc));
     }
}
