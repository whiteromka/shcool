<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class BusinessRequest
 *
 * @property int $id
 * @property string $company
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $telegram    // @rom_1989
 * @property string $city
 * @property string $industry
 * @property string $message
 * @property Carbon|null $deadline
 * @property string $budget
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class BusinessRequest extends Model
{
    protected $fillable = [
        'company',
        'name',
        'email',
        'phone',
        'telegram',
        'city',
        'industry',
        'message',
        'deadline',
        'budget'
    ];

    protected $table = 'business_requests';
}
