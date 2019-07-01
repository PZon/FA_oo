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
 
 class ContentRegisterForm{
	 private $framework;
	 private $registerForm;
	 
	 public function __construct(){
		 $this->framework=new Framework();
		 $this->registerForm=new RegisterForm();
	 }
	 
	 public function displayPageContents(){
		 $this->framework->displayTopPage();
		 $this->registerForm->displayRegisterForm();
		 $this->framework->displayBottomPage();
	 }
 }
 
 class ContentStatement{
	 
 }