  <div id="content">
  <div class="block">
  <form name="login" id="login" method="post" action="./index.php?act=doLogin">
    <table width="250" style="margin-left:144px">
      <tr>
        <td>
        	<h2>Login</h2>
        </td>
      </tr>
    </table>
    <table width="250" style="margin-left:144px">
      <tr>
        <td>
        	<p><label for="title">Account : </label></p>
        </td>
        <td>
        	<p><input type="text" name="account" id="account" value="" /></p>
        </td>
      </tr>
      <tr>
        <td>
        	<p><label for="title">Password : </label></p>
        </td>
        <td>
        	<p><input type="password" name="password" id="password" value="" /></p>
        </td>
      </tr>
    </table>
    
    <table width="240" style="margin-left:144px">
      <tr>
        <td><p class="errorMessages"><?php echo nl2br($this->message); ?></p></td>
      </tr>
    </table>
    
    <table width="240" style="margin-left:144px">
      <tr>
        <td><p><input type="submit" value="login"></p></td>
        <td><p class="blockFunctions"><a href="./index.php?act=register">register</a></p></td>
      </tr>
    </table>
  </form>
  </div>
  </div>