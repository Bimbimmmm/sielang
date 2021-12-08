<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassQuiz;
use App\Models\ClassQuizQuestion;
use App\Models\ClassQuizChoice;
use App\Models\ClassQuizCollection;
use App\Models\ClassQuizCollectionAnswer;
use Validator;
use Alert;

class StudentClassQuizController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id, $idc)
     {
       $check=ClassQuiz::where(['id' => $id, 'is_active' => TRUE])->count();
       if($check > 0){
         $user_id = auth()->user()->id;
         $data=ClassQuiz::where('id', $id)->first();
         $collection=ClassQuizCollection::where(['user_id' => $user_id, 'meeting_quiz_id' => $id])->first();
         return view('student/class/quiz/show', compact('id', 'idc', 'data', 'collection'));
       }else{
         Alert::error('Gagal', 'Kuis Sudah Tidak Aktif!');
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
         $check=ClassQuizCollection::where(['meeting_quiz_id' => $id, 'user_id' => $user_id, 'is_deleted' => FALSE])->count();
         if($check > 0){
           Alert::error('Gagal', 'Kuis Sudah Dikerjakan!');
           return redirect()->back();
         }else{
           $data = new ClassQuizCollection;
           $data->meeting_quiz_id = $id;
           $data->user_id = $user_id;
           $data->is_finished = FALSE;
           $data->is_scored = FALSE;
           $data->is_deleted = FALSE;
           $save = $data->save();

           $get=ClassQuizCollection::where(['meeting_quiz_id' => $id, 'user_id' => $user_id])->first();
           $questions=ClassQuizQuestion::where(['meeting_quiz_id' => $id, 'is_deleted' =>FALSE])->get();

           foreach($questions as $question){
             $data1 = new ClassQuizCollectionAnswer;
             $data1->meeting_quiz_collection_id = $get->id;
             $data1->meeting_quiz_question_id = $question->id;
             $data1->is_multiple_choice = $question->is_multiple_choice;
             $data1->is_true = FALSE;
             $save1 = $data1->save();
           }

           $getqs=ClassQuizCollectionAnswer::where('meeting_quiz_collection_id', $get->id)->first();

           if($save1){
             Alert::success('Berhasil', 'Session Berhasil Dibuat, Silahkan Mengerjakan Kuis!');
             return redirect()->route('studentclassquizwork', array($id, $idc, $get->id, $getqs->id));
           } else {
             Alert::error('Gagal', 'Gagal Membuat Session');
             return redirect()->back();
           }
         }
      }

    public function work($id, $idc, $idcol, $idqs)
    {
        $user_id = auth()->user()->id;
        $data=ClassQuizCollection::where(['meeting_quiz_id' => $id, 'user_id' => $user_id, 'is_deleted' => FALSE])->first();
        $check=ClassQuiz::where('id', $id)->first();
        $working_second=$check->working_time*60;
        $time = strtotime($data->created_at) + $working_second;
        $work_time=date('M j, Y H:i:s', $time);

        $questions=ClassQuizCollectionAnswer::where('meeting_quiz_collection_id', $idcol)->get();
        $ques=ClassQuizCollectionAnswer::where('id', $idqs)->first();
        $choices=ClassQuizChoice::where('meeting_quiz_question_id', $ques->meeting_quiz_question_id)->get();
        return view('student/class/quiz/work', compact('id', 'idc', 'idcol', 'data', 'work_time', 'check', 'questions', 'ques', 'choices'));
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
          $choice = ClassQuizChoice::where('id', $request->answer)->first();
          $data = ClassQuizCollectionAnswer::findOrFail($idqs);
          if($data->is_multiple_choice == TRUE){
            $data->update([
                'answer'    => $choice->choice,
                'is_true'   => $choice->is_answer
            ]);
          }else{
            $data->update([
                'answer'    => $choice->choice
            ]);
          }
          $get=ClassQuizCollectionAnswer::where('answer', NULL)->first();
          if($get != NULL){
            Alert::success('Berhasil', 'Pertanyaan Berhasil Dijawab!');
            return redirect()->route('studentclassquizwork', array($id, $idc, $idcol, $get->id));
          }else{
            Alert::success('Berhasil', 'Semua Pertanyaan Sudah Dijawab, Silahkan Klik Tombol Selesai!');
            return redirect()->back();
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
        $data = ClassQuizCollection::findOrFail($idcol);
        $gets=ClassQuizCollectionAnswer::where('meeting_quiz_collection_id', $data->id)->get();
        $count=ClassQuizCollectionAnswer::where('meeting_quiz_collection_id', $data->id)->count();
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
        Alert::success('Berhasil', 'Kuis Berhasil Dikerjakan, Silahkan Menunggu Penilaian Akhir!');
        return redirect()->route('studentclassquizshow', array($id, $idc));
     }
}
