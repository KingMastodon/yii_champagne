<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\GoalsApis;
use app\models\GoalsLog;
use yii\httpclient\Client;


class GoalApiProvider extends Model
{
    public string $baseUrl;
    public string $idParamName;
    public string $goalParamName;
    public string $priceParamName;
    public string $requestType;

    public int $goalId;
    public string $goalContent;
    public int $goalPrice;


    
    public function __construct(GoalsApis $goalsApis, GoalsLog $goalsLog)
    {
        parent::__construct([]);
        $this->baseUrl = $goalsApis->base_url;
        $this->idParamName = $goalsApis->id_param_name;
        $this->goalParamName = $goalsApis->goal_param_name;
        $this->priceParamName = $goalsApis->price_param_name;
        $this->requestType = $goalsApis->request_type;

        $this->goalId = $goalsLog->id;
        $this->goalContent = $goalsLog->goal;
        $this->goalPrice = $goalsLog->price;
    }


    public function createHttpClientRequest()
    {
        $data = [
            $this->idParamName => $this->goalId,
            $this->goalParamName => $this->goalContent,
            $this->priceParamName => $this->goalPrice        
        ];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod($this->requestType)
            ->setUrl($this->baseUrl)
            ->setData($data)
            ->send();
        return $response;
    }
}
