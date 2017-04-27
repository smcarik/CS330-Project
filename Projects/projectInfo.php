<?php
class UserStoryInfo{
	var $id = 0;
	var $asa= null;
	var $iwant = null;
	var $inorderto = null;
	var $accept = null;
	var $size = null;
	var $sprint = 0;
	var $donepercent = 0;
	var $approved = null;
	var $reason = null;
	public function __construct($pos,$as,$iw,$ino,$acc,$si,$spr,$dp,$app,$re){
		$this-> id = $pos;
		$this-> asa = $as;
		$this-> iwant = $iw;
		$this-> inorderto = $ino;
		$this-> accept = $acc;
		$this-> size = $si;
		$this-> sprint = $spr;
		$this-> donepercent = $dp;
		$this-> approved = $app;
		$this-> reason = $re;
	}

	public function setid($i){
		$this->id = $i;
	}

	public function getid(){
		return $this->id;
	}
	public function setasa($a){
		$this->asa = $a;
	}

	public function getasa(){
		return $this->asa;
	}
	public function setiwant($iw){
		$this->$iwant = iw;
	}

	public function getiwant(){
		return $this->iwant;
	}
	
	public function setinorderto($in){
		$this->inorderto = $in;
	}
	
	public function getinorderto(){
		return $this->inorderto;
	}
	
	public function setaccept($acc){
		$this->accept = $acc;
	}
	
	public function getaccept(){
		return $this->accept;
	}
	
	public function setsize($s){
		$this->size = $s;
	}
	
	public function getsize(){
		return $this->size;
	}
	
	public function setsprint($sp){
		$this->sprint = $sp;
	}
	
	public function getsprint(){
		return $this->sprint;
	}
	
	public function setdonepercent($dp){
		$this-> donepercent = $dp;
	}
	
	public function getdonepercent(){
		return $this->donepercent;
	}
	
	public function setapproved($app){
		$this -> approved = $app;
	}
	
	public function getapproved(){
		return $this->approved;
	}
	
	public function setreason($re){
		$this->reason = $re;
	}
	
	public function getreason(){
		return $this->reason;
	}
}
?>