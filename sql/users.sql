CREATE TABLE users
(
    id           int AUTO_INCREMENT PRIMARY KEY,
    name         varchar(255) not null,
    email        varchar(255) not null unique,
    password     varchar(255) not null,
    verified bool
)