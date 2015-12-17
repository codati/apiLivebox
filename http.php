<?php

/**
 * Description of recuperation
 *
 * @author codati
 */
class http {

    private $curl;
    private $cookie;
    private $context;
    public $addr;
    private $isPost = false;

    function __construct($addr = "192.168.1.1") {
        $this->addr = $addr;
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(CURLOPT_RETURNTRANSFER => TRUE, CURLOPT_COOKIEJAR => $this->cookie, CURLOPT_COOKIEFILE => $this->cookie));
    }

    private function setPostMode($data = " ") {
        if (!$this->isPost) {
            $this->isPost = true;
            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "POST");
        }
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
    }

    private function setGetMode() {
        if ($this->isPost) {
            $this->isPost = false;
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, false);
            curl_setopt($this->curl, CURLOPT_HTTPGET, true);
        }
    }

    function connection($password, $login = 'admin') {
        $this->setPostMode();
        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/authenticate?username=' . $login . '&password=' . $password);
        $content = curl_exec($this->curl);
        $json = json_decode($content);
        //  print_r($json);
        if ($json->status != 0) {
            throw new Exception("login error");
        }
        $this->context = $json->data->contextID;
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('X-Context: ' . $this->context));
    }

    function changeIp() {
        $this->setPostMode('{"parameters":{"WanMode":"DSL_PPP"}}');


        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/sysbus/NMC:setWanMode');
        $content = curl_exec($this->curl);
        $json = json_decode($content);
        if (!$json->status) {
            throw new Exception("changeIp error");
        }
    }

    function getExternalIp() {
        $this->setPostMode('{"parameters":{}}');
        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/sysbus/NMC:getWANStatus');
        $content = curl_exec($this->curl);
        $json = json_decode($content);
        //     print_r($json);
        if ($json->data->ConnectionState != "Connected") {
            return false;
        } else {
            return $json->data->IPAddress;
        }
    }
    function getInformationWifi() {
        $this->setPostMode('{"parameters":{"mibs":"wlanradio","flag":"wlanradio","traverse":"down"}}');
        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/sysbus/NeMo/Intf/lan:getMIBs');
        $content = curl_exec($this->curl);
        $json = json_decode($content);
//            print_r($json);
        return $json->status->wlanradio->wifi0_ath;
    }

    function scanWifiCanalAuto() {
        $this->setPostMode('{"parameters":{}}');
        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/sysbus/NeMo/Intf/wifi0_ath:startAutoChannelSelection');
        $content = curl_exec($this->curl);
        $json = json_decode($content);
       //var_dump($json);
    }
    function reboot()
    {
        $this->setPostMode('{"parameters":{}}');
        curl_setopt($this->curl, CURLOPT_URL, 'http://' . $this->addr . '/sysbus/NMC:reboot');
        $content = curl_exec($this->curl);
        $json = json_decode($content);
        if (!$json->status) {
            throw new Exception("reboot error");
        }
    }
}
