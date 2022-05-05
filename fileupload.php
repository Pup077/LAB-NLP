<html>
<body>
<form action="upload_file.php"id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
  <input type="file" id="upload_file" name="upload_file" />
  <input type="submit" name='submit_image' value="Submit Comment" onclick='upload_image();'/>
</form>
<div class='progress' id="progress_div">
<div class='bar' id='bar1'></div>
</div>
<div id='output_image'>

</body>
</html>