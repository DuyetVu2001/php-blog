<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_errno) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// CREATE DATABASE
$sql_drop_db = "DROP DATABASE IF EXISTS blog_db";
$sql_create_db = "CREATE DATABASE blog_db";
$sql_select_db = "USE blog_db";

$sql_create_table_user = "CREATE TABLE User ( 
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            username VARCHAR(30) NOT NULL,
                            firstname VARCHAR(30) NOT NULL,
                            lastname VARCHAR(30) NOT NULL,
                            email VARCHAR(50),
                            created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                          )";

$sql_create_table_genre = "CREATE TABLE Genre ( 
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(30) NOT NULL
                          )";

$sql_create_table_article = "CREATE TABLE Article ( 
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            userId INT(6) UNSIGNED NOT NULL,
                            genreId INT(6) UNSIGNED NOT NULL,
                            title VARCHAR(30) NOT NULL,
                            content LONGTEXT NOT NULL,
                            summary TEXT,
                            created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            FOREIGN KEY (userId) REFERENCES User(id),
                            FOREIGN KEY (genreId) REFERENCES Genre(id)
                          )";

if (
  $conn->query($sql_drop_db) === TRUE
  && $conn->query($sql_create_db) === TRUE
  && $conn->query($sql_select_db) === TRUE
  && $conn->query($sql_create_table_user) === TRUE
  && $conn->query($sql_create_table_genre) === TRUE
  && $conn->query($sql_create_table_article) === TRUE
) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

// INSERT DATA
$sql_insert_user = "INSERT INTO User (email, username, firstname, lastname)
                    VALUES ('Vũ Ngọc Duyệt', 'vungocduyet', 'Vũ', 'Ngọc Duyệt'),
                            ('Đỗ Đức Hiếu', 'docduhieu', 'Đỗ', 'Đức Hiếu'),
                            ('Hoàng Tuấn Hà', 'hoangtuanha', 'Hoàng', 'Tuấn Hà'),
                            ('Trần Văn Hậu', 'tranvanhau', 'Trần', 'Văn Hậu')";

$sql_insert_genre = "INSERT INTO Genre (name)
                    VALUES ('life'),
                            ('action')";

$sql_insert_article = "INSERT INTO Article(userId, genreId, title, content, summary)
                        VALUES (1, 1, 'Đức Hiếu', 'Đức Hiếu là một nhà văn đầu tiên được đọc trên thế giới', 'Đức Hiếu là một nhà văn đầu tiên được đọc trên thế giới'),
                                (2, 2, 'Trần Văn Hậu', 'Trần Văn Hậu là một nhà văn đầu tiên được đọc trên thế giới', 'Trần Văn Hậu là một nhà văn đầu tiên được đọc trên thế giới'),
                                (3, 2, 'Hoàng Tuấn Hà', 'Hoàng Tuấn Hà là một nhà văn đầu tiên được đọc trên thế giới', 'Hoàng Tuấn Hà là một nhà văn đầu tiên được đọc trên thế giới'),
                                (4, 1, 'Vũ Ngọc Duyệt', 'Vũ Ngọc Duyệt là một nhà văn đầu tiên được đọc trên thế giới', 'Hoàng Tuấn Hà là một nhà văn đầu tiên được đọc trên thế giới')";

if (
  $conn->query($sql_insert_user) === TRUE
  && $conn->query($sql_insert_genre) === TRUE
  && $conn->query($sql_insert_article) === TRUE
) {
  echo "Data inserted successfully";
} else {
  echo "Error inserting data: " . $conn->error;
}

$conn->close();
