create table og_image_url
(
    id        int auto_increment
        primary key,
    url_id    int default 1 not null,
    url       text          null,
    short_url text          null,
    constraint id
        unique (id),
    constraint og_image_url_og_image_id_fk
        foreign key (url_id) references og_image (id)
);
