PRAGMA foreign_keys = ON;

-- Таблица shop

create table shop
(
    id      INTEGER not null
        constraint shop_pk
            primary key autoincrement,
    name    TEXT    not null,
    address TEXT    not null
);

INSERT INTO shop (name, address) values ('Магнит', 'г. Москва, ул. Юбилейная д .13'),
                                        ('Пятёрочка', 'г. Москва, ул. Свободы д. 78'),
                                        ('Лента', 'г. Москва, ул. Петрозаводская д. 5'),
                                        ('Шанс', 'г. Москва, ул. Строителей д. 25'),
                                        ('Автозаряд', 'г. Москва, ул. Автомобилистов д. 77');

-- Таблица product

create table product
(
    id    INTEGER not null
        constraint product_pk
            primary key autoincrement,
    name  TEXT    not null,
    price REAL    not null,
    count INTEGER not null,
    id_shop integer not null
        constraint id_shop_fk
            references product (id)
);



INSERT INTO product (name, price, count, id_shop) VALUES ('Вода', 12.00, 56, 1),
                                                         ('Мандарины', 9.00, 120, 1),
                                                         ('Сок Апельсиновый', 34.00, 20, 1),
                                                         ('Молоко', 12.00, 139, 1),
                                                         ('Йогурт', 34.00, 31, 1),
                                                         ('Вода', 11.00, 46, 2),
                                                         ('Мандарины', 8.00, 110, 2),
                                                         ('Сок Апельсиновый', 32.00, 28, 2),
                                                         ('Молоко', 13.00, 131, 2),
                                                         ('Йогурт', 30.00, 34, 2),
                                                         ('Вода', 15.00, 78, 3),
                                                         ('Мандарины', 12.00, 156, 3),
                                                         ('Сок Апельсиновый', 38.00, 45, 3),
                                                         ('Молоко', 16.00, 241, 3),
                                                         ('Йогурт', 35.00, 67, 3),
                                                         ('Шуба норковая', 12900.99, 5, 4),
                                                         ('Дубленка', 6900.90, 9, 4),
                                                         ('Шапка норковая', 1490.00, 12, 4),
                                                         ('Перчатки', 900.00, 25, 4),
                                                         ('Пуховик', 3900.00, 12, 4),
                                                         ('Стеклоомывающая жидкость', 5.00, 19, 5),
                                                         ('Огнетушитель', 14.00, 16, 5),
                                                         ('Аптечка', 10.00, 51, 5),
                                                         ('Вода дистиллированная', 3.00, 29, 5),
                                                         ('Стеклоочиститель', 18.00, 109, 5);


-- Таблица client

create table client
(
    id    INTEGER not null
        constraint product_pk
            primary key autoincrement,
    name  TEXT    not null,
    surname TEXT   not null,
    phone TEXT not null
);



INSERT INTO client (name, surname, phone) VALUES ('Иван', 'Петухов', '+79041203478'),
                                                 ('Анастасия', 'Кондратьева', '+79086205641'),
                                                 ('Ирина', 'Козлова', '+79125664290'),
                                                 ('Олег', 'Морозов', '+79651708444'),
                                                 ('Виктор', 'Можегов', '+79098803269');

-- Таблица order

create table orderTable
(
    id         integer not null
        constraint order_pk
            primary key autoincrement,
    created_at TEXT    not null,
    shop_id    integer not null
        constraint order___fk_shop_id
            references shop (id),
    client_id  integer not null
        constraint order___fk_client_id
            references client (id)
);

INSERT INTO orderTable (created_at, shop_id, client_id) VALUES ('20230131123109', 1, 1),
                                                               ('20230202110402', 2, 2),
                                                               ('20230203100405', 3, 3),
                                                               ('20230205234511', 4, 4),
                                                               ('20230207193348', 5, 5);




-- Таблица order_product

create table order_product
(
    id         integer not null
        constraint order_product_pk
            primary key,
    id_order   integer not null
        constraint order_product_order_null_fk
            references orderTable (id),
    id_product integer not null
        constraint order_product_product_null_fk
            references product (id),
    id_shop    integer not null
        constraint order_product_shop_null_fk
            references shop (id)
);





INSERT INTO order_product (id_order, id_product, id_shop) VALUES (1, 1, 1),
                                                                 (1, 2, 1),
                                                                 (1, 5, 1),
                                                                 (2, 6, 2),
                                                                 (2, 7, 2),
                                                                 (3, 11, 3),
                                                                 (3, 12, 3),
                                                                 (4, 16, 4),
                                                                 (5, 25, 5);


SELECT op.id_order "Номер заказа", p.name "Название продукта", p.price "Цена", s.name "Магазин" FROM order_product op
                                                                                                         JOIN product p on op.id_product = p.id
                                                                                                         JOIN shop s on s.id = op.id_shop;
