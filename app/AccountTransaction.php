<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AccountTransaction
 *
 * @property int $id
 * @property int $account_id
 * @property string $type
 * @property string|null $sub_type
 * @property string $amount
 * @property string|null $reff_no
 * @property \Illuminate\Support\Carbon $operation_date
 * @property int $created_by
 * @property int|null $transaction_id
 * @property int|null $transaction_payment_id
 * @property int|null $transfer_transaction_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Transaction|null $transaction
 * @property-read AccountTransaction|null $transfer_transaction
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereReffNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereTransactionPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereTransferTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountTransaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountTransaction withoutTrashed()
 * @mixin \Eloquent
 */
class AccountTransaction extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'operation_date',
        'created_at',
        'updated_at'
    ];

    public function media()
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transaction_id');
    }

    /**
     * Gives account transaction type from payment transaction type
     * @param  string $payment_transaction_type
     * @return string
     */
    public static function getAccountTransactionType($tansaction_type)
    {
        $account_transaction_types = [
            'sell' => 'credit',
            'purchase' => 'debit',
            'expense' => 'debit',
            'purchase_return' => 'credit',
            'sell_return' => 'debit',
            'payroll' => 'debit',
            'expense_refund' => 'credit'
        ];

        return $account_transaction_types[$tansaction_type];
    }

    /**
     * Creates new account transaction
     * @return obj
     */
    public static function createAccountTransaction($data)
    {
        $transaction_data = [
            'amount' => $data['amount'],
            'account_id' => $data['account_id'],
            'type' => $data['type'],
            'sub_type' => !empty($data['sub_type']) ? $data['sub_type'] : null,
            'operation_date' => !empty($data['operation_date']) ? $data['operation_date'] : \Carbon::now(),
            'created_by' => $data['created_by'],
            'transaction_id' => !empty($data['transaction_id']) ? $data['transaction_id'] : null,
            'transaction_payment_id' => !empty($data['transaction_payment_id']) ? $data['transaction_payment_id'] : null,
            'note' => !empty($data['note']) ? $data['note'] : null,
            'transfer_transaction_id' => !empty($data['transfer_transaction_id']) ? $data['transfer_transaction_id'] : null,
        ];

        $account_transaction = AccountTransaction::create($transaction_data);

        return $account_transaction;
    }

    /**
     * Updates transaction payment from transaction payment
     * @param  obj $transaction_payment
     * @param  array $inputs
     * @param  string $transaction_type
     * @return string
     */
    public static function updateAccountTransaction($transaction_payment, $transaction_type)
    {
        if (!empty($transaction_payment->account_id)) {
            $account_transaction = AccountTransaction::where(
                'transaction_payment_id',
                $transaction_payment->id
            )
                    ->first();
            if (!empty($account_transaction)) {
                $account_transaction->amount = $transaction_payment->amount;
                $account_transaction->account_id = $transaction_payment->account_id;
                $account_transaction->operation_date = $transaction_payment->paid_on;
                $account_transaction->save();
                return $account_transaction;
            } else {
                $accnt_trans_data = [
                    'amount' => $transaction_payment->amount,
                    'account_id' => $transaction_payment->account_id,
                    'type' => self::getAccountTransactionType($transaction_type),
                    'operation_date' => $transaction_payment->paid_on,
                    'created_by' => $transaction_payment->created_by,
                    'transaction_id' => $transaction_payment->transaction_id,
                    'transaction_payment_id' => $transaction_payment->id
                ];

                //If change return then set type as debit
                if ($transaction_payment->transaction->type == 'sell' && $transaction_payment->is_return == 1) {
                    $accnt_trans_data['type'] = 'debit';
                }

                self::createAccountTransaction($accnt_trans_data);
            }
        }
    }

    public function transfer_transaction()
    {
        return $this->belongsTo(\App\AccountTransaction::class, 'transfer_transaction_id');
    }

    public function account()
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }
}
