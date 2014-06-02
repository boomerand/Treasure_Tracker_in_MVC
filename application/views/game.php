<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Treasure Tracker</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
<div id="container">
	<div>
		<img src="/assets/img/game_title.png" id="game_title" alt="Treasure Tracker logo">
		<p class="story">You are the Dread Pirate Roberts - the most feared pirate of the seven seas! You
			spend your days collecting treasure and amassing a great wealth. Why do you need all that gold? Who 
			cares? You're a pirate and collecting gold is what you do. Search the farms, caves, and homes to 
			gain more gold. If you're feeling lucky, take a shot at the casino and see what happens. Be careful
			- you may lose more than you win!</p>
	</div>
	<div id="game">
		<h2>Your Gold: 
			<span>
			<?php
				if($this->session->userdata('gold'))
				{
			?>
					<?= $this->session->userdata('gold') ?>
			<?php	
				}
				else
				{
			?>
					0
			<?php
				}
			?>
			</span>
		</h2>
		<!-- BEGIN BARN BUCKET -->
		<div class="bucket">
			<img src="/assets/img/barn.png" alt="barn">
			<h3>Old Barn</h3>
			<p>Earns 10 - 20 Gold</p>
			<form action="/get_gold" method="post">
				<input type="hidden" name="building" value="farm">
				<input type="submit" class="submit" value="Find Gold!">
			</form>
		</div>
		<!-- BEGIN CAVE BUCKET -->
		<div class="bucket">
			<img src="/assets/img/cave.png" alt="cave">
			<h3>Mountain Cave</h3>
			<p>Earns 5 - 10 Gold</p>
			<form action="/get_gold" method="post">
				<input type="hidden" name="building" value="cave">
				<input type="submit" class="submit" value="Find Gold!">
			</form>
		</div>
		<!-- BEGIN HOUSE BUCKET -->
		<div class="bucket">
			<img src="/assets/img/home.png" alt="home">
			<h3>Village Home</h3>
			<p>Earns 2 - 5 Gold</p>
			<form action="/get_gold" method="post">
				<input type="hidden" name="building" value="house">
				<input type="submit" class="submit" value="Find Gold!">
			</form>
		</div>
		<!-- BEGIN CASINO BUCKET -->
		<div class="bucket">
			<img src="/assets/img/chips.png" alt="chips">
			<h3>Casino</h3>
			<p>Earns/Loses 0 - 50 Gold</p>
			<form action="/get_gold" method="post">
				<input type="hidden" name="building" value="casino">
				<input type="submit" class="submit" value="Find Gold!">
			</form>
		</div>
		<!-- BEGIN ACTIVITY READOUT -->
		<div id="activity">
			<p>
				<?php
					if($this->session->userdata('activities'))
					{
						$reverseLog = array_reverse($this->session->userdata('activities'));
						foreach($reverseLog as $log)
						{ 
				?>			
							<p id="green"><?=$log ?></p>
				<?php
						}
					}
					else
					{
				?>
						<p id="greeting">Welcome! How much gold will ye earn today?</p>
				<?php	
					}
				?>
			</p>
		</div>
		<!-- RESET GOLD COUNT -->
		<form id="reset" action="/reset" method="post">
			<input type="hidden" name="action" value="reset">
			<input type="submit" class="reset" value="Reset Gold">
		</form>
	</div>
</div>	
</body>
</html>