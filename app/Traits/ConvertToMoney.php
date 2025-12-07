<?php
namespace App\Traits;

trait ConvertToMoney {
    public function getMoniAndCoin($moni){
        $data = $moni - floor($moni);
        $coins = floor($data*100);
        $strCoin = (string)$coins;
        $value = 0;
        if(strlen($strCoin)==1){
            $value= floor($moni).'.0'.$coins;
        }else{
            $value= floor($moni).'.'.$coins;
        }        
        return $value;
    }
}
