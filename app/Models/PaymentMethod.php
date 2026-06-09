<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod.
 *
 * @property int         $payment_method_id
 * @property string|null $payment_method_name
 */
class PaymentMethod extends Model
{
    public $timestamps = false;

    protected $table = 'payment_methods';

    protected $primaryKey = 'payment_method_id';

    protected $fillable = [
        'payment_method_name',
    ];
}
