<?php
 // namespace Helper;
//require '../vendor/autoload.php'; 
include('constant.php');
include('apihelper.php');
class ApiHelper
{
    /**
     * fetch data
     * @return String
     */
    public static function processGuzzleRequest($type, $params, $methodName,$redirectForSuccess,$redirectForFailure)
    {
        $apiUrl = API_URL;
        $client = new \GuzzleHttp\Client();
        $res = $client->request($type, $apiUrl . $methodName, [
            'form_params' => $params
        ]);
        
        return $res->getBody();
    }
}

?>
