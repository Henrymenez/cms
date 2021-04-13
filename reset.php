<?php 
include_once("lib/header.php");
?>
Reset PASSWORD <hr>


<form action="lib/processreset.php" method="post">

<p>
<?php 
if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
    echo "<span style='color:green'>" . $_SESSION['message'] . "</span>";

    session_destroy();
}
?>
</p>

<p>
<label> Reset Code:</label> <input  type="text" name="username" placeholder="Reset">
</p>

<p>
<label> Email:</label> <input  type="email" name="email" placeholder="Email">
</p>

<p>
<label> New Password:</label> <input  type="password" name="password" placeholder="Password">
</p>
<br>
<p>
<button type="submit">Submit</button></p>
</form>


<?php 
include_once("lib/footer.php");

?>