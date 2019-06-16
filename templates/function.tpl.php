  <div id="functions">
    <ul>
      <form name="searchUsers" id="searchUsers" method="get" action="./index.php?act=searchUsers">
        <li><input type="hidden" name="act" value="searchUsers"><input type="text" name="keyword" id="keyword" placeholder="Search" onclick="./index.php?act=searchUsers" style="width:84px"/></li>
      </form>
      
      <li><a href="./index.php?account=<?php echo $this->user['account']?>">
      <table width="100%">
        <tr>
          <td width="24" style="vertical-align:top"><img src="./head/<?php echo $this->user['head']; ?>" height="24" width="24" style="border: 1px solid #000;"></td>
          <td><?php echo $this->user['username']; ?></td>
        </tr>
      </table>
      </a></li>

      <li><a href="./index.php?act=friends">好友名單</a></li>
      <li><a href="./index.php?act=editUser">個人資料</a></li>

      <?php if ($this->user['type'] == 1): ?>
      <li><a href="./index.php?act=manageUsers">管理使用者</a></li>
      <?php endif; ?>

      <li><a href="./index.php?act=logout">登出</a></li>
    </ul>
  </div>