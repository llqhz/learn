# rbac 权限控制
## 五张表

user ( id, name, is_admin, status )
role ( id, name, status )
user_role ( id, uid, role_id )

access ( id, name, urls, statu )
role_access ( id, role_id, access_id )

### 操作日志表
app_log ( id, name, urls, details, times )

> 当用户点击urls , 找到用户id => 从user_rule表找到用户的所有角色 => 从role_access表中找到每个角色的所有权限
判断每个权限是否match urls若有,则有权限

