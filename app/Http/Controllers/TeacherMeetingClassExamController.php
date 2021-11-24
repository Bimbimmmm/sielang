<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\ClassExam;
use App\Models\ClassExamQuestion;
use App\Models\ClassExamChoice;
use Validator;
use Alert;

class TeacherMeetingClassExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $check=TeachingHour::where('id', $id)->count();
      if($check > 0){
        return view('teacher/teaching/exam/create', compact('id'));
      }else{
        Alert::error('Gagal', 'Data Tidak Ditemukan!');
        return redirect()->route('teacherteachingindex');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $rules = [
          'name'               => 'required',
          'start_date'         => 'required',
          'expired_date'       => 'required',
          'file.*'             => 'mimes:png,jpg,pdf|max:2048'
      ];

      $messages = [
          'name.required'               => 'Nama Wajib Diisi',
          'start_date.required'         => 'Tanggal Mulai Ujian Wajib Diisi',
          'expired_date.required'       => 'Tanggal Expired Ujian Wajib Diisi',
          'file.mimes'                  => 'File Kisi-Kisi wajib berekstensi .png atau .jpg atau .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $start_date = date("Y-m-d", strtotime($request->start_date));
      $expired_date = date("Y-m-d", strtotime($request->expired_date));

      if($request->file != null){
        $original_name = $request->file->getClientOriginalName();
        $file = 'file_lampiran_ujian' . time() . '_' . $original_name;
        $request->file->move(public_path('storage/exam'), $file);
      }else{
        $file = null;
      }

      $data = new ClassExam;
      $data->name = $request->name;
      $data->teaching_hour_id = $id;
      $data->start_date = $start_date;
      $data->expired_date = $expired_date;
      $data->file = $file;
      $data->is_locked = FALSE;
      $data->is_active = FALSE;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Ujian Berhasil Dibuat');
          return redirect()->route('teacherteachingshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Membuat Ujian! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('teachertaskcreate', $id);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idt)
    {
      $data=ClassExam::where('id', $id)->first();
      $questions=ClassExamQuestion::where(['meeting_exam_id' => $id, 'is_deleted' => FALSE])->get();
      return view('teacher/teaching/exam/show', compact('data', 'id', 'idt', 'questions'));
    }

    public function createquestion($id, $idt)
    {
      return view('teacher/teaching/exam/question/create', compact('id', 'idt'));
    }

    public function storequestion(Request $request, $id, $idt)
    {
      $rules = [
        'question'            => 'required',
        'is_multiple_choice'  => 'required',
        'file.*'              => 'mimes:png,jpg|max:2048',
        'file_answer_option_1.*'    => 'mimes:png,jpg|max:2048',
        'file_answer_option_2.*'    => 'mimes:png,jpg|max:2048',
        'file_answer_option_3.*'    => 'mimes:png,jpg|max:2048',
        'file_answer_option_4.*'    => 'mimes:png,jpg|max:2048',
        'file_answer_option_5.*'    => 'mimes:png,jpg|max:2048'
      ];

      $messages = [
        'question.required'           => 'Pertanyaan Wajib Diisi',
        'is_multiple_choice.required' => 'Jenis Pertanyaan Wajib Dipilih',
        'start_date.required'         => 'Tanggal Mulai Tugas Wajib Diisi',
        'expired_date.required'       => 'Tanggal Expired Tugas Wajib Diisi',
        'file.mimes'                  => 'File Tugas wajib berekstensi .png atau .jpg dan maksimal 2mb',
        'file_answer_option_1.mimes'      => 'File Lampiran Jawaban 1 wajib berekstensi .png atau .jpg dan maksimal 2mb',
        'file_answer_option_2.mimes'      => 'File Lampiran Jawaban 2 wajib berekstensi .png atau .jpg dan maksimal 2mb',
        'file_answer_option_3.mimes'      => 'File Lampiran Jawaban 3 wajib berekstensi .png atau .jpg dan maksimal 2mb',
        'file_answer_option_4.mimes'      => 'File Lampiran Jawaban 4 wajib berekstensi .png atau .jpg dan maksimal 2mb',
        'file_answer_option_5.mimes'      => 'File Lampiran Jawaban 5 wajib berekstensi .png atau .jpg dan maksimal 2mb'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }
      $check_checkbox=0;
      //Check is key answer just one
      if($request->checkbox_answer_option_1 != NULL){
        $check_checkbox=$check_checkbox+1;
      }else if($request->checkbox_answer_option_2 != NULL){
        $check_checkbox=$check_checkbox+1;
      }else if($request->checkbox_answer_option_3 != NULL){
        $check_checkbox=$check_checkbox+1;
      }else if($request->checkbox_answer_option_4 != NULL){
        $check_checkbox=$check_checkbox+1;
      }else if($request->checkbox_answer_option_5 != NULL){
        $check_checkbox=$check_checkbox+1;
      }

      if($check_checkbox > 1){
        Alert::error('Gagal', 'Pilihan Kunci Jawaban Hanya Boleh Satu!');
        return redirect()->back();
      }else{

        if($request->file != null){
          $original_name = $request->file->getClientOriginalName();
          $file = 'file_lampiran_soal' . time() . '_' . $original_name;
          $request->file->move(public_path('storage/exam/question'), $file);
        }else{
          $file = null;
        }

        if($request->file_answer_option_1 != null){
          $original_name = $request->file_answer_option_1->getClientOriginalName();
          $file_answer_option_1 = 'file_lampiran_pilihan_ganda_nomor_1' . time() . '_' . $original_name;
          $request->file_answer_option_1->move(public_path('storage/exam/choice'), $file_answer_option_1);
        }else{
          $file_answer_option_1 = null;
        }

        if($request->file_answer_option_2 != null){
          $original_name = $request->file_answer_option_2->getClientOriginalName();
          $file_answer_option_2 = 'file_lampiran_pilihan_ganda_nomor_2' . time() . '_' . $original_name;
          $request->file_answer_option_2->move(public_path('storage/exam/choice'), $file_answer_option_2);
        }else{
          $file_answer_option_2 = null;
        }

        if($request->file_answer_option_3 != null){
          $original_name = $request->file_answer_option_3->getClientOriginalName();
          $file_answer_option_3 = 'file_lampiran_pilihan_ganda_nomor_2' . time() . '_' . $original_name;
          $request->file_answer_option_3->move(public_path('storage/exam/choice'), $file_answer_option_3);
        }else{
          $file_answer_option_3 = null;
        }

        if($request->file_answer_option_4 != null){
          $original_name = $request->file_answer_option_4->getClientOriginalName();
          $file_answer_option_4 = 'file_lampiran_pilihan_ganda_nomor_4' . time() . '_' . $original_name;
          $request->file_answer_option_4->move(public_path('storage/exam/choice'), $file_answer_option_4);
        }else{
          $file_answer_option_4 = null;
        }

        if($request->file_answer_option_5 != null){
          $original_name = $request->file_answer_option_5->getClientOriginalName();
          $file_answer_option_5 = 'file_lampiran_pilihan_ganda_nomor_5' . time() . '_' . $original_name;
          $request->file_answer_option_5->move(public_path('storage/exam/choice'), $file_answer_option_5);
        }else{
          $file_answer_option_5 = null;
        }

        $data = new ClassExamQuestion;
        $data->meeting_exam_id = $id;
        $data->question = $request->question;
        $data->question_file = $file;
        $data->is_multiple_choice = $request->is_multiple_choice;
        $data->is_deleted = FALSE;
        $save = $data->save();

        $get=ClassExamQuestion::where(['meeting_exam_id' => $id, 'question' => $request->question])->first();

        if($request->is_multiple_choice == TRUE){

          $data1 = new ClassExamChoice;
          $data1->meeting_exam_question_id = $get->id;
          $data1->choice = $request->answer_option_1;
          $data1->file = $file_answer_option_1;
          if($request->checkbox_answer_option_1 == "on"){
            $data1->is_answer = TRUE;
          }else{
            $data1->is_answer = FALSE;
          }
          $save1 = $data1->save();

          $data2 = new ClassExamChoice;
          $data2->meeting_exam_question_id = $get->id;
          $data2->choice = $request->answer_option_2;
          $data1->file = $file_answer_option_2;
          if($request->checkbox_answer_option_2 == "on"){
            $data2->is_answer = TRUE;
          }else{
            $data2->is_answer = FALSE;
          }
          $save2 = $data2->save();

          $data3 = new ClassExamChoice;
          $data3->meeting_exam_question_id = $get->id;
          $data3->choice = $request->answer_option_3;
          $data1->file = $file_answer_option_3;
          if($request->checkbox_answer_option_3 == "on"){
            $data3->is_answer = TRUE;
          }else{
            $data3->is_answer = FALSE;
          }
          $save3 = $data3->save();

          $data4 = new ClassExamChoice;
          $data4->meeting_exam_question_id = $get->id;
          $data4->choice = $request->answer_option_4;
          $data1->file = $file_answer_option_4;
          if($request->checkbox_answer_option_4 == "on"){
            $data4->is_answer = TRUE;
          }else{
            $data4->is_answer = FALSE;
          }
          $save4 = $data4->save();

          $data5 = new ClassExamChoice;
          $data5->meeting_exam_question_id = $get->id;
          $data5->choice = $request->answer_option_5;
          $data1->file = $file_answer_option_5;
          if($request->checkbox_answer_option_5 == "on"){
            $data5->is_answer = TRUE;
          }else{
            $data5->is_answer = FALSE;
          }
          $save5 = $data5->save();

          if($save5){
            Alert::success('Berhasil', 'Pertanyaan Berhasil Dibuat');
            return redirect()->route('teacherexamshow', array($id, $idt));
          } else {
            Alert::error('Gagal', 'Gagal Membuat Pertanyaan! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
          }
        }else{
          if($save){
            Alert::success('Berhasil', 'Pertanyaan Berhasil Dibuat');
            return redirect()->route('teacherexamshow', array($id, $idt));
          } else {
            Alert::error('Gagal', 'Gagal Membuat Pertanyaan! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
          }
        }
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showquestion($id, $idq, $idt)
     {
       $question=ClassExamQuestion::where('id', $id)->first();
       $datas=ClassExamChoice::where('meeting_exam_question_id', $question->id)->get();
       return view('teacher/teaching/exam/question/show', compact('idq', 'idt', 'question', 'datas'));
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
     {
       $data = ClassExamQuestion::findOrFail($id);
       $data->update([
             'is_deleted'   => TRUE
         ]);
       Alert::success('Berhasil', 'Pertanyaan Berhasil Dihapus');
       return redirect()->back();
     }
}
