<?php
if($_FILES['image']['name']){
	if(move_uploaded_file($_FILES['image']['tmp_name'],'1.jpg')){	
		exec ("/usr/bin/convert -strip 1.jpg -flatten \
				-resize 75x50^ -gravity Center -crop 75x50+0+0 +repage \
				-background white -alpha remove -quality 80% thumb_92_82/1.jpg");
		exec ("/usr/bin/convert -strip 1.jpg -flatten \
				-resize 170x113^ -gravity Center -crop 170x113+0+0 +repage \
				-gravity SouthWest -draw 'image Over 0,0 100,43 'zap_logo.png'' \
				-background white -alpha remove -quality 80% thumb_200_296/1.jpg");
		exec ("/usr/bin/convert -strip 1.jpg -flatten \
				-resize 241x161^ -gravity Center -crop 241x161+0+0 +repage \
				-gravity SouthWest -draw 'image Over 0,0 100,43 'zap_logo.png'' \
				-background white -alpha remove -quality 80% thumb_860_482/1.jpg");
		exec ("/usr/bin/convert -strip 1.jpg -flatten \
				-resize 800x800 \
				-gravity SouthWest -draw 'image Over 0,0 0,0 'zap_logo.png'' \
				-background white -alpha remove -quality 80% 1.jpg");
	}	
	header("Location:1.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="image">
	<br><br>
	<input type="submit" name="btn" value="Upload">
</form>
<br><br>
Original Image Link : <a href="original.jpg">http://www.zapcasa.it/zap-test3/demo/demo-1000x1000/original.jpg</a>


