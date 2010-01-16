CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL,
    UNIQUE (
       name
    )
);
CREATE TABLE config (
    name VARCHAR(50) NOT NULL ,
    value VARCHAR(200) NOT NULL ,
    PRIMARY KEY ( name )
)