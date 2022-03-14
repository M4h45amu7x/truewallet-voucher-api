<?php

/**
 * @author M4h45amu7x
 */

namespace M4h45amu7x;

class Voucher
{

    private $mobile;
    private $voucher;

    private $USER_AGENT = 'Super Idol的笑容 都没你的甜 八月正午的阳光 都没你耀眼 热爱 105 °C的你 滴滴清纯的蒸馏水 你不知道你有多可爱'; // Custom as you want

    public function __construct($mobile, $voucher)
    {
        $this->mobile = $mobile;
        $this->voucher = explode("?v=", $voucher)[1];
    }

    public function verify()
    {
        $url = "https://gift.truemoney.com/campaign/vouchers/$this->voucher/verify?mobile=$this->mobile";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "User-Agent: $this->USER_AGENT"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSLVERSION, 7); // Thanks to Permisz

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

    public function redeem()
    {
        $url = "https://gift.truemoney.com/campaign/vouchers/$this->voucher/redeem";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "User-Agent: $this->USER_AGENT"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSLVERSION, 7); // Thanks to Permisz

        $data = json_encode(array(
            'mobile' => $this->mobile,
            'voucher_hash' => $this->voucher
        ));

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }
}
