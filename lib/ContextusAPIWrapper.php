<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContextusAPIWrapper
 *
 * @author peirano357
 */

namespace ContextusAPIWrapper;

class ContextusAPIWrapper {

    private $url;
    private $client_id;
    private $client_secret;
    private $images_basepath;

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

    public function setClientSecret($client_secret) {
        $this->client_secret = $client_secret;
    }

    public function setImagesBasepath($images_basepath) {
        $this->images_basepath = $images_basepath;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function getClientSecret() {
        return $this->client_secret;
    }

    public function getImagesBasepath() {
        return $this->images_basepath;
    }

    public function getLoginToken() {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUrl() . "/api/v1/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"grant_type\"\r\n\r\nclient_credentials\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($this->getClientId() . ':' . $this->getClientSecret()),
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: ea86572d-5fa2-c37f-bead-0b610fa01bab"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {

            $access_token = json_decode($response, true);
            $access_token = $access_token['access_token'];
            return $access_token;
        }
    }

    /**
     * 
     * @param string $token
     * @param array $paransArr
     * @return array
     */
    public function getClientProducts($token, $paramsArr) {

        $paramsArr = $this->arrangeParamsForFilter($paramsArr);
        $result = [];

        // recursively call to the endpoint on different pages:  // $params['paging_limit']
        $processed = 0;
        do {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->getUrl() . '/api/v1/products?access_token=' . $token,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => json_encode($paramsArr),
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                ),
            ));
            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $result = array_merge($result, $response['body']['items']);
            $totalProducts = $response['body']['paging']['total'];

            // update offset/pagination for the next run
            $paramsArr["paging"]["offset"] = $paramsArr["paging"]["offset"] + $paramsArr["paging"]["limit"];

            $processed = count($result);

            $err = curl_error($curl);
        } while ($processed < $totalProducts);

        return $result;
    }

    /**
     * 
     * @param type $arrParams
     * @return array
      $data = [
      "filter" => [
      "name" => "%Malbec%"
      ],
      "price" => [
      "min" => 0,
      "max" => 99999999
      ],
      "sort"=> [
      "key" => "09",
      "direction" => "asc"
      ],
      "paging" => [
      "offset" => 0,
      "limit" =>10
      ]
      ];
     */
    private function arrangeParamsForFilter($arrParams) {

        $result = [];

        $arrParams['size'] = 'large';

        if (isset($arrParams['name']) && $arrParams['name'] != '') {
            $result["filter"]["name"] = $arrParams['name'];
        }

        $result["price"] = [];

        if (isset($arrParams['price_max']) && $arrParams['price_max'] != '' && is_numeric($arrParams['price_max'])) {
            $result["price"]["max"] = $arrParams['price_max'];
        }

        if (isset($arrParams['price_min']) && $arrParams['price_min'] != '' && is_numeric($arrParams['price_min'])) {
            $result["price"]["min"] = $arrParams['price_min'];
        }

        $result["sort"] = [];

        if (isset($arrParams['sort_direction']) && $arrParams['sort_direction']) {
            $result["sort"]["direction"] = $arrParams['sort_direction'];
        }

        if (isset($arrParams['sort_key']) && $arrParams['sort_key']) {
            $result["sort"]["key"] = $arrParams['sort_key'];
        }


        $result["paging"] = [];

        if (isset($arrParams['paging_offset']) && is_numeric($arrParams['paging_offset'])) {
            $result["paging"]["offset"] = $arrParams['paging_offset'];
        }

        if (isset($arrParams['paging_limit']) && is_numeric($arrParams['paging_limit'])) {
            $result["paging"]["limit"] = $arrParams['paging_limit'];
        }

        return $result;
    }

}
