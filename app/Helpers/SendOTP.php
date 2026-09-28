<?php


namespace App\Helpers;

class SendOTP
{
    public static function send($mode, $enquiry,$phone, $otp)
    {
                // $message = 'Your%20OTP%20Verification%20Code%20is%20'.$otp;
                // $otpsend = json_decode(file_get_contents('http://alvosms.popularmaruti.com/api/v1/send?token=1hl6rg0j72and8mfibosz94ewck5pv&numbers='.$phone.'&route=2&message='.$message.'&sender=PVSWEB&template-id=1207161597206619359'), true);
                if($otpsend['success']) {
                    $var = 'otp' . $phone;
                    session([$var => $otp]);
                    return response()->json([
                        'status' => true,
                        'otp' => $otp,
                        'mode' => $mode,
                        'id' => $enquiry->id
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'mode' => $mode,
                        'id' => $enquiry->id,
                        'message' => 'Failed to send OTP'
                    ]);
                }
    }
}
