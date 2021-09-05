<?php
class Common
{
  public function errorHandling($data)
  {
    http_response_code(200);

    if ($data === 'family') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. You are facing some configuration related issues, Please check with support team.")
      ));
    }

    if ($data === 'expense') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. Expense/Income data not found.")
      ));
    }

    if ($data === 'category') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. Category data not found.")
      ));
    }
	
	if ($data === 'bydate') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. Start Date/End Date perameter not found.")
      ));
    }
  }
}
