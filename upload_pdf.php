<?php include 'header.php'; include 'assets/page/func.php'; 

?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Upload Policy PDF</h3>
                <div class="whitebg">
                  <form action="upload.php" method="post" enctype="multipart/form-data">
    Select pdf to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
<hr>
    <input type="submit" value="Upload Pdf" name="submit">
</form>
                </div>                                
            </div>
            
        </div>
    </div>
</div>

<?php include 'footer.php';


?>