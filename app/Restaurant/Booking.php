<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Restaurant\Booking
 *
 * @property int $id
 * @property int $contact_id
 * @property int|null $waiter_id
 * @property int|null $table_id
 * @property int|null $correspondent_id
 * @property int $business_id
 * @property int $location_id
 * @property string $booking_start
 * @property string $booking_end
 * @property int $created_by
 * @property string $booking_status
 * @property string|null $booking_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Business $business
 * @property-read \App\User|null $correspondent
 * @property-read \App\Contact $customer
 * @property-read \App\BusinessLocation $location
 * @property-read \App\Restaurant\ResTable|null $table
 * @property-read \App\User|null $waiter
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCorrespondentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereWaiterId($value)
 * @mixin \Eloquent
 */
class Booking extends Model
{
    //Allowed booking statuses ('waiting', 'booked', 'completed', 'cancelled')

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(\App\Contact::class, 'contact_id');
    }

    public function table()
    {
        return $this->belongsTo(\App\Restaurant\ResTable::class, 'table_id');
    }

    public function correspondent()
    {
        return $this->belongsTo(\App\User::class, 'correspondent_id');
    }

    public function waiter()
    {
        return $this->belongsTo(\App\User::class, 'waiter_id');
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }

    public function business()
    {
        return $this->belongsTo(\App\Business::class, 'business_id');
    }

    public static function createBooking($input)
    {

        $data = [
            'contact_id' => $input['contact_id'],
            'waiter_id' => isset($input['res_waiter_id']) ? $input['res_waiter_id'] : null,
            'table_id' => isset($input['res_table_id']) ? $input['res_table_id'] : null,
            'business_id' => $input['business_id'],
            'location_id' => $input['location_id'],
            'correspondent_id' => isset($input['correspondent']) ? $input['correspondent'] : null,
            'booking_start' => $input['booking_start'],
            'booking_end' => $input['booking_end'],
            'created_by' => $input['created_by'],
            'booking_status' => isset($input['booking_status']) ? $input['booking_status'] : 'booked',
            'booking_note' => $input['booking_note']
        ];
        $booking = Booking::create($data);

        return $booking;
    }
}
