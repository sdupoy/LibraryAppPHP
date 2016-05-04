# LibraryAppPHP

#Author
Simon Dupoy – sdupoy@hawk.iit.edu

#Project description
I decided not to use any framework for this project. I developed a library management application. An admin can log in, create, update and delete users, books and CDs. A librarian can only log in, create, update and delete books and CDs. A client, and the two other types, can search for books or CDs, by consulting the entire list, or search by title or author/artist. A client not registered yet can fill out a form and create an account.

#Development environment
I am on Windows 10, I used Notepad++ to develop this project. I used xampp (Tomcat Apache) for the server side. My PHP version is 5.6.14.

#Installation instructions
There is no special instruction. Of course, apache and tomcat must be running (if you are deploying it locally).

You have 3 users already set:
Mail / Username                            Password
bwillis@expendables.com / admin             adm
cli@lfp.com / client                        cli
lib@lfp.com / librarian                     lib

#Insights and results
Log in as different users with different roles. Log in with the username or with the mail address. With the client, it is mostly consulting what is available or not and do some search. With the librarian, it is possible to add some content and edit the availability. An admin can do everything he wants.
I learned how to handle a session and particularly, in case of redirection to use session_write_close(); to have consistent variable.
For the display, I used Foundation.

#References
PHP Documentation: https://secure.php.net/manual/en/manual.php
StackOverflow. The Panique project for the login.
IIT ITMD 562 course, my work for AS3.
