<hr>
<section class="container-fluid">
	<h2 class="text-center">Affiliate Websites</h2>
	<div class="d-flex align-items-center">
		<?php
		$table = "our_websites";
		require( "connect.php" );
		$sql = "SELECT * FROM " . $table;
		$sql .= " ORDER BY RAND() LIMIT 3";
		$result = $conn->query( $sql );

		if ( $result->num_rows > 0 ) {
			while ( $row = $result->fetch_assoc() ) {
				$name = $row[ "name" ];
				$url = $row[ "url" ];
				$description = $row[ "description" ];
				echo( '<div class="col-4">' );
				echo PHP_EOL;
				echo( '<a href="http://www.' . $url . '" title="' . $name . '" alt="' . $name . '">' );
				echo PHP_EOL;
				echo( '<h3 class="text-center">' . $name . '</h3>' );
				echo PHP_EOL;
				echo( '<p class="text-justify paragraph-short">' . $description . '</p>' );
				echo PHP_EOL;
				echo( '</a>' );
				echo PHP_EOL;
				echo( '</div>' );
				echo PHP_EOL;
			}
		} else {
			echo "0 results";
		}
		?>
	</div>
</section>
</body>