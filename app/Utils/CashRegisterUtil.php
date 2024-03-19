<?php

namespace App\Utils;

use App\CashRegister;
use App\CashRegisterTransaction;
use App\Transaction;

use DB;
use Illuminate\Support\Facades\Log;

class CashRegisterUtil extends Util
{
    /**
     * Returns number of opened Cash Registers for the
     * current logged in user
     *
     * @return int
     */
    public function countOpenedRegister()
    {
        $user_id = auth()->user()->id;
        $count =  CashRegister::where('user_id', $user_id)
                                ->where('status', 'open')
                                ->count();
        return $count;
    }

    /**
     * Adds sell payments to currently opened cash register
     *
     * @param object/int $transaction
     * @param array $payments
     *
     * @return boolean
     */
    public function addSellPayments($transaction, $payments)
    {
        $user_id = auth()->user()->id;
        $register =  CashRegister::where('user_id', $user_id)
                                ->where('status', 'open')
                                ->first();
        $payments_formatted = [];
        foreach ($payments as $payment) {
            $payment_amount = (isset($payment['is_return']) && $payment['is_return'] == 1) ? (-1*$this->num_uf($payment['amount'])) : $this->num_uf($payment['amount']);
            if ($payment_amount != 0) {
                $type = 'credit';
                if ($transaction->type == 'expense') {
                    $type = 'debit';
                }

                $payments_formatted[] = new CashRegisterTransaction([
                    'amount' => $payment_amount,
                    'pay_method' => $payment['method'],
                    'type' => $type,
                    'transaction_type' => $transaction->type,
                    'transaction_id' => $transaction->id
                ]);
            }
        }

        if (!empty($payments_formatted)) {
            $register->cash_register_transactions()->saveMany($payments_formatted);
        }

        return true;
    }

    /**
     * Add a transaction on the cash register of tye recebimento_fiado
     */
    public function addFiadoPaymentToCashRegister($transaction_payment)
    {
        $user_id = auth()->user()->id;
        
        $register = CashRegister::where('user_id', $user_id)
            ->where('status', 'open')
        ->first();

        $register->cash_register_transactions()->save(new CashRegisterTransaction([
            'amount' => $transaction_payment->amount,
            'pay_method' => $transaction_payment->method,
            'type' => 'credit',
            'transaction_type' => 'receipt_on_credit',
            'transaction_payment_id' => $transaction_payment->id
        ]));

        return true;
    }

    /**
     * Make a delete of a payment transaction from the cash register.
     * It will make the delete only if $transaction_payment_id is different of
     * 0 and null.
     */
    public function deleteFiadoPaymentFromCashRegister($transaction_payment_id)
    {
        if (!empty($transaction_payment_id)) {
            CashRegisterTransaction::where('transaction_payment_id', $transaction_payment_id)->delete();
        }
    }

    /**
     * Adds sell payments to currently opened cash register
     *
     * @param object/int $transaction
     * @param array $payments
     *
     * @return boolean
     */
    public function updateSellPayments($status_before, $transaction, $payments)
    {
        $user_id = auth()->user()->id;
        $register =  CashRegister::where('user_id', $user_id)
            ->where('status', 'open')
        ->first();

        //If draft -> final then add all
        //If final -> draft then refund all
        //If final -> final then update payments
        if ($status_before == 'draft' && $transaction->status == 'final') {
            
            $this->addSellPayments($transaction, $payments);

        } elseif ($status_before == 'final' && $transaction->status == 'draft') {
            
            $this->refundSell($transaction);
            
        } elseif ($status_before == 'final' && $transaction->status == 'final') {
            
            CashRegisterTransaction::where('transaction_id', $transaction->id)
                ->where('cash_register_id', $register->id)
            ->delete();

            $payments_formatted = [];

            foreach ($payments as $payment) {
                $payments_formatted[] = new CashRegisterTransaction([
                    'amount' => $payment['amount'],
                    'pay_method' => $payment['method'],
                    'type' => 'credit',
                    'transaction_type' => 'sell',
                    'transaction_id' => $transaction->id
                ]);
            }

            if (!empty($payments_formatted)) {
                $register->cash_register_transactions()->saveMany($payments_formatted);
            }
        }

        return true;
    }

    /**
     * Refunds all payments of a sell
     *
     * @param object/int $transaction
     *
     * @return boolean
     */
    public function refundSell($transaction)
    {
        $user_id = auth()->user()->id;
        $register =  CashRegister::where('user_id', $user_id)
                                ->where('status', 'open')
                                ->first();

        $total_payment = CashRegisterTransaction::where('transaction_id', $transaction->id)
                            ->select(
                                DB::raw("SUM(IF(pay_method='cash', IF(type='credit', amount, -1 * amount), 0)) as total_cash"),
                                DB::raw("SUM(IF(pay_method='card', IF(type='credit', amount, -1 * amount), 0)) as total_card"),
                                DB::raw("SUM(IF(pay_method='cheque', IF(type='credit', amount, -1 * amount), 0)) as total_cheque"),
                                DB::raw("SUM(IF(pay_method='bank_transfer', IF(type='credit', amount, -1 * amount), 0)) as total_bank_transfer"),
                                DB::raw("SUM(IF(pay_method='other', IF(type='credit', amount, -1 * amount), 0)) as total_other"),
                                DB::raw("SUM(IF(pay_method='custom_pay_1', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_1"),
                                DB::raw("SUM(IF(pay_method='custom_pay_2', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_2"),
                                DB::raw("SUM(IF(pay_method='custom_pay_3', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_3"),
                                DB::raw("SUM(IF(pay_method='custom_pay_4', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_4"),
                                DB::raw("SUM(IF(pay_method='custom_pay_5', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_5"),
                                DB::raw("SUM(IF(pay_method='custom_pay_6', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_6"),
                                DB::raw("SUM(IF(pay_method='custom_pay_7', IF(type='credit', amount, -1 * amount), 0)) as total_custom_pay_7")
                            )->first();
        $refunds = [
                    'cash' => $total_payment->total_cash,
                    'card' => $total_payment->total_card,
                    'cheque' => $total_payment->total_cheque,
                    'bank_transfer' => $total_payment->total_bank_transfer,
                    'other' => $total_payment->total_other,
                    'custom_pay_1' => $total_payment->total_custom_pay_1,
                    'custom_pay_2' => $total_payment->total_custom_pay_2,
                    'custom_pay_3' => $total_payment->total_custom_pay_3,
                    'custom_pay_4' => $total_payment->total_custom_pay_4,
                    'custom_pay_5' => $total_payment->total_custom_pay_5,
                    'custom_pay_6' => $total_payment->total_custom_pay_6,
                    'custom_pay_7' => $total_payment->total_custom_pay_7
                ];
        $refund_formatted = [];
        foreach ($refunds as $key => $val) {
            if ($val > 0) {
                $refund_formatted[] = new CashRegisterTransaction([
                    'amount' => $val,
                    'pay_method' => $key,
                    'type' => 'debit',
                    'transaction_type' => 'refund',
                    'transaction_id' => $transaction->id
                ]);
            }
        }

        if (!empty($refund_formatted)) {
            $register->cash_register_transactions()->saveMany($refund_formatted);
        }
        return true;
    }

    /**
     * Retrieves details of given rigister id else currently opened register
     *
     * @param $register_id default null
     *
     * @return object
     */
    public function getRegisterDetails($register_id = null)
    {
        $query = CashRegister::leftjoin(
            'cash_register_transactions as ct',
            'ct.cash_register_id',
            '=',
            'cash_registers.id'
        )
        ->join(
            'users as u',
            'u.id',
            '=',
            'cash_registers.user_id'
        )
        ->leftJoin(
            'business_locations as bl',
            'bl.id',
            '=',
            'cash_registers.location_id'
        );
        if (empty($register_id)) {
            $user_id = auth()->user()->id;
            $query->where('user_id', $user_id)
                ->where('cash_registers.status', 'open');
        } else {
            $query->where('cash_registers.id', $register_id);
        }
                              
        $register_details = $query->select(
            'cash_registers.created_at as open_time',
            'cash_registers.closed_at as closed_at',
            'cash_registers.user_id',
            'cash_registers.closing_note',
            'cash_registers.location_id',
            'cash_registers.denominations',
            DB::raw("SUM(IF(transaction_type='initial', amount, 0)) as cash_in_hand"),

            DB::raw("SUM(IF(transaction_type='receipt_on_credit', amount, 0)) as total_receipt_on_credit"),

            DB::raw("SUM(IF(pay_method='cash',          IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_cash_receipt_on_credit"),
            DB::raw("SUM(IF(pay_method='card',          IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_card_receipt_on_credit"),
            DB::raw("SUM(IF(pay_method='cheque',        IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_cheque_receipt_on_credit"),
            DB::raw("SUM(IF(pay_method='bank_transfer', IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_bank_transfer_receipt_on_credit"),
            DB::raw("SUM(IF(pay_method='other',         IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_credit"),
            DB::raw("SUM(IF(pay_method='custom_pay_1',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_1"),
            DB::raw("SUM(IF(pay_method='custom_pay_2',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_2"),
            DB::raw("SUM(IF(pay_method='custom_pay_3',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_3"),
            DB::raw("SUM(IF(pay_method='custom_pay_4',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_4"),
            DB::raw("SUM(IF(pay_method='custom_pay_5',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_5"),
            DB::raw("SUM(IF(pay_method='custom_pay_6',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_6"),
            DB::raw("SUM(IF(pay_method='custom_pay_7',  IF(transaction_type='receipt_on_credit', amount, 0), 0)) as total_other_receipt_on_custom_pay_7"),

            DB::raw("SUM(IF(transaction_type='sell', amount, IF(transaction_type='refund', -1 * amount, 0))) as total_sale"),
            DB::raw("SUM(IF(transaction_type='expense', IF(transaction_type='refund', -1 * amount, amount), 0)) as total_expense"),
            DB::raw("SUM(IF(pay_method='cash', IF(transaction_type='sell', amount, 0), 0)) as total_cash"),
            DB::raw("SUM(IF(pay_method='cash', IF(transaction_type='expense', amount, 0), 0)) as total_cash_expense"),
            DB::raw("SUM(IF(pay_method='cheque', IF(transaction_type='sell', amount, 0), 0)) as total_cheque"),
            DB::raw("SUM(IF(pay_method='cheque', IF(transaction_type='expense', amount, 0), 0)) as total_cheque_expense"),
            DB::raw("SUM(IF(pay_method='card', IF(transaction_type='sell', amount, 0), 0)) as total_card"),
            DB::raw("SUM(IF(pay_method='card', IF(transaction_type='expense', amount, 0), 0)) as total_card_expense"),
            DB::raw("SUM(IF(pay_method='bank_transfer', IF(transaction_type='sell', amount, 0), 0)) as total_bank_transfer"),
            DB::raw("SUM(IF(pay_method='bank_transfer', IF(transaction_type='expense', amount, 0), 0)) as total_bank_transfer_expense"),
            DB::raw("SUM(IF(pay_method='other', IF(transaction_type='sell', amount, 0), 0)) as total_other"),
            DB::raw("SUM(IF(pay_method='other', IF(transaction_type='expense', amount, 0), 0)) as total_other_expense"),
            DB::raw("SUM(IF(pay_method='advance', IF(transaction_type='sell', amount, 0), 0)) as total_advance"),
            DB::raw("SUM(IF(pay_method='advance', IF(transaction_type='expense', amount, 0), 0)) as total_advance_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_1', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_1"),
            DB::raw("SUM(IF(pay_method='custom_pay_2', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_2"),
            DB::raw("SUM(IF(pay_method='custom_pay_3', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_3"),
            DB::raw("SUM(IF(pay_method='custom_pay_4', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_4"),
            DB::raw("SUM(IF(pay_method='custom_pay_5', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_5"),
            DB::raw("SUM(IF(pay_method='custom_pay_6', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_6"),
            DB::raw("SUM(IF(pay_method='custom_pay_7', IF(transaction_type='sell', amount, 0), 0)) as total_custom_pay_7"),
            DB::raw("SUM(IF(pay_method='custom_pay_1', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_1_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_2', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_2_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_3', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_3_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_4', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_4_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_5', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_5_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_6', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_6_expense"),
            DB::raw("SUM(IF(pay_method='custom_pay_7', IF(transaction_type='expense', amount, 0), 0)) as total_custom_pay_7_expense"),
            DB::raw("SUM(IF(transaction_type='refund', amount, 0)) as total_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='cash', amount, 0), 0)) as total_cash_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='cheque', amount, 0), 0)) as total_cheque_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='card', amount, 0), 0)) as total_card_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='bank_transfer', amount, 0), 0)) as total_bank_transfer_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='other', amount, 0), 0)) as total_other_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='advance', amount, 0), 0)) as total_advance_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_1', amount, 0), 0)) as total_custom_pay_1_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_2', amount, 0), 0)) as total_custom_pay_2_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_3', amount, 0), 0)) as total_custom_pay_3_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_4', amount, 0), 0)) as total_custom_pay_4_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_5', amount, 0), 0)) as total_custom_pay_5_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_6', amount, 0), 0)) as total_custom_pay_6_refund"),
            DB::raw("SUM(IF(transaction_type='refund', IF(pay_method='custom_pay_7', amount, 0), 0)) as total_custom_pay_7_refund"),
            DB::raw("SUM(IF(pay_method='cheque', 1, 0)) as total_cheques"),
            DB::raw("SUM(IF(pay_method='card', 1, 0)) as total_card_slips"),
            DB::raw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) as user_name"),
            'u.email',
            'bl.name as location_name'
        )->first();
        return $register_details;
    }

    /**
     * Get the transaction details for a particular register
     *
     * @param $user_id int
     * @param $open_time datetime
     * @param $close_time datetime
     *
     * @return array
     */
    public function getRegisterTransactionDetails($user_id, $open_time, $close_time, $is_types_of_service_enabled = false)
    {
        $product_details_by_brand = Transaction::where('transactions.created_by', $user_id)
            ->whereBetween('transactions.created_at', [$open_time, $close_time])
            ->where('transactions.type', 'sell')
            ->where('transactions.status', 'final')
            ->where('transactions.is_direct_sale', 0)
            ->join('transaction_sell_lines AS TSL', 'transactions.id', '=', 'TSL.transaction_id')
            ->join('products AS P', 'TSL.product_id', '=', 'P.id')
            ->where('TSL.children_type', '!=', 'combo')
            ->leftjoin('brands AS B', 'P.brand_id', '=', 'B.id')
            ->groupBy('B.id')
            ->select(
                'B.name as brand_name',
                DB::raw('SUM(TSL.quantity) as total_quantity'),
                DB::raw('SUM(TSL.unit_price_inc_tax*TSL.quantity) as total_amount')
            )
            ->orderByRaw('CASE WHEN brand_name IS NULL THEN 2 ELSE 1 END, brand_name')
        ->get();

        $product_details = Transaction::where('transactions.created_by', $user_id)
                ->whereBetween('transactions.created_at', [$open_time, $close_time])
                ->where('transactions.type', 'sell')
                ->where('transactions.status', 'final')
                ->where('transactions.is_direct_sale', 0)
                ->join('transaction_sell_lines AS TSL', 'transactions.id', '=', 'TSL.transaction_id')
                ->join('variations AS v', 'TSL.variation_id', '=', 'v.id')
                ->join('product_variations AS pv', 'v.product_variation_id', '=', 'pv.id')
                ->join('products AS p', 'v.product_id', '=', 'p.id')
                ->where('TSL.children_type', '!=', 'combo')
                ->groupBy('v.id')
                ->select(
                    'p.name as product_name',
                    'p.type as product_type',
                    'v.name as variation_name',
                    'pv.name as product_variation_name',
                    'v.sub_sku as sku',
                    DB::raw('SUM(TSL.quantity) as total_quantity'),
                    DB::raw('SUM(TSL.unit_price_inc_tax*TSL.quantity) as total_amount')
                )
                ->get();

        //If types of service
        $types_of_service_details = null;
        if ($is_types_of_service_enabled) {
            $types_of_service_details = Transaction::where('transactions.created_by', $user_id)
                ->whereBetween('transaction_date', [$open_time, $close_time])
                ->where('transactions.is_direct_sale', 0)
                ->where('transactions.type', 'sell')
                ->where('transactions.status', 'final')
                ->leftjoin('types_of_services AS tos', 'tos.id', '=', 'transactions.types_of_service_id')
                ->groupBy('tos.id')
                ->select(
                    'tos.name as types_of_service_name',
                    DB::raw('SUM(final_total) as total_sales')
                )
                ->orderBy('total_sales', 'desc')
                ->get();
        }

        $transaction_details = Transaction::where('transactions.created_by', $user_id)
                ->whereBetween('transactions.created_at', [$open_time, $close_time])
                ->where('transactions.type', 'sell')
                ->where('transactions.is_direct_sale', 0)
                ->where('transactions.status', 'final')
                ->select(
                    DB::raw('SUM(tax_amount) as total_tax'),
                    DB::raw('SUM(IF(discount_type = "percentage", total_before_tax*discount_amount/100, discount_amount)) as total_discount'),
                    DB::raw('SUM(final_total) as total_sales'),
                    DB::raw('SUM(shipping_charges) as total_shipping_charges')
                )
                ->first();

        return ['product_details_by_brand' => $product_details_by_brand,
                'transaction_details' => $transaction_details,
                'types_of_service_details' => $types_of_service_details,
                'product_details' => $product_details
            ];
    }

    /**
     * Retrieves the currently opened cash register for the user
     *
     * @param $int user_id
     *
     * @return obj
     */
    public function getCurrentCashRegister($user_id)
    {
        $register =  CashRegister::where('user_id', $user_id)
                                ->where('status', 'open')
                                ->first();

        return $register;
    }
}
