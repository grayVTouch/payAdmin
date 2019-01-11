drop table if exists `cl_route`;
create table if not exists `cl_route` (
  id int not null auto_incrment ,
  name char(255) comment '名称' ,
  link char(255) comment '连接' ,
  p_id int comment 'cl_route.id' ,
  enable enum('y' , 'n') default 'y' comment '是否启用：y-启用 n-禁用' ,
  used enum('y' , 'n') default 'y' comment '是否完善：y-启用 n-禁用' ,
  create_time datetime default current_timestamp ,
  primary key `id` (`id`)
) engine = innodb character set = utf8mb4 collate = utf8mb4_bin comment '路由表 by cxl';

drop table if exists `cl_user_permission`;
create table if not exists `cl_user_permission` (
  id int not null auto_incrment ,
  user_id int comment 'cl_role.id' ,
  route_id int comment 'cl_route.id' ,
) engine = innodb character set = utf8mb4 collate = utf8mb4_bin comment '权限表 by cxl';

