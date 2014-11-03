<?php

class Veritrans_Transaction {

  public static function status($id)
  {
    return Veritrans_ApiRequestor::get(
        Veritrans_Config::getBaseUrl() . '/' . $id . '/status',
        Veritrans_Config::$serverKey,
        false);
  }

  public static function approve($id)
  {
    return Veritrans_ApiRequestor::post(
        Veritrans_Config::getBaseUrl() . '/' . $id . '/approve',
        Veritrans_Config::$serverKey,
        false)->status_code;
  }

  public static function cancel($id)
  {
    return Veritrans_ApiRequestor::post(
        Veritrans_Config::getBaseUrl() . '/' . $id . '/cancel',
        Veritrans_Config::$serverKey,
        false)->status_code;
  }

  public static function get_by_order_ids($page, $row, $order_ids = array())
  {
    $params = array(
        'order_ids' => $order_ids,
        'page' => $page,
        'row_per_page' => $row
      );

    if (Veritrans_Config::$isSanitized) {
      Veritrans_Sanitizer::jsonRequest($params);
    }

    $result = Veritrans_ApiRequestor::post(
        Veritrans_Config::getBaseUrl() . '/transaction',
        Veritrans_Config::$serverKey,
        $params);

    return $result;
  }
}