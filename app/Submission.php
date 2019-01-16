<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id', 'problem_id', 'file_path', 'status'
    ];

    public function sender() {
		return $this->belongsTo('App\User', 'user_id');
    }
    
    public function problem() {
		return $this->belongsTo('App\Problem', 'problem_id');
	}
}
