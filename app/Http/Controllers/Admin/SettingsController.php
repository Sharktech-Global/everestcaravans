<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\GeneralSetting;
use App\HomeSettings;
use Carbon\Carbon;
use Jackiedo\DotenvEditor\DotenvEditor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $editor;

    public function __construct(DotenvEditor $editor)
    {
        $this->editor = $editor;
    }

    public function index()
    {
        $setting = Setting::select(['key', 'value'])->get();
        $data['timezone'] = array(
            '(UTC-11:00) Midway Island' => 'Pacific/Midway',
            '(UTC-11:00) Samoa' => 'Pacific/Samoa',
            '(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
            '(UTC-09:00) Alaska' => 'US/Alaska',
            '(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
            '(UTC-08:00) Tijuana' => 'America/Tijuana',
            '(UTC-07:00) Arizona' => 'US/Arizona',
            '(UTC-07:00) Chihuahua' => 'America/Chihuahua',
            '(UTC-07:00) La Paz' => 'America/Chihuahua',
            '(UTC-07:00) Mazatlan' => 'America/Mazatlan',
            '(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
            '(UTC-06:00) Central America' => 'America/Managua',
            '(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
            '(UTC-06:00) Guadalajara' => 'America/Mexico_City',
            '(UTC-06:00) Mexico City' => 'America/Mexico_City',
            '(UTC-06:00) Monterrey' => 'America/Monterrey',
            '(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
            '(UTC-05:00) Bogota' => 'America/Bogota',
            '(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
            '(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
            '(UTC-05:00) Lima' => 'America/Lima',
            '(UTC-05:00) Quito' => 'America/Bogota',
            '(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
            '(UTC-04:30) Caracas' => 'America/Caracas',
            '(UTC-04:00) La Paz' => 'America/La_Paz',
            '(UTC-04:00) Santiago' => 'America/Santiago',
            '(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
            '(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
            '(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
            '(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
            '(UTC-03:00) Greenland' => 'America/Godthab',
            '(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
            '(UTC-01:00) Azores' => 'Atlantic/Azores',
            '(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
            '(UTC+00:00) Casablanca' => 'Africa/Casablanca',
            '(UTC+00:00) Edinburgh' => 'Europe/London',
            '(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
            '(UTC+00:00) Lisbon' => 'Europe/Lisbon',
            '(UTC+00:00) London' => 'Europe/London',
            '(UTC+00:00) Monrovia' => 'Africa/Monrovia',
            '(UTC+00:00) UTC' => 'UTC',
            '(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
            '(UTC+01:00) Belgrade' => 'Europe/Belgrade',
            '(UTC+01:00) Berlin' => 'Europe/Berlin',
            '(UTC+01:00) Bern' => 'Europe/Berlin',
            '(UTC+01:00) Bratislava' => 'Europe/Bratislava',
            '(UTC+01:00) Brussels' => 'Europe/Brussels',
            '(UTC+01:00) Budapest' => 'Europe/Budapest',
            '(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
            '(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
            '(UTC+01:00) Madrid' => 'Europe/Madrid',
            '(UTC+01:00) Paris' => 'Europe/Paris',
            '(UTC+01:00) Prague' => 'Europe/Prague',
            '(UTC+01:00) Rome' => 'Europe/Rome',
            '(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
            '(UTC+01:00) Skopje' => 'Europe/Skopje',
            '(UTC+01:00) Stockholm' => 'Europe/Stockholm',
            '(UTC+01:00) Vienna' => 'Europe/Vienna',
            '(UTC+01:00) Warsaw' => 'Europe/Warsaw',
            '(UTC+01:00) West Central Africa' => 'Africa/Lagos',
            '(UTC+01:00) Zagreb' => 'Europe/Zagreb',
            '(UTC+02:00) Athens' => 'Europe/Athens',
            '(UTC+02:00) Bucharest' => 'Europe/Bucharest',
            '(UTC+02:00) Cairo' => 'Africa/Cairo',
            '(UTC+02:00) Harare' => 'Africa/Harare',
            '(UTC+02:00) Helsinki' => 'Europe/Helsinki',
            '(UTC+02:00) Istanbul' => 'Europe/Istanbul',
            '(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
            '(UTC+02:00) Kyiv' => 'Europe/Helsinki',
            '(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
            '(UTC+02:00) Riga' => 'Europe/Riga',
            '(UTC+02:00) Sofia' => 'Europe/Sofia',
            '(UTC+02:00) Tallinn' => 'Europe/Tallinn',
            '(UTC+02:00) Vilnius' => 'Europe/Vilnius',
            '(UTC+03:00) Baghdad' => 'Asia/Baghdad',
            '(UTC+03:00) Kuwait' => 'Asia/Kuwait',
            '(UTC+03:00) Minsk' => 'Europe/Minsk',
            '(UTC+03:00) Nairobi' => 'Africa/Nairobi',
            '(UTC+03:00) Riyadh' => 'Asia/Riyadh',
            '(UTC+03:00) Volgograd' => 'Europe/Volgograd',
            '(UTC+03:30) Tehran' => 'Asia/Tehran',
            '(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
            '(UTC+04:00) Baku' => 'Asia/Baku',
            '(UTC+04:00) Moscow' => 'Europe/Moscow',
            '(UTC+04:00) Muscat' => 'Asia/Muscat',
            '(UTC+04:00) St. Petersburg' => 'Europe/Moscow',
            '(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
            '(UTC+04:00) Yerevan' => 'Asia/Yerevan',
            '(UTC+04:30) Kabul' => 'Asia/Kabul',
            '(UTC+05:00) Islamabad' => 'Asia/Karachi',
            '(UTC+05:00) Karachi' => 'Asia/Karachi',
            '(UTC+05:00) Tashkent' => 'Asia/Tashkent',
            '(UTC+05:30) Chennai' => 'Asia/Calcutta',
            '(UTC+05:30) Kolkata' => 'Asia/Kolkata',
            '(UTC+05:30) Mumbai' => 'Asia/Calcutta',
            '(UTC+05:30) New Delhi' => 'Asia/Calcutta',
            '(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
            '(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
            '(UTC+06:00) Almaty' => 'Asia/Almaty',
            '(UTC+06:00) Astana' => 'Asia/Dhaka',
            '(UTC+06:00) Dhaka' => 'Asia/Dhaka',
            '(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
            '(UTC+06:30) Rangoon' => 'Asia/Rangoon',
            '(UTC+07:00) Bangkok' => 'Asia/Bangkok',
            '(UTC+07:00) Hanoi' => 'Asia/Bangkok',
            '(UTC+07:00) Jakarta' => 'Asia/Jakarta',
            '(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
            '(UTC+08:00) Beijing' => 'Asia/Hong_Kong',
            '(UTC+08:00) Chongqing' => 'Asia/Chongqing',
            '(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
            '(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
            '(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
            '(UTC+08:00) Perth' => 'Australia/Perth',
            '(UTC+08:00) Singapore' => 'Asia/Singapore',
            '(UTC+08:00) Taipei' => 'Asia/Taipei',
            '(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
            '(UTC+08:00) Urumqi' => 'Asia/Urumqi',
            '(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
            '(UTC+09:00) Osaka' => 'Asia/Tokyo',
            '(UTC+09:00) Sapporo' => 'Asia/Tokyo',
            '(UTC+09:00) Seoul' => 'Asia/Seoul',
            '(UTC+09:00) Tokyo' => 'Asia/Tokyo',
            '(UTC+09:30) Adelaide' => 'Australia/Adelaide',
            '(UTC+09:30) Darwin' => 'Australia/Darwin',
            '(UTC+10:00) Brisbane' => 'Australia/Brisbane',
            '(UTC+10:00) Canberra' => 'Australia/Canberra',
            '(UTC+10:00) Guam' => 'Pacific/Guam',
            '(UTC+10:00) Hobart' => 'Australia/Hobart',
            '(UTC+10:00) Melbourne' => 'Australia/Melbourne',
            '(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
            '(UTC+10:00) Sydney' => 'Australia/Sydney',
            '(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
            '(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
            '(UTC+12:00) Auckland' => 'Pacific/Auckland',
            '(UTC+12:00) Fiji' => 'Pacific/Fiji',
            '(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
            '(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
            '(UTC+12:00) Magadan' => 'Asia/Magadan',
            '(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',
            '(UTC+12:00) New Caledonia' => 'Asia/Magadan',
            '(UTC+12:00) Solomon Is.' => 'Asia/Magadan',
            '(UTC+12:00) Wellington' => 'Pacific/Auckland',
            '(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
        );
        $data['environment'] = array(
            'local' => 'Local',
            'production' => 'Production',
        );
        return view('admin.settings.index', ['setting' => $setting, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'APP_NAME' => 'required',
            'APP_ENV' => 'required',
            'APP_DEBUG' => 'required',
            'APP_URL' => 'required',
            'MAIL_HOST' => 'required',
            'MAIL_PORT' => 'required',
            'MAIL_USERNAME' => 'required',
            'MAIL_PASSWORD' => 'required',
            'MAIL_FROM_ADDRESS' => 'required',
            'MAIL_FROM_NAME' => 'required',
            'NOCAPTCHA_SECRET' => 'required',
            'NOCAPTCHA_SITEKEY' => 'required',
            'APP_TIME_ZONE' => 'required',
        ]);

        foreach ($validated as $key => $value) {
            $setting = Setting::getByKey($key);
            if ($setting->value != $value) {
                $setting->key = $key;
                $setting->value = $value;
                $setting->save();
                activity('admin')->performedOn($setting)->causedBy($user)->withProperties(['data' => $request->post])->log('Updated Settings #' . $key . '.');
                $this->editor->setKey($key, $value)->save();
            }
        }

        return redirect()->back()->with('success', 'Successfully updated settings.');
    }

    public function general()
    {
        $settings = GeneralSetting::first();
        return view('admin.settings.general', ['settings' => $settings]);
    }
    public function store_general(Request $request)
    {

        $validated = $request->validate([
            'phonenumber' => 'required',
            'mobile_1' => 'nullable',
            'whatsapp' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'map' => 'required',
            'logo' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'logo_secondary' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'logo_third' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'logo_fourth' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg,ico,webp',
            'popup' => 'required',
            'website_color' => 'nullable',
            'linkedin' => 'nullable',
            'twitter' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable|email',

        ]);

            $general = GeneralSetting::firstOrCreate();
            $general->mobile = $validated['phonenumber'];
            $general->mobile_1 = $validated['mobile_1'];
            $general->whatsapp = $validated['whatsapp'];
            $general->facebook =  $validated['facebook'];
            $general->instagram = $validated['instagram'];
            $general->youtube = $validated['youtube'];
            $general->linkedin = $validated['linkedin'];
            $general->twitter = $validated['twitter'];
            $general->email = $validated['email'];
            $general->address = $validated['address'];
            $general->map = $validated['map'];
            $general->popup = $validated['popup'];
            $general->website_color = $validated['website_color'];
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->logo->getClientOriginalName(),
                    'public'
                );
                $general->logo = $path;
            }
            if ($request->hasFile('logo_secondary')) {
                $path1 = $request->file('logo_secondary')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->logo_secondary->getClientOriginalName(),
                    'public'
                );
                $general->logo_secondary = $path1;
            }
            if ($request->hasFile('logo_third')) {
                $path1 = $request->file('logo_third')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->logo_third->getClientOriginalName(),
                    'public'
                );
                $general->logo_third = $path1;
            }
            if ($request->hasFile('logo_fourth')) {
                $path3 = $request->file('logo_fourth')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->logo_fourth->getClientOriginalName(),
                    'public'
                );
                $general->logo_fourth = $path3;
            }
            if ($request->hasFile('favicon')) {
                $path2 = $request->file('favicon')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->favicon->getClientOriginalName(),
                    'public'
                );
                $general->favicon = $path2;
            }
            $res = $general->save();

        if($res){
            return redirect()->back()->with('success', 'Details Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }

    public function home()
    {
        $home_settings = HomeSettings::first();
        return view('admin.settings.home', ['home_settings' => $home_settings]);
    }
    public function store_home(Request $request)
    {

        $validated = $request->validate([
            'testdrive_text' => 'sometimes|required|max:100',
            'insurance_text' => 'sometimes|required|max:100',
            'exchange_text' => 'sometimes|required|max:100',
            'service_text' => 'sometimes|required|max:100',
            'testdrive_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'exchange_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'insurance_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'service_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'contact_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'background_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',

        ]);

            $home = HomeSettings::firstOrCreate();
            $home->testdrive_text = $validated['testdrive_text'];
            $home->insurance_text = $validated['insurance_text'];
            $home->exchange_text =  $validated['exchange_text'];
            $home->service_text = $validated['service_text'];
            $home->seo_title = $validated['seo_title'];
            $home->seo_description = $validated['seo_description'];
            $home->seo_keywords = $validated['seo_keywords'];
            if ($request->hasFile('testdrive_image')) {
                $path = $request->file('testdrive_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->testdrive_image->getClientOriginalName(),
                    'public'
                );
                $home->testdrive_image = $path;
            }
            if ($request->hasFile('exchange_image')) {
                $path1 = $request->file('exchange_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->exchange_image->getClientOriginalName(),
                    'public'
                );
                $home->exchange_image = $path1;
            }
            if ($request->hasFile('service_image')) {
                $path1 = $request->file('service_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->service_image->getClientOriginalName(),
                    'public'
                );
                $home->service_image = $path1;
            }
            if ($request->hasFile('insurance_image')) {
                $path1 = $request->file('insurance_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->insurance_image->getClientOriginalName(),
                    'public'
                );
                $home->insurance_image = $path1;
            }
            if ($request->hasFile('contact_image')) {
                $path1 = $request->file('contact_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->contact_image->getClientOriginalName(),
                    'public'
                );
                $home->contact_image = $path1;
            }
            if ($request->hasFile('background_image')) {
                $path1 = $request->file('background_image')->storeAs(
                    'upload/site',
                    carbon::today()->toDateString(). '_' . $request->background_image->getClientOriginalName(),
                    'public'
                );
                $home->background_image = $path1;
            }

            $res = $home->save();

        if($res){
            return redirect()->back()->with('success', 'Details Updated successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }

}
