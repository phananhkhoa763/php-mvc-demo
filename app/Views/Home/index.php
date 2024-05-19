<h1><?php echo $title; ?></h1>
<?php echo '<pre>';var_dump($errors)?>
<form method="post" action="<?php echo _WEB_ROOT; ?>/home/update_validate"> 
    <input type="text" class="" name="fullname" placeholder="Họ tên..." /><br /> 
    <input type="text" name="email" placeholder="Emait..."> <br /> 
    <input type="number" name="age" placeholder="tuổi..."> <br /> 
    <input type="password" name="password" placeholder="Mặt khóu..." /> <br /> 
    <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu..." /> 
    <button type="submit">Submit</button> 
</form>