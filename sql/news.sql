CREATE TABLE news
(
    id      int AUTO_INCREMENT PRIMARY KEY,
    name    varchar(255) not null,
    image   varchar(255) not null unique,
    content text
)