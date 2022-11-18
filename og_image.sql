create table og_image
(
    id           int auto_increment
        primary key,
    title        varchar(50)  null,
    descriptions text         null,
    imgurl       varchar(255) null,
    keyword      varchar(100) null
);
