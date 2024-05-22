<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\House;
use App\Models\Offer;

class Apartment extends Model
{
    use CrudTrait;
    use HasFactory;

    private const APARTMENT_TYPE_TRANSLATIONS = [
        'APARTMENT' => 'Wohnung',
        'HOUSE'     => 'Haus',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function getTranslatedApartmentType()
    {
        return self::APARTMENT_TYPE_TRANSLATIONS[$this->apartment_type];
    }

    public function getAllImageUrls()
    {
        $returnArray = [];
        $allImages = $this->images->sortBy('sort_order')
                          ->merge($this->house->images->sortBy('sort_order'))
                          ->merge($this->house->address->images->sortBy('sort_order'));
        foreach ($allImages as $img) {
            $returnArray[] = Storage::url($img->getFilePath());
        }
        return $returnArray;
    }

    public function makeImageSlideshow(
        $splideId = null,
        $splideClasses = null,
        $imgCssClasses = null
    ) {
        $templateString = <<<EOF
            <section %s %s aria-label="Splide">
                <div class="splide__track">
                        %s
                </div>
            </section>
EOF;
        $imageUrls = $this->getAllImageUrls();
        $liElems = [];
        foreach ($imageUrls as $url) {
            $liElems[] = sprintf(
                '<img src="%s"%s>',
                $url,
                empty($imgCssClasses) ? ''
                : sprintf(
                    ' class="%s"',
                    implode(' ', $imgCssClasses)
                )
            );
        }
        return sprintf(
            $templateString,

            empty($splideId) ? ''
            : sprintf(' id="%s"', $splideId),

            empty($splideClasses) ? ''
            : sprintf(
                ' class="%s"',
                implode(' ', $splideClasses)
            ),

            php_array_to_ul_elem(
                $liElems,
                ['splide__list'],
                ['splide__slide'],
            )
        );
    }

    public function getNumberOfRoomsText()
    {
        if ($this->apartment_type == 'HOUSE') {
            if ($this->number_of_rooms == 1)
                $noun = 'Zimmer';
            else
                $noun = 'Zimmern';
            return sprintf('Haus mit %d %s', $this->number_of_rooms, $noun);
        }
        else {
            return $this->number_of_rooms . '-Zi. Wohnung';
        }
    }

    public function getSpecials()
    {
        $specials = json_decode($this->specials, true);
        $returnArray = [];

        if (empty($specials))
            return $returnArray;

        foreach ($specials as $specialsEntry) {
            // TODO: For now, just using the German ones,
            // but this needs to be refactored.
            if (!empty($specialsEntry['1']))
                $returnArray[] = $specialsEntry['1'];
        }
        return $returnArray;
    }

    public function getRoomText($roomType, $furnitureAsUl = false)
    {
        if (!in_array($roomType, ['living_room', 'kitchen', 'bathroom']))
            return ''; // TODO: Raise exception?
        $retTxt = sprintf(
            '%s %s',
            $this->{$roomType . '_description'},
            $this->{$roomType . '_type'}
        );
        if (isset($this->{$roomType . '_equipment'}))
            $retTxt .= sprintf(' mit %s', $this->{$roomType . '_equipment'});

        $furniture = json_decode($this->{$roomType . '_furniture'});
        if (!empty($furniture)) {
            if ($furnitureAsUl)
                $retTxt .= php_array_to_ul_elem($furniture);
            else
                $retTxt .= ' mit ' . implode(', ', $furniture);
        }
        return $retTxt;
    }

    // TODO: See Feature #1180
    public function getEquipmentText()
    {
        $generalEquipment = [];
        $flooringInfo = sprintf(
            '%s %s',
            $this->flooring_description,
            $this->flooring
        );
        if (!empty($this->flooring_material))
            $flooringInfo .= sprintf(' (%s)', $this->flooring_material);

        if (!empty(trim($flooringInfo)))
            $generalEquipment[] = $flooringInfo;

        if (!empty($this->luxury_items))
            $generalEquipment[] = implode(', ', json_decode($this->luxury_items));
        if (!empty($this->windows))
            $generalEquipment[] = implode(', ', json_decode($this->windows));

        $technicalEquipment = [];
        if ($this->has_internet)
            $technicalEquipment[] = 'Internetzugang';
        if ($this->has_television && $this->television_size_inches > 0)
            $technicalEquipment[] = sprintf('%d" Flachbildfernseher', $this->television_size_inches);

        $returnString = sprintf(
            'Allgemein%s',
            php_array_to_ul_elem($generalEquipment)
        );

        if (!empty($technicalEquipment))
            $returnString .= sprintf(
                'Technische Ausstattung%s',
                php_array_to_ul_elem($technicalEquipment)
            );

        return $returnString;
    }
}
