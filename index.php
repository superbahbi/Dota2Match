<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dota2match</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="./assets/css/dota2minimapheroes.css" rel="stylesheet">
    <link href="./assets/css/custom.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<?php
		if($_GET["matchid"]) {
			$matchid = ($_GET["matchid"]);
		}
		
		include './src/api.php';
		include './src/data.php';
		$api = new api();
		$data = new data();
		$steam_api_key = '';
		$dota_webapi_listing ='GetMatchDetails';

		$api->url = 'http://api.steampowered.com/IDOTA2Match_570/'.$dota_webapi_listing.'/v1/?key='.$steam_api_key.'&match_id='.$matchid;
		
		try {
		$s = $api->get_api_data();
		} catch (Exception  $e ) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		$dota_webapi_listing = 'GetHeroes';
		$api->url = 'http://api.steampowered.com/IEconDOTA2_570/'.$dota_webapi_listing.'/v1/?key='.$steam_api_key;
		try {
		$heroes = $api->get_api_data();
		} catch (Exception  $e ) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		} 	

		$dota_webapi_listing = 'GetGameItems';
		$api->url = 'http://api.steampowered.com/IEconDOTA2_570/'.$dota_webapi_listing.'/v0001/?key='.$steam_api_key;
		try {
		$item = $api->get_api_data();
		} catch (Exception  $e ) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		} 		
		
		
?>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Dota2Live</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <form class="navbar-form pull-right" action="" method="get">
              <input class="span2" type="text" placeholder="Enter match id"  name="matchid">
              <button type="submit" class="btn">Find match</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      
	<?php 
	echo '<div class="row well">';
		echo '<div class="col-md-4">';
			echo '<h3>Match '. $matchid . '</h3>';
		echo '</div>';
		echo '<div class="col-md-8">';
		
		echo '<ul class="list-inline">';
			echo '<li><ul class="list-unstyled">';
			  echo '<li>Lobby Type</li>';
			  echo '<li>'.$data->get_lobby_type($s->result->lobby_type).'</li>';
			echo '</ul></li>';
			echo '<li><ul class="list-unstyled">';
			  echo '<li>Game mode</li>';
			  echo '<li>'.$data->get_game_mode($s->result->game_mode).'</li>';
			echo '</ul></li>';
			echo '<li><ul class="list-unstyled">';
			  echo '<li>Region</li>';
			  echo '<li>'.$data->get_region($s->result->cluster).'</li>';
			echo '</ul></li>';
			echo '<li><ul class="list-unstyled">';
			  echo '<li>Duration</li>';
			  echo '<li>'.date("H:i:s", mktime(0,0, round($s->result->duration) % (24*3600))).'</li>';
			echo '</ul></li>';
			echo '<li><ul class="list-unstyled">';
			  echo '<li>Match ended</li>';
			  echo '<li>';
				$time = (time() - ($s->result->start_time + $s->result->duration)) / 60; #in minutes
				if($time > 60 && $time < 120 ){
					echo 'a hour ago';
				} else if($time > 120 && $time < 1440) {
					echo round($time / 60) .' hours ago';
				} else if($time > 1440 && $time < 2880) {
					echo 'a day ago';
				} else if($time > 2880) {
					echo round($time / 1440) .' days ago';
				} else {
					echo round($time) . ' minutes ago';
				}
				
			  echo '</li>';
			echo '</ul></li>';
		echo '</ul>';
		echo '</div>';
	echo '</div>';
	?>
	<div class="row well">
		<div class="row">
			<?php
			if($s->result->radiant_win == true) {
				echo '<h3 class="radvic">Radiant victory</h3>';
			} else {
				echo '<h3 class="dirvic">Dire victory</h3>';
			}
			?>
		</div>
		<div class="">
			<?php
			echo '<p>RADIANT</p>';
								echo '<table class="table table-bordered radiant">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Hero</th>';
											echo '<th>Player</th>';
											echo '<th>Level</th>';
											echo '<th>K</th>';
											echo '<th>D</th>';
											echo '<th>A</th>';
											echo '<th>Gold</th>';
											echo '<th>LH</th>';
											echo '<th>DN</th>';
											echo '<th>XPM</th>';
											echo '<th>GPM</th>';
											echo '<th>HD</th>';
											echo '<th>HH</th>';
											echo '<th>TD</th>';
											echo '<th>Items</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									foreach($s->result->players as $d) {
										if($d->player_slot < 6){
										echo '<tr>';
											#hero
											foreach ( $heroes->result->heroes as $hero ) {
												if ( $d->hero_id == $hero->id ) {
													echo '<td><i class="d2mh '.$hero->name.'"></i>' . ucfirst(str_replace('_', ' ', substr($hero->name, 14))).'</td>';
												}
											}
											if($d->additional_units){
												foreach($d->additional_units as $unit){
													echo ' with '. ucfirst(str_replace('_', ' ', $unit->unitname));
												}
											}
											#player
											echo '<td>'. $api->get_player_name($data->convert_id($d->account_id)) .'</td>';
											echo '<td>'. $d->level .'</td>';
											echo '<td>'. $d->kills .'</td>';
											echo '<td>'. $d->death .'</td>';
											echo '<td>'. $d->assists .'</td>';
											echo '<td><img src="./assets/images/gold.png">'. $d->gold .'</td>';
											echo '<td>'. $d->last_hits .'</td>';
											echo '<td>'. $d->denies .'</td>';
											echo '<td>'. $d->xp_per_min .'</td>';
											echo '<td>'. $d->gold_per_min .'</td>';
											echo '<td>'. $d->hero_damage .'</td>';
											echo '<td>'. $d->hero_healing .'</td>';
											echo '<td>'. $d->tower_damage .'</td>';

											#item
											echo '<td>';
											foreach ( $item->result->items as $i ) {
												
												if ( $i->id == $d->item_0 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_1 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_2 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_3 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_4 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_5 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												
											}
											if($d->additional_units){
												foreach($d->additional_units as $unit){
													foreach ( $item->result->items as $i ) {
														if ( $i->id == $unit->item_0 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_1 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_2 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_3 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_4 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_5 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
													}
												}
											}
											echo '</td>';
										echo '</tr>';
										}
									}
									echo '</tbody>';
								echo '</table>';
								#picks and bans
								if ($s->result->picks_bans) {
									echo '<ul class="list-inline">';
									foreach( $s->result->picks_bans as $pb ){
										if ( $pb->team == 0 ) {
											foreach ( $heroes->result->heroes as $hero ) {
												if ( $pb->hero_id == $hero->id ) {
													
														echo '<li><ul class="list-unstyled">';
															echo '<li><i class="d2mh '.$hero->name.'"></i></li>';
															if ( $pb->is_pick ){
																echo '<li>Pick</li></ul></li>';
															} else {
																echo '<li>Ban</li></ul></li>';
															}
												}
											}
										}
									}
									echo'</ul>';
								}
								echo '<p>DIRE</p>';
								echo '<table class="table table-bordered dire">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Hero</th>';
											echo '<th>Player</th>';
											echo '<th>Level</th>';
											echo '<th>K</th>';
											echo '<th>D</th>';
											echo '<th>A</th>';
											echo '<th>Gold</th>';
											echo '<th>LH</th>';
											echo '<th>DN</th>';
											echo '<th>XPM</th>';
											echo '<th>GPM</th>';
											echo '<th>HD</th>';
											echo '<th>HH</th>';
											echo '<th>TD</th>';
											echo '<th>Items</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									foreach($s->result->players as $d) {
										if($d->player_slot > 6){
										echo '<tr>';
											#hero
											foreach ( $heroes->result->heroes as $hero ) {
												if ( $d->hero_id == $hero->id ) {
													echo '<td><i class="d2mh '.$hero->name.'"></i>' . ucfirst(str_replace('_', ' ', substr($hero->name, 14))).'</td>';
												}
											}
											if($d->additional_units){
												foreach($d->additional_units as $unit){
													echo ' with '. ucfirst(str_replace('_', ' ', $unit->unitname));
												}
											}
											echo '</td>';
											#player
											echo '<td>'. $api->get_player_name($data->convert_id($d->account_id)) .'</td>';
											echo '<td>'. $d->level .'</td>';
											echo '<td>'. $d->kills .'</td>';
											echo '<td>'. $d->death .'</td>';
											echo '<td>'. $d->assists .'</td>';
											echo '<td><img src="./assets/images/gold.png">'. $d->gold .'</td>';
											echo '<td>'. $d->last_hits .'</td>';
											echo '<td>'. $d->denies .'</td>';
											echo '<td>'. $d->xp_per_min .'</td>';
											echo '<td>'. $d->gold_per_min .'</td>';
											echo '<td>'. $d->hero_damage .'</td>';
											echo '<td>'. $d->hero_healing .'</td>';
											echo '<td>'. $d->tower_damage .'</td>';

											#item
											echo '<td>';
											foreach ( $item->result->items as $i ) {
												
												if ( $i->id == $d->item_0 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_1 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_2 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_3 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_4 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
												if ( $i->id == $d->item_5 ) {
													echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
												}
											}
											if($d->additional_units){
												echo '<br>';
												foreach($d->additional_units as $unit){
													foreach ( $item->result->items as $i ) {
														if ( $i->id == $unit->item_0 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_1 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_2 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_3 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_4 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
														if ( $i->id == $unit->item_5 ) {
															echo '<a href="#" rel="tooltip" title="" data-original-title="' .substr($i->name, 5) . '"><img style="height:24px" src="http://media.steampowered.com/apps/dota2/images/items/' .substr($i->name, 5) . '_eg.png"></a>';
														}
													}
												}
											}
											echo '</td>';
										echo '</tr>';
										}
									}
									echo '</tbody>';
								echo '</table>';
								#picks and bans
								if ($s->result->picks_bans) {
									echo '<ul class="list-inline">';
									foreach( $s->result->picks_bans as $pb ){
										if ( $pb->team == 1 ) {
											foreach ( $heroes->result->heroes as $hero ) {
												if ( $pb->hero_id == $hero->id ) {
													
														echo '<li><ul class="list-unstyled">';
															echo '<li><i class="d2mh '.$hero->name.'"></i></li>';
															if ( $pb->is_pick ){
																echo '<li>Pick</li></ul></li>';
															} else {
																echo '<li>Ban</li></ul></li>';
															}
												}
											}
										}
									}
									echo'</ul>';
								}	
			?>
		</div>
	</div>
    </div> <!-- /container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap-transition.js"></script>
    <script src="./assets/js/bootstrap-alert.js"></script>
    <script src="./assets/js/bootstrap-modal.js"></script>
    <script src="./assets/js/bootstrap-dropdown.js"></script>
    <script src="./assets/js/bootstrap-scrollspy.js"></script>
    <script src="./assets/js/bootstrap-tab.js"></script>
    <script src="./assets/js/bootstrap-tooltip.js"></script>
    <script src="./assets/js/bootstrap-popover.js"></script>
    <script src="./assets/js/bootstrap-button.js"></script>
    <script src="./assets/js/bootstrap-collapse.js"></script>
    <script src="./assets/js/bootstrap-carousel.js"></script>
    <script src="./assets/js/bootstrap-typeahead.js"></script>
	

  </body>
</html>
