<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;
use App\Mail\InquiryClientConfirmation;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'max-rent' => 'required|numeric',
            'number_of_rooms-min' => 'required|numeric',
            'start_date' => 'required|date',
            'min_months' => 'required|numeric',
            'persons-info' => 'required|max:255',
            'job_type' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'tos' => 'accepted',
            'privacy' => 'accepted',
            'accept-furnished' => 'accepted',
            'captcha' => 'required|captcha',
        ]);

        // Notify team about inquiry.
        $appointmentWanted = null;
        if ($request->input('appointment-wanted') == 'yes') {
            $appointmentWanted = true;
        } else if ($request->input('appointment-wanted') == 'no') {
            $appointmentWanted = false;
        }
        Mail::to(env('CR_INQUIRY_MAIL_ADDRESS'))->send(new Inquiry(
            sourceId: $request->input('source_id'),
            appointmentWanted: $appointmentWanted,
            apartmentQuestions: $request->input('apartment-questions'),
            numberOfRoomsMin: $request->input('number_of_rooms-min'),
            startDate: $request->input('start_date'),
            latestMoveInDate: $request->input('latest-move-in-date'),
            minMonths: $request->input('min_months'),
            personsInfo: $request->input('persons-info'),
            neighborhood: $request->input('neighborhood'),
            petsInfo: $request->input('pets-info'),
            jobType: $request->input('job_type'),
            salutation: $request->input('salutation'),
            title: $request->input('title'),
            maxRent: $request->input('max-rent'),
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            company: $request->input('company'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            other: $request->input('other'),
        ));

        // Send confirmation to client.
        Mail::to($request->input('email'))->send(new InquiryClientConfirmation(
            salutation: $request->input('salutation'),
            name: $request->input('last_name'),
            maxRent: $request->input('max-rent'),
            numberOfRoomsMin: $request->input('number_of_rooms-min'),
            startDate: $request->input('start_date'),
            minMonths: $request->input('min_months'),
            offerId: $request->input('offer_id'),
            offerLegacyId: $request->input('source_id'),
        ));

        return redirect('/thanks');
    }
}
