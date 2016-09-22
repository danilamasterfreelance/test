<?php

class Transport{
   public $type;
   public $speed;
   public $year;
   public $license;
   public $personal_chair;
   
   public function __construct($type, $speed, $year, $license, $personal_chair){
      $this->type = $type;
	  $this->speed = $speed;
	  $this->year = $year;
	  $this->license = $license;
	  $this->personal_chair = $personal_chair;
   }
   public function getType(){
      $base = "Тип - $this->type";
	  return $base;
   }
   public function getSpeed(){
      $base = "Скорость - $this->speed км/ч";
	  return $base;
   }
   public function getYear(){
      $base = "Год выпуска - $this->year";
	  return $base;
   }
   public function getLicense(){
      $base = "Требуемые права - $this->license";
	  return $base;
   }
   public function getInfo(){
      $base = "{$this->getType()}<br>";
	  $base .= "{$this->getSpeed()}<br>";
	  $base .= "{$this->getYear()}<br>";
	  $base .= "{$this->getLicense()}<br>";
	  return $base;
   }
   
}
class cargoTransport extends Transport {
   public function getPersonalChair(){
      return "Грузоподъемность - $this->personal_chair";
   }
   public function getInfo(){
      $base = parent::getInfo();
	  $base .= "{$this->getPersonalChair()}<br>";
	  return $base;
   }
}
class passengerTransport extends Transport {
   public function getPersonalChair(){
      return "пасажировместимость - $this->personal_chair - мест";
   }
   public function getInfo(){
      $base = parent::getInfo();
	  $base .= "{$this->getPersonalChair()}<br>";
	  return $base;
   }
}
class automobileTransport extends Transport {
   public function getPersonalChair(){
      return "Количество мест - $this->personal_chair";
   }
   public function getInfo(){
      $base = parent::getInfo();
	  $base .= "{$this->getPersonalChair()}<br>";
	  return $base;
   }
}
class motorcycleTransport extends Transport {
   public function getPersonalChair(){
      return "Количество мест - $this->personal_chair";
   }
   
   public function getInfo(){
      $base = parent::getInfo();
	  $base .= "{$this->getPersonalChair()}<br>";
	  return $base;
   }
}
class yachtTransport extends Transport {
   public function getPersonalChair(){
      return "Количество кают - $this->personal_chair";
   }
   public function getInfo(){
      $base = parent::getInfo();
	  $base .= "{$this->getPersonalChair()}<br>";
	  return $base;
   }
}


?>