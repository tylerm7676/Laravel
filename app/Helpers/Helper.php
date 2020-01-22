<?php

if (!function_exists('search_ebay_products')) {
    /**
     *
     * */
    function search_ebay_products($query)
    {   
        $curl = curl_init();
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<findItemsByKeywordsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\r\n  <keywords>{$query}</keywords>\r\n  <paginationInput>\r\n    <entriesPerPage>25</entriesPerPage>\r\n  </paginationInput>\r\n</findItemsByKeywordsRequest>\r\n";;

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://svcs.ebay.com/services/search/FindingService/v1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $xml,
        CURLOPT_HTTPHEADER => array(
            "X-EBAY-SOA-OPERATION-NAME: findItemsByKeywords",
            "X-EBAY-SOA-SECURITY-APPNAME: NerdyCyc-F19Team0-PRD-03882c1d0-978885f5"
        ),
        ));

        $response = curl_exec($curl);
        return $response;
    }

}
?>