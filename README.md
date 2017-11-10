**SmsTraffic client**

Sample usage:

`$authentication = new \Dvt\SmsTraffic\Authentication('username', 'password', 'My Company Name');
$config = new \Dvt\SmsTraffic\Config([
    'transliterate' => false,
]);
$service = new \Dvt\SmsTraffic\Service($authentication, $config);
$result = $service->send(new \Dvt\SmsTraffic\Message('Тестовое сообщение'), '9001234567');`