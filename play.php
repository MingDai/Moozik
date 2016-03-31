<?php $d1 = json_decode($_POST["s1"], TRUE);
$d2 = json_decode($_POST["s2"], TRUE);
// echo $d1;
// echo $d2;
for ($i = 0; $i < count($d1); ++$i) {
	// echo $d1[$i];
	// echo $d2[$i];

	$d1[$i] = $d1[$i]." ".$d2[$i];
}

?>

<!DOCTYPE html>
<html>

<head><title></title>
<script src="https://www.rdio.com/api/api.js?helper=helper.html&client_id=UKQc1RauLVUDqLwpRnBjOg"></script>
<script src="js/rdio-utils.js"></script>
<script src="js/underscore-1.4.4.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">


(function() {
	window.Main = {

		init: function() 
		{
			var self = this;
			R.ready(function() 
			{
				R.player.queue.clear();
				R.authenticate(function(success) 
				{
					if (success)
					{
				// this.$songs = new Array("Taylor Swift Ours", "John Legend Stay With You", "Neon Trees Animal");

				// var songs = new Array("Taylor Swift Ours", "Owl City Deer in the headlights", "Frozen");

						<?php
							echo "var songs = ".json_encode($d1).";\n";
						?>

						for (var term in songs) 
							{
							self.addSong(songs[term]);
							console.log("added " + songs[term]);
							// R.player.queue.on("add", function(model, collection, info){
							// console.log("source" + model.get("key") + " added to queue at " + info.index);
					//	});
							}

						R.ready(function() {
							console.log("length of queue " + R.player.queue.length());
							R.player.queue.play(0);

						});
					}		
				});
			});
		},


		addSong: function(query) {
			console.log(query);
			R.ready(function() {
				R.request({
					    method: 'search',
					    content: { query: query, types: 'Album' },
					    success: function(response) {
					      var result = response.result.results[0];
					      var name = result.name;
					      var artist = result.artist;
						      if (R.authenticated())
						      {
							      console.log('Now Playing: ' + name  + ' by ' + artist);
							      // R.player.queue.add({source: result.key})
							      R.player.queue.add(result.key); 
							  }
					    }
					  });
			  
			});

		}

	};

	$(document).ready(function() {
		Main.init();
	});
	
})();




</script>
</head>
<body>
</body>
</html>