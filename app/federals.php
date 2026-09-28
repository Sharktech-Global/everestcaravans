<?php


if (!function_exists('randString')) {
    function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }

        return $str;
    }
}

if (!function_exists('processFederalPayment')) {
    function processFederalPayment($uuid, $amount, $route)
    {
        $obj = new \AWLMEAPI;
        $reqMsgDTO = new \ReqMsgDTO();
        $reqMsgDTO->setOrderId(randString(25));
        $reqMsgDTO->setMid(config('federal.merchant_id'));
        $reqMsgDTO->setTrnAmt((int) $amount);
        $reqMsgDTO->setTrnCurrency("INR");
        $reqMsgDTO->setMeTransReqType("S");
        $reqMsgDTO->setEnckey(config('federal.encryption_key'));
        $reqMsgDTO->setResponseUrl($route);
        $reqMsgDTO->setTrnRemarks("VSSKerala registration payment");
        $reqMsgDTO->setAddField1($uuid);
        $reqMsgDTO->setAddField2("");
        $reqMsgDTO->setAddField3("");
        $reqMsgDTO->setAddField4("");
        $reqMsgDTO->setAddField5("");
        $reqMsgDTO->setAddField6("");
        $reqMsgDTO->setAddField7("");
        $reqMsgDTO->setAddField8("");
        $reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
        if (config('federal.live_active')) {
            $action_url = config('federal.action_urls.live');
        } else {
            $action_url = config('federal.action_urls.test');
        }
        return ['reqMsgDTO' => $reqMsgDTO, 'action_url' => $action_url];
    }
}

if (!function_exists('requestFederalPayment')) {
    function requestFederalPayment($responseMerchant)
    {
        $obj = new \AWLMEAPI();
        $resMsgDTO = new \ResMsgDTO();
        $enc_key = config('federal.encryption_key');
        $response = $obj->parseTrnResMsg($responseMerchant, $enc_key);
        return $response;
    }
}
