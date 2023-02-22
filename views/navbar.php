
<header class="header">
    <a  href="#" class="connect_item">Connect</a>
    <form class="forme"  action="<?php echo HOME_URL . "request/login_post.php" ; ?>" method="POST">
        <label for="" class="close-btn fas fa-times"></label>
        <div class="text">Login Form</div>
        <div class="data">
        <label for="email">Email</label>
        <input required  type="text"  name="email" id="email">
        </div>
        <div class="data">
        <label for="password">Password</label>
        <input required type="password" name="password" id="password">
        </div>
        <button class="btn_valider" type="submit">valider</button>
    </form>
    <?php 
	if(isset($_GET['msg'])) {
		echo $_GET['msg']; 
	} ?>
</header >

