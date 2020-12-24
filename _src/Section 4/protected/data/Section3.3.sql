ALTER TABLE `tbl_album`   
  ADD COLUMN `description` VARCHAR(1024) NULL AFTER `name`,
  ADD COLUMN `category_id` INT(11) NULL AFTER `description`;
