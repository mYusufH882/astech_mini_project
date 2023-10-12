<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $id_type
 * @property int $id_category
 * @property int $amount
 * @property string $transaction_date
 * @property string $created_at
 * @property string $updated_at
 */
class Transaction extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transaction';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_type', 'id_category', 'amount', 'transaction_date', 'created_at', 'updated_at'];

    public function typeItem()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id');
    }

    public function categoryItem()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }

    public static function getTotal($type)
    {
        return Transaction::where('id_type', $type)->sum('amount');
    }
}
