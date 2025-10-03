<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    // Custom primary key
    protected $primaryKey = 'task_id';

    // If task_id is auto-incrementing (integer), leave this as true
    public $incrementing = true;

    // If task_id is NOT integer (e.g., string/uuid), you must set:
    // public $keyType = 'string';
}
