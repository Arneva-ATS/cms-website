<script type="text/javascript">

function cek(){
var nama = document.getElementById("username").value;
var password = document.getElementById("password").value;

if(nama == ''){
document.getElementById('error1').innerHTML="Username Harus Di isi";
return false;
}

if(password == ''){
document.getElementById('error2').innerHTML="Password Harus Di isi";
return false;
}

return true;
}
</script>

<style>
input,button,img{padding:10px;}
body{background-color:#00923f;}
</style>

<body onLoad="document.login.username.focus();">
<br><br>
<center><img src="img/Logo-BAZNAS2.png" width="180"></center>
<br>
<form method="post" action="cek_login.php" onSubmit="return cek();" name="login">
<table align="center" cellpadding="4" cellspacing="0" style="border:1px solid #000; padding:15px;" bgcolor="#e6ea42">
<tr><td>Username</td><td><input type=text name='username' placeholder='masukan username' id='username'><p id='error1' style='background-color:#FF0000;color:#FFFFFF;'></p></td></tr>
<tr><td>Password</td><td><input type=password name='password' placeholder='masukan password' id='password'><p id='error2' style='background-color:#FF0000;color:#FFFFFF;'></p></td></tr>
<tr><td></td><td><input type=submit value='Login'> <input type=reset value='Reset'> </td></tr>
</table>
</form>

<center><font color="#024f30"><b>Copyright &copy; by Baznas Kota Payakumbuh Allrihtreserved</b> </font></center>