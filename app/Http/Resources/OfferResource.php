<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isAjaxRequest = $request->input('ajax') === '1';
        $splideCount = 0;

        foreach ($this->resource as &$offer) {
            $apartment = &$offer->apartment;
            $house     = &$apartment->house;
            $address   = &$house->address;
            if ($isAjaxRequest) {
                $address->nearby_public_transit =
                    $address->getSubwayStationsAsList();
                $apartment->number_of_rooms =
                    $apartment->getNumberOfRoomsText();
                $offer->start_date = $offer->getStartText();
                $offer->max_months = $offer->getMaxMonthsText();
                $offer->rent = get_euro_text($offer->rent);
            }
            // Unset fields with potentially sensitive data.
            unset(
                $offer->user_id,
                $offer->notes,
                $offer->reference,
                $offer->last_changed_by,
                $offer->va_was_sent,
                $apartment->notes,
                $apartment->date_created,
                $apartment->account_manager,
                $apartment->key_number,
            );

            if ($isAjaxRequest) {
                $offer['apartment__title']           = $apartment->title;
                $offer['apartment__number_of_rooms'] = $apartment->number_of_rooms;
                $offer['apartment__size_sq_m']       = $apartment->size_sq_m;
                $offer['address__neighborhood']      =
                    empty($address->neighborhood)
                    ? ''
                    : ', ' . $address->neighborhood;
                $offer['address__street']            = $address->street;
                $offer['address__nearby_public_transit'] =
                    '<p class="not-mobile">'
                    . implode('</p><p class="not-mobile">', $address->nearby_public_transit)
                    . '</p>';
                $offer['apartment__image_slideshow'] = $apartment->makeImageSlideshow(
                    sprintf('splide-%s', $splideCount),
                    ['splide'],
                    ['list-view-image'],
                    [
                        sprintf(
                            'onclick="window.location.href = \'/offers/%s\';"',
                            $offer->id
                        )
                    ]
                );
                $offer['apartment__rating_stars'] = $apartment->getRatingStarsImg(75);
                $offer['apartment__equipment_icons'] = $apartment->getEquipmentIcons();
                ++$splideCount;
            } else {
                // TODO: Maybe there's a better way to do this?
                $offer['apartment'] = $apartment;
                $offer['apartment']['house'] = $house;
                $offer['apartment']['house']['address'] = $address;
            }

            // Unset foreign IDs.
            unset(
                $offer->apartment_id,
                $offer['apartment']->house_id,
                $offer['apartment']->user_id,
                $offer['apartment']['house']->address_id,
            );

        }
        $returnArray = parent::toArray($request);
        return $returnArray;
    }
}
