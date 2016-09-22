<?php

class Payeer{
   private $m_shop; 
   private $m_orderid;
   private $m_amount;
   private $m_curr;
   private $m_desc;
   private $m_key;
   private $sign;
   private $sign_hach;
   public function __construct(){
      $this->m_shop = 236195956; // номер магазина
	  $this->m_orderid = 1; // персональный номер заказа
	  $this->m_amount = 1; // цена
	  $this->m_curr = "RUB"; // валюта
	  $this->m_desc = "Test"; // описание
	  $this->m_key = "123456789"; // секретный ключ
      $this->settings($this->m_shop, $this->m_orderid, $this->m_amount, $this->m_curr, $this->m_desc, $this->m_key);
   }
   /*
   Иницилизируем ключ SIGN 
   */
   public function settings($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc, $m_key){
      $this->m_shop = $m_shop;
	  $this->m_orderid = $m_orderid;
	  $this->m_amount = number_format($m_amount, 2, '.', '');
	  $this->m_curr = $m_curr;
	  $this->m_desc = base64_encode($m_desc);
	  $this->m_key = $m_key;
	  $arHash = array(
	     $this->m_shop,
	     $this->m_orderid,
	     $this->m_amount,
	     $this->m_curr,
	     $this->m_desc,
	     $this->m_key
      );
	  $this->sign = strtoupper(hash('sha256', implode(':', $arHash)));
   }
   /*
   Вывод формы
   */
   public function viewForm(){
      $base = "<form method='GET' action='https://payeer.com/merchant/'>";
	  $base .= "<input type='hidden' name='m_shop' value='$this->m_shop'>";
	  $base .= "<input type='hidden' name='m_orderid' value='$this->m_orderid'>";
	  $base .= "<input type='hidden' name='m_amount' value='$this->m_amount'>";
	  $base .= "<input type='hidden' name='m_curr' value='$this->m_curr'>";
	  $base .= "<input type='hidden' name='m_desc' value='$this->m_desc'>";
	  $base .= "<input type='hidden' name='m_sign' value='$this->sign'>";
	  $base .= "<input type='submit' name='m_process' value='send' />";
	  $base .= "</form>";
	  return $base;
   }
   /*
   Обработчик
   */
   public function getStatus(){ 
      if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189'))) return;
      
      if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])){
         $arHash = array($_POST['m_operation_id'],
		    $_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$this->m_key
		 );
		 $this->sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
	     if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success'){
		    echo $_POST['m_orderid'].'|success';
		    exit;
         }
	     echo $_POST['m_orderid'].'|error';
      }
   }
   
   /*
   Успешное выполнение оплаты
   */
   public function getSuccess(){ 
      $base = "Оплата успешно проведена";
	  return $base;
   }
   /*
   Ошибка при оплате
   */
   public function getFail(){ // неуспешное выполнение скрипта
      $base = "При оплате возникла ошибка";
	  return $base;
   }
   /*
   Формирование ссылки
   */
   public function createUrl(){
      return "https://payeer.com/merchant/?m_shop=$this->m_shop&m_orderid=$this->m_orderid&m_amount=$this->m_amount&m_curr=$this->m_curr&m_desc=$this->m_desc&m_sign={$this->sign}&tocken=".md5($_SESSION['token_auth']);
   }
   /*
   вызов автоматическое переадресации
   */
   public function readdressing(){
      
      $plan = new Plans($_GET['id']);
      $this->settings($this->m_shop, md5($_SESSION['token_auth']."123"), $this->m_amount, $this->m_curr, "Тарифный план - {$plan->get_title_plan()} (депозит - {$plan->get_deposit()})", $this->m_key);
      $base = header("Location: {$this->createUrl()}");
      return $base;
   }
}

?>