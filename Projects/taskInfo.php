<?php

class TaskInfo{
	
	var $usid;
	//var $tid;
	var $desc;
	var $sprint;
	var $taskloc;
	var $perc;
	var $member;
	
	public function __construct($id, $de, $sp, $tl, $pe, $me){
		$this->usid = $id;
		//$this->tid = $tid;
		$this->desc = $de;
		$this->sprint = $sp;
		$this->taskloc = $tl;
		$this->perc = $pe;
		$this->member = $me;
	}
	
	public function getusid(){
		return $this->usid;
	}
	
	public function setusid($us){
		$this->usid = $us;
	}
	
	public function getdesc(){
		return $this->desc;
	}
	
	public function setdesc($de){
		$this->desc = $de;
	}
	
	public function getsprint(){
		return $this->sprint;
	}
	
	public function setsprint($sp){
		$this->sprint = $sp;
	}
	
	public function gettaskloc(){
		return $this->taskloc;
	}
	
	public function settaskloc($tl){
		$this->taskloc = $tl;
	}
	
	public function getperc(){
		return $this->perc;
	}
	
	public function setperc($pe){
		$this->perc = $pe;
	}
	
	public function getmember(){
		return $this->member;
	}
	
	public function setmember($me){
		$this->member = $me;
	}
}

?>