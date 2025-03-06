<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Apartment;
use App\Models\User;

class Offer extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    public const API_FIELDS = [
        'id',
        'apartment_id',
        'source_id',
        'start_date',
        'end_date',
        'min_months',
        'max_months',
        'number_of_persons',
        'rent',
        'security_deposit',
        'security_deposit_type',
        'reference',
        'notes',
        'date_created',
        'last_changed_by',
        'date_last_changed',
        'time_last_changed',
        'status',
        'publish_on_immoscout',
        'va_was_sent',
        'created_at',
        'updated_at',
        'is_premium',
        'utility_cost_included',
        'electricity_cost_included',
        'heating_cost_included',
        'gas_cost_included',
        'water_cost_included',
        'internet_cost_included',
        'cleaning_cost_included',
        'utility_cost_amount',
        'electricity_cost_amount',
        'heating_cost_amount',
        'gas_cost_amount',
        'water_cost_amount',
        'internet_cost_amount',
        'cleaning_cost_amount',
        'date_published',
        'user_id',
    ];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMaxMonthsText()
    {
        if ($this->max_months > 0) {
            return sprintf(
                '%s %d %s',
                __('höchstens'),
                $this->max_months,
                __('Monate'),
            );
        }
        else {
            return __('für unbefristet');
        }
    }

    public function getInfoAtAGlanceText()
    {
        return $this->apartment->number_of_rooms . __('-Zi.') . ' '
            . $this->apartment->getTranslatedApartmentType() . ' | '
            . $this->apartment->size_sq_m . 'm<sup>2</sup> | '
            . get_euro_text($this->rent) . ' | '
            . $this->apartment->house->address->neighborhood;
    }

    public function getStartText()
    {
        $today = date('Y-m-d');
        if ($this->start_date > $today) {
            return format_date($this->start_date);
        }
        else {
            return __('sofort');
        }
    }

    public function getLimitationsText()
    {
        $limitationsArray = [];
        $personsNoun = sprintf(
            ' %s',
            __($this->number_of_persons == 1 ? 'Person' : 'Personen')
        );

        ;
        if (!empty($this->number_of_persons))
            $limitationsArray[] = 'max. ' . $this->number_of_persons . $personsNoun;
        if (!$this->smoking_ok)
            $limitationsArray[] = __('nur an Nichtraucher');

        return implode(', ', $limitationsArray);
    }

    // TODO: This will be refactored. See Feature #972.
    public function getSecurityDepositText()
    {
        switch ($this->security_deposit_type) {
            case 'FREE_TEXT':
            default:
                return $this->security_deposit;
            case 'EURO_AMOUNT':
                return get_euro_text($this->security_deposit);
            case 'MONTHLY_RENTS':
                return sprintf(
                    '%d %s',
                    $this->security_deposit,
                    __('Monatsmieten')
                );
        }
    }
}
