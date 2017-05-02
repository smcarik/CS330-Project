<?php
	class User{
		var $fname = null;
		var $lname = null;
		var $uname = null;
		var $role = null;
		
		public function __construct($fn,$ln,$un){
			$this->fname = $fn;
			$this->lname = $ln;
			$this->uname = $un;
		}
		
		public function setFName($fn){
			$this->fname = $fn;
		}
		
		public function getFName(){
			return $this->fname;
		}
		public function setLName($fn){
			$this->lname = $fn;
		}
		
		public function getLName(){
			return $this->lname;
		}
		public function setUName($fn){
			$this->uname = $fn;
		}
		
		public function getUName(){
			return $this->uname;
		}
		
		public function getRole()
		{
			return $this->role;
		}
		
		public function setRole($role)
		{
			$this->role = $role;
		}
	}
?>