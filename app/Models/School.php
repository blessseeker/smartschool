<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createNewSchoolID($left_id)
    {
        $latest_right_id = DB::select("select MAX(RIGHT(id,3)) as max_id from schools where LEFT(id, 7) = '".$left_id."'");
        $new_right_id = "";
        if(count($latest_right_id)>0) {
            $int_new_right_id = ((int)$latest_right_id[0]->max_id)+1;
            $new_right_id = sprintf("%03s", $int_new_right_id);
        } else {
            $new_right_id = "001";
        }   
        return $left_id."".$new_right_id;
    }

    public function user()
    {
        return $this->hasMany(User::class, 'school_id');
    }
}
