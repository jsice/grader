<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'admin_id', 'name', 'pdf_path', 'status'
    ];

    public function testsets() {
		return $this->hasMany('App\ProblemTestSet', 'problem_id');
	}

}
