<?php
namespace sdupoy\fp;

require_once 'ILibraryRepository.php';
require_once 'Book.php';
require_once 'User.php';
require_once 'CD.php';

class SqliteLibraryRepository implements ILibraryRepository{
	private $dbfile = 'data/library_db_pdo.sqlite';
    private $db;
	
	public function __construct(){
        $this->db = new \PDO('sqlite:' . $this->dbfile);
        $this->db->exec("CREATE TABLE IF NOT EXISTS Books (Id INTEGER PRIMARY KEY, Author TEXT, Title TEXT, Isbn TEXT, Year INTEGER, Publisher TEXT, Summary TEXT, Available BOOLEAN)");
		$this->db->exec("CREATE TABLE IF NOT EXISTS CDs (Id INTEGER PRIMARY KEY, Artist TEXT, Title TEXT, NbTracks INTEGER, Year INTEGER, Available BOOLEAN)");
		$this->db->exec("CREATE TABLE IF NOT EXISTS Users (Id INTEGER PRIMARY KEY, Username TEXT, FirstName TEXT, LastName TEXT, Password TEXT, Email TEXT, Role TEXT)");
    }
		
	public function logUserIn($username, $password){
		
		
		$query = $this->db->prepare('SELECT * FROM Users WHERE Username=:username OR Email=:username LIMIT 1;');
		$query->bindParam(':username', $username);
		$query->execute();
        $query = $query->fetchObject();
        if ($query) {
            if (password_verify($password, $query->Password)) {
				$_SESSION['username'] = $query->Username;
				$_SESSION['firstName'] = $query->FirstName;
				$_SESSION['lastName'] = $query->LastName;
				$_SESSION['email'] = $query->Email;
				$_SESSION['role'] = $query->Role;
				session_write_close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
	}
	
	public function createUser($user){
		$username = $user->getUsername();
		$firstName = $user->getFirstName();
		$lastName = $user->getLastName();
		$email = $user->getEmail();
		$role = $user->getRole();
		$password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
		$query = $this->db->prepare("INSERT INTO Users (Username, FirstName, LastName, Password, Email, Role) VALUES (:username,:firstName,:lastName, :password, :email, :role);");
		$query->bindParam(':username', $username);
		$query->bindParam(':firstName', $firstName);
		$query->bindParam(':lastName', $lastName);
		$query->bindParam(':password', $password);
		$query->bindParam(':email', $email);
		$query->bindParam(':role', $role);
		$query->execute();
		
	}
	
	public function isUserInDatabase($username, $email){
		$test = $this->db->prepare("SELECT * FROM Users WHERE Username=:username OR Email=:email;");
		$test->bindParam(':username', $username);
		$test->bindParam(':email', $email);
		$test->execute();
		$count=0;
		foreach($test as $row) {
            $count +=1;
        }
		if($count!=0){
			return true;
		} else{
			return false;
		}
		
	}
	
	public function getAllUsers()
    {
        $userList = array();
        $result = $this->db->query("SELECT * FROM Users;");
        foreach($result as $row) {
            $aUser = new User();
			$aUser->setId($row['Id']);
			$aUser->setUsername($row['Username']);
            $aUser->setFirstName($row['FirstName']);
            $aUser->setLastName($row['LastName']);
			$aUser->setPassword($row['Password']);
			$aUser->setEmail($row['Email']);
			$aUser->setRole($row['Role']);
            $userList[$aUser->getId()] = $aUser;
        }
        return $userList;
    }
	
	public function getUserById($id){
		$usersList = $this->getAllUsers();
        if (array_key_exists($id, $usersList)) {
            return $usersList[$id];
        }
	}
	
	public function updateUser($user){
		$username = $user->getUsername();
		$firstName = $user->getFirstName();
		$lastName = $user->getLastName();
		$email = $user->getEmail();
		$role = $user->getRole();
		$passwordNotHashed = $user->getPassword();
		$password = password_hash($passwordNotHashed, PASSWORD_BCRYPT);
		$id = $user->getId();
		
		$query = $this->db->prepare('UPDATE Users SET Username=:username, FirstName=:firstName, LastName=:lastName, Password=:password, Email=:email, Role=:role WHERE Id = $id;');
		$query->bindParam(':username', $username);
		$query->bindParam(':firstName', $firstName);
		$query->bindParam(':lastName', $lastName);
		$query->bindParam(':password', $password);
		$query->bindParam(':email', $email);
		$query->bindParam(':role', $role);
		$query->execute();
		
	}
	
	public function deleteUser($id){
		$usersList = $this->getAllUsers();
        if (array_key_exists($id, $usersList)) {
			$this->db->exec("DELETE FROM Users WHERE Id=$id;");
        }
	}
	
	public function searchUsers($info){
		$usersList = array();
		
        $query = $this->db->prepare("SELECT * FROM Users WHERE Username LIKE :info OR Email LIKE :info OR LastName LIKE :info OR FirstName LIKE :info;");
		$info='%'.$info.'%';
		$query->bindParam(':info', $info);
		$query->execute();
        foreach($query as $row) {
            $aUser = new User();
			$aUser->setId($row['Id']);
			$aUser->setUsername($row['Username']);
            $aUser->setFirstName($row['FirstName']);
            $aUser->setLastName($row['LastName']);
			$aUser->setPassword($row['Password']);
			$aUser->setEmail($row['Email']);
			$aUser->setRole($row['Role']);
            $usersList[$aUser->getId()] = $aUser;
        }
        return $usersList;
	}
	
	public function createBook($book){
		$author = $book->getAuthor();
		$title = $book->getTitle();
		$isbn = $book->getIsbn();
		$year = $book->getYear();
		$publisher = $book->getPublisher();
		$summary = $book->getSummary();
		$available = $book->getAvailable();
		
		$query = $this->db->prepare("INSERT INTO Books (Author, Title, Isbn, Year, Publisher, Summary, Available) VALUES (:author,:title,'$isbn', '$year', :publisher, :summary,'$available');");
		$query->bindParam(':author', $author);
		$query->bindParam(':title', $title);
		$query->bindParam(':publisher', $publisher);
		$query->bindParam(':summary', $summary);
		$query->execute();
	}
	
	
	public function updateBook($book){
		$author = $book->getAuthor();
		$title = $book->getTitle();
		$isbn = $book->getIsbn();
		$year = $book->getYear();
		$publisher = $book->getPublisher();
		$summary = $book->getSummary();
		$available = $book->getAvailable();
		$id = $book->getId();
		$query = $this->db->prepare("UPDATE Books SET Author=:author, Title=:title, Isbn=:isbn, Year=:year,Publisher=:publisher, Summary=:summary, Available=:available WHERE Id = $id;");
		$query->bindParam(':author', $author);
		$query->bindParam(':title', $title);
		$query->bindParam(':publisher', $publisher);
		$query->bindParam(':summary', $summary);
		$query->bindParam(':isbn', $isbn);
		$query->bindParam(':year', $year);
		$query->bindParam(':available', $available);
		$query->execute();
	}
	
	public function getAllBooks()
    {
        $bookList = array();
        $result = $this->db->query("SELECT * FROM Books;");
        foreach($result as $row) {
            $aBook = new Book();
			$aBook->setId($row['Id']);
			$aBook->setAuthor($row['Author']);
            $aBook->setTitle($row['Title']);
            $aBook->setIsbn($row['Isbn']);
			$aBook->setYear($row['Year']);
			$aBook->setPublisher($row['Publisher']);
			$aBook->setSummary($row['Summary']);
			$aBook->setAvailable($row['Available']);
            $bookList[$aBook->getId()] = $aBook;
        }
        return $bookList;
    }
	
	public function getBookById($id){
		$bookList = $this->getAllBooks();
        if (array_key_exists($id, $bookList)) {
            return $bookList[$id];
        }
	}
	
	public function deleteBook($id){
		$bookList = $this->getAllBooks();
        if (array_key_exists($id, $bookList)) {
			$this->db->exec("DELETE FROM Books WHERE Id=$id;");
        }
	}
	
	public function getBooksByAuthor($author)
    {
        $bookList = array();
        $query = $this->db->prepare("SELECT * FROM Books WHERE Author LIKE :author;");
		$author='%'.$author.'%'; 
		$query->bindParam(':author', $author);
		$query->execute();
        foreach($query as $row) {
            $aBook = new Book();
			$aBook->setId($row['Id']);
			$aBook->setAuthor($row['Author']);
            $aBook->setTitle($row['Title']);
            $aBook->setIsbn($row['Isbn']);
			$aBook->setYear($row['Year']);
			$aBook->setPublisher($row['Publisher']);
			$aBook->setSummary($row['Summary']);
			$aBook->setAvailable($row['Available']);
            $bookList[$aBook->getId()] = $aBook;
        }
        return $bookList;
    }
	
	public function searchBooks($title){
		$bookList = array();
		
        $query = $this->db->prepare("SELECT * FROM Books WHERE Title LIKE :title;");
		$title='%'.$title.'%'; 
		$query->bindParam(':title', $title);
		$query->execute();
        foreach($query as $row) {
            $aBook = new Book();
			$aBook->setId($row['Id']);
			$aBook->setAuthor($row['Author']);
            $aBook->setTitle($row['Title']);
            $aBook->setIsbn($row['Isbn']);
			$aBook->setYear($row['Year']);
			$aBook->setPublisher($row['Publisher']);
			$aBook->setSummary($row['Summary']);
			$aBook->setAvailable($row['Available']);
            $bookList[$aBook->getId()] = $aBook;
        }
        return $bookList;
	}
	
	public function createCD($cd){
		$artist = $cd->getArtist();
		$title = $cd->getTitle();
		$nbTracks = $cd->getNbTracks();
		$year = $cd->getYear();
		$available = $cd->getAvailable();
		$query = $this->db->prepare("INSERT INTO Cds (Artist, Title, NbTracks, Year, Available) VALUES (:artist, :title, '$nbTracks', '$year', '$available');");
		$query->bindParam(':artist', $artist);
		$query->bindParam(':title', $title);
		$query->execute();
	}
	
	public function getAllCds()
    {
        $cdList = array();
        $result = $this->db->query("SELECT * FROM Cds;");
        foreach($result as $row) {
            $aCd = new CD();
			$aCd->setId($row['Id']);
			$aCd->setArtist($row['Artist']);
            $aCd->setTitle($row['Title']);
            $aCd->setNbTracks($row['NbTracks']);
			$aCd->setYear($row['Year']);
			$aCd->setAvailable($row['Available']);
            $cdList[$aCd->getId()] = $aCd;
        }
        return $cdList;
    }
	
	public function updateCD($cd){
		$artist = $cd->getArtist();
		$title = $cd->getTitle();
		$nbTracks = $cd->getNbTracks();
		$year = $cd->getYear();
		$available = $cd->getAvailable();
		$id = $cd->getId();
		$query = $this->db->prepare("UPDATE Cds SET Artist=:artist, Title=:title, NbTracks='$nbTracks', Year='$year',Available='$available' WHERE Id = $id;");
		$query->bindParam(':artist', $artist);
		$query->bindParam(':title', $title);
		$query->execute();
	}
	
	public function getCDById($id){
		$cdList = $this->getAllCds();
        if (array_key_exists($id, $cdList)) {
            return $cdList[$id];
        }
	}
	
	public function getCdsByArtist($artist){
		$cdList = array();
        $query = $this->db->prepare("SELECT * FROM Cds WHERE Artist LIKE :artist;");
		$artist='%'.$artist.'%'; 
		$query->bindParam(':artist', $artist);
		$query->execute();
        foreach($query as $row) {
            $aCd = new CD();
			$aCd->setId($row['Id']);
			$aCd->setArtist($row['Artist']);
            $aCd->setTitle($row['Title']);
            $aCd->setNbTracks($row['NbTracks']);
			$aCd->setYear($row['Year']);
			$aCd->setAvailable($row['Available']);
            $cdList[$aCd->getId()] = $aCd;
        }
        return $cdList;
	}
	
	public function searchCds($title){
		$cdList = array();
		
        $query = $this->db->prepare("SELECT * FROM Cds WHERE Title LIKE :title;");
		$title='%'.$title.'%'; 
		$query->bindParam(':title', $title);
		$query->execute();
        foreach($query as $row) {
            $aCd = new CD();
			$aCd->setId($row['Id']);
			$aCd->setArtist($row['Artist']);
            $aCd->setTitle($row['Title']);
            $aCd->setNbTracks($row['NbTracks']);
			$aCd->setYear($row['Year']);
			$aCd->setAvailable($row['Available']);
            $cdList[$aCd->getId()] = $aCd;
        }
        return $cdList;
	}
	public function deleteCD($id){
		$cdList = $this->getAllCds();
        if (array_key_exists($id, $cdList)) {
			$this->db->exec("DELETE FROM Cds WHERE Id=$id;");
        }
	}
} ?>