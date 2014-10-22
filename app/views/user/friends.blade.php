<form method="POST" action="friends/add-friend">
	Friend ID: <input type="text" name="friend">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/add-friend-to-group">
	Friend ID: <input type="text" name="friend">
	Group ID: <input type="text" name="group">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/add-group">
	Group Name: <input type="text" name="group">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/del-friend-from-group">
	Friend ID: <input type="text" name="friend">
	Group ID: <input type="text" name="group">
	<input type="submit" name="submit" value="删除">
</form>
<form method="POST" action="friends/del-group">
	Group Name: <input type="text" name="group">
	<input type="submit" name="submit" value="删除">
</form>