<?php
//
//Class AtolWebDriver
//{
//    protected $addr="127.0.0.1",$port="16732";
//    public $timeout = 30; //таймаут соединений
//    public $operator;
//
//    function __construct($addr=false,$port=false)
//    {
//        if ($addr!==false) $this->addr=$addr;
//        if ($port!==false) $this->port=$port;
//    }
//
//    public function CallAPI($method, $data,$_url="/requests")
//    {
//        $url = "http://".$this->addr.":".$this->port.$_url;
//        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl,CURLOPT_TIMEOUT, $this->timeout);
//        $headers = ['Content-Type: application/json'];
//        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
//
//        $resp = curl_exec($curl);
//        $data = json_decode($resp,1);
//        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//
//        curl_close($curl);
//
//        $res= [$data,$code,$resp];
//
//        print_r($res);
//        return $res;
//    }
//
//    //получает результат задания
//    public function get_res($uuid)
//    {
//        $ready = false;
//        $cnt=0;
//
//        $res_url = '/requests/'.$uuid;
//
//        while (!$ready && ++$cnt<60)
//        {
//            usleep(500000); //подождем чуть, прежде чем просить ответ
//
//            list($res,$code,$resp) = $this->CallAPI('GET',[],$res_url);
//            $ready = ($res['results'][0]['status'] == 'ready');
//            if ($ready) return $res;
//        }
//
//        return false; //не удалось получить результата
//    }
//
//    //создает задание
//    public function add_req($uuid,$req)
//    {
//        return $this->CallAPI('POST', ['uuid'=>$uuid,'request'=>$req]);
//    }
//
//    //генерирует уникальный id для задания
//    public function gen_uuid()
//    {
//        return exec('uuidgen -r');
//    }
//
//    //выполняет задание и возвращает его результат
//    public function atol_task($type,$req=[])
//    {
//        $req['type'] = $type;
//        $uuid =  $this->gen_uuid();
//
//        $req = $this->add_req($uuid,$req);
//        if ($req[1]!='201') return false; //ошибка добавления
//
//        $res = $this->get_res($uuid);
//        //ошибка результата
//        if ($res===false || !isset($res['results'][0])) return false;
//        return $res['results'][0];
//    }
//
//    /*дальше уже идут конкретные задачи*/
//
//    //статус смены
//    public function get_shift_status()
//    {
//        $res = $this->atol_task('getShiftStatus');
//        if ($res===false) return false;
//        //closed / opened / expired
//        return $res['result']['shiftStatus']['state'];
//    }
//
//    //открытие смены
//    public function open_shift()
//    {
//        $status = $this->get_shift_status();
//        //eсли истекла, то надо закрыть
//        if ($status=="expired") $this->close_shift();
//        if ($status=="opened") return "Не могу открыть открытую смену";
//
//        $res = $this->atol_task('openShift',['operator'=>$this->operator]);
//    }
//
//
//
//    //закрытие смены
//    public function close_shift()
//    {
//        $status = $this->get_shift_status();
//        if ($status=="closed") return "Не могу закрыть закрытую смену";
//
//        $res = $this->atol_task('closeShift',['operator'=>$this->operator]);
//    }
//
//
//    public function items_prepare($items)
//    {
//        $res_items = [];
//        $summ = 0;
//        while ($item = array_shift($items))
//        {
//            $res_item = $item;
//            if (!isset($item['type']))
//                $res_item['type']="position";
//
//            if (isset($item['price']) && isset($item['quantity']))
//            {
//                $res_item['amount'] = $item['price']*$item['quantity'];
//                $res_item['tax'] = ['type'=>'none'];
//                $summ+=$res_item['amount'];
//            }
//
//
//            $res_items[] = $res_item;
//        }
//
//        return [$res_items,$summ];
//    }
//
//
//    //продажа sell, возврат sellReturn
//    public function fiskal($type_op="sell",$items,$pay_type="cash")
//    {
//        $data = [];
//        $data['operator'] = $this->operator;
//        $data['payments'] = [];
//        list($data['items'],$summ) = $this->items_prepare($items);
//
//        //+++тут может быть несколько типов оплаты одновременно
//        $data['payments'][] = ['type'=>$pay_type,'sum'=>$summ];
//
//        $res = $this->atol_task($type_op,$data);
//    }
//
//
//
//}
//
////тут передается ip где крутится web-сервис драйвера Атол, можно еще и порт передать
//$atol = new AtolWebDriver('192.168.100.10');
//
////тут надо фио кассира
//$atol->operator = ['name'=>'сист.администратор'];
//
////составляем массив товаров с количеством и ценой
//$items = [];
//$items[] = ['name'=>'Пакет полиэтиленовый','price'=>0.7,'quantity'=>1];
//$items[] = ['name'=>'Пакет бумажный','price'=>0.4,'quantity'=>1];
//
//
////открываем смену
//$atol->open_shift();
//
////продаем товары
//$atol->fiskal("sell",$items);
//if($atol){
//    echo 'Done';
//}else{
//    echo 'nonesense';
//}
//
//sleep(10); //немного подождем, чтобы успеть оторвать чек
////а теперь сделаем возврат всего этого, т.к. это просто проверка
//$atol->fiskal("sellReturn",$items);
//
////еще подождем перед огромным чеком
//sleep(20);
//
////закрываем смену, печатаем отчет
//$atol->close_shift();