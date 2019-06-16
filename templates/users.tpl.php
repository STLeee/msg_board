<script>
	function askForDelete(id, account) {
		if (confirm("確定要刪除 " + account + " ?")) {
			document.location.href="./index.php?act=deleteUser&id=" + id;
		}
	}
</script>
  
<?php include 'templates/function.tpl.php'; ?>
  
  <div id="content">
  
  	<h2><?php echo $this->message; ?></h2>

    <?php if ($this->usersMessages != NULL): ?>
		<?php if (count($this->usersMessages)): ?>
        
        <?php foreach ($this->usersMessages as $userMessages): ?>
        <div class="messageBlock">
            <h2>
              <table width="100%">
                <tr>
                  <td width="270">
            	    <a style="color:#000000" href="./index.php?account=<?php echo $userMessages['account']; ?>"><?php echo $userMessages['username']; ?></a>
                  </td>
                  <td>
                    <p class="messageBlockFunctions">
                    <?php if ($this->user['id'] != $userMessages['id']): ?>
                      <?php if ($userMessages['friendType'] == 0): ?>
                      <a href="./index.php?act=addFriend&id=<?php echo $userMessages['id']; ?>">加為好友</a>
                      <?php elseif ($userMessages['friendType'] == 1): ?>
                      等待確認中-<a href="./index.php?act=cancalAddFriend&id=<?php echo $userMessages['id']; ?>">取消</a>
                      <?php elseif ($userMessages['friendType'] == 2): ?>
                      <a href="./index.php?act=confirmFriend&id=<?php echo $userMessages['id']; ?>">確認</a>／<a href="./index.php?act=refuseFriend&id=<?php echo $userMessages['id']; ?>">拒絕</a>
                      <?php elseif ($userMessages['friendType'] == 3): ?>
                      <a href="./index.php?act=removeFriend&id=<?php echo $userMessages['id']; ?>">刪除好友</a>
                      <?php endif; ?>
                    <?php endif; ?>
                    </p>
                  </td>
                </tr>
              </table>
            </h2>
             <table>
              <tr>
                <td style="padding:4px; vertical-align:top"><img src="./head/<?php echo $userMessages['head']; ?>" height="64px" width="64px"></td>
                <td style="vertical-align:top">
                  <table style="padding:4px">
                    <tr>
                      <td width="90px"><p>Birthday : </p></td>
                      <td><p><?php echo $userMessages['birthday']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td><p>Telephone : </p></td>
                      <td><p><?php echo $userMessages['telephone']; ?></p></td>
                    </tr>
                    
                    <tr>
                      <td><p>City : <p></td>
                      <td><p><?php echo $userMessages['city']; ?></p></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
        </div>
        <?php endforeach; ?>
        
        <?php else: ?>
        <p>找不到符合的朋友</p>
        <?php endif; ?>
    <?php endif; ?>
    
    

    
<script language="JavaScript">
  function skey(id, selected) {
    if (selected != '換群組...') {
		if (selected != '<新增>') {
			document.location.href="./index.php?act=changeGroup&id=" + id + "&groupName=" + selected;
		} else {
			groupName = prompt("新增群組：", "default");
			if (groupName != null) document.location.href="./index.php?act=changeGroup&id=" + id + "&groupName=" + groupName;
		}
	}
  }
</script>
    <?php if ($this->allFriends != NULL): ?>
		<?php if (count($this->allFriends)): ?>
        
		<?php foreach ($this->allFriends as $key => $groud) {
          if ($key > 0) $groupNames[] = $groud['groupName'];
        }?>
        
        <?php foreach ($this->allFriends as $key => $groud): ?>
          <?php if (count($groud['friends'])): ?>
            <h3><?php echo $groud['groupName']; ?></h3>
            <?php foreach ($groud['friends'] as $friend): ?>
            <div class="messageBlock">
                <h2>
                  <table width="100%">
                    <tr>
                      <td width="270">
                        <a style="color:#000000" href="./index.php?account=<?php echo $friend['account']; ?>"><?php echo $friend['username']; ?></a>
                      </td>
                      <td class="messageBlockFunctions">
                        <?php if ($key == 0): ?>
                        <a href="./index.php?act=confirmFriend&id=<?php echo $friend['id']; ?>">確認</a>／<a href="./index.php?act=refuseFriend&id=<?php echo $friend['id']; ?>">拒絕</a>
                        <?php else: ?>
                      	<form>
                        <select name="groupName" id="groupName" onchange="skey(<?php echo $friend['id'];?>, this.options[this.selectedIndex].value)" style="width:84px">
                          <option>換群組...</option>
                          <?php foreach ($groupNames as $groudName) {
			                echo '<option>' . $groudName . '</option>';
                          }?>
                          <option><新增></option>
                        </select>
                        |
                        <a href="./index.php?act=removeFriend&id=<?php echo $friend['id']; ?>">刪除</a>
                        <?php endif; ?>
                        </form>
                      </td>
                    </tr>
                  </table>
                </h2>
               <table>
                <tr>
                  <td style="padding:4px; vertical-align:top"><img src="./head/<?php echo $friend['head']; ?>" height="64px" width="64px"></td>
                  <td style="vertical-align:top">
                    <table style="padding:4px">
                      <tr>
                        <td width="90px"><p>Birthday : </p></td>
                        <td><p><?php echo $friend['birthday']; ?></p></td>
                      </tr>
                      
                      <tr>
                        <td><p>Telephone : </p></td>
                        <td><p><?php echo $friend['telephone']; ?></p></td>
                      </tr>
                      
                      <tr>
                        <td><p>City : <p></td>
                        <td><p><?php echo $friend['city']; ?></p></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endforeach; ?>
        
        <?php else: ?>
        <p>你沒有朋友...好可憐</p>
        <?php endif; ?>
    <?php endif; ?>

  </div>