<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\TransactionPaymentDeleted;
use App\Events\TransactionPaymentUpdated;
use App\Utils\CashRegisterUtil;

/**
 * App\TransactionPayment
 *
 * @property int $id
 * @property int|null $transaction_id
 * @property int|null $business_id
 * @property int $is_return Used during sales to return the change
 * @property string $amount
 * @property string|null $method
 * @property string|null $payment_type
 * @property string|null $transaction_no
 * @property string|null $card_transaction_number
 * @property string|null $card_number
 * @property string|null $card_type
 * @property string|null $card_holder_name
 * @property string|null $card_month
 * @property string|null $card_year
 * @property string|null $card_security
 * @property string|null $cheque_number
 * @property string|null $bank_account_number
 * @property string|null $paid_on
 * @property int|null $created_by
 * @property int $paid_through_link
 * @property string|null $gateway
 * @property int $is_advance
 * @property int|null $payment_for
 * @property int|null $parent_id
 * @property string|null $note
 * @property string|null $document
 * @property string|null $payment_ref_no
 * @property int|null $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|TransactionPayment[] $child_payments
 * @property-read int|null $child_payments_count
 * @property-read \App\User|null $created_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CashDenomination[] $denominations
 * @property-read int|null $denominations_count
 * @property-read mixed $document_name
 * @property-read mixed $document_path
 * @property-read \App\Account|null $payment_account
 * @property-read \App\Transaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardHolderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardSecurity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardTransactionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCardYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereChequeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereIsAdvance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereIsReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment wherePaidOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment wherePaidThroughLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment wherePaymentFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment wherePaymentRefNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereTransactionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TransactionPayment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the phone record associated with the user.
     */
    public function payment_account()
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }

    /**
     * Get the transaction related to this payment.
     */
    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transaction_id');
    }

    /**
     * Get the user.
     */
    public function created_user()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    /**
     * Get child payments
     */
    public function child_payments()
    {
        return $this->hasMany(\App\TransactionPayment::class, 'parent_id');
    }

    /**
     * Retrieves documents path if exists
     */
    public function getDocumentPathAttribute()
    {
        $path = !empty($this->document) ? asset('/uploads/documents/' . $this->document) : null;
        
        return $path;
    }

    /**
     * Removes timestamp from document name
     */
    public function getDocumentNameAttribute()
    {
        $document_name = !empty(explode("_", $this->document, 2)[1]) ? explode("_", $this->document, 2)[1] : $this->document ;
        return $document_name;
    }

    public static function deletePayment($payment)
    {
        //Update parent payment if exists
        if (!empty($payment->parent_id)) {
            $parent_payment = TransactionPayment::find($payment->parent_id);
            $parent_payment->amount -= $payment->amount;

            if ($parent_payment->amount <= 0) {
                $parent_payment->delete();
                event(new TransactionPaymentDeleted($parent_payment));
            } else {
                $parent_payment->save();
                //Add event to update parent payment account transaction
                event(new TransactionPaymentUpdated($parent_payment, null));
            }
        }

        $payment->delete();

        $transactionUtil = new \App\Utils\TransactionUtil(new CashRegisterUtil());

        if(!empty($payment->transaction_id)) {
            //update payment status
            $transaction = $payment->load('transaction')->transaction;
            $transaction_before = $transaction->replicate();

            $payment_status = $transactionUtil->updatePaymentStatus($payment->transaction_id);

            $transaction->payment_status = $payment_status;
            
            $transactionUtil->activityLog($transaction, 'payment_edited', $transaction_before);
        }

        $log_properities = [
            'id' => $payment->id,
            'ref_no' => $payment->payment_ref_no
        ];
        $transactionUtil->activityLog($payment, 'payment_deleted', null, $log_properities);

        //Add event to delete account transaction
        event(new TransactionPaymentDeleted($payment));
        
    }

    public function denominations()
    {
        return $this->morphMany(\App\CashDenomination::class, 'model');
    }
}
