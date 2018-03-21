<!DOCTYPE html>
<html>
<head>
	
	<title>Adamlink Selecteur</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="https://fonts.googleapis.com/css?family=Sura:400,700" rel="stylesheet">

	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	<style>
	body{
		padding: 30px 60px;
		text-align: center;
		font-family: 'Sura', serif;
		color: #4C44A5;
	}
	a{
		text-decoration: none;
		color: #4C44A5;
		display: inline-block;
		margin: 0;
		padding: 0;
	}
	#results{
		text-align: center;
		margin-top: 30px;
	}
	#results .item{
		float:left;
		margin-right: 20px;
		margin-bottom: 20px;
	}
	#results .item input{
		position: absolute;
		padding: 5px;
		background-color: #000;
	}
	#results .item img{
		height: 200px;

	}
	#turtleform{
		clear: both;
	}
	input[type=text]{
		margin-top: 10px;
		margin-bottom: 10px;
	}
	textarea{
		height: 300px;
	}
	</style>

	
</head>
<body>


	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-8">
		      	<textarea name="query" class="form-control"></textarea>
		    </div>
		    <div class="col-md-4">
		      	<button id="go" class="btn btn-primary">haal items</button>
		    </div>
		 </div>
	</div>

	<div id="results">

	</div>

	<div class="container-fluid" id="turtleform">
		<div class="row">
		    <div class="col-md-8">
		    	<input class="form-control" value="dc:subject" type="text" name="property" placeholder="bijvoorbeeld dc:subject" />
		    	<input class="form-control" type="text" name="value" placeholder="kan uri of string zijn" />
		    	<textarea class="form-control" id="turtle"></textarea>
		    </div>
		    <div class="col-md-4">
		      	<button id="turtelize" class="btn btn-primary">maak turtle</button>
		    </div>
		 </div>
	</div>


	<script type="text/javascript">
		
		$('#go').click(function() {
			var sparql = $('textarea[name=query]').val();

			$.post( "results.php", { sparql: sparql })
			.done(function( data ) {
				$('#results').html(data);
			});
		  	
		});

		$('#turtelize').click(function() {
			turtle = '# zelf even aan eventuele prefixen denken!\n\n';
			$('input[type=checkbox]').each(function(){
				if($(this).is(":checked")){
					var predicate = $('input[name=property]').val();
					var thevalue = $('input[name=value]').val();
					turtle += '<' + this.value + '>' + "\n";
					turtle += "\t" + predicate + ' ';
					turtle += thevalue + " .\n\n";
				}
			});
		  	$('#turtle').val(turtle);
		});


	</script>

</body>
</html>
