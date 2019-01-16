<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemTestSet extends Model
{
    protected $fillable = [
        'problem_id', 'input_path', 'output_path'
    ];

    public function problem() {
		return $this->belongsTo('App\Problem', 'problem_id');
    }

}
