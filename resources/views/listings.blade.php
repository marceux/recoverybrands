<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Code Test</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    <body>
    	<div class="container">
    		<header>
		    	<h1>Code Test (<a href="https://github.com/marceux/rehabs"><i class="fa fa-github"></i> Repo</a>)</h1>
		    	<h2>By <a href="https://github.com/marceux">Marco Salazar de Leon</a></h2>
		    </header>

			<table class="table table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th>Distance (Miles)</th>
						<th>Meeting Name</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($results as $distance => $result): ?>
						<tr>
							<td><?php echo $distance; ?></td>
							<td><?php echo $result["meeting_name"]; ?></td>
							<td><?php echo $result["raw_address"]; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"</script>
    </body>
</html>