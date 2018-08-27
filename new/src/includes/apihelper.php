<?php
 // namespace Helper;
require '../vendor/autoload.php'; 
include('constant.php');
class ApiHelper
{
    /**
     * fetch data
     * @return String
     */
    public static function getApiResponse($type, $params, $methodName)
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
