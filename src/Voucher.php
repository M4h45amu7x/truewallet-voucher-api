<?php

/**
 * @author M4h45amu7x
 */

namespace M4h45amu7x;

use CurlHandle;

class Voucher
{

    private string $mobile;
    private string $voucher;
    private string $userAgent;

    public function __construct(string $mobile, string $voucher, string $userAgent = '')
    {
        $this->mobile = $mobile;
        $this->voucher = $this->extractVoucherId($voucher);
        $this->userAgent = $userAgent ?: $this->getDefaultUserAgent();
    }

    public function verify(): mixed
    {
        $url = "https://gift.truemoney.com/campaign/vouchers/{$this->voucher}/verify?mobile={$this->mobile}";

        $curl = $this->createCurl($url);
        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp);
    }

    public function redeem(): mixed
    {
        $url = "https://gift.truemoney.com/campaign/vouchers/{$this->voucher}/redeem";

        $curl = $this->createCurl($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->createRedeemRequestBody());
        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp);
    }

    private function createCurl(string $url): CurlHandle
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "User-Agent: {$this->userAgent}"
            ],
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
            // - For debug only! -
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
            // -------------------
        ]);

        return $curl;
    }

    private function extractVoucherId(string $voucher): string
    {
        return explode("?v=", $voucher)[1] ?? '';
    }

    private function createRedeemRequestBody(): string
    {
        $data = [
            'mobile' => $this->mobile,
            'voucher_hash' => $this->voucher
        ];

        return json_encode($data);
    }

    private function getDefaultUserAgent(): string
    {
        return 'Super Idol的笑容 都没你的甜 八月正午的阳光 都没你耀眼 热爱 105 °C的你 滴滴清纯的蒸馏水 你不知道你有多可爱';
    }
}
