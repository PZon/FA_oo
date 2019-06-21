<?php
 class ContentFrontPage{
	 private $content;
	 private $registerForm;
	 
	 public function __construct(){
		 $this->content=new FrontPage();
		 $this->registerForm=new RegisterFormModal();
	 } 
	
	 public function displayFrontPage(){
		 $this->content->displayDescription();
		 $this->registerForm->displayRegisterFormModal();
	 }
 }