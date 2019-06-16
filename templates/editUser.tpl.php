<?php include 'templates/function.tpl.php'; ?>
  
  <div class="messageBlock">
    <form name="editUser" id="editUser" method="post" action="./index.php?act=doEditUser&id=<?php echo $this->userMessages['id']; ?>" enctype="multipart/form-data" >
      <h2>
        <table width="100%">
          <tr>
            <td width="36">
              <img src="./head/<?php echo $this->userMessages['head']; ?>" height="32" width="32">
            </td>
            <td width="270">
              <input type="text" name="username" id="username" value="<?php echo $this->userMessages['username']; ?>" style="font-size:24px;" />
            </td>
            <td>
              <p class="messageBlockFunctions">
              </p>
            </td>
          </tr>
        </table>
      </h2>
      
      <h4 style="margin-bottom:4px">Basic Information : </h4>
      <table width="100%">
        <tr>
          <td width="180px"><p>Avatar : </p></td>
          <td><p><input type="file" name="head" id="head" /></p></td>
        </tr>
        
        <tr>
          <td><p>Birthday : </p></td>
          <td><p><input type="date" name="birthday" id="birthday" value="<?php echo $this->userMessages['birthday']; ?>" /></p></td>
        </tr>
        
        <tr>
          <td><p>Telephone : </p></td>
          <td><p><input type="text" name="telephone1" id="telephone1" value="<?php echo split('-', $this->userMessages['telephone'])[0]; ?>" size="2" />
           - 
           <input type="text" name="telephone2" id="telephone2" value="<?php echo split('-', $this->userMessages['telephone'])[1]; ?>" size="10" /></p></td>
        </tr>
        
        <tr>
          <td><p>City : </p></td>
          <td><p><input type="text" name="city" id="city" value="<?php echo $this->userMessages['city']; ?>" /></p></td>
        </tr>
      </table>
      
      <h4 style="margin-bottom:4px">Change Password : </h4>
      <table width="100%">
        <tr>
          <td width="180px"><p>Old Password : </p></td>
          <td><p><input type="password" name="password" id="password" /></p></td>
        </tr>
        
        <tr>
          <td><p>New Password : </p></td>
          <td><p><input type="password" name="newPassword" id="newPassword" /></p></td>
        </tr>
        
        <tr>
          <td><p>Confirm New Password : </p></td>
          <td><p><input type="password" name="newPassword2" id="newPassword2" /></p></td>
        </tr>
        
        <tr>
          <td><p><input type="submit" value="edit"></p></td>
          <td><p class="messageBlockFunctions"><a href="./index.php?act=doEditUser">cancal</a></p></td>
        </tr>
      </table>
    </form>
  </div>