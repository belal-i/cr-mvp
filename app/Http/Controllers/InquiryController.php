<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;

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
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email|max:255',
            'tos' => 'accepted',
            'privacy' => 'accepted',
            'captcha' => 'required|captcha',
        ]);

        // TODO: Inquiry model? Write to database? Lots of possibilities...
        // Also, this right here obviously needs to be improved, for now it's
        // just to quickly demonstrate.
        Mail::to(env('CR_INQUIRY_MAIL_ADDRESS'))->send(new Inquiry(
            sourceId: $request->input('source_id'),
            appointmentWanted: $request->input('appointment-wanted') == 'yes',
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

        // TODO
        return redirect('/offers');
    }
}
