<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'activity', 'model', 'description'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public static function logActivity(string $activity)
    {

        $filename = storage_path('logs/activity.txt');
        $file = fopen($filename, "a+");
        if ($file) {
            if (is_writable($filename)) {
                fwrite($file, $activity);
            } else {
                throw new Exception("$filename is not writable!");
            }
        } else {
            throw new Exception("$file is not open for action!");
        }
    }
}
