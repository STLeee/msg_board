<script>
	function askForCancel() {
		if (confirm("不要註冊?")) {
			document.location.href="./";	
		}
	}
</script>

  <div id="content">
  <div class="block">
  <form name="login" id="login" method="post" action="./index.php?act=doRegister">
    <table width="250" style="margin-left:119px">
      <tr>
        <td>
        	<h2>Register</h2>
        </td>
      </tr>
    </table>
    <table width="300" style="margin-left:119px">
    
      <tr>
        <td><p><label for="title">Account : </label></p></td>
        <td><p><input type="text" name="account" id="account" value="" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">Password : </label></p></td>
        <td><p><input type="password" name="password" id="password" value="" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">Confirm Password : </label></p></td>
        <td><p><input type="password" name="password2" id="password2" value="" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">Name : </label></p></td>
        <td><p><input type="text" name="username" id="username" value="" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">Birthday : </label></p></td>
        <td><p><input type="date" name="birthday" id="birthday" value="" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">Telephone : </label></p></td>
        <td><p><input type="text" name="telephone1" id="telephone1" value="" size="2" /> - <input type="text" name="telephone2" id="telephone2" value="" size="10" /></p></td>
      </tr>
      
      <tr>
        <td><p><label for="title">City : </label></p></td>
        <td><p><input type="text" name="city" id="city" value="" /></p></td>
      </tr>
      
    </table>
    
    <table width="240" style="margin-left:119px">
      <tr>
        <td><p class="errorMessages"><?php echo nl2br($this->message); ?></p></td>
      </tr>
    </table>
    
    <table width="300" style="margin-left:119px">
      <tr>
        <td><p><input type="submit" value="register"></p></td>
        <td><p class="blockFunctions"><a href="javascript:void(0)" onclick="askForCancel()">cancel</a></p></td>
      </tr>
    </table>
  </form>
  </div>
  </div>