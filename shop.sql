-- 当前项目的所有表

-- 创建一个用于管理shop41库的用户
-- grant分配权限，分配所有权限 在 shop41.* 为 shop41_user 加密为 '1234abcd'
grant all privileges on shop41.* to shop41_user IDENTIFIED BY '1234abcd';
-- 刷新权限，使之立即生效
flush privileges;

-- 使用的库
create database shop41 charset=utf8;
use shop41;

-- 管理员
create table kang_admin (
	admin_id int unsigned not null auto_increment comment '管理员ID,PK',
	admin_name varchar(32) not null default '' comment '姓名',
	admin_password char(32) not null default '' comment 'md5()处理之后的单向密码',
	primary key (admin_id)
) engine=myisam charset=utf8;

-- 添加测试数据
insert into kang_admin values (23, 'kang', md5('1234abcd'));
insert into kang_admin values (45, 'admin', md5('1234abcd'));

-- 商品表
create table kang_goods (
	goods_id int unsigned not null auto_increment comment 'PK',
	goods_name varchar(64) not null default '' comment '商品名',
	shop_price decimal(10, 2) not null default 0 comment '商品价格,浮点double和定点decimal',
	image_ori varchar(255) not null default '' comment '原始图片地址',
	goods_image varchar(255) not null default '' comment '项目中使用的处理过的图片地址，例如缩略图，加水印等',
	goods_desc text comment '商品描述',
	goods_number int unsigned not null default 0 comment '库存',
	is_best tinyint not null default 0 comment '是否精品',
	is_new tinyint not null default 1 comment '是否新品',
	is_hot tinyint not null default 0 comment '是否热销',
	is_on_sale tinyint not null default 1 comment '是否上架在售',
	-- 重要数据，需要记录些额外信息！
	-- create_admin_id commnt '哪个管理员添加的'
	-- update_admin_id commnt '哪个管理员添加的'
	-- create_time comment '创建时间',
	-- update_time comment '最后更新时间',
	primary key (goods_id)
) engine=myisam charset=utf8;