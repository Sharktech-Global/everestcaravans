<?php


namespace App\Helpers;

use App\Location;
use App\Mail\EnquiryMail;
use App\Mail\SuccessMail;
use App\Mail\SuccessMailEnquery;
use App\Mail\EnquiryTestDrive;
use App\Mail\EnquiryInsureCar;
use App\Mail\EnquiryServiceCar;
use App\Mail\QuickEnquiry;
use App\Mail\OfferEnquiry;
use App\Mail\EnquiryBuyNewCar;
use App\Mail\ExchangeEnquiry;
use App\Mail\UsedcarEnquiry;
use App\Mail\CareerEnquiry;
use App\Mail\Subscription;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public static function send($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        // Mail::to($email["to"] ?: ['hello@example.com'])
        //     ->cc($email["cc"] ?: ['enquiry@axlr8.com'])
        //     ->bcc($email["bcc"] ?: ['nvsite@gmail.com'])
        //     ->send(new EnquiryMail($subject, $enquiry));
        Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }

    public static function booking($booking)
    {
        $location = Location::find($booking->location_id);
        $email["to"] = $location->email;
        $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
        $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;

        $data['Name'] = $booking->first_name . ' ' . $booking->last_name;
        $data['Email'] = $booking->email;
        $data['Phone'] = $booking->phone;
        $data['Location'] = $booking->location->name;
        $data['Billing Address'] = $booking->billing_address . ', ' . $booking->state . ', ' . $booking->city . ' Postcode:' . $booking->postcode;
        $data['Payment Method'] = strtoupper($booking->payment);
        $data['Vehicle'] = $booking->vehicle->name;
        foreach (json_decode($booking->vehicle_details) as $key => $value) {
            $data[ucfirst($key)] = $value;
        }
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])->send(new EnquiryMail('New Booking from ' . $booking->first_name . ' ' . $booking->last_name, $data));
        Mail::to($data['Email'])->send(new SuccessMail('Your booking has been submitted successfully.<br> Thank you for choosing Axlr8.', $data));
        return true;
    }

    public static function testdrive($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->vehicle_id;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new EnquiryTestDrive($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function buynewcar($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->vehicle->name;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new EnquiryBuyNewCar($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function insurance($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Email'] = $enquiry->email;
        $data['Mobile'] = $enquiry->mobile;
        $data['reg_number'] = $enquiry->reg_number;
        $data['Location'] = $enquiry->location->name;
        Mail::to($email["to"] ?: ['hello@example.com'])
            ->cc($email["cc"] ?: ['enquiry@axlr8.com'])
            ->bcc($email["bcc"] ?: ['nvsite@gmail.com'])
            ->send(new EnquiryInsureCar($subject, $data));
        Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function service($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        if($enquiry->service_name){
            $data['Service'] = $enquiry->service_name;
        }
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->model;
        $data['Regno'] = $enquiry->reg_number;
        $data['ServiceDate'] = $enquiry->service_date;
        $data['ServiceName'] = $enquiry->service_name;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new EnquiryServiceCar($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function quick($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        @$data['Email'] = @$enquiry->email;
        $data['Phone'] = @$enquiry->phone;
        $data['Location'] = @$enquiry->location->name;
        $data['Subject'] = @$enquiry->subject;
        @$data['Model'] = @$enquiry->vehicle->name;
        @$data['Message'] = @$enquiry->message;
        Mail::to($email["to"] ?: ['hello@example.com'])
            ->cc($email["cc"] ?: ['enquiry@axlr8.com'])
            ->bcc($email["bcc"] ?: ['nvsite@gmail.com'])
            ->send(new QuickEnquiry($subject, $data));
            if($enquiry['email']){
            Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
            }
            return true;
    }
    public static function talk($subject, $talkceo, $location_id = null)
    {
        // if ($location_id) {
        //     $location = Location::find($location_id);
        //     $email["to"] = trim($location->email);
        //     $email["cc"] = (trim($location->email_ccs)) ? explode(',', trim($location->email_ccs)) : null;
        //     $email["bcc"] = (trim($location->email_bccs)) ? explode(',', trim($location->email_bccs)) : null;
        // } else {
        //     $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
        //     $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
        //     $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        // }
        $data['Name'] = $talkceo->name;
        $data['Email'] = $talkceo->email;
        $data['Phone'] = $talkceo->phone;
        $data['Location'] = $talkceo->location->name;
        $data['Subject'] = $talkceo->subject;
        $data['Message'] = $talkceo->message;
        Mail::to(['divin.netventure@gmail.com'])
            // ->bcc($email["bcc"] ?: ['nvsite@gmail.com'])
            ->send(new QuickEnquiry($subject, $data));
        Mail::to($talkceo['email'])->send(new SuccessMailEnquery('Your request to talk to CEO has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function offer($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = implode(',',json_decode($enquiry->model));
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new OfferEnquiry($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function exchange($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->model;
        $data['Year'] = $enquiry->year;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new ExchangeEnquiry($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function usedcar($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->model;
        $data['Year'] = $enquiry->year;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new UsedcarEnquiry($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function career($subject, $data)
    {
        $email["to"] = ($data['to_emails']) ? explode(',', $data['to_emails']) : null;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new CareerEnquiry($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
    public static function subscribe($subject, $enquiry, $location_id = null)
    {
        if ($location_id) {
            $location = Location::find($location_id);
            $email["to"] = $location->email;
            $email["cc"] = ($location->email_ccs) ? explode(',', $location->email_ccs) : null;
            $email["bcc"] = ($location->email_bccs) ? explode(',', $location->email_bccs) : null;
        } else {
            $email["to"] = (config('contact.contact_emails')) ? explode(',', config('contact.contact_emails')) : null;
            $email["cc"] = (config('contact.contact_email_ccs')) ? explode(',', config('contact.contact_email_ccs')) : null;
            $email["bcc"] = (config('contact.contact_email_bccs')) ? explode(',', config('contact.contact_email_bccs')) : null;
        }
        $data['Name'] = $enquiry->name;
        $data['Phone'] = $enquiry->phone;
        $data['Location'] = $enquiry->location->name;
        $data['Model'] = $enquiry->vehicle->name;
        Mail::to($email["to"] ?: ['divin.netventure@gmail.com'])
            ->send(new Subscription($subject, $data));
        //Mail::to($enquiry['email'])->send(new SuccessMailEnquery('Your enquiry has been submitted successfully.<br> Thank you reaching out to us, we will get back to you shortly.'));
        return true;
    }
}
