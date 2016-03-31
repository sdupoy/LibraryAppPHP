<?php
namespace sdupoy\fp;

class User{
	private $id;
	private $username = '';
	private $firstName = '';
	private $lastName = '';
	private $password ='';
	private $email ='';
	private $role ='';
	
	public function __construct(){}

	public function getId(){
		return $this->id;
	}
	
    public function setId($id){
        $this->id = $id;
    }
	
	public function getUsername(){
		return $this->username;
	}
	
    public function setUsername($username){
        $this->username = $username;
    }
	
	public function getFirstName(){
		return $this->firstName;
	}
	
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
	
	public function getLastName(){
		return $this->lastName;
	}
	
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
	
	public function getPassword(){
		return $this->password;
	}
	
    public function setPassword($password){
        $this->password = $password;
    }
	
	public function getEmail(){
		return $this->email;
	}
	
    public function setEmail($email){
        $this->email = $email;
    }
	public function getRole(){
		return $this->role;
	}
	
    public function setRole($role){
        $this->role = $role;
    }
	
}