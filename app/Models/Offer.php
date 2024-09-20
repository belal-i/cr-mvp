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
        if ($this->max_months > 0)
            return 'höchstens ' . $this->max_months . ' Monate';
        else
            return 'für unbefristet';
    }

    public function getInfoAtAGlanceText()
    {
        return $this->apartment->number_of_rooms . '-Zi. '
            . $this->apartment->getTranslatedApartmentType() . ' | '
            . $this->apartment->size_sq_m . 'm<sup>2</sup> | '
            . get_euro_text($this->rent) . ' | '
            . $this->apartment->house->address->neighborhood;
    }

    public function getStartText()
    {
        $today = date('Y-m-d');
        if ($this->start_date > $today) {
            $date = new \DateTime($this->start_date);
            $formatter = new \IntlDateFormatter(
                'de-DE',
                \IntlDateFormatter::SHORT,
                \IntlDateFormatter::NONE,
                'Europe/Berlin',
                \IntlDateFormatter::GREGORIAN,
                'dd.MM.yyyy'
            );
            return $formatter->format($date);
        }
        else {
            return 'sofort';
        }
    }

    public function getLimitationsText()
    {
        $limitationsArray = [];
        $personsNoun = $this->number_of_persons == 1 ? ' Person' : ' Personen';
        if (!empty($this->number_of_persons))
            $limitationsArray[] = 'max. ' . $this->number_of_persons . $personsNoun;
        if (!$this->smoking_ok)
            $limitationsArray[] = 'nur an Nichtraucher';

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
                return sprintf('%d Monatsmieten', $this->security_deposit);
        }
    }
}
