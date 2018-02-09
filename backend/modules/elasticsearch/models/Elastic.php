<?php
namespace backend\modules\elasticsearch\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class Elastic extends Model
{
    public $url;
    public $data = [];

    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    public static function connect($url, $data = [], $requestMethod)
    {
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_POST, true);
        if($data !== []) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, Json::encode($data));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-type: application/json",
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        return [
            'res' => $result,
            'status' => $status,
            'error' => $error
        ];
    }
    /**
     * Product
     */
    public static function product($productId)
    {

    }
}
