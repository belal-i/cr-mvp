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

        // See https://laravel.com/docs/11.x/validation
        $validated = $request->validate([
            'max-rent' => 'required',
            'number_of_rooms-min' => 'required',
            'start_date' => 'required',
            'min_months' => 'required',
            'persons-info' => 'required',
            'job_type' => 'required',
            'last_name' => 'required',
            // TODO: IIRC, there is some data privacy law, where only one
            // can be required.
            'email' => 'required',
            'phone' => 'required',

            'tos' => 'required',
            'privacy' => 'required',
            'captcha' => 'required|captcha',
        ]);

        // TODO: Inquiry model? Write to database? Lots of possibilities...
        // Also, this right here obviously needs to be improved, for now it's
        // just to quickly demonstrate.
        Mail::to(env('CR_INQUIRY_MAIL_ADDRESS'))->send(new Inquiry(
            sourceId: $request->input('source_id'),
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
