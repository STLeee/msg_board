<script>
	function askForDelete(id, account) {
		if (confirm("確定要刪除 " + account + " ?")) {
			document.location.href="./index.php?act=deleteUser&id=" + id;	
		}
	}
</script>
  
<?php include 'templates/function.tpl.php'; ?>

<div id="content">

<?php if (count($this->usersMessages)): ?>
<?php foreach ($this->usersMessages as $user): ?>
        <div class="messageBlock">
<?php if ($user['enable']): ?>
            <h2>
<?php else: ?>
            <h2 style="background-color:#F00">
<?php endif; ?>
                <table width="100%">
                  <tr>
                    <td width="300">
                      <a style="color:#000" href="./index.php?account=<?php echo $user['account']; ?>"><?php echo $user['id'] . " : " . $user['account']; ?></a>
                    </td>
                    <td>
                      <p class="messageBlockFunctions">
<?php if ($user['id'] != $this->user['id']): ?>
                        <a href="<?php echo './index.php?act=editUser&id=' . $user['id']; ?>">修改</a>
                        |
<?php if ($user['enable']): ?>
                        <a href="<?php echo './index.php?act=disableUser&id=' . $user['id']; ?>">凍結</a>
<?php else: ?>
                        <a href="<?php echo './index.php?act=enableUser&id=' . $user['id']; ?>">解凍</a>
<?php endif; ?>
                        |
                        <a href="javascript:void(0)" onclick="askForDelete(<?php echo $user['id'] . ", '" . $user['account'] . "'"; ?>)">刪除</a>
<?php endif; ?>
                      </p>
                    </td>
                  </tr>
                </table>
            </h2>
            <table>
              <tr>
                <td style="padding:4px"><img src="./head/<?php echo $user['head']; ?>" height="128px" width="128px"></td>
                <td>
                  <table>
                    <tr>
                      <td><p>Password : </p></td>
                      <td><p><?php echo $user['password']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td><p>Type : </p></td>
                      <td><p><?php echo $user['type']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td width="90"><p>Name : </p></td>
                      <td><p><?php echo $user['username']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td width="80px"><p>Birthday : </p></td>
                      <td><p><?php echo $user['birthday']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td><p>Telephone : </p></td>
                      <td><p><?php echo $user['telephone']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td><p>City : <p></td>
                      <td><p><?php echo $user['city']; ?></p></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p>沒有任何帳號</p>
        <?php endif; ?>

  </div>