<?php
namespace sdupoy\fp;

class CD{
	private $id;
	private $artist = '';
	private $title = '';
	private $nbTracks = '';
	private $year = '';
	private $available ='';
	
	public function __construct(){}
	
	public function getId(){
		return $this->id;
	}
	
    public function setId($id){
        $this->id = $id;
    }
	
	public function getArtist(){
		return $this->artist;
	}
	
    public function setArtist($artist){
        $this->artist = $artist;
    }
	
	public function getTitle(){
		return $this->title;
	}
	
    public function setTitle($title){
        $this->title = $title;
    }
	
	public function getNbTracks(){
		return $this->nbTracks;
	}
	
    public function setNbTracks($nbTracks){
        $this->nbTracks = $nbTracks;
    }
	
	public function getYear(){
		return $this->year;
	}
	
    public function setYear($year){
        $this->year = $year;
    }
	
	public function getAvailable(){
		return $this->available;
	}
	
    public function setAvailable($available){
        $this->available = $available;
    }
	
}