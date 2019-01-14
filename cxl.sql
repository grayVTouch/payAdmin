drop table if exists `cl_role`;
create table if not exists `cl_role` (
  id int unsigned not null auto_increment ,
  name char(255) comment '角色名称' ,
  code char(255) comment '角色代码' ,
  weight int default 0 comment '权重' ,
  create_time datetime default current_timestamp ,
  primary key `id` (`id`)
) engine = innodb character set = utf8mb4 collate = utf8mb4_bin comment '角色表 by cxl';

drop table if exists `cl_role_permission`;
create table if not exists `cl_role_permission` (
  id int not null auto_increment ,
  role_id int comment 'cl_role.id' ,
  route_id int comment 'cl_route.id' ,
  primary key `id` (`id`)
) engine = innodb character set = utf8mb4 collate = utf8mb4_bin comment '角色权限表 by cxl';

drop table if exists `cl_route`;
create table if not exists `cl_route` (
  id int unsigned not null auto_increment ,
  name char(255) comment '名称（中文）' ,
  en char(255) comment '英文名称' ,
  module char(50) comment '模块' ,
  controller char(50) comment '控制器' ,
  action char(50) comment '动作' ,
  is_menu enum('y' , 'n') default 'n' comment '是否菜单项：y-是 n-否' ,
  enable enum('y' , 'n') default 'y' comment '仅对菜单项有效，是否启用：y-启用 n-禁用' ,
  ico_for_font char(255) comment '图标字体名称，仅针对iview 框架做的特殊处理' ,
  ico_for_small char(255) comment '小图标，图片链接地址' ,
  ico_for_big char(255) comment '大图标，图片链接地址' ,
  weight int default 0 comment '权重' ,
  p_id int default 0 comment 'cl_route.id' ,
  create_time datetime default current_timestamp ,
  primary key `id` (`id`)
) engine = innodb character set = utf8mb4 collate = utf8mb4_bin comment '路由表 by cxl';

insert into `cl_role` (name , code) values
('管理员' , 100) ,
('代理' , 110) ,
('商户' , 120);

insert into `cl_route` (name , en , module , controller , action , is_menu , ico_for_font , p_id) values
('用户管理' , 'User Manager' , null , null , null , 'y' , 'ios-paper' , 0) ,
('用户列表' , null , 'pay' , 'User' , 'listView' , 'y' , 'ios-paper' , 1) ,
('权限管理' , 'Permission Manager' , null , null , null , 'y' , 'ios-lock' , 0) ,
('角色列表' , null , 'pay' , 'Role' , 'listView' , 'y' , 'ios-paper' , 3) ,
('路由列表' , null , 'pay' , 'Route' , 'listView' , 'y' , 'ios-paper' , 3) ,
('角色权限' , null , 'pay' , 'Role' , 'perm' , 'y' , 'ios-paper' , 3) ,
('编辑角色' , null , 'pay' , 'Role' , 'editView' , 'n' , '' , 4) ,
('添加角色' , null , 'pay' , 'Role' , 'addView' , 'n' , '' , 4) ,
('删除角色' , null , 'pay' , 'Role' , 'del' , 'n' , '' , 4);

insert into `cl_role_permission` (role_id , route_id) values
(1 , 1) ,
(1 , 2) ,
(1 , 3) ,
(1 , 4) ,
(1 , 5) ,
(1 , 6);

-- alter table `cl_user` drop `is_root`;
-- alter table `cl_user` add `is_root` enum('y' , 'n') default 'n' comment '是否超级管理员：y-是 n-否';