<?php
namespace sdupoy\fp;

interface ILibraryRepository{
	public function createBook($book);
	public function updateBook($book);
	public function getAllBooks();
	public function getBookById($id);
	public function getBooksByAuthor($author);
	public function searchBooks($title);
	public function deleteBook($id);
	
	public function createUser($user);
	public function updateUser($user);
	public function getAllUsers();
	public function getUserById($id);
	public function searchUsers($info);
	
	public function logUserIn($username, $password);
	public function isUserInDatabase($username, $email);
	
	public function createCD($cd);
	public function updateCD($cd);
	public function getAllCds();
	public function getCDById($id);
	public function getCdsByArtist($artist);
	public function searchCds($title);
	public function deleteCD($id);
}
?>