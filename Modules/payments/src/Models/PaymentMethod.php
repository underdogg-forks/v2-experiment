<?php

namespace Modules\Payments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @property int         $payment_method_id
 * @property string|null $payment_method_name
 */
class PaymentMethod extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payment_methods';

    protected $primaryKey = 'payment_method_id';

    protected $guarded = [];

    protected static function newFactory(): Factory
    {
        return \Modules\Payments\Database\Factories\PaymentMethodFactory::new();
    }
}
