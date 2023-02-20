<?php

declare(strict_types=1);

require_once("./autoload.php");

// Таблица shop
$tableShop = new Main('shop');
$resultInsert = $tableShop->insert(['id', 'name', 'address'], ['6', 'Романов', 'г. Москва, ул. Романовых д. 12']);
print_r($resultInsert);

$resultUpdate = $tableShop->update(5, ['name' => 'ЗарядАвтоПлюс', 'address' => 'г. Москва, ул. Гонщиков д. 666']);
print_r($resultUpdate);

$resultFind = $tableShop->find(1);
print_r($resultFind);

$resultDelete = $tableShop->delete(2);
print_r($resultDelete);

// Таблица product
$tableProduct = new Main('product');
$resultInsert = $tableProduct->insert(['id', 'name', 'price', 'count', 'id_shop'], ['26', 'Пряники', '3.00', '32', '1']);
print_r($resultInsert);

$resultUpdate = $tableProduct->update(3, ['price' => '29.00', 'count' => '26']);
print_r($resultUpdate);

$resultFind = $tableProduct->find(1);
print_r($resultFind);

$resultDelete = $tableProduct->delete(2);
print_r($resultDelete);

// Таблица client
$tableClient = new Main('client');
$resultInsert = $tableClient->insert(['id', 'name', 'surname', 'phone'], ['7', 'Виктор', 'Викторович', '+79045671235']);
print_r($resultInsert);

$resultUpdate = $tableClient->update(2, ['name' => 'Василий', 'surname' => 'Романец']);
print_r($resultUpdate);

$resultFind = $tableClient->find(4);
print_r($resultFind);

$resultDelete = $tableClient->delete(5);
print_r($resultDelete);

// Таблица order
$tableOrder = new Main('orderTable');
$resultInsert = $tableOrder->insert(['id', 'created_at', 'shop_id', 'client_id'], ['7', '202302101859', '3', '3']);
print_r($resultInsert);

$resultUpdate = $tableOrder->update(3, ['created_at' => '20230208111122']);
print_r($resultUpdate);

$resultFind = $tableOrder->find(1);
print_r($resultFind);

$resultDelete = $tableOrder->delete(2);
print_r($resultDelete);

// Таблица order_product
$tableOrderProduct = new Main('order_product');
$resultInsert = $tableOrderProduct->insert(['id', 'id_order', 'id_product', 'id_shop'], ['10', '7', '3', '3']);
print_r($resultInsert);

$resultUpdate = $tableOrderProduct->update(3, ['id_product' => '6']);
print_r($resultUpdate);

$resultFind = $tableOrderProduct->find(1);
print_r($resultFind);

$resultDelete = $tableOrderProduct->delete(2);
print_r($resultDelete);