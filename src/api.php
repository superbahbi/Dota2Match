

<?php
class api {
	var $url;
	var $profileinfo;
	public function get_api_data() {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$this->url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
		$data = json_decode($data);

		if (!$data) {
			throw new Exception('get_api_data: No data found. ');
		}
        return $data;
    }
	public function get_player_name($s) {
		$this->url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=&steamids=" . $s;
		$profileinfo = $this->get_api_data();
		foreach($profileinfo->response->players as $player) {
			if ( $player->personaname ) {
				$temp = $player->personaname;
			}
		}
		if(!isset($player->personaname)) {
			$temp = "Anonymous";
		}
		return $temp;
	}
	public function get_profileurl($s){
		return $this->profileinfo;
	}

};
?>