DROP TABLE IF EXISTS users;
CREATE TABLE users(
	username VARCHAR(100) PRIMARY KEY,
	password VARCHAR(100) NOT NULL,
	name VARCHAR(100),
	email VARCHAR(100),
	phone VARCHAR(100));

INSERT INTO users(username, password) VALUES('admin', md5('12345'));
