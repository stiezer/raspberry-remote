<?php if($rows) :  ?>

	<form action="<?php print ('/index.php/download/start') ?>" method="post">
	<select name="magnet">
		<?php foreach($rows as $row) :  ?>
			<option value="<?php print $row['magnet'] ?>"><?php print $row['name'] ?></option>
		<?php endforeach; ?>
	</select>
	<input type="submit"  />
	</form>
	
<?php endif; ?>
<h1>Search</h1>


<form action="" method="post">
	<input type="text" name="search" />
</form>

