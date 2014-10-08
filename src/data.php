

<?php
class data {
	public function convert_id($id){
    if (strlen($id) === 17)
    {
        $converted = substr($id, 3) - 61197960265728;
    }
    else
    {
        $converted = '765'.($id + 61197960265728);
    }
 
    return (string) $converted;
}
	public function get_lobby_type($s) {
		switch($s){
		case -1:
			$lobby = "Invalid";
			break;
		case 0:
			$lobby = "Public Matchmaking";
			break;
		case 1:
			$lobby = "Practice";
			break;
		case 2:
			$lobby = "Tournament";
			break;
		case 3:
			$lobby = "Tutorial";
			break;
		case 4:
			$lobby = "Co-op with bots";
			break;
		case 5:
			$lobby = "Team matchmaking";
			break;
		case 6:
			$lobby = "Solo Queue";
			break;
		case 7:
			$lobby = "Ranked Matchmkaing";
			break;
		case 8:
			$lobby = "1v1 matchmaking";
			break;
		default:
			$lobby = "Unknown";
			break;
		}
		return $lobby;
    }
	public function get_game_mode($s) {
		switch($s) {
			case 0:
				$mode = "Unknown";
				break;

			case 1:
				$mode = "All Pick";
				break;

			case 2:
				$mode = "Captains Mode";
				break;

			case 3:
				$mode = "Random Draft";
				break;

			case 4:
				$mode = "Single Draft";
				break;

			case 5:
				$mode = "All Random";
				break;

			case 6:
				$mode = "?? INTRO/DEATH ??";
				break;

			case 7:
				$mode = "The Diretide";
				break;

			case 8:
				$mode = "Reverse Captains Mode";
				break;

			case 9:
				$mode = "Greeviling";
				break;

			case 10:
				$mode = "Tutorial";
				break;

			case 11:
				$mode = "Mid Only";
				break;

			case 12:
				$mode = "Least Played";
				break;

			case 13:
				$mode = "New Player Pool";
				break;

			case 14:
				$mode = "Compendium Matchmaking";
				break;

			case 15:
				$mode = "Custom";
				break;

			case 16:
				$mode = "Captains Draft";
				break;

			case 17:
				$mode = "Balanced Draft";
				break;

			case 18:
				$mode = "Ability Draft";
				break;

			case 19:
				$mode = "?? Event ??";
				break;

			case 20:
				$mode = "All Random Death Match";
				break;

			case 21:
				$mode = "1vs1 Solo Mid";
				break;
			
			default:
				$mode = "Unknown";
				break;
		}
		return $mode;
	}
	public function get_region($s) {
		switch($s) {
			case 111:
				$region = "US West";
				break;
			 
			case 112:
				$region = "US West";
				break;
			 
			case 114:
				$region = "US West";
				break;			 
			 
			case 121:
				$region = "US East";
				break;			 
			 
			case 122:
				$region = "US East";
				break;			 
			 
			case 123:
				$region = "US East";
				break;
			 
			case 124:
				$region = "US East";
			 	break;
			 
			case 131:
				$region = "Europe West";
			 	break;
			 
			case 132:
				$region = "Europe West";
			 	break;
			 
			case 133:
				$region = "Europe West";
			 	break;
			 
			case 134:
				$region = "Europe West";
			 	break;
			 
			case 135:
				$region = "Europe West";
			 	break;
			 
			case 136:
				$region = "Europe West";
			 	break;
			 
			case 142:
				$region = "South Korea";
			 	break;
			 
			case 143:
				$region = "South Korea";
			 	break;
			 
			case 151:
				$region = "Southeast Asia";
			 	break;
			 
			case 152:
				$region = "Southeast Asia";
			 	break;
			 
			case 153:
				$region = "Southeast Asia";
			 	break;
			 
			case 161:
				$region = "China";
			 	break;
			 
			case 163:
				$region = "China";
			 	break;
			 
			case 171:
				$region = "Australia";
			 	break;
			 
			case 181:
				$region = "Russia";
			 	break;
			 
			case 182:
				$region = "Russia";
			 	break;
			 
			case 183:
				$region = "Russia";
			 	break;
			 
			case 184:
				$region = "Russia";
			 	break;
			 
			case 191:
				$region = "Europe East";
			 	break;
			 
			case 200:
				$region = "South America";
			 	break;
			 
			case 204:
				$region = "South America";
			 	break;
			 
			case 211:
				$region = "South America";
			 	break;
			 
			case 212:
				$region = "South America";
			 	break;
			 
			case 213:
				$region = "South America";
			 	break;
			 
			case 221:
				$region = "China";
			 	break;
			 
			case 222:
				$region = "China";
			 	break;
			 
			case 223:
				$region = "China";
			 	break;
			 
			case 231:
				$region = "China";
				break;
			default:
				$region = "Unknown";
				break;
		}
		return $region;
	}
	
	};
?>