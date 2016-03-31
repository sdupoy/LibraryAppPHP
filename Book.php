<?php
namespace sdupoy\fp;

class Book{
	private $id;
	private $author = '';
	private $title = '';
	private $isbn = '';
	private $year = '';
	private $publisher = '';
	private $summary = '';
	private $available ='';
	
	public function __construct(){}
	
	public function getId(){
		return $this->id;
	}
	
    public function setId($id){
        $this->id = $id;
    }
	
	public function getAuthor(){
		return $this->author;
	}
	
    public function setAuthor($author){
        $this->author = $author;
    }
	
	public function getTitle(){
		return $this->title;
	}
	
    public function setTitle($title){
        $this->title = $title;
    }
	
	public function getIsbn(){
		return $this->isbn;
	}
	
    public function setIsbn($isbn){
        $this->isbn = $isbn;
    }
	
	public function getYear(){
		return $this->year;
	}
	
    public function setYear($year){
        $this->year = $year;
    }
	
	public function getPublisher(){
		return $this->publisher;
	}
	
    public function setPublisher($publisher){
        $this->publisher = $publisher;
    }
	
	public function getSummary(){
		return $this->summary;
	}
	
    public function setSummary($summary){
        $this->summary = $summary;
    }
	
	public function getAvailable(){
		return $this->available;
	}
	
    public function setAvailable($available){
        $this->available = $available;
    }
	
}