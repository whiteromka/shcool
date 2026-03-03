<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReviewController
 *
 * @property int $id
 * @property string $name
 * @property string $course
 * @property string $message
 */
class Review extends Model
{
    protected $fillable = [
        'name',
        'course',
        'message'
    ];

    protected $table = 'reviews';
}
