/*
DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
*/
USE tienda;
CREATE TABLE IF NOT EXISTS users(
    user_id int primary key auto_increment,
    user_email varchar(120) unique not null,
    user_password varchar(180) not null,
    user_status enum('Active','Inactive') DEFAULT 'Active',
    user_privilege enum('Administrator','Salesman') NOT NULL,
    user_temp_password varchar(180),
    user_update_pass enum('N','S') default 'N',
    user_creation timestamp default current_timestamp,
    user_updated timestamp default current_timestamp on update current_timestamp
    );

CREATE TABLE IF NOT EXISTS categories(
    id_category SMALLINT PRIMARY KEY auto_increment,
    name_category VARCHAR(50) NOT NULL,
    desc_category TEXT,
    icon_category VARCHAR(180),
    status_category ENUM('Active','Inactive') DEFAULT 'Active',
    created_category timestamp default current_timestamp,
    update_category timestamp default current_timestamp on update current_timestamp
);

CREATE OR REPLACE VIEW session_vw AS SELECT user_id, user_email, user_update_pass, user_status, user_privilege FROM users;

CREATE TABLE IF NOT EXISTS producto(
    id_producto INT PRIMARY KEY auto_increment,
    name_product VARCHAR(60) NOT NULL,
    price_sell_product double NOT NULL,
    price_buy_product double NOT NULL,
    desc_product text,
    category_id SMALLINT NOT NULL,
    icon_product VARCHAR(180),
    status_product ENUM('Active','Inactive') DEFAULT 'Active',
    created_product timestamp default current_timestamp,
    update_product timestamp default current_timestamp on update current_timestamp,
    FOREIGN KEY(category_id) REFERENCES categories(id_category)
);