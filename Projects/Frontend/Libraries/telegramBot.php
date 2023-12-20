<?php 

class InternaltelegramBot
{
	const apiURL = "https://api.telegram.org/bot";
	public $token = '5534810537:AAEfTCYFMsg1qmPsxk3t6Rmnc3Jp8yqurD0';
	public $chatId = '814802441';
	public $chatUsername = 'ISOMARCO';
	public function setToken($token)
	{
		$this->token = $token;
		return $this;
	}
	public function start()
	{
		return self::apiURL;
	}
	public function request($method,$posts=[])
	{
		$url = self::apiURL . $this->token . '/'.$method;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		if(count($posts) !== 0)curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($posts));

		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}

	public function deleteWebhook()
	{
		return $this->request('deleteWebhook');
	}

	public function setWebhook($url)
	{
		return $this->request('setWebhook',['url'=>$url]);
	}

	public function getWebhook()
	{
		$this->request('getWebhookInfo');
	}

	public function getData()
	{
		$data = json_decode(file_get_contents("php://input"),true);
		$this->chatId = $data['message']['chat']['id'];
		$this->chatUsername = $data['message']['from']['username'];
		return $data['message']['text'];
	}

	public function sendMessage($message,$username=null)
	{
        if(empty($username))
		return $this->request('sendMessage',[
			'chat_id'=>$this->chatId,
			'text'=>$message
		]);

        return $this->request('sendMessage',[
			'chat_id'=>$username,
			'text'=>$message
		]);
	}

	public function sendPoll($question,$options,$correct,$message_id=null)
	{
		return $this->request('sendPoll',[
			'chat_id'=>$this->chatId,
			'question'=>$question,
			'options'=>$options,
			'type'=>'quiz',
			'correct_option_id'=>$correct,
			'reply_to_message_id'=>$message_id
		]);
	}

	public function sendAudio($audio,$message_id=null)
	{
		return $this->request('sendAudio',[
			'chat_id'=>$this->chatId,
			'audio'=>$audio,
			'reply_to_message_id'=>$message_id
		]);
	}

	public function sendVoice($voice,$message_id=null)
	{
		return $this->request('sendVoice',[
			'chat_id'=>$this->chatId,
			'voice'=>$voice,
			'reply_to_message_id'=>$message_id
		]);
	}

	public function sendPhoto($url,$caption=null,$message_id=null)
	{
		return $this->request('sendPhoto',[
			'chat_id'=>$this->chatId,
			'photo'=>$url,
			'caption'=>$caption,
			'reply_to_message_id'=>$message_id
		]);
	}

	public function curl_get_contents($url) 
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}


}