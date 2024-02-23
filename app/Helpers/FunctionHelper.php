<?php


if (!function_exists('indonesian_date')) {
  function indonesian_date($date)
  {
    $date = date('Y-m-d', strtotime($date));
    $month = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $split = explode('-', $date);

    return $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];
  }
}
