<?php 
require_once("pasifik.php");

class TestCase
{
	function __construct()
	{
		$username = "YOUR_USERNAME";
		$password = "YOUR_PASSWORD";
		$this->header = "YOUR_COMPANY";
		$lang = "tr"; // 'tr': Turkish response, 'en': English response, 'ar': Arabic response.
		$DEBUG = true;
		$this->obj = new PasifikAPI($username, $password, $lang, $DEBUG);
	}
	public function send_one_message_to_many_receipients(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "SMS Test";
		$result = $this->obj->submit($from, $to, $text);
	}
	public function send_one_message_to_many_receipients_schedule_delivery(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "SMS Test";
		$scheduled_delivery_time = "2016-09-28T09:30:00Z";// "%Y-%m-%dT%H:%M:%SZ" format e.g "2016-07-23T21:54:02Z" in UTC Timezone.
		$result = $this->obj->submit($from, $to, $text, false, "Default", $scheduled_delivery_time);
	}
	public function send_one_message_to_many_receipients_schedule_delivery_with_validity_period(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "SMS Test";
		$scheduled_delivery_time = "2016-09-28T09:30:00Z";// "%Y-%m-%dT%H:%M:%SZ" format e.g "2016-07-23T21:54:02Z" in UTC Timezone.
		$period = 1440; // minutes number e.g 1440 minutes for 24 hours
		$result = $this->obj->submit($from, $to, $text, false, "Default", $scheduled_delivery_time, $period);
	}
	public function send_one_message_to_many_receipients_turkish_language(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "Artık Ulusal Dil Tanımlayıcısı ile Türkçe karakterli smslerinizi rahatlıkla iletebilirsiniz.";
		$alphabet = "TurkishSingleShift";
		$result = $this->obj->submit($from, $to, $text, false, $alphabet);
	}
	public function send_one_message_to_many_receipients_flash_sms(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "My first Flash SMS, It will be temporary on your phone.";
		$alphabet = "DefaultMclass0";
		$result = $this->obj->submit($from, $to, $text, false, $alphabet);
	}
	public function send_one_message_to_many_receipients_unicode(){
		$from = $this->header;
		$to = "905999999998,905999999999";
		$text = "メッセージありがとうございます";
		$alphabet = "UCS2";
		$result = $this->obj->submit($from, $to, $text, false, $alphabet);
	}
	public function send_one_message_to_many_receipients_outside_turkey(){
		$from = $this->header;
		$to = "+435999999998,+435999999999";// '+' required e.g '+43' for Germany mobile prefix number
		$text = "SMS Test";
		$universal = true; // true: it means send sms outside Turkey
		$result = $this->obj->submit($from, $to, $text, $universal);
	}
	public function send_many_message_to_many_receipients(){
		$from = $this->header;
		$envelopes = array(array("to" => "905999999998", "text"=> "test 1"), array("to" => "905999999999", "text"=> "test 2"));
		$result = $this->obj->submit_multi($from, $envelopes);
	}
	public function query_multi_general_report(){
		$start_date = "01.03.2016"; // formated as turkish date time format "%d.%m.%Y"
		$end_date = "01.03.2016"; // formated as turkish date time format "%d.%m.%Y"
		$result = $this->obj->query_multi($start_date, $end_date);
	}
	public function query_multi_general_report_with_id(){
		$sms_id = "123456";
		$result = $this->obj->query_multi_id($sms_id);
	}
	public function query_detailed_report_with_id(){
		$sms_id = "123456";
		$result = $this->obj->query($sms_id);
	}
	public function get_account_settings(){
		$result = $this->obj->getsettings();
	}
	public function get_authority(){
		$encode = false;
		$result = $this->obj->authorization($encode);
	}
	public function get_cdr_report(){
		$i_account = 123456;
		$result = $this->obj->call_history($i_account);
	}
	public function get_cdr_report_range_datetime(){
		$i_account = 123456;
		$start_date = "2016-08-31T10:12:45Z";
		$end_date = "2016-09-01T10:12:45Z";
		$cli = "";
		$cld = "";
		$offset = 0;
		$limit = 100;
		$result = $this->obj->call_history($i_account, $start_date, $end_date, $cli, $cld, $offset, $limit);
	}
	public function get_cdr_report_with_type(){
		$i_account = 123456;
		$start_date = "";
		$end_date = "";
		$cli = "";
		$cld = "";
		$offset = 0;
		$limit = 50;
		$type_flag = array("non_zero_and_errors", "non_zero", "all", "complete", "incomplete", "errors");
		$type = $type_flag[0];
		$result = $this->obj->call_history($i_account, $start_date, $end_date, $cli, $cld, $offset, $limit, $type);
	}
	public function get_active_calls(){
		$i_account_list = array(123, 456);
		$result = $this->obj->call_active($i_account_list);
	}
	public function get_disconnect_active_call(){
		$id = 123456;
		$result = $this->obj->call_active_disconnect($id);
	}
}
$test = new TestCase();
//$test->send_one_message_to_many_receipients();
//$test->send_one_message_to_many_receipients_schedule_delivery();
//$test->send_one_message_to_many_receipients_schedule_delivery_with_validity_period();
//$test->send_one_message_to_many_receipients_turkish_language();
//$test->send_one_message_to_many_receipients_flash_sms();
//$test->send_one_message_to_many_receipients_unicode();
//$test->send_one_message_to_many_receipients_outside_turkey();
//$test->send_many_message_to_many_receipients();
//$test->query_multi_general_report();
//$test->query_multi_general_report_with_id();
//$test->query_detailed_report_with_id();
//$test->get_account_settings();
//$test->get_authority();
//$test->get_cdr_report();
//$test->get_cdr_report_range_datetime();
//$test->get_cdr_report_with_type();
//$test->get_active_calls();
//$test->get_disconnect_active_call();
?>
