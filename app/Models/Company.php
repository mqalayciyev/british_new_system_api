<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use SoftDeletes, Notifiable;
    protected $table = 'companies';
    protected $guarded = [];
    protected $hidden = array('password');

    public function manager(){
        return $this->hasOne('App\Models\Manager');
    }
    public function teacher(){
        return $this->hasOne('App\Models\Teacher');
    }
    public function academicHours(){
        return $this->hasOne('App\Models\AcademicHours');
    }
    public function ageCategory(){
        return $this->hasOne('App\Models\AgeCategory');
    }
    public function announcement(){
        return $this->hasOne('App\Models\Announcement');
    }
    public function assignee(){
        return $this->hasOne('App\Models\Assignee');
    }
    public function attendanceMap(){
        return $this->hasOne('App\Models\AttendanceMap');
    }
    public function audio(){
        return $this->hasOne('App\Models\Audio');
    }
    public function book(){
        return $this->hasOne('App\Models\Media');
    }
    public function corparateClient(){
        return $this->hasOne('App\Models\CorparateClient');
    }
    public function demoLesson(){
        return $this->hasOne('App\Models\DemoLesson');
    }
    public function evaluation(){
        return $this->hasOne('App\Models\Evaluation');
    }
    public function exam(){
        return $this->hasOne('App\Models\Exam');
    }
    public function examResult(){
        return $this->hasOne('App\Models\ExamResult');
    }
    public function examType(){
        return $this->hasOne('App\Models\ExamType');
    }
    public function groupLesson(){
        return $this->hasOne('App\Models\GroupLesson');
    }
    public function image(){
        return $this->hasOne('App\Models\Image');
    }
    public function learningType(){
        return $this->hasOne('App\Models\LearningType');
    }
    public function lesson(){
        return $this->hasOne('App\Models\Lesson');
    }
    public function level(){
        return $this->hasOne('App\Models\Level');
    }
    public function messages(){
        return $this->hasOne('App\Models\Messages');
    }
    public function notification(){
        return $this->hasOne('App\Models\Notification');
    }
    public function office(){
        return $this->hasOne('App\Models\Office');
    }
    public function payment(){
        return $this->hasOne('App\Models\Payment');
    }
    public function permission(){
        return $this->hasOne('App\Models\Permission');
    }
    public function privateLesson(){
        return $this->hasOne('App\Models\PrivateLesson');
    }
    public function scheduling(){
        return $this->hasOne('App\Models\Scheduling');
    }
    public function student(){
        return $this->hasOne('App\Models\Student');
    }
    public function tasks(){
        return $this->hasOne('App\Models\Tasks');
    }
    public function teacherLesson(){
        return $this->hasOne('App\Models\TeacherLesson');
    }
    public function teacherPayment(){
        return $this->hasOne('App\Models\TeacherPayment');
    }
    public function test(){
        return $this->hasOne('App\Models\Test');
    }
    public function user(){
        return $this->hasOne('App\Models\User');
    }
    public function video(){
        return $this->hasOne('App\Models\Video');
    }
}
