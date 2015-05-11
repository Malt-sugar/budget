/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50534
Source Host           : 127.0.0.1:3306
Source Database       : armalik_rnd

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2015-01-18 16:25:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ait_system_module`
-- ----------------------------
DROP TABLE IF EXISTS `ait_system_module`;
CREATE TABLE `ait_system_module` (
  `sm_id` varchar(20) NOT NULL COMMENT 'System Module Primary ID',
  `sm_name` varchar(50) NOT NULL COMMENT 'Module Name',
  `sm_icon` varchar(20) NOT NULL COMMENT 'Module Icon',
  `sm_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Module Display Order',
  `sm_entry_date` datetime NOT NULL COMMENT 'Module Entry Date Time',
  PRIMARY KEY (`sm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ait_system_module
-- ----------------------------
INSERT INTO `ait_system_module` VALUES ('SM-000001', 'Control Panel', 'SM-000001.png', '1', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000002', 'Setup', 'SM-000002.png', '2', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000003', 'Product', 'SM-000003.png', '3', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000004', 'Payment', 'SM-000004.png', '4', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000005', 'Management', 'SM-000005.png', '5', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000006', 'Report', 'SM-000006.png', '6', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000007', 'Setup', 'SM-000002.png', '7', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000008', 'R&D Activities', 'SM-000002.png', '9', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000009', 'Trail Analysis', 'SM-000002.png', '10', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000010', 'Head Office', 'SM-000002.png', '11', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000011', 'General Info', 'SM-000002.png', '8', '0000-00-00 00:00:00');
INSERT INTO `ait_system_module` VALUES ('SM-000012', 'R & D Reports', '', '0', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `ait_system_task`
-- ----------------------------
DROP TABLE IF EXISTS `ait_system_task`;
CREATE TABLE `ait_system_task` (
  `st_id` varchar(20) NOT NULL COMMENT 'System Task Id Primary Key',
  `st_sm_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'System Module ID Foreign Key',
  `st_icon` varchar(20) NOT NULL COMMENT 'Task Icon',
  `st_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Task Display Order',
  `st_name` varchar(100) NOT NULL COMMENT 'Task Name',
  `st_pram` varchar(150) NOT NULL DEFAULT '0' COMMENT 'System Task Parameter',
  `st_eventadd` varchar(15) NOT NULL COMMENT 'Task Add Event',
  `st_eventsave` varchar(15) DEFAULT NULL,
  `st_eventedit` varchar(15) NOT NULL COMMENT 'Task Edit Event',
  `st_eventdelete` varchar(15) NOT NULL COMMENT 'Task Delete Event',
  `st_eventview` varchar(15) NOT NULL COMMENT 'Task View Event',
  `st_eventreport` varchar(15) NOT NULL COMMENT 'Task Report Event',
  `st_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Task Entry Date & Time',
  `st_status` varchar(15) NOT NULL DEFAULT 'Active' COMMENT 'Task Display Status',
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ait_system_task
-- ----------------------------
INSERT INTO `ait_system_task` VALUES ('ST-000001', 'SM-000001', 'ST-000001.png', '1', 'Modules & Task', 'Modules_Task/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:17:20', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000002', 'SM-000001', 'ST-000002.png', '2', 'User Group', 'user_group/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:17:20', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000003', 'SM-000001', 'ST-000003.png', '3', 'Create User', 'user_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:17:20', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000004', 'SM-000002', 'ST-000004.png', '1', 'Employee', 'employee_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000005', 'SM-000002', 'ST-000005.png', '2', 'Distributor', 'distributor_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000006', 'SM-000002', 'ST-000006.png', '3', 'Dealer', 'dealer_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000007', 'SM-000002', 'ST-000007.png', '4', 'Warehouse', 'warehouse_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000008', 'SM-000002', 'ST-000008.png', '5', 'Designation', 'designation_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000009', 'SM-000002', 'ST-000009.png', '6', 'Zone', 'zone_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000010', 'SM-000002', 'ST-000010.png', '7', 'Crop', 'crop_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000011', 'SM-000002', 'ST-000011.png', '8', 'Variety', 'varriety_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-21 12:46:30', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000012', 'SM-000002', 'ST-000012.png', '9', 'Product', 'product_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000013', 'SM-000002', 'ST-000013.png', '10', 'Product Pricing', 'product_pricing/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000014', 'SM-000002', 'ST-000014.png', '11', 'Bank', 'bank_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000015', 'SM-000002', 'ST-000015.png', '12', 'Branch', 'bank_branch_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000016', 'SM-000002', 'ST-000016.png', '13', 'Territory', 'territory_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000017', 'SM-000003', '', '1', 'PO', 'product_purchase_order/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2013-12-25 05:38:40', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000018', 'SM-000003', '', '2', 'Inventory', 'product_inventory/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000019', 'SM-000003', '', '3', 'Transfer', 'product_transfer/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000020', 'SM-000002', 'ST-000020.png', '14', 'Pack Size', 'product_pack_size/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-02 12:45:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000021', 'SM-000003', '', '4', 'PO Approve', 'product_purchase_order_approve/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000022', 'SM-000003', '', '5', 'PO Delivery', 'product_purchase_order_delivery/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000023', 'SM-000003', '', '6', 'Goods Received', 'product_purchase_order_receive/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-05-19 21:16:21', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000024', 'SM-000004', '', '1', 'Credit Limit', 'distributor_credit_limit/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2013-12-26 14:14:14', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000025', 'SM-000003', '', '7', 'Special Offer', 'product_special_offer/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000026', 'SM-000003', '', '8', 'Sale', 'distributor_product_sale/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000027', 'SM-000005', '', '1', 'Weekly Tour Plan', 'weekly_tour_plan/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2013-12-28 11:03:36', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000028', 'SM-000005', '', '2', 'Add Task', 'add_task/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-01-01 11:42:57', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000029', 'SM-000003', '', '9', 'Sale Target', 'product_sale_target/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000030', 'SM-000005', '', '3', 'Photo Gallery', 'product_photo_gallery/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000031', 'SM-000004', '', '2', 'Add Payment', 'distributor_add_payment/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000032', 'SM-000005', '', '4', 'Progress Task', 'progress_task/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000033', 'SM-000002', '.png', '15', 'Product Type', 'product_type/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000034', 'SM-000001', '.png', '4', 'Change Password', 'user_change_password/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000035', 'SM-000001', '.png', '5', 'Reset Password', 'user_reset_password/list_frm.php', 'add', '', 'edit', 'delete', 'details', 'report', '2014-01-07 08:24:23', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000036', 'SM-000002', '.png', '16', 'Create Season', 'session_create/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-21 13:41:55', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000037', 'SM-000006', 'ST-000037.png', '1', 'Season Wise Variety Report', 'report_season_variety/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-05-31 00:59:53', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000038', 'SM-000003', '.png', '10', 'Sale Return', 'product_sale_return/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000039', 'SM-000006', '.png', '2', 'Sales Report', 'report_sale/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-07 09:58:16', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000040', 'SM-000006', '.png', '3', 'Purchase Order Report', 'report_purchase_order/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000041', 'SM-000006', '.png', '4', 'Sales Return Report', 'report_sale_return/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000042', 'SM-000006', '.png', '5', 'Credit Limit Report', 'report_credit_limit/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000043', 'SM-000006', '.png', '6', 'Current Stock Report', 'report_warehouse_current_stock/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-12 12:37:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000044', 'SM-000006', '.png', '7', 'Distributor Current Stock Report', 'report_distributor_current_stock/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-08 05:11:29', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000045', 'SM-000006', '.png', '8', 'Distributor Sales Report', 'report_distributor_sale/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000046', 'SM-000006', '.png', '9', 'Distributor Balance Report', 'report_distributor_balance/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000047', 'SM-000006', '.png', '10', 'Distributor Payment Report', 'report_distributor_payment/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000048', 'SM-000006', '.png', '11', 'Weekly Tour Plan Report', 'report_weekly_tour_plan/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-03-08 05:11:33', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000049', 'SM-000006', '.png', '12', 'Task Report', 'report_task/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000050', 'SM-000005', '.png', '5', 'Weekly Tour Plan Progress', 'weekly_tour_plan_progress/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000051', 'SM-000006', '.png', '13', 'Invoice Print', 'report_invoice_print/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000052', 'SM-000006', '.png', '14', 'PO Delivery Status Report', 'report_po_delivery_status/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000053', 'SM-000006', '.png', '15', 'Distributor Sales in KG', 'report_distributor_sale_in_kg/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000054', 'SM-000006', '.png', '16', 'Sales in kG', 'report_sale_in_kg/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000055', 'SM-000006', '.png', '17', 'Warehouse Current Stock in KG', 'report_warehouse_current_stock_in_kg/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000056', 'SM-000002', '.png', '17', 'Division', 'division_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000057', 'SM-000004', '.png', '3', 'Payment Receipt', 'distributor_payment_recevipt/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000058', 'SM-000006', '.png', '18', 'Challan Print', 'report_challan_print/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000059', 'SM-000006', '.png', '19', 'Product Sale Target', 'report_product_sale_target/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000060', 'SM-000002', '.png', '18', 'Delete Product ', 'product_delete/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000061', 'SM-000002', '.png', '19', 'Delete PO Approve', 'product_purchase_order_approve_delete/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000062', 'SM-000002', '', '20', 'Delete PO Delivery', 'product_purchase_order_delivery_delete/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000063', 'SM-000002', '', '21', 'Delete Goods Received', 'product_purchase_order_receive_delete/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000064', 'SM-000002', '', '22', 'Farmer Info', 'farmer_info/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000065', 'SM-000003', '.png', '11', 'PDO Product Create', 'pdo_product_create/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000066', 'SM-000003', '.png', '12', 'Product Photo Upload', 'pdo_product_photo_upload/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-07-06 11:03:29', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000067', 'SM-000003', '.png', '13', 'PRI Product Review', 'pdo_product_review/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-07-17 11:33:49', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000068', 'SM-000003', '.png', '14', 'Zone Sale Target', 'product_sale_target_zone/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000069', 'SM-000006', '', '20', 'Product Sale Target (Marketing)', 'report_product_sale_target_marketing/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000070', 'SM-000002', '', '23', 'Delete Distributor Payment', 'delete_distributor_add_payment/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000071', 'SM-000003', '.png', '15', 'PDO Product View', 'pdo_product_review_view/list_frm.php', 'add', 'save', 'edit', 'delete', 'details', 'report', '0000-00-00 00:00:00', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000072', 'SM-000007', 'ST-000072.png', '1', 'Create Crop', 'create_crop', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-09-10 17:31:15', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000073', 'SM-000007', 'ST-000073.png', '2', 'Create Type', 'create_crop_type', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-09-15 11:45:46', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000074', 'SM-000007', 'ST-000074.png', '3', 'Create Variety', 'create_crop_variety', 'add', 'save', 'edit', 'delete', 'details', 'report', '2014-09-15 11:45:48', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000075', 'SM-000007', 'ST-000074.png', '4', 'Create Principal', 'create_principal', '', null, '', '', '', '', '2014-09-16 14:58:23', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000076', 'SM-000007', 'ST-000074.png', '5', 'Create Fertilizer', 'create_fertilizer', '', null, '', '', '', '', '2014-09-16 14:58:30', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000077', 'SM-000007', 'ST-000074.png', '6', 'Create Pesticide & Fungicide', 'create_pesticide', '', null, '', '', '', '', '2014-09-16 14:58:44', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000078', 'SM-000007', 'ST-000074.png', '7', 'Create Plot', 'create_plot', '', null, '', '', '', '', '2014-09-16 14:58:48', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000079', 'SM-000008', 'ST-000074.png', '1', 'Plot Design', 'rnd_plot_design', '', null, '', '', '', '', '2014-09-16 16:34:40', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000080', 'SM-000008', '', '2', 'Fertiliser Requirement', 'rnd_feriliser_requirement', '', null, '', '', '', '', '2014-09-16 16:34:43', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000081', 'SM-000008', '', '3', 'Fertiliser Stock In', 'rnd_feriliser_stock_in', '', null, '', '', '', '', '2014-09-16 16:34:45', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000082', 'SM-000008', '', '4', 'Fertiliser Stock Out', 'rnd_feriliser_stock_out', '', null, '', '', '', '', '2014-09-16 16:34:47', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000083', 'SM-000008', '', '5', 'Pesticide Stock In', 'rnd_pesticide_stock_in', '', null, '', '', '', '', '2014-09-16 16:34:49', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000084', 'SM-000008', '', '6', 'Pesticide Stock Out', 'rnd_pesticide_stock_out', '', null, '', '', '', '', '2014-09-16 16:34:52', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000085', 'SM-000008', '', '7', 'Labour Activities', 'rnd_labour_activities', '', null, '', '', '', '', '2014-09-16 16:34:54', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000086', 'SM-000009', '', '1', '15 Day\'s Picture Intervel - Fortnightly', 'trail_fiftyfive_fortnighly_report', '', null, '', '', '', '', '2014-09-17 12:55:20', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000087', 'SM-000009', '', '2', '15 Day\'s Picture Report', 'trail_fiftyfive_picture_report', '', null, '', '', '', '', '2014-09-17 14:13:53', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000088', 'SM-000009', '', '3', 'Flower/Curd Report', 'trail_flower_curd_report', '', null, '', '', '', '', '2014-09-17 12:56:37', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000089', 'SM-000009', '', '4', 'Flowering Picture Report', 'trail_flower_picture_report', '', null, '', '', '', '', '2014-09-17 12:56:53', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000090', 'SM-000009', '', '5', 'Disease Report', 'trail_disease_report', '', null, '', '', '', '', '2014-09-17 12:57:34', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000091', 'SM-000009', '', '6', 'Fruit/Curd Report', 'trail_fruid_curd_report', '', null, '', '', '', '', '2014-09-17 12:59:15', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000092', 'SM-000009', '', '7', 'Fruit/Curd Picture Report', 'trail_fruid_curd_picture_report', '', null, '', '', '', '', '2014-09-17 12:59:17', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000093', 'SM-000009', '', '8', 'First and Last Harvesting Report', 'trail_harvesting_report', '', null, '', '', '', '', '2014-09-17 12:59:19', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000094', 'SM-000010', '', '1', 'Crop Classification', 'hofc_crop_classification', '', null, '', '', '', '', '2014-09-17 13:00:37', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000095', 'SM-000010', '', '2', 'Sample Local Procurement', 'hofc_sample_local_procurement', '', null, '', '', '', '', '2014-09-17 13:01:09', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000096', 'SM-000010', '', '3', 'Sample Principal Procurement', 'hofc_principal_procurement', '', null, '', '', '', '', '2014-09-17 13:01:23', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000097', 'SM-000011', '', '1', 'Sample Delivery Status', 'general_sample_delivery', '', null, '', '', '', '', '2015-01-17 12:10:38', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000098', 'SM-000009', '', '0', 'Fruit Report Entry', 'trial_fruit_report_entry', '', '', '', '', '', '', '2015-01-06 17:28:35', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000099', 'SM-000009', '', '0', 'Fruit Report', 'trial_fruit_report', '', '', '', '', '', '', '2015-01-06 17:28:40', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000100', 'SM-000012', '', '0', 'Fertilizer Current Stock Report', 'rnd_fertilizer_current_stock', '', null, '', '', '', '', '2015-01-12 15:00:38', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000101', 'SM-000012', '', '0', 'Pesticide Current Stock Report', 'rnd_pesticide_current_stock', '', null, '', '', '', '', '2015-01-12 19:12:23', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000102', 'SM-000012', '', '0', 'Labour Activity Report', 'rnd_labour_activity_report', '', null, '', '', '', '', '2015-01-13 17:18:52', 'Active');
INSERT INTO `ait_system_task` VALUES ('ST-000103', 'SM-000012', '', '0', 'Procurement Report', 'rnd_procurement_report', '', null, '', '', '', '', '2015-01-17 12:09:45', 'Active');

-- ----------------------------
-- Table structure for `ait_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `ait_user_group`;
CREATE TABLE `ait_user_group` (
  `ug_rowid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key Auto ID',
  `ug_id` varchar(15) NOT NULL COMMENT 'Group ID Primary Key',
  `ug_name` varchar(100) NOT NULL COMMENT 'Group Name',
  `up_sm_id` varchar(15) NOT NULL COMMENT 'System Module ID  Foreign Key',
  `up_st_id` varchar(15) NOT NULL COMMENT 'System Task ID  Foreign Key',
  `up_eventadd` varchar(15) NOT NULL COMMENT 'Task Add Event',
  `up_eventsave` varchar(15) DEFAULT NULL,
  `up_eventedit` varchar(15) NOT NULL COMMENT 'Task Edit Event',
  `up_eventdelete` varchar(15) NOT NULL COMMENT 'Task Delete Event',
  `up_eventview` varchar(15) NOT NULL COMMENT 'Task View Event',
  `up_eventreport` varchar(15) NOT NULL COMMENT 'Task Report Event',
  `up_confidentiality` varchar(25) NOT NULL COMMENT 'Data Confidentiality Level',
  `ug_entry_date` datetime NOT NULL COMMENT 'Uger Group Entry Date Time',
  PRIMARY KEY (`ug_rowid`),
  KEY `up_sm_id` (`up_sm_id`),
  KEY `up_st_id` (`up_st_id`),
  KEY `ug_id` (`ug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11178 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ait_user_group
-- ----------------------------
INSERT INTO `ait_user_group` VALUES ('9147', 'UG-000006', 'Admin', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9148', 'UG-000006', 'Admin', 'SM-000002', 'ST-000004', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9149', 'UG-000006', 'Admin', 'SM-000002', 'ST-000005', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9150', 'UG-000006', 'Admin', 'SM-000002', 'ST-000006', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9151', 'UG-000006', 'Admin', 'SM-000002', 'ST-000007', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9152', 'UG-000006', 'Admin', 'SM-000002', 'ST-000009', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9153', 'UG-000006', 'Admin', 'SM-000002', 'ST-000010', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9154', 'UG-000006', 'Admin', 'SM-000002', 'ST-000011', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9155', 'UG-000006', 'Admin', 'SM-000002', 'ST-000012', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9156', 'UG-000006', 'Admin', 'SM-000002', 'ST-000013', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9157', 'UG-000006', 'Admin', 'SM-000002', 'ST-000016', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9158', 'UG-000006', 'Admin', 'SM-000002', 'ST-000020', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9159', 'UG-000006', 'Admin', 'SM-000002', 'ST-000033', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9160', 'UG-000006', 'Admin', 'SM-000002', 'ST-000036', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9161', 'UG-000006', 'Admin', 'SM-000003', 'ST-000017', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9162', 'UG-000006', 'Admin', 'SM-000003', 'ST-000021', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9163', 'UG-000006', 'Admin', 'SM-000003', 'ST-000025', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9164', 'UG-000006', 'Admin', 'SM-000003', 'ST-000029', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9165', 'UG-000006', 'Admin', 'SM-000004', 'ST-000024', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9166', 'UG-000006', 'Admin', 'SM-000005', 'ST-000027', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9167', 'UG-000006', 'Admin', 'SM-000005', 'ST-000028', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9168', 'UG-000006', 'Admin', 'SM-000005', 'ST-000032', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9169', 'UG-000006', 'Admin', 'SM-000005', 'ST-000050', '', '', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9170', 'UG-000006', 'Admin', 'SM-000006', 'ST-000037', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9171', 'UG-000006', 'Admin', 'SM-000006', 'ST-000039', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9172', 'UG-000006', 'Admin', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9173', 'UG-000006', 'Admin', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9174', 'UG-000006', 'Admin', 'SM-000006', 'ST-000042', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9175', 'UG-000006', 'Admin', 'SM-000006', 'ST-000043', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9176', 'UG-000006', 'Admin', 'SM-000006', 'ST-000044', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9177', 'UG-000006', 'Admin', 'SM-000006', 'ST-000045', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9178', 'UG-000006', 'Admin', 'SM-000006', 'ST-000046', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9179', 'UG-000006', 'Admin', 'SM-000006', 'ST-000047', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9180', 'UG-000006', 'Admin', 'SM-000006', 'ST-000048', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9181', 'UG-000006', 'Admin', 'SM-000006', 'ST-000049', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9182', 'UG-000006', 'Admin', 'SM-000006', 'ST-000051', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9183', 'UG-000006', 'Admin', 'SM-000006', 'ST-000052', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9184', 'UG-000006', 'Admin', 'SM-000006', 'ST-000053', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9185', 'UG-000006', 'Admin', 'SM-000006', 'ST-000054', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9186', 'UG-000006', 'Admin', 'SM-000006', 'ST-000055', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9506', 'UG-000007', 'Exicutive', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9507', 'UG-000007', 'Exicutive', 'SM-000002', 'ST-000005', 'add', 'save', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9508', 'UG-000007', 'Exicutive', 'SM-000002', 'ST-000006', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9509', 'UG-000007', 'Exicutive', 'SM-000002', 'ST-000009', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9510', 'UG-000007', 'Exicutive', 'SM-000002', 'ST-000016', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9859', 'UG-000003', 'Destributor', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9860', 'UG-000003', 'Destributor', 'SM-000002', 'ST-000006', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9861', 'UG-000003', 'Destributor', 'SM-000003', 'ST-000017', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9862', 'UG-000003', 'Destributor', 'SM-000003', 'ST-000023', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9863', 'UG-000003', 'Destributor', 'SM-000003', 'ST-000026', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9864', 'UG-000003', 'Destributor', 'SM-000003', 'ST-000038', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9865', 'UG-000003', 'Destributor', 'SM-000004', 'ST-000031', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9866', 'UG-000003', 'Destributor', 'SM-000005', 'ST-000027', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9867', 'UG-000003', 'Destributor', 'SM-000005', 'ST-000032', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9868', 'UG-000003', 'Destributor', 'SM-000005', 'ST-000050', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9869', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9870', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9871', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000044', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9872', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000045', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9873', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000046', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9874', 'UG-000003', 'Destributor', 'SM-000006', 'ST-000047', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9980', 'UG-000002', 'Warehouse', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9981', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000010', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9982', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000011', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9983', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000012', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9984', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000013', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9985', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000020', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9986', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000033', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9987', 'UG-000002', 'Warehouse', 'SM-000002', 'ST-000036', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9988', 'UG-000002', 'Warehouse', 'SM-000003', 'ST-000018', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9989', 'UG-000002', 'Warehouse', 'SM-000003', 'ST-000019', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9990', 'UG-000002', 'Warehouse', 'SM-000003', 'ST-000022', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9991', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000037', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9992', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000039', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9993', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9994', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9995', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000043', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9996', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000051', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9997', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000055', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('9998', 'UG-000002', 'Warehouse', 'SM-000006', 'ST-000058', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10198', 'UG-000004', 'Marketing', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10199', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000005', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10200', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000006', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10201', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000009', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10202', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000014', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10203', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000015', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10204', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000016', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10205', 'UG-000004', 'Marketing', 'SM-000002', 'ST-000056', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10206', 'UG-000004', 'Marketing', 'SM-000003', 'ST-000021', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10207', 'UG-000004', 'Marketing', 'SM-000003', 'ST-000025', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10208', 'UG-000004', 'Marketing', 'SM-000003', 'ST-000068', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10209', 'UG-000004', 'Marketing', 'SM-000004', 'ST-000024', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10210', 'UG-000004', 'Marketing', 'SM-000005', 'ST-000028', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10211', 'UG-000004', 'Marketing', 'SM-000005', 'ST-000032', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10212', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000037', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10213', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000039', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10214', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10215', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10216', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000042', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10217', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000043', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10218', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000044', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10219', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000045', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10220', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000046', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10221', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000047', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10222', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000048', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10223', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000049', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10224', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000051', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10225', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000052', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10226', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000053', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10227', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000054', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10228', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000055', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10229', 'UG-000004', 'Marketing', 'SM-000006', 'ST-000069', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10379', 'UG-000005', 'IT Executive', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10380', 'UG-000005', 'IT Executive', 'SM-000001', 'ST-000035', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10381', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000004', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10382', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000005', 'add', 'save', '', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10383', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000006', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10384', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000007', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10385', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000009', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10386', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000010', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10387', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000011', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10388', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000012', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10389', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000014', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10390', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000015', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10391', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000016', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10392', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000020', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10393', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000033', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10394', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000056', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10395', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000060', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10396', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000061', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10397', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000062', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10398', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000063', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10399', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000064', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10400', 'UG-000005', 'IT Executive', 'SM-000002', 'ST-000070', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10401', 'UG-000005', 'IT Executive', 'SM-000003', 'ST-000065', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10402', 'UG-000005', 'IT Executive', 'SM-000003', 'ST-000066', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10403', 'UG-000005', 'IT Executive', 'SM-000003', 'ST-000067', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10406', 'UG-000010', 'Product Recharge Incharge', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10407', 'UG-000010', 'Product Recharge Incharge', 'SM-000003', 'ST-000067', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10411', 'UG-000009', 'Product Development Officer', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10412', 'UG-000009', 'Product Development Officer', 'SM-000002', 'ST-000064', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10413', 'UG-000009', 'Product Development Officer', 'SM-000003', 'ST-000066', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10414', 'UG-000009', 'Product Development Officer', 'SM-000003', 'ST-000071', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10488', 'UG-000011', 'PDO Product Creator', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10489', 'UG-000011', 'PDO Product Creator', 'SM-000002', 'ST-000064', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10490', 'UG-000011', 'PDO Product Creator', 'SM-000003', 'ST-000065', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10491', 'UG-000008', 'Zonal Head Office', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10492', 'UG-000008', 'Zonal Head Office', 'SM-000003', 'ST-000017', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10493', 'UG-000008', 'Zonal Head Office', 'SM-000003', 'ST-000029', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10494', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000039', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10495', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10496', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10497', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000044', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10498', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000045', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10499', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000046', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10500', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000047', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10501', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000054', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('10502', 'UG-000008', 'Zonal Head Office', 'SM-000006', 'ST-000069', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11076', 'UG-000001', 'Administrator', 'SM-000001', 'ST-000001', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11077', 'UG-000001', 'Administrator', 'SM-000001', 'ST-000002', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11078', 'UG-000001', 'Administrator', 'SM-000001', 'ST-000003', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11079', 'UG-000001', 'Administrator', 'SM-000001', 'ST-000034', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11080', 'UG-000001', 'Administrator', 'SM-000001', 'ST-000035', 'add', '', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11081', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000004', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11082', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000005', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11083', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000006', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11084', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000007', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11085', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000008', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11086', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000009', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11087', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000010', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11088', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000011', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11089', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000012', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11090', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000013', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11091', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000014', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11092', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000015', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11093', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000016', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11094', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000020', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11095', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000033', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11096', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000036', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11097', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000056', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11098', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000060', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11099', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000061', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11100', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000062', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11101', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000063', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11102', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000064', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11103', 'UG-000001', 'Administrator', 'SM-000002', 'ST-000070', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11104', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000017', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11105', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000018', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11106', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000019', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11107', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000021', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11108', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000022', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11109', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000023', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11110', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000025', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11111', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000026', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11112', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000029', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11113', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000038', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11114', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000065', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11115', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000066', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11116', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000067', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11117', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000068', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11118', 'UG-000001', 'Administrator', 'SM-000003', 'ST-000071', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11119', 'UG-000001', 'Administrator', 'SM-000004', 'ST-000024', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11120', 'UG-000001', 'Administrator', 'SM-000004', 'ST-000031', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11121', 'UG-000001', 'Administrator', 'SM-000004', 'ST-000057', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11122', 'UG-000001', 'Administrator', 'SM-000005', 'ST-000027', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11123', 'UG-000001', 'Administrator', 'SM-000005', 'ST-000028', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11124', 'UG-000001', 'Administrator', 'SM-000005', 'ST-000030', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11125', 'UG-000001', 'Administrator', 'SM-000005', 'ST-000032', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11126', 'UG-000001', 'Administrator', 'SM-000005', 'ST-000050', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11127', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000037', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11128', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000039', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11129', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000040', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11130', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000041', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11131', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000042', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11132', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000043', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11133', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000044', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11134', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000045', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11135', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000046', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11136', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000047', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11137', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000048', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11138', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000049', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11139', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000051', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11140', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000052', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11141', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000053', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11142', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000054', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11143', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000055', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11144', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000058', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11145', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000059', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11146', 'UG-000001', 'Administrator', 'SM-000006', 'ST-000069', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11147', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000072', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11148', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000073', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11149', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000074', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11150', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000075', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11151', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000076', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11152', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000077', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11153', 'UG-000001', 'Administrator', 'SM-000007', 'ST-000078', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11154', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000079', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11155', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000080', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11156', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000081', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11157', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000082', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11158', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000083', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11159', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000084', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11160', 'UG-000001', 'Administrator', 'SM-000008', 'ST-000085', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11161', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000086', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11162', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000087', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11163', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000088', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11164', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000089', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11165', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000090', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11166', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000091', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11167', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000092', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11168', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000093', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11169', 'UG-000001', 'Administrator', 'SM-000010', 'ST-000094', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11170', 'UG-000001', 'Administrator', 'SM-000010', 'ST-000095', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11171', 'UG-000001', 'Administrator', 'SM-000010', 'ST-000096', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11172', 'UG-000001', 'Administrator', 'SM-000011', 'ST-000097', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11173', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000098', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11174', 'UG-000001', 'Administrator', 'SM-000009', 'ST-000099', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11175', 'UG-000001', 'Administrator', 'SM-000012', 'ST-000100', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11176', 'UG-000001', 'Administrator', 'SM-000012', 'ST-000101', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');
INSERT INTO `ait_user_group` VALUES ('11177', 'UG-000001', 'Administrator', 'SM-000012', 'ST-000102', 'add', 'save', 'edit', 'delete', 'details', 'report', '', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `ait_user_login`
-- ----------------------------
DROP TABLE IF EXISTS `ait_user_login`;
CREATE TABLE `ait_user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `employee_name` varchar(200) DEFAULT NULL,
  `user_level` varchar(100) NOT NULL COMMENT 'Employee Pirmary key',
  `division_id` varchar(20) NOT NULL,
  `zone_id` varchar(20) DEFAULT NULL,
  `territory_id` varchar(20) DEFAULT NULL,
  `warehouse_id` varchar(20) DEFAULT NULL,
  `user_group_id` varchar(20) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` text,
  `user_tmp_pass` varchar(20) DEFAULT NULL,
  `tmp_pass_status` int(1) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_expire_date` date DEFAULT NULL,
  `user_status` varchar(10) DEFAULT NULL COMMENT 'Active, Inactive',
  `del_status` int(1) NOT NULL,
  `user_photo` varchar(50) DEFAULT NULL,
  `entry_by` varchar(20) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ait_user_login
-- ----------------------------
INSERT INTO `ait_user_login` VALUES ('1', 'UI-000001', 'EI-000001', 'Md. Mizanur Rahman', 'Marketing', '0', '', '', '', 'UG-000001', 'super', 'ee96ba35751a964c34782fc0930952c0', null, '0', '2014-05-27 17:13:12', null, 'Active', '0', '31120701.jpg', null, null);
INSERT INTO `ait_user_login` VALUES ('17', 'UI-000002', 'EI-000019', 'Thanvir Salim Noor', 'Warehouse', '0', '', '', 'WI-000001', 'UG-000002', '0012', '68d9fcdfcf651453c37583179cbb2fcd', null, '0', '2014-06-02 06:24:16', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('18', 'UI-000003', 'EI-000020', 'Md. Sanowar Hossain', 'Marketing', '0', '', '', '', 'UG-000005', 'sanowar', '5fb552d46349660d5f1bb19a5589748b', null, '0', '2014-09-02 09:41:02', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('19', 'UI-000004', 'EI-000021', 'Md. Tariqul Islam', 'Marketing', '0', '', '', '', 'UG-000007', '0017', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('20', 'UI-000005', 'EI-000027', 'Dr. Arif Matin ', 'Marketing', '0', '', '', '', 'UG-000006', '009', 'ede396d31627acccc5eea2ee48948339', null, '0', '2014-06-05 21:30:17', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('21', 'UI-000006', 'EI-000018', 'A.K.M Shahidul Islam', 'Marketing', '0', '', '', '', 'UG-000004', '0010', '1bdc02582eb52f39d541e8f48ee569f7', null, '0', '2014-09-11 08:53:16', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('22', 'UI-000007', 'EI-000006', 'Md. Nazmul Kabir', 'Zone', '0', 'ZI-000005', '', '', 'UG-000003', '0060', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('23', 'UI-000008', 'EI-000064', 'Siddique Bazaar', 'Warehouse', '0', '', '', 'WI-000003', 'UG-000002', 'siddique_bazar ', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('24', 'UI-000009', 'EI-000065', 'Rangpur', 'Warehouse', '0', '', '', 'WI-000002', 'UG-000002', 'rangpur', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('25', 'UI-000010', 'EI-000023', 'Md. Zakir Hossain', 'Division', 'DI-000001', '', '', '', 'UG-000008', '0018', '3a648655fda348301400125166e79568', null, '0', '2014-07-10 11:47:23', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('26', 'UI-000011', 'EI-000015', 'Md. Abdus Samad', 'Zone', '0', 'ZI-000009', '', '', 'UG-000003', '0050', '3a648655fda348301400125166e79568', null, '0', '2014-08-11 19:51:17', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('27', 'UI-000012', 'EI-000066', 'Md. Mojnur Rahman', 'Division', 'DI-000002', '', '', '', 'UG-000008', '0027', '49f0c5d6f2b3c882e6a37dad50de2999', null, '0', '2014-07-10 11:47:30', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('28', 'UI-000013', 'EI-000007', 'Md. Mustafizar Rahman', 'Zone', '0', 'ZI-000007', '', '', 'UG-000003', '0057', '363776a769d5e837d28b47600a6c8ed1', null, '0', '2014-07-07 13:20:44', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('29', 'UI-000014', 'EI-000008', 'Md. Alimuzzaman (Babu)', 'Zone', '0', 'ZI-000008', '', '', 'UG-000003', '0054', '94be9d736a54c18efce6263b9446039e', null, '0', '2014-06-30 01:02:12', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('30', 'UI-000015', 'EI-000011', 'Md. Rezaul Karim', 'Zone', '0', 'ZI-000011', '', '', 'UG-000003', '0052', 'cfb7d7cddaf723a3efea4aaad9b04dc2', null, '0', '2014-06-22 14:51:21', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('31', 'UI-000016', 'EI-000009', 'Md. Abdul Alim', 'Zone', '0', 'ZI-000010', '', '', 'UG-000003', '0056', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('32', 'UI-000017', 'EI-000013', 'Md. Harun-Or-Rashid', 'Zone', '0', 'ZI-000006', '', '', 'UG-000003', '0055', '416106893283dbf1de5deca26a0e0806', null, '0', '2014-07-07 18:25:05', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('33', 'UI-000018', 'EI-000067', 'S.M Sarowar Hossain', 'Zone', '0', 'ZI-000004', '', '', 'UG-000003', '0068', '49f0c5d6f2b3c882e6a37dad50de2999', null, '0', '2014-08-21 09:35:03', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('34', 'UI-000019', 'EI-000012', 'A.R.M Roknuzzaman Prodhan', 'Zone', '0', 'ZI-000003', '', '', 'UG-000003', '0053', 'ee8081f4b95cfa6ae0010f5976ef80c6', null, '0', '2014-06-24 23:42:27', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('35', 'UI-000020', 'EI-000010', 'Md. Abdul hai', 'Zone', '0', 'ZI-000002', '', '', 'UG-000003', '0051', 'd010520096297a86347279e997b542c7', null, '0', '2014-06-24 21:32:49', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('36', 'UI-000021', 'EI-000072', 'Md. Zakir Hossain', 'Zone', '0', 'ZI-000001', '', '', 'UG-000003', '0064', '3a648655fda348301400125166e79568', null, '0', '2014-06-17 11:26:03', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('37', 'UI-000022', 'EI-000005', ' Prantosh Kumar', 'Marketing', '', '', '', '', 'UG-000009', '0061', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('38', 'UI-000023', 'EI-000004', 'Md. Fazlul Karim', 'Marketing', '', '', '', '', 'UG-000009', '0063', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('39', 'UI-000024', 'EI-000003', 'Md. Iklash Hussain', 'Marketing', '', '', '', '', 'UG-000009', '0065', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('40', 'UI-000025', 'EI-000002', 'Md. Shafiur Rahman', 'Marketing', '', '', '', '', 'UG-000009', '0066', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('41', 'UI-000026', 'EI-000001', 'Md. Mizanur Rahman', 'Marketing', '', '', '', '', 'UG-000009', '0067', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('42', 'UI-000027', 'EI-000060', 'Sumon Sarker', 'Marketing', '', '', '', '', 'UG-000009', '0042', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('43', 'UI-000028', 'EI-000071', 'Swarup Podder', 'Marketing', '', '', '', '', 'UG-000010', '0080', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('44', 'UI-000029', 'EI-000069', 'Md. Arefur Rahman', 'Marketing', '', '', '', '', 'UG-000010', '0081', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('45', 'UI-000030', 'EI-000022', 'Md. Abidur Rahman', 'Marketing', '', '', '', '', 'UG-000011', '0026', '145066a3eac722fc69fdc1c0d769cd39', null, '0', '2014-08-11 16:41:49', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('46', 'UI-000031', 'EI-000001', 'Md. Mizanur Rahman', 'Marketing', '', '', '', '', 'UG-000011', 'pdo', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('47', 'UI-000032', 'EI-000078', 'Md. Hadiuzzaman', 'Marketing', '', '', '', '', 'UG-000010', '0083', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);
INSERT INTO `ait_user_login` VALUES ('48', 'UI-000033', 'EI-000079', 'Md. Asraf Khan', 'Zone', '', 'ZI-000009', '', '', 'UG-000003', '0069', 'ede396d31627acccc5eea2ee48948339', null, '0', '0000-00-00 00:00:00', null, 'Active', '0', null, null, null);

-- ----------------------------
-- Table structure for `rnd_crop_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_crop_info`;
CREATE TABLE `rnd_crop_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crop_name` varchar(50) NOT NULL,
  `crop_code` varchar(20) NOT NULL,
  `crop_height` int(11) NOT NULL,
  `crop_width` int(11) NOT NULL,
  `fruit_type` int(11) NOT NULL,
  `sample_size` int(11) NOT NULL,
  `initial_plants` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by_2` (`created_by`),
  KEY `modified_by_2` (`modified_by`),
  KEY `created_by_3` (`created_by`),
  KEY `modified_by_3` (`modified_by`),
  KEY `created_by_4` (`created_by`),
  KEY `modified_by_4` (`modified_by`),
  KEY `created_by_5` (`created_by`),
  KEY `modified_by_5` (`modified_by`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_crop_info
-- ----------------------------
INSERT INTO `rnd_crop_info` VALUES ('3', 'Cucumber', 'C0001', '46', '23', '2', '1', '0', '1', 'UI-000001', '1419337772', 'UI-000001', '1420697092');
INSERT INTO `rnd_crop_info` VALUES ('4', 'Brinjal', 'B0001', '654', '344', '3', '1', '0', '1', 'UI-000001', '1419342256', 'UI-000001', '1420698019');
INSERT INTO `rnd_crop_info` VALUES ('5', 'Potato', 'P0001', '82', '41', '0', '1', '0', '1', 'UI-000001', '1419342385', null, null);
INSERT INTO `rnd_crop_info` VALUES ('6', 'Pumpkin', 'C0007', '45', '23', '0', '1', '0', '1', 'UI-000001', '1420024701', null, null);
INSERT INTO `rnd_crop_info` VALUES ('7', 'Tomato', 'T0001', '45', '23', '1', '1', '0', '1', 'UI-000001', '1420872764', null, null);
INSERT INTO `rnd_crop_info` VALUES ('8', 'Cucumbers', 'asas', '21', '12', '1', '1', '11', '1', 'UI-000001', '1420885553', 'UI-000001', '1421319426');
INSERT INTO `rnd_crop_info` VALUES ('9', 'Casasas', 'C000123', '12', '23', '5', '1', '12', '1', 'UI-000001', '1420891829', 'UI-000001', '1421319387');
INSERT INTO `rnd_crop_info` VALUES ('10', 'test', 'T0345', '12', '23', '3', '1', '11', '1', 'UI-000001', '1421320206', 'UI-000001', '1421320213');

-- ----------------------------
-- Table structure for `rnd_disease_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_disease_info`;
CREATE TABLE `rnd_disease_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rnd_code_id` int(10) DEFAULT NULL,
  `disease_part` int(1) DEFAULT NULL,
  `disease_image_url` varchar(20) DEFAULT NULL,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rnd_code_id` (`rnd_code_id`),
  CONSTRAINT `rnd_disease_info_ibfk_1` FOREIGN KEY (`rnd_code_id`) REFERENCES `rnd_variety_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_disease_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fertilizer_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fertilizer_info`;
CREATE TABLE `rnd_fertilizer_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fertilizer_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fertilizer_info
-- ----------------------------
INSERT INTO `rnd_fertilizer_info` VALUES ('1', 'Euria', '1', 'UI-000001', '1419675354', 'UI-000001', '1419678814');
INSERT INTO `rnd_fertilizer_info` VALUES ('2', 'Phosphate', '1', 'UI-000001', '1419675447', 'UI-000001', '1419677802');
INSERT INTO `rnd_fertilizer_info` VALUES ('3', 'Potassium', '1', 'UI-000001', '1419675463', 'UI-000001', '1419680235');

-- ----------------------------
-- Table structure for `rnd_fertilizer_requirement_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fertilizer_requirement_info`;
CREATE TABLE `rnd_fertilizer_requirement_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fertilizer_id` int(10) DEFAULT NULL,
  `requirement_date` int(11) DEFAULT NULL,
  `seed_bed_id` int(10) DEFAULT NULL,
  `requirement_type` int(1) NOT NULL,
  `plot_id` int(10) DEFAULT NULL,
  `plot_row_id` int(10) DEFAULT NULL,
  `fertilizer_quantity` double(5,2) DEFAULT NULL,
  `fertilizer_price` double(11,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fertilizer_id` (`fertilizer_id`),
  KEY `seed_bed_id` (`seed_bed_id`),
  KEY `plot_id` (`plot_id`),
  KEY `plot_row_id` (`plot_row_id`),
  CONSTRAINT `rnd_fertilizer_requirement_info_ibfk_1` FOREIGN KEY (`fertilizer_id`) REFERENCES `rnd_fertilizer_info` (`id`),
  CONSTRAINT `rnd_fertilizer_requirement_info_ibfk_2` FOREIGN KEY (`seed_bed_id`) REFERENCES `rnd_seed_bed_info` (`id`),
  CONSTRAINT `rnd_fertilizer_requirement_info_ibfk_3` FOREIGN KEY (`plot_id`) REFERENCES `rnd_plot_info` (`id`),
  CONSTRAINT `rnd_fertilizer_requirement_info_ibfk_4` FOREIGN KEY (`plot_row_id`) REFERENCES `rnd_plot_row_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fertilizer_requirement_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fertilizer_stock_in`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fertilizer_stock_in`;
CREATE TABLE `rnd_fertilizer_stock_in` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fertilizer_id` int(10) DEFAULT NULL,
  `fertilizer_quantity` double(6,2) NOT NULL,
  `fertilizer_price` decimal(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fertilizer_id` (`fertilizer_id`),
  CONSTRAINT `rnd_fertilizer_stock_in_ibfk_1` FOREIGN KEY (`fertilizer_id`) REFERENCES `rnd_fertilizer_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fertilizer_stock_in
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fertilizer_stock_out`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fertilizer_stock_out`;
CREATE TABLE `rnd_fertilizer_stock_out` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fertilizer_id` int(10) DEFAULT NULL,
  `seed_bed_id` int(10) DEFAULT NULL,
  `fertilizer_quantity` double(6,2) NOT NULL,
  `fertilizer_price` double(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fertilizer_id` (`fertilizer_id`),
  CONSTRAINT `rnd_fertilizer_stock_out_ibfk_1` FOREIGN KEY (`fertilizer_id`) REFERENCES `rnd_fertilizer_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fertilizer_stock_out
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fifteendays_interval_picture`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fifteendays_interval_picture`;
CREATE TABLE `rnd_fifteendays_interval_picture` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rnd_code_id` int(50) DEFAULT NULL,
  `picture_day` varchar(20) DEFAULT NULL,
  `picture_url` varchar(50) DEFAULT NULL,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rnd_code_id` (`rnd_code_id`),
  CONSTRAINT `rnd_fifteendays_interval_picture_ibfk_1` FOREIGN KEY (`rnd_code_id`) REFERENCES `rnd_variety_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fifteendays_interval_picture
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fifteen_days_picture_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fifteen_days_picture_report`;
CREATE TABLE `rnd_fifteen_days_picture_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `rnd_code` varchar(20) NOT NULL,
  `sowing_date` int(30) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(11) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_fifteen_days_picture_report
-- ----------------------------
INSERT INTO `rnd_fifteen_days_picture_report` VALUES ('1', '1', '6', '5', '18', '1420048800', 'UI-000001', '1420453462', null, null);
INSERT INTO `rnd_fifteen_days_picture_report` VALUES ('3', '0', '6', '5', '17', '1417370400', 'UI-000001', '1420554118', null, null);

-- ----------------------------
-- Table structure for `rnd_fifteen_days_picture_report_images`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fifteen_days_picture_report_images`;
CREATE TABLE `rnd_fifteen_days_picture_report_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_report_id` int(11) NOT NULL,
  `image_name` varchar(20) NOT NULL,
  `picture_day` int(11) NOT NULL,
  `picture_date` int(11) NOT NULL,
  `actual_picture_date` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_fifteen_days_picture_report_images
-- ----------------------------
INSERT INTO `rnd_fifteen_days_picture_report_images` VALUES ('1', '1', '14205530160.jpg', '15', '1421172000', '0', 'Remarks', 'UI-000001', '1420453462', 'UI-000001', '1420553887');
INSERT INTO `rnd_fifteen_days_picture_report_images` VALUES ('3', '1', '14205530171.jpg', '30', '1421172000', '0', 'Remarkssssssssssssss', 'UI-000001', '1420519479', 'UI-000001', '1420553887');
INSERT INTO `rnd_fifteen_days_picture_report_images` VALUES ('4', '1', '14205530172.jpg', '45', '1422381600', '0', ' Remarks 33333333333333333', 'UI-000001', '1420519509', 'UI-000001', '1420553887');
INSERT INTO `rnd_fifteen_days_picture_report_images` VALUES ('5', '1', '1420553803.jpg', '60', '1422468000', '1420553803', ' Remarks sdsdsdsd', 'UI-000001', '1420553803', 'UI-000001', '1420553887');
INSERT INTO `rnd_fifteen_days_picture_report_images` VALUES ('6', '3', '1420554118.jpg', '15', '1420480800', '1420554118', ' Remarks new', 'UI-000001', '1420554118', null, null);

-- ----------------------------
-- Table structure for `rnd_first_last_harvesting_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_first_last_harvesting_report`;
CREATE TABLE `rnd_first_last_harvesting_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rnd_code_id` int(10) DEFAULT NULL,
  `initial_plants_during_trial_start` varchar(20) DEFAULT NULL,
  `harvesting_date` int(11) DEFAULT NULL,
  `no_of_plants_harvested` int(6) NOT NULL,
  `no_of_fruits` int(6) DEFAULT NULL,
  `total_market` int(6) DEFAULT NULL,
  `total_market_weight` double(6,2) NOT NULL,
  `uniformity` double(6,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_first_last_harvesting_report
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_flowering_picture_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_flowering_picture_report`;
CREATE TABLE `rnd_flowering_picture_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `season_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `rnd_code_id` int(10) DEFAULT NULL,
  `first_flowering_pic` varchar(20) DEFAULT NULL,
  `first_flowering_remark` text,
  `fifty_flowering_pic` varchar(20) DEFAULT NULL,
  `fifty_flowering_remark` text,
  `first_setting_pic` varchar(20) DEFAULT NULL,
  `first_setting_remark` text,
  `first_harvested_pic` varchar(20) DEFAULT NULL,
  `first_harvested_remark` text,
  `last_harvested_pic` varchar(20) DEFAULT NULL,
  `last_harvested_remark` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rnd_code_id` (`rnd_code_id`),
  CONSTRAINT `rnd_flowering_picture_report_ibfk_1` FOREIGN KEY (`rnd_code_id`) REFERENCES `rnd_variety_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_flowering_picture_report
-- ----------------------------
INSERT INTO `rnd_flowering_picture_report` VALUES ('3', '1', '6', '5', '18', 'ffp1420634742.jpg', 'r11', 'fpp1420634742.jpg', 'r22', 'ffs1420634742.jpg', 'r33', 'fhf1420634742.jpg', 'r44', 'lhf1420642020.jpg', 'r55', '1', 'UI-000001', '1420634742', 'UI-000001', '1420642020');

-- ----------------------------
-- Table structure for `rnd_flowering_type_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_flowering_type_info`;
CREATE TABLE `rnd_flowering_type_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flowering_type` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_flowering_type_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_flower_curd_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_flower_curd_report`;
CREATE TABLE `rnd_flower_curd_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fertilizer_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_flower_curd_report
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_fortnightly_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fortnightly_report`;
CREATE TABLE `rnd_fortnightly_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rnd_code_id` int(10) DEFAULT NULL,
  `sowing_date` int(11) DEFAULT NULL,
  `transplanting_date` int(11) DEFAULT NULL,
  `initial_plants_during_trial_start` int(10) DEFAULT NULL,
  `fortnightly_reporting_date` int(11) DEFAULT NULL,
  `plant_type` int(1) DEFAULT NULL,
  `plant_uniformity` int(1) DEFAULT NULL,
  `distance_from_ground_curd` int(1) DEFAULT NULL,
  `crud_type` int(1) DEFAULT NULL,
  `crud_color` int(1) DEFAULT NULL,
  `crud_compactness` int(1) DEFAULT NULL,
  `crud_uniformity` int(1) DEFAULT NULL,
  `disease_severity` int(1) DEFAULT NULL,
  `special_characters_status` int(1) DEFAULT NULL,
  `accepted_status` int(1) DEFAULT NULL,
  `special_characters` text,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rnd_code_id` (`rnd_code_id`),
  CONSTRAINT `rnd_fortnightly_report_ibfk_1` FOREIGN KEY (`rnd_code_id`) REFERENCES `rnd_variety_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fortnightly_report
-- ----------------------------
INSERT INTO `rnd_fortnightly_report` VALUES ('1', '10', '1420480800', '1420480800', '12', '1420567200', '2', '2', '2', '2', '2', '2', '2', '2', '2', '1', ' Special Characters ssss', ' Remarks sss', '1', null, '1420269982', 'UI-000001', '1420278063');
INSERT INTO `rnd_fortnightly_report` VALUES ('2', '10', '1420048800', '1420394400', '34', '1420999200', '2', '1', '1', '1', '2', '3', '1', '1', '1', '1', ' Special Character', ' Remarks ', '1', 'UI-000001', '1420270182', null, null);
INSERT INTO `rnd_fortnightly_report` VALUES ('3', '15', '1421776800', '1421431200', '89', '1422208800', '2', '2', '1', '1', '1', '2', '2', '1', '1', '1', ' Special Characters ', '\r\nRemarks\r\n', '1', 'UI-000001', '1420270275', null, null);

-- ----------------------------
-- Table structure for `rnd_fruit_curd_report`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_fruit_curd_report`;
CREATE TABLE `rnd_fruit_curd_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rnd_code_id` int(10) DEFAULT NULL,
  `curd_type` int(1) DEFAULT NULL,
  `curd_color` int(1) DEFAULT NULL,
  `curd_weight` double(6,2) DEFAULT NULL,
  `curd_diameter` double(6,2) DEFAULT NULL,
  `curd_height` double(6,2) DEFAULT NULL,
  `curd_compactness` varchar(150) DEFAULT NULL,
  `keeping_quality` varchar(150) DEFAULT NULL,
  `special_characters` varchar(150) DEFAULT NULL,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `rnd_code_id` (`rnd_code_id`),
  CONSTRAINT `rnd_fruit_curd_report_ibfk_1` FOREIGN KEY (`rnd_code_id`) REFERENCES `rnd_variety_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_fruit_curd_report
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_history`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_history`;
CREATE TABLE `rnd_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_history
-- ----------------------------
INSERT INTO `rnd_history` VALUES ('1', '13', 'rnd_variety_info', '{\"principal_id\":\"2\",\"flowering_type_id\":\"2\",\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"V0004\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1419837484}', 'UI-000001', '', '1419837484');
INSERT INTO `rnd_history` VALUES ('2', '40', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":1,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1419837484}', 'UI-000001', '', '1419837484');
INSERT INTO `rnd_history` VALUES ('3', '41', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":1,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1419837484}', 'UI-000001', '', '1419837484');
INSERT INTO `rnd_history` VALUES ('4', '42', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":1,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1419837484}', 'UI-000001', '', '1419837484');
INSERT INTO `rnd_history` VALUES ('5', '14', 'rnd_variety_info', '{\"principal_id\":\"1\",\"flowering_type_id\":\"1\",\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"V0005\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1419942030}', 'UI-000001', '', '1419942030');
INSERT INTO `rnd_history` VALUES ('6', '43', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":5,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1419942030}', 'UI-000001', '', '1419942030');
INSERT INTO `rnd_history` VALUES ('7', '44', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":5,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1419942030}', 'UI-000001', '', '1419942030');
INSERT INTO `rnd_history` VALUES ('8', '45', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":5,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1419942030}', 'UI-000001', '', '1419942030');
INSERT INTO `rnd_history` VALUES ('9', '15', 'rnd_variety_info', '{\"principal_id\":\"2\",\"flowering_type_id\":\"1\",\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"V0004\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1419943231}', 'UI-000001', '', '1419943231');
INSERT INTO `rnd_history` VALUES ('10', '46', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":15,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1419943231}', 'UI-000001', '', '1419943231');
INSERT INTO `rnd_history` VALUES ('11', '47', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":15,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1419943231}', 'UI-000001', '', '1419943231');
INSERT INTO `rnd_history` VALUES ('12', '48', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":15,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1419943231}', 'UI-000001', '', '1419943231');
INSERT INTO `rnd_history` VALUES ('13', '16', 'rnd_variety_info', '{\"principal_id\":\"2\",\"flowering_type_id\":\"1\",\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_name\":\"V0005\",\"rnd_code\":\"V0005\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1420004518}', 'UI-000001', '', '1420004518');
INSERT INTO `rnd_history` VALUES ('14', '49', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":16,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420004518}', 'UI-000001', '', '1420004518');
INSERT INTO `rnd_history` VALUES ('15', '50', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":16,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420004518}', 'UI-000001', '', '1420004518');
INSERT INTO `rnd_history` VALUES ('16', '51', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":16,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420004518}', 'UI-000001', '', '1420004518');
INSERT INTO `rnd_history` VALUES ('17', '1', 'rnd_sample_delivery_date', '{\"season_id\":\"1\",\"destined_delivery_date\":\"2014-12-01\",\"delivered_status\":\"1\",\"delivery_date\":\"2014-12-17\",\"received_status\":\"1\",\"rnd_received_date\":\"2014-12-15\",\"destined_sowing_date\":\"2014-12-02\",\"sowing_status\":\"1\",\"sowing_date\":\"2014-12-30\",\"remark\":\"', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('18', '1', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420013418,\"rnd_code_id\":\"10\"}', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('19', '2', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420013418,\"rnd_code_id\":\"11\"}', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('20', '3', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420013418,\"rnd_code_id\":\"12\"}', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('21', '4', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420013418,\"rnd_code_id\":\"15\"}', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('22', '5', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420013418,\"rnd_code_id\":\"16\"}', 'UI-000001', '', '1420013418');
INSERT INTO `rnd_history` VALUES ('23', '2', 'rnd_sample_delivery_date', '{\"season_id\":\"1\",\"destined_delivery_date\":1414778400,\"delivered_status\":\"1\",\"delivery_date\":\"2014-12-18\",\"received_status\":\"1\",\"rnd_received_date\":\"2014-12-03\",\"destined_sowing_date\":1417370400,\"sowing_status\":\"1\",\"sowing_date\":\"2014-12-23\",\"remark\":\"\\r\\n', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('24', '6', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420013629,\"rnd_code_id\":\"10\"}', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('25', '7', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420013629,\"rnd_code_id\":\"11\"}', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('26', '8', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420013629,\"rnd_code_id\":\"12\"}', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('27', '9', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420013629,\"rnd_code_id\":\"15\"}', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('28', '10', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420013629,\"rnd_code_id\":\"16\"}', 'UI-000001', '', '1420013629');
INSERT INTO `rnd_history` VALUES ('29', '3', 'rnd_sample_delivery_date', '{\"season_id\":\"1\",\"destined_delivery_date\":1414346400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1417543200,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1417975200,\"rnd_received_date\":1417370400,\"sowing_date\":1418839200', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('30', '11', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420013895,\"rnd_code_id\":\"10\"}', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('31', '12', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420013895,\"rnd_code_id\":\"11\"}', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('32', '13', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420013895,\"rnd_code_id\":\"12\"}', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('33', '14', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420013895,\"rnd_code_id\":\"15\"}', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('34', '15', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420013895,\"rnd_code_id\":\"16\"}', 'UI-000001', '', '1420013895');
INSERT INTO `rnd_history` VALUES ('35', '4', 'rnd_sample_delivery_date', '{\"season_id\":\"2\",\"destined_delivery_date\":1415037600,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1417629600,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1418320800,\"rnd_received_date\":1418148000,\"sowing_date\":1417370400', 'UI-000001', '', '1420014764');
INSERT INTO `rnd_history` VALUES ('36', '16', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1420014764,\"rnd_code_id\":\"11\"}', 'UI-000001', '', '1420014764');
INSERT INTO `rnd_history` VALUES ('37', '17', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1420014764,\"rnd_code_id\":\"12\"}', 'UI-000001', '', '1420014764');
INSERT INTO `rnd_history` VALUES ('38', '18', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1420014764,\"rnd_code_id\":\"15\"}', 'UI-000001', '', '1420014764');
INSERT INTO `rnd_history` VALUES ('39', '19', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1420014764,\"rnd_code_id\":\"16\"}', 'UI-000001', '', '1420014764');
INSERT INTO `rnd_history` VALUES ('40', '5', 'rnd_sample_delivery_date', '{\"season_id\":\"3\",\"destined_delivery_date\":1414951200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1419184800,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1419012000,\"rnd_received_date\":1418148000,\"sowing_date\":1418839200', 'UI-000001', '', '1420014800');
INSERT INTO `rnd_history` VALUES ('41', '20', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1420014800,\"rnd_code_id\":\"10\"}', 'UI-000001', '', '1420014800');
INSERT INTO `rnd_history` VALUES ('42', '21', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1420014800,\"rnd_code_id\":\"12\"}', 'UI-000001', '', '1420014800');
INSERT INTO `rnd_history` VALUES ('43', '22', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1420014800,\"rnd_code_id\":\"15\"}', 'UI-000001', '', '1420014800');
INSERT INTO `rnd_history` VALUES ('44', '23', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1420014800,\"rnd_code_id\":\"16\"}', 'UI-000001', '', '1420014800');
INSERT INTO `rnd_history` VALUES ('45', '6', 'rnd_crop_info', '{\"crop_name\":\"Pumpkin\",\"crop_code\":\"C0007\",\"crop_width\":\"23\",\"crop_height\":\"45\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420024701}', 'UI-000001', 'insert', '1420024701');
INSERT INTO `rnd_history` VALUES ('46', '6', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1414951200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1419184800,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1419012000,\"rnd_received_date\":1418148000,\"sowing_date\":1418839200,\"created_by\":\"U', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('47', '24', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1420093244,\"rnd_code_id\":\"10\"}', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('48', '25', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1420093244,\"rnd_code_id\":\"11\"}', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('49', '26', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1420093244,\"rnd_code_id\":\"12\"}', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('50', '27', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1420093244,\"rnd_code_id\":\"15\"}', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('51', '28', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1420093244,\"rnd_code_id\":\"16\"}', 'UI-000001', 'insert', '1420093244');
INSERT INTO `rnd_history` VALUES ('52', '29', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420094024,\"rnd_code_id\":\"10\"}', 'UI-000001', 'insert', '1420094024');
INSERT INTO `rnd_history` VALUES ('53', '30', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420094024,\"rnd_code_id\":\"11\"}', 'UI-000001', 'insert', '1420094024');
INSERT INTO `rnd_history` VALUES ('54', '31', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420094024,\"rnd_code_id\":\"16\"}', 'UI-000001', 'insert', '1420094024');
INSERT INTO `rnd_history` VALUES ('55', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1414951200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1419184800,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1419012000,\"rnd_received_date\":1418148000,\"sowing_date\":1418839200,\"modified_by\":\"', 'UI-000001', 'UPDATE', '1420094603');
INSERT INTO `rnd_history` VALUES ('56', '32', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094603,\"rnd_code_id\":\"10\"}', 'UI-000001', 'INSERT', '1420094603');
INSERT INTO `rnd_history` VALUES ('57', '33', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094603,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1420094603');
INSERT INTO `rnd_history` VALUES ('58', '34', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094603,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1420094603');
INSERT INTO `rnd_history` VALUES ('59', '35', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094603,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1420094603');
INSERT INTO `rnd_history` VALUES ('60', '36', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094603,\"rnd_code_id\":\"16\"}', 'UI-000001', 'INSERT', '1420094603');
INSERT INTO `rnd_history` VALUES ('61', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1414951200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1419184800,\"sowing_status\":\"1\",\"remark\":\" Remarks season 3\",\"delivery_date\":1419012000,\"rnd_received_date\":1418148000,\"sowing_date\":1418839200,\"modifi', 'UI-000001', 'UPDATE', '1420094622');
INSERT INTO `rnd_history` VALUES ('62', '37', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094622,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1420094622');
INSERT INTO `rnd_history` VALUES ('63', '38', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094622,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1420094622');
INSERT INTO `rnd_history` VALUES ('64', '39', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420094622,\"rnd_code_id\":\"16\"}', 'UI-000001', 'INSERT', '1420094622');
INSERT INTO `rnd_history` VALUES ('65', '2', 'rnd_fortnightly_report', '{\"rnd_code_id\":\"10\",\"sowing_date\":1420048800,\"transplanting_date\":1420394400,\"initial_plants_during_trial_start\":false,\"fortnightly_reporting_date\":1420999200,\"plant_type\":\"2\",\"plant_uniformity\":\"1\",\"distance_from_ground_curd\":\"1\",\"crud_type\":\"1\",\"crud_co', 'UI-000001', 'INSERT', '1420270182');
INSERT INTO `rnd_history` VALUES ('66', '3', 'rnd_fortnightly_report', '{\"rnd_code_id\":\"15\",\"sowing_date\":1421776800,\"transplanting_date\":1421431200,\"initial_plants_during_trial_start\":\"89\",\"fortnightly_reporting_date\":1422208800,\"plant_type\":\"2\",\"plant_uniformity\":\"2\",\"distance_from_ground_curd\":\"1\",\"crud_type\":\"1\",\"crud_col', 'UI-000001', 'INSERT', '1420270275');
INSERT INTO `rnd_history` VALUES ('67', '1', 'rnd_fortnightly_report', '{\"rnd_code_id\":\"10\",\"sowing_date\":1420480800,\"transplanting_date\":1420480800,\"initial_plants_during_trial_start\":\"12\",\"fortnightly_reporting_date\":1420567200,\"plant_type\":\"2\",\"plant_uniformity\":\"2\",\"distance_from_ground_curd\":\"2\",\"crud_type\":\"2\",\"crud_col', 'UI-000001', 'UPDATE', '1420278063');
INSERT INTO `rnd_history` VALUES ('68', '11', 'rnd_variety_info', '{\"flowering_type_id\":\"3\",\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"V0002\",\"rnd_code\":\"V0002\",\"variety_type\":\"3\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"2\",\"modified_by\":\"UI-000001\",\"modification_date\":1420280527}', 'UI-000001', 'UPDATE', '1420280527');
INSERT INTO `rnd_history` VALUES ('69', '52', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":\"11\",\"created_by\":\"UI-000001\",\"creation_date\":1420280527,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420280527');
INSERT INTO `rnd_history` VALUES ('70', '53', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":\"11\",\"created_by\":\"UI-000001\",\"creation_date\":1420280527,\"season_id\":\"2\"}', 'UI-000001', 'INSERT', '1420280527');
INSERT INTO `rnd_history` VALUES ('71', '12', 'rnd_variety_info', '{\"flowering_type_id\":\"2\",\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_name\":\"V0003\",\"rnd_code\":\"V0003\",\"variety_type\":\"2\",\"status\":\"1\",\"company_name\":\"SoftBD Ltd.\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date\":1420280895}', 'UI-000001', 'UPDATE', '1420280896');
INSERT INTO `rnd_history` VALUES ('72', '54', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_id\":\"12\",\"created_by\":\"UI-000001\",\"creation_date\":1420280896,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420280896');
INSERT INTO `rnd_history` VALUES ('73', '55', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_id\":\"12\",\"created_by\":\"UI-000001\",\"creation_date\":1420280896,\"season_id\":\"2\"}', 'UI-000001', 'INSERT', '1420280896');
INSERT INTO `rnd_history` VALUES ('74', '56', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_id\":\"12\",\"created_by\":\"UI-000001\",\"creation_date\":1420280896,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420280896');
INSERT INTO `rnd_history` VALUES ('75', '5', 'rnd_product_type_info', '{\"crop_id\":\"6\",\"product_type\":\"Early\",\"product_type_code\":\"E\",\"product_type_height\":\"45\",\"product_type_width\":\"23\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420288180}', 'UI-000001', 'INSERT', '1420288180');
INSERT INTO `rnd_history` VALUES ('76', '17', 'rnd_variety_info', '{\"flowering_type_id\":\"1\",\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"V0006\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-17-CKA\",\"created_by\":\"UI-000001\",\"creation_date\":1420288217}', 'UI-000001', 'INSERT', '1420288217');
INSERT INTO `rnd_history` VALUES ('77', '57', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":17,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420288217}', 'UI-000001', 'INSERT', '1420288217');
INSERT INTO `rnd_history` VALUES ('78', '58', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":17,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420288217}', 'UI-000001', 'INSERT', '1420288217');
INSERT INTO `rnd_history` VALUES ('79', '18', 'rnd_variety_info', '{\"flowering_type_id\":\"1\",\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"V0006\",\"variety_type\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-18-CKA\",\"created_by\":\"UI-000001\",\"creation_date\":1420288227}', 'UI-000001', 'INSERT', '1420288227');
INSERT INTO `rnd_history` VALUES ('80', '59', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":18,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420288227}', 'UI-000001', 'INSERT', '1420288227');
INSERT INTO `rnd_history` VALUES ('81', '60', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":18,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420288227}', 'UI-000001', 'INSERT', '1420288227');
INSERT INTO `rnd_history` VALUES ('82', '19', 'rnd_variety_info', '{\"flowering_type_id\":\"1\",\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"V0008\",\"variety_type\":\"3\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"2\",\"rnd_code\":\"C0007-E-19-Code2\",\"created_by\":\"UI-000001\",\"creation_date\":1420288345}', 'UI-000001', 'INSERT', '1420288345');
INSERT INTO `rnd_history` VALUES ('83', '61', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":19,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420288345}', 'UI-000001', 'INSERT', '1420288345');
INSERT INTO `rnd_history` VALUES ('84', '62', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":19,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420288345}', 'UI-000001', 'INSERT', '1420288345');
INSERT INTO `rnd_history` VALUES ('85', '1', 'rnd_fifteen_days_picture_report', '{\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code\":\"17\",\"sowing_date\":\"01-01-2015\",\"picture_date\":\"08-01-2015\",\"picture_day\":\"15\",\"image_name\":\"1420371609.jpg\",\"remarks\":\" Remarks \",\"created_by\":\"UI-000001\",\"creation_date\":1420371609}', 'UI-000001', 'INSERT', '1420371609');
INSERT INTO `rnd_history` VALUES ('86', '2', 'rnd_fifteen_days_picture_report', '{\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code\":\"19\",\"sowing_date\":1420048800,\"picture_date\":1421949600,\"picture_day\":\"15\",\"image_name\":\"1420439487.jpg\",\"remarks\":\"\\r\\nRemarks\\r\\n\",\"created_by\":\"UI-000001\",\"creation_date\":1420439487}', 'UI-000001', 'INSERT', '1420439487');
INSERT INTO `rnd_history` VALUES ('87', '1', 'rnd_fifteen_days_picture_report', '{\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code\":\"17\",\"sowing_date\":1420048800,\"picture_date\":1422036000,\"picture_day\":\"15\",\"remarks\":\"Remarks \",\"created_by\":\"UI-000001\",\"creation_date\":1420445999}', 'UI-000001', 'INSERT', '1420445999');
INSERT INTO `rnd_history` VALUES ('88', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420445999.jpg\",\"picture_day\":\"15\",\"remarks\":\"Remarks \",\"picture_report_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420445999}', 'UI-000001', 'INSERT', '1420445999');
INSERT INTO `rnd_history` VALUES ('89', '1', 'rnd_fifteen_days_picture_report', '{\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code\":\"18\",\"sowing_date\":1420048800,\"created_by\":\"UI-000001\",\"creation_date\":1420453462}', 'UI-000001', 'INSERT', '1420453462');
INSERT INTO `rnd_history` VALUES ('90', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420453462.jpg\",\"picture_date\":\"15-01-2015\",\"picture_day\":\"15\",\"remarks\":\"Remarks\",\"picture_report_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1420453462}', 'UI-000001', 'INSERT', '1420453462');
INSERT INTO `rnd_history` VALUES ('91', '2', 'rnd_fifteen_days_picture_report', '{\"crop_id\":false,\"type_id\":false,\"rnd_code\":false,\"sowing_date\":1420048800,\"created_by\":\"UI-000001\",\"creation_date\":1420519363}', 'UI-000001', 'INSERT', '1420519363');
INSERT INTO `rnd_history` VALUES ('92', '2', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420519363.jpg\",\"picture_date\":1420519363,\"picture_day\":\"30\",\"remarks\":\" Remarks \",\"picture_report_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1420519363}', 'UI-000001', 'INSERT', '1420519363');
INSERT INTO `rnd_history` VALUES ('93', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420519479.jpg\",\"picture_date\":1420519479,\"picture_day\":\"30\",\"remarks\":\"Remarkssssssssssssss\",\"picture_report_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420519479}', 'UI-000001', 'INSERT', '1420519479');
INSERT INTO `rnd_history` VALUES ('94', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420519509.jpg\",\"picture_date\":1420519509,\"picture_day\":\"45\",\"remarks\":\" Remarks 33333333333333333\",\"picture_report_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420519509}', 'UI-000001', 'INSERT', '1420519509');
INSERT INTO `rnd_history` VALUES ('95', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484180.jpg\",\"picture_day\":\"14\",\"picture_date\":\"05-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('96', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484180.jpg\",\"picture_day\":\"14\",\"picture_date\":\"05-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('97', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484180.jpg\",\"picture_day\":\"14\",\"picture_date\":\"05-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('98', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484191.jpg\",\"picture_day\":\"29\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('99', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484191.jpg\",\"picture_day\":\"29\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('100', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484191.jpg\",\"picture_day\":\"29\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('101', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484192.jpg\",\"picture_day\":\"44\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('102', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484192.jpg\",\"picture_day\":\"44\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('103', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205484192.jpg\",\"picture_day\":\"44\",\"picture_date\":\"06-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548419}', 'UI-000001', 'UPDATE', '1420548419');
INSERT INTO `rnd_history` VALUES ('104', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('105', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('106', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('107', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('108', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('109', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('110', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('111', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('112', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420548507}', 'UI-000001', 'UPDATE', '1420548507');
INSERT INTO `rnd_history` VALUES ('113', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205493890.jpg\",\"picture_day\":\"44\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549389}', 'UI-000001', 'UPDATE', '1420549389');
INSERT INTO `rnd_history` VALUES ('114', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205493890.jpg\",\"picture_day\":\"44\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549389}', 'UI-000001', 'UPDATE', '1420549389');
INSERT INTO `rnd_history` VALUES ('115', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205493890.jpg\",\"picture_day\":\"44\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549389}', 'UI-000001', 'UPDATE', '1420549389');
INSERT INTO `rnd_history` VALUES ('116', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549390}', 'UI-000001', 'UPDATE', '1420549390');
INSERT INTO `rnd_history` VALUES ('117', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549390}', 'UI-000001', 'UPDATE', '1420549390');
INSERT INTO `rnd_history` VALUES ('118', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549390}', 'UI-000001', 'UPDATE', '1420549390');
INSERT INTO `rnd_history` VALUES ('119', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('120', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('121', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('122', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('123', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('124', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('125', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('126', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('127', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549440}', 'UI-000001', 'UPDATE', '1420549440');
INSERT INTO `rnd_history` VALUES ('128', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549732}', 'UI-000001', 'UPDATE', '1420549732');
INSERT INTO `rnd_history` VALUES ('129', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549732}', 'UI-000001', 'UPDATE', '1420549732');
INSERT INTO `rnd_history` VALUES ('130', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549732}', 'UI-000001', 'UPDATE', '1420549732');
INSERT INTO `rnd_history` VALUES ('131', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205497970.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('132', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205497970.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('133', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205497970.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('134', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('135', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('136', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549797}', 'UI-000001', 'UPDATE', '1420549797');
INSERT INTO `rnd_history` VALUES ('137', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205498070.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('138', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205498070.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('139', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205498070.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('140', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('141', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('142', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420549807}', 'UI-000001', 'UPDATE', '1420549807');
INSERT INTO `rnd_history` VALUES ('143', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500710.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('144', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500710.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('145', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500710.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('146', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500711.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('147', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500711.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('148', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205500711.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550071');
INSERT INTO `rnd_history` VALUES ('149', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550072');
INSERT INTO `rnd_history` VALUES ('150', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550072');
INSERT INTO `rnd_history` VALUES ('151', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550071}', 'UI-000001', 'UPDATE', '1420550072');
INSERT INTO `rnd_history` VALUES ('152', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502320.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550232}', 'UI-000001', 'UPDATE', '1420550232');
INSERT INTO `rnd_history` VALUES ('153', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502320.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550232}', 'UI-000001', 'UPDATE', '1420550232');
INSERT INTO `rnd_history` VALUES ('154', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502320.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550232}', 'UI-000001', 'UPDATE', '1420550232');
INSERT INTO `rnd_history` VALUES ('155', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502331.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('156', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502331.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('157', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205502331.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('158', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('159', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('160', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"01-01-1970\",\"modified_by\":\"UI-000001\",\"modification_date\":1420550233}', 'UI-000001', 'UPDATE', '1420550233');
INSERT INTO `rnd_history` VALUES ('161', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516430.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('162', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516430.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('163', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516430.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('164', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516431.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('165', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516431.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('166', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516431.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551643');
INSERT INTO `rnd_history` VALUES ('167', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516432.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551644');
INSERT INTO `rnd_history` VALUES ('168', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516432.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551644');
INSERT INTO `rnd_history` VALUES ('169', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205516432.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420551643}', 'UI-000001', 'UPDATE', '1420551644');
INSERT INTO `rnd_history` VALUES ('170', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524770.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('171', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524770.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('172', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524770.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('173', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524771.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('174', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524771.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('175', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524771.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('176', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524772.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('177', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524772.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('178', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205524772.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552477}', 'UI-000001', 'UPDATE', '1420552477');
INSERT INTO `rnd_history` VALUES ('179', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('180', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('181', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('182', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('183', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('184', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"4\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('185', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('186', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('187', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"2\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420552619}', 'UI-000001', 'UPDATE', '1420552619');
INSERT INTO `rnd_history` VALUES ('188', '1', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205530160.jpg\",\"picture_day\":\"44\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553017}', 'UI-000001', 'UPDATE', '1420553017');
INSERT INTO `rnd_history` VALUES ('189', '3', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205530171.jpg\",\"picture_day\":\"45\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553017}', 'UI-000001', 'UPDATE', '1420553017');
INSERT INTO `rnd_history` VALUES ('190', '4', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"14205530172.jpg\",\"picture_day\":\"46\",\"picture_date\":-21600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553017}', 'UI-000001', 'UPDATE', '1420553017');
INSERT INTO `rnd_history` VALUES ('191', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"44\",\"picture_date\":\"15-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420553105}', 'UI-000001', 'UPDATE', '1420553105');
INSERT INTO `rnd_history` VALUES ('192', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":\"15-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420553105}', 'UI-000001', 'UPDATE', '1420553105');
INSERT INTO `rnd_history` VALUES ('193', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"46\",\"picture_date\":\"07-01-2015\",\"modified_by\":\"UI-000001\",\"modification_date\":1420553105}', 'UI-000001', 'UPDATE', '1420553105');
INSERT INTO `rnd_history` VALUES ('194', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"15\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553304}', 'UI-000001', 'UPDATE', '1420553304');
INSERT INTO `rnd_history` VALUES ('195', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"30\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553304}', 'UI-000001', 'UPDATE', '1420553304');
INSERT INTO `rnd_history` VALUES ('196', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":1422381600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553304}', 'UI-000001', 'UPDATE', '1420553304');
INSERT INTO `rnd_history` VALUES ('197', '5', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420553803.jpg\",\"picture_date\":\"06-01-2015\",\"actual_picture_date\":1420553803,\"picture_day\":\"60\",\"remarks\":\" Remarks sdsdsdsd\",\"picture_report_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420553803}', 'UI-000001', 'INSERT', '1420553803');
INSERT INTO `rnd_history` VALUES ('198', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"15\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553803}', 'UI-000001', 'UPDATE', '1420553803');
INSERT INTO `rnd_history` VALUES ('199', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"30\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553803}', 'UI-000001', 'UPDATE', '1420553803');
INSERT INTO `rnd_history` VALUES ('200', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":1422381600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553803}', 'UI-000001', 'UPDATE', '1420553803');
INSERT INTO `rnd_history` VALUES ('201', '1', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"15\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553887}', 'UI-000001', 'UPDATE', '1420553887');
INSERT INTO `rnd_history` VALUES ('202', '3', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"30\",\"picture_date\":1421172000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553887}', 'UI-000001', 'UPDATE', '1420553887');
INSERT INTO `rnd_history` VALUES ('203', '4', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"45\",\"picture_date\":1422381600,\"modified_by\":\"UI-000001\",\"modification_date\":1420553887}', 'UI-000001', 'UPDATE', '1420553887');
INSERT INTO `rnd_history` VALUES ('204', '5', 'rnd_fifteen_days_picture_report_images', '{\"picture_day\":\"60\",\"picture_date\":1422468000,\"modified_by\":\"UI-000001\",\"modification_date\":1420553887}', 'UI-000001', 'UPDATE', '1420553887');
INSERT INTO `rnd_history` VALUES ('205', '3', 'rnd_fifteen_days_picture_report', '{\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code\":\"17\",\"sowing_date\":1417370400,\"created_by\":\"UI-000001\",\"creation_date\":1420554118}', 'UI-000001', 'INSERT', '1420554118');
INSERT INTO `rnd_history` VALUES ('206', '6', 'rnd_fifteen_days_picture_report_images', '{\"image_name\":\"1420554118.jpg\",\"picture_date\":1420480800,\"actual_picture_date\":1420554118,\"picture_day\":\"15\",\"remarks\":\" Remarks new\",\"picture_report_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1420554118}', 'UI-000001', 'INSERT', '1420554118');
INSERT INTO `rnd_history` VALUES ('207', '3', 'rnd_flowering_picture_report', '{\"rnd_code_id\":\"18\",\"first_flowering_pic\":\"ffp1420628781.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420628781.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420628781.jpg\",\"first_setting_remark\":\"r3\",\"first_harvested_pic\":\"', 'UI-000001', 'INSERT', '1420628782');
INSERT INTO `rnd_history` VALUES ('208', '4', 'rnd_flowering_picture_report', '{\"rnd_code_id\":\"12\",\"first_flowering_pic\":\"ffp1420631853.jpg.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420631853.jpg.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420631853.jpg.jpg\",\"first_setting_remark\":\"r3\",\"first_harv', 'UI-000001', 'INSERT', '1420631853');
INSERT INTO `rnd_history` VALUES ('209', '5', 'rnd_flowering_picture_report', '{\"rnd_code_id\":\"18\",\"first_flowering_pic\":\"ffp1420632031.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420632031.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420632031.jpg\",\"first_setting_remark\":\"r3\",\"first_harvested_pic\":\"', 'UI-000001', 'INSERT', '1420632031');
INSERT INTO `rnd_history` VALUES ('210', '1', 'rnd_flowering_picture_report', '{\"season_id\":\"1\",\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code_id\":\"18\",\"first_flowering_pic\":\"ffp1420634647.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420634647.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420634647.jpg\",\"first_', 'UI-000001', 'INSERT', '1420634647');
INSERT INTO `rnd_history` VALUES ('211', '2', 'rnd_flowering_picture_report', '{\"season_id\":\"1\",\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code_id\":\"18\",\"first_flowering_pic\":\"ffp1420634661.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420634661.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420634661.jpg\",\"first_', 'UI-000001', 'INSERT', '1420634661');
INSERT INTO `rnd_history` VALUES ('212', '3', 'rnd_flowering_picture_report', '{\"season_id\":\"1\",\"crop_id\":\"6\",\"type_id\":\"5\",\"rnd_code_id\":\"18\",\"first_flowering_pic\":\"ffp1420634742.jpg\",\"first_flowering_remark\":\"r1\",\"fifty_flowering_pic\":\"fpp1420634742.jpg\",\"fifty_flowering_remark\":\"r2\",\"first_setting_pic\":\"ffs1420634742.jpg\",\"first_', 'UI-000001', 'INSERT', '1420634742');
INSERT INTO `rnd_history` VALUES ('213', '3', 'rnd_flowering_picture_report', '{\"first_flowering_remark\":\"r11\",\"fifty_flowering_remark\":\"r22\",\"first_setting_remark\":\"r33\",\"first_harvested_remark\":\"r44\",\"last_harvested_remark\":\"r55\",\"last_harvested_pic\":\"lhf1420642020.jpg\",\"modified_by\":\"UI-000001\",\"modification_date\":1420642020}', 'UI-000001', 'UPDATE', '1420642020');
INSERT INTO `rnd_history` VALUES ('214', '7', 'rnd_pesticide_fungicide_stock_in', '{\"pesticide_id\":\"1\",\"pesticide_quantity\":\"100\",\"pesticide_price\":\"50\",\"created_by\":\"UI-000001\",\"creation_date\":1420646513}', 'UI-000001', 'INSERT', '1420646514');
INSERT INTO `rnd_history` VALUES ('215', '3', 'rnd_crop_info', '{\"crop_name\":\"Cucumber\",\"crop_code\":\"C0001\",\"crop_width\":\"23\",\"crop_height\":\"46\",\"fruit_type\":\"2\",\"sample_size\":\"1\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1420697092}', 'UI-000001', 'UPDATE', '1420697092');
INSERT INTO `rnd_history` VALUES ('216', '4', 'rnd_crop_info', '{\"crop_name\":\"Brinjal\",\"crop_code\":\"B0001\",\"crop_width\":\"344\",\"crop_height\":\"654\",\"fruit_type\":\"3\",\"sample_size\":\"1\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1420698019}', 'UI-000001', 'UPDATE', '1420698019');
INSERT INTO `rnd_history` VALUES ('217', '1', 'rnd_product_type_info', '{\"crop_id\":\"4\",\"product_type\":\"Type11\",\"product_type_code\":\"Code11\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1420698961}', 'UI-000001', 'UPDATE', '1420698961');
INSERT INTO `rnd_history` VALUES ('218', '20', 'rnd_variety_info', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"V0009\",\"variety_type\":\"2\",\"number_of_seeds\":\"10\",\"quantity\":\"11\",\"characteristics\":\" Characteristics \",\"new_old_status\":\"0\",\"status\":\"1\",\"company_name\":\"SoftBD\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-4-C', 'UI-000001', 'INSERT', '1420719295');
INSERT INTO `rnd_history` VALUES ('219', '63', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":20,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420719295}', 'UI-000001', 'INSERT', '1420719295');
INSERT INTO `rnd_history` VALUES ('220', '64', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":20,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420719295}', 'UI-000001', 'INSERT', '1420719295');
INSERT INTO `rnd_history` VALUES ('221', '21', 'rnd_variety_info', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"v00012\",\"variety_type\":\"3\",\"number_of_seeds\":\"12\",\"quantity\":\"11\",\"characteristics\":\" Characteristics \",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"2\",\"rnd_code\":\"B0001-Code11-3-', 'UI-000001', 'INSERT', '1420719532');
INSERT INTO `rnd_history` VALUES ('222', '65', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":21,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420719532}', 'UI-000001', 'INSERT', '1420719532');
INSERT INTO `rnd_history` VALUES ('223', '66', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":21,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420719532}', 'UI-000001', 'INSERT', '1420719532');
INSERT INTO `rnd_history` VALUES ('224', '22', 'rnd_variety_info', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_name\":\"v00011\",\"variety_type\":\"1\",\"number_of_seeds\":\"12\",\"quantity\":\"11\",\"characteristics\":\"sdsdsscscscs\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0001-Code3-2-CKA-15\"', 'UI-000001', 'INSERT', '1420720724');
INSERT INTO `rnd_history` VALUES ('225', '67', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_id\":22,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420720724}', 'UI-000001', 'INSERT', '1420720724');
INSERT INTO `rnd_history` VALUES ('226', '68', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"3\",\"variety_id\":22,\"season_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420720724}', 'UI-000001', 'INSERT', '1420720724');
INSERT INTO `rnd_history` VALUES ('227', '23', 'rnd_variety_info', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"c00013\",\"variety_type\":\"1\",\"number_of_seeds\":\"34\",\"quantity\":\"12\",\"characteristics\":\"sdsdsd\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-5-CKA-15\",\"created_', 'UI-000001', 'INSERT', '1420721880');
INSERT INTO `rnd_history` VALUES ('228', '69', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":23,\"season_id\":\"3\",\"created_by\":\"UI-000001\",\"creation_date\":1420721880}', 'UI-000001', 'INSERT', '1420721880');
INSERT INTO `rnd_history` VALUES ('229', '70', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":23,\"season_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420721880}', 'UI-000001', 'INSERT', '1420721880');
INSERT INTO `rnd_history` VALUES ('230', '24', 'rnd_variety_info', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"v00014\",\"variety_type\":\"1\",\"number_of_seeds\":\"34\",\"quantity\":\"12\",\"characteristics\":\"wdwdwdw\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-6-CKA-15\",\"created', 'UI-000001', 'INSERT', '1420722016');
INSERT INTO `rnd_history` VALUES ('231', '71', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":24,\"season_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1420722016}', 'UI-000001', 'INSERT', '1420722016');
INSERT INTO `rnd_history` VALUES ('232', '72', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":24,\"season_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420722016}', 'UI-000001', 'INSERT', '1420722016');
INSERT INTO `rnd_history` VALUES ('233', '25', 'rnd_variety_info', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_name\":\"v89098\",\"variety_type\":\"1\",\"number_of_seeds\":\"10\",\"quantity\":\"23\",\"characteristics\":\"efefef\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"C0007-E-7-CKA-15\",\"created_', 'UI-000001', 'INSERT', '1420864510');
INSERT INTO `rnd_history` VALUES ('234', '73', 'rnd_variety_season', '{\"crop_id\":\"6\",\"product_type_id\":\"5\",\"variety_id\":25,\"season_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420864510}', 'UI-000001', 'INSERT', '1420864510');
INSERT INTO `rnd_history` VALUES ('235', '7', 'rnd_crop_info', '{\"crop_name\":\"Tomato\",\"crop_code\":\"T0001\",\"crop_width\":\"23\",\"crop_height\":\"45\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420872764}', 'UI-000001', 'INSERT', '1420872764');
INSERT INTO `rnd_history` VALUES ('236', '6', 'rnd_product_type_info', '{\"crop_id\":\"7\",\"product_type\":\"Type000T\",\"product_type_code\":\"T0001\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420872797}', 'UI-000001', 'INSERT', '1420872797');
INSERT INTO `rnd_history` VALUES ('237', '26', 'rnd_variety_info', '{\"crop_id\":\"7\",\"product_type_id\":\"6\",\"variety_name\":\"v00098\",\"variety_type\":\"1\",\"number_of_seeds\":\"12\",\"quantity\":\"14\",\"characteristics\":\"dsdsdsds\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"T0001-T0001-1-CKA-15\",\"cr', 'UI-000001', 'INSERT', '1420875422');
INSERT INTO `rnd_history` VALUES ('238', '74', 'rnd_variety_season', '{\"crop_id\":\"7\",\"product_type_id\":\"6\",\"variety_id\":26,\"season_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1420875422}', 'UI-000001', 'INSERT', '1420875422');
INSERT INTO `rnd_history` VALUES ('239', '10', 'rnd_variety_info', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_name\":\"V0001\",\"variety_type\":\"1\",\"number_of_seeds\":\"13\",\"quantity\":\"9\",\"characteristics\":\"dff\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"P0001-Code2-1-CKA-15\",\"modified_', 'UI-000001', 'UPDATE', '1420877390');
INSERT INTO `rnd_history` VALUES ('240', '75', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877390,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420877390');
INSERT INTO `rnd_history` VALUES ('241', '76', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877390,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420877390');
INSERT INTO `rnd_history` VALUES ('242', '10', 'rnd_variety_info', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_name\":\"V0001\",\"variety_type\":\"1\",\"number_of_seeds\":\"13\",\"quantity\":\"9\",\"characteristics\":\"dff\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"rnd_code\":\"P0001-Code2-1-CKA-15\",\"modified_', 'UI-000001', 'UPDATE', '1420877403');
INSERT INTO `rnd_history` VALUES ('243', '77', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877403,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420877403');
INSERT INTO `rnd_history` VALUES ('244', '78', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877403,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420877403');
INSERT INTO `rnd_history` VALUES ('245', '10', 'rnd_variety_info', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_name\":\"V0001\",\"variety_type\":\"1\",\"number_of_seeds\":\"13\",\"quantity\":\"9\",\"characteristics\":\"dff\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date', 'UI-000001', 'UPDATE', '1420877526');
INSERT INTO `rnd_history` VALUES ('246', '79', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877526,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420877526');
INSERT INTO `rnd_history` VALUES ('247', '80', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877526,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420877526');
INSERT INTO `rnd_history` VALUES ('248', '10', 'rnd_variety_info', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_name\":\"V0001\",\"variety_type\":\"1\",\"number_of_seeds\":\"13\",\"quantity\":\"9\",\"characteristics\":\"dff\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date', 'UI-000001', 'UPDATE', '1420877677');
INSERT INTO `rnd_history` VALUES ('249', '81', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877677,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420877677');
INSERT INTO `rnd_history` VALUES ('250', '82', 'rnd_variety_season', '{\"crop_id\":\"5\",\"product_type_id\":\"2\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877677,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420877677');
INSERT INTO `rnd_history` VALUES ('251', '10', 'rnd_variety_info', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_name\":\"V0001\",\"variety_type\":\"1\",\"number_of_seeds\":\"13\",\"quantity\":\"9\",\"characteristics\":\"dff\",\"new_old_status\":\"1\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date', 'UI-000001', 'UPDATE', '1420877811');
INSERT INTO `rnd_history` VALUES ('252', '83', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877811,\"season_id\":\"1\"}', 'UI-000001', 'INSERT', '1420877811');
INSERT INTO `rnd_history` VALUES ('253', '84', 'rnd_variety_season', '{\"crop_id\":\"4\",\"product_type_id\":\"1\",\"variety_id\":\"10\",\"created_by\":\"UI-000001\",\"creation_date\":1420877811,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420877811');
INSERT INTO `rnd_history` VALUES ('254', '23', 'rnd_variety_info', '{\"number_of_seeds\":\"34\",\"quantity\":\"12\",\"characteristics\":\"sdsdsd\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date\":1420880067}', 'UI-000001', 'UPDATE', '1420880067');
INSERT INTO `rnd_history` VALUES ('255', '85', 'rnd_variety_season', '{\"crop_id\":false,\"product_type_id\":false,\"variety_id\":\"23\",\"created_by\":\"UI-000001\",\"creation_date\":1420880067,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420880067');
INSERT INTO `rnd_history` VALUES ('256', '86', 'rnd_variety_season', '{\"crop_id\":false,\"product_type_id\":false,\"variety_id\":\"23\",\"created_by\":\"UI-000001\",\"creation_date\":1420880067,\"season_id\":\"5\"}', 'UI-000001', 'INSERT', '1420880067');
INSERT INTO `rnd_history` VALUES ('257', '23', 'rnd_variety_info', '{\"number_of_seeds\":\"34\",\"quantity\":\"12\",\"characteristics\":\"sdsdsd\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"modified_by\":\"UI-000001\",\"modification_date\":1420880206}', 'UI-000001', 'UPDATE', '1420880206');
INSERT INTO `rnd_history` VALUES ('258', '87', 'rnd_variety_season', '{\"crop_id\":false,\"product_type_id\":false,\"variety_id\":\"23\",\"created_by\":\"UI-000001\",\"creation_date\":1420880206,\"season_id\":\"3\"}', 'UI-000001', 'INSERT', '1420880206');
INSERT INTO `rnd_history` VALUES ('259', '88', 'rnd_variety_season', '{\"crop_id\":false,\"product_type_id\":false,\"variety_id\":\"23\",\"created_by\":\"UI-000001\",\"creation_date\":1420880206,\"season_id\":\"5\"}', 'UI-000001', 'INSERT', '1420880206');
INSERT INTO `rnd_history` VALUES ('260', '8', 'rnd_crop_info', '{\"crop_name\":\"Cucumbers\",\"crop_code\":\"asas\",\"crop_width\":\"12\",\"crop_height\":\"21\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420885553}', 'UI-000001', 'INSERT', '1420885553');
INSERT INTO `rnd_history` VALUES ('261', '9', 'rnd_crop_info', '{\"crop_name\":\"Casasas\",\"crop_code\":\"C000123\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1420891829}', 'UI-000001', 'INSERT', '1420891829');
INSERT INTO `rnd_history` VALUES ('262', '9', 'rnd_crop_info', '{\"crop_name\":\"Casasas\",\"crop_code\":\"C000123\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1420895950}', 'UI-000001', 'UPDATE', '1420895950');
INSERT INTO `rnd_history` VALUES ('263', '9', 'rnd_crop_info', '{\"crop_name\":\"Casasas\",\"crop_code\":\"C000123\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1420898379}', 'UI-000001', 'UPDATE', '1420898379');
INSERT INTO `rnd_history` VALUES ('264', '1', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420826400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421604000,\"sowing_status\":\"1\",\"remark\":\"sasasas\",\"delivery_date\":1420135200,\"rnd_received_date\":1421258400,\"sowing_date\":1421344800,\"created_by\":\"UI-', 'UI-000001', 'INSERT', '1421157482');
INSERT INTO `rnd_history` VALUES ('265', '1', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157482,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421157482');
INSERT INTO `rnd_history` VALUES ('266', '15', 'rnd_variety_info', '{\"quantity\":-1}', 'UI-000001', 'UPDATE', '1421157482');
INSERT INTO `rnd_history` VALUES ('267', '2', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157482,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421157482');
INSERT INTO `rnd_history` VALUES ('268', '11', 'rnd_variety_info', '{\"quantity\":-1}', 'UI-000001', 'UPDATE', '1421157482');
INSERT INTO `rnd_history` VALUES ('269', '3', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157482,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421157482');
INSERT INTO `rnd_history` VALUES ('270', '12', 'rnd_variety_info', '{\"quantity\":-1}', 'UI-000001', 'UPDATE', '1421157482');
INSERT INTO `rnd_history` VALUES ('271', '1', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421172000,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421863200,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1422468000,\"rnd_received_date\":1421863200,\"sowing_date\":1422554400,\"created_by\":\"UI-0', 'UI-000001', 'INSERT', '1421157573');
INSERT INTO `rnd_history` VALUES ('272', '1', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157573,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421157573');
INSERT INTO `rnd_history` VALUES ('273', '15', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421157573');
INSERT INTO `rnd_history` VALUES ('274', '2', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157573,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421157573');
INSERT INTO `rnd_history` VALUES ('275', '11', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421157573');
INSERT INTO `rnd_history` VALUES ('276', '3', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421157573,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421157573');
INSERT INTO `rnd_history` VALUES ('277', '12', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421157573');
INSERT INTO `rnd_history` VALUES ('278', '1', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421172000,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421863200,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1422468000,\"rnd_received_date\":1421863200,\"sowing_date\":1422554400,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421158104');
INSERT INTO `rnd_history` VALUES ('279', '4', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158104,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421158104');
INSERT INTO `rnd_history` VALUES ('280', '5', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158104,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421158105');
INSERT INTO `rnd_history` VALUES ('281', '6', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158104,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421158105');
INSERT INTO `rnd_history` VALUES ('282', '1', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420567200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421258400,\"sowing_status\":\"1\",\"remark\":\"asas\",\"delivery_date\":1420221600,\"rnd_received_date\":1420740000,\"sowing_date\":1420653600,\"created_by\":\"UI-000', 'UI-000001', 'INSERT', '1421158309');
INSERT INTO `rnd_history` VALUES ('283', '1', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421158309,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421158309');
INSERT INTO `rnd_history` VALUES ('284', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421158309');
INSERT INTO `rnd_history` VALUES ('285', '2', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421158309,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421158309');
INSERT INTO `rnd_history` VALUES ('286', '11', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421158309');
INSERT INTO `rnd_history` VALUES ('287', '3', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":1,\"created_by\":\"UI-000001\",\"creation_date\":1421158309,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421158309');
INSERT INTO `rnd_history` VALUES ('288', '12', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421158309');
INSERT INTO `rnd_history` VALUES ('289', '1', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420567200,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421258400,\"sowing_status\":\"1\",\"remark\":\"asas\",\"delivery_date\":1420221600,\"rnd_received_date\":1420740000,\"sowing_date\":1420653600,\"modified_by\":\"UI-00', 'UI-000001', 'UPDATE', '1421158418');
INSERT INTO `rnd_history` VALUES ('290', '4', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158418,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421158418');
INSERT INTO `rnd_history` VALUES ('291', '5', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158418,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421158418');
INSERT INTO `rnd_history` VALUES ('292', '6', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421158418,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421158418');
INSERT INTO `rnd_history` VALUES ('293', '7', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421210965,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421210965');
INSERT INTO `rnd_history` VALUES ('294', '11', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421210965');
INSERT INTO `rnd_history` VALUES ('295', '8', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421210965,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421210965');
INSERT INTO `rnd_history` VALUES ('296', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421210965');
INSERT INTO `rnd_history` VALUES ('297', '9', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421210965,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421210965');
INSERT INTO `rnd_history` VALUES ('298', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421210965');
INSERT INTO `rnd_history` VALUES ('299', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"created_by\":\"UI-', 'UI-000001', 'INSERT', '1421211237');
INSERT INTO `rnd_history` VALUES ('300', '10', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1421211237,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421211237');
INSERT INTO `rnd_history` VALUES ('301', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421211237');
INSERT INTO `rnd_history` VALUES ('302', '11', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1421211237,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421211237');
INSERT INTO `rnd_history` VALUES ('303', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421211237');
INSERT INTO `rnd_history` VALUES ('304', '12', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":2,\"created_by\":\"UI-000001\",\"creation_date\":1421211237,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421211237');
INSERT INTO `rnd_history` VALUES ('305', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421211237');
INSERT INTO `rnd_history` VALUES ('306', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421211277');
INSERT INTO `rnd_history` VALUES ('307', '13', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421211277,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421211277');
INSERT INTO `rnd_history` VALUES ('308', '14', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421211277,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421211277');
INSERT INTO `rnd_history` VALUES ('309', '15', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421211277,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421211277');
INSERT INTO `rnd_history` VALUES ('310', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421212184');
INSERT INTO `rnd_history` VALUES ('311', '16', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212184,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421212184');
INSERT INTO `rnd_history` VALUES ('312', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421212184');
INSERT INTO `rnd_history` VALUES ('313', '17', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212184,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421212184');
INSERT INTO `rnd_history` VALUES ('314', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421212184');
INSERT INTO `rnd_history` VALUES ('315', '18', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212184,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421212184');
INSERT INTO `rnd_history` VALUES ('316', '15', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421212184');
INSERT INTO `rnd_history` VALUES ('317', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421212299');
INSERT INTO `rnd_history` VALUES ('318', '19', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212299,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421212299');
INSERT INTO `rnd_history` VALUES ('319', '20', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212299,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421212299');
INSERT INTO `rnd_history` VALUES ('320', '21', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421212299,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421212299');
INSERT INTO `rnd_history` VALUES ('321', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421214648');
INSERT INTO `rnd_history` VALUES ('322', '22', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421214648,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421214648');
INSERT INTO `rnd_history` VALUES ('323', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421214648');
INSERT INTO `rnd_history` VALUES ('324', '23', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421214648,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421214648');
INSERT INTO `rnd_history` VALUES ('325', '12', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421214648');
INSERT INTO `rnd_history` VALUES ('326', '24', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421214648,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421214648');
INSERT INTO `rnd_history` VALUES ('327', '15', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421214648');
INSERT INTO `rnd_history` VALUES ('328', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421215189');
INSERT INTO `rnd_history` VALUES ('329', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421215189');
INSERT INTO `rnd_history` VALUES ('330', '15', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421215189');
INSERT INTO `rnd_history` VALUES ('331', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421215209');
INSERT INTO `rnd_history` VALUES ('332', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421215209');
INSERT INTO `rnd_history` VALUES ('333', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421215209');
INSERT INTO `rnd_history` VALUES ('334', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421215245');
INSERT INTO `rnd_history` VALUES ('335', '25', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421215245,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421215245');
INSERT INTO `rnd_history` VALUES ('336', '17', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421215245');
INSERT INTO `rnd_history` VALUES ('337', '26', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421215245,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421215245');
INSERT INTO `rnd_history` VALUES ('338', '18', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421215245');
INSERT INTO `rnd_history` VALUES ('339', '27', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"2\",\"created_by\":\"UI-000001\",\"creation_date\":1421215245,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421215245');
INSERT INTO `rnd_history` VALUES ('340', '19', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421215245');
INSERT INTO `rnd_history` VALUES ('341', '17', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421215630');
INSERT INTO `rnd_history` VALUES ('342', '18', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421215631');
INSERT INTO `rnd_history` VALUES ('343', '19', 'rnd_variety_info', '{\"quantity\":14}', 'UI-000001', 'UPDATE', '1421215631');
INSERT INTO `rnd_history` VALUES ('344', '2', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1422554400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422381600,\"sowing_status\":\"1\",\"remark\":\"asasasa\",\"delivery_date\":1421431200,\"rnd_received_date\":1421863200,\"sowing_date\":1419789600,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421216098');
INSERT INTO `rnd_history` VALUES ('345', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"created_by\":\"UI-00000', 'UI-000001', 'INSERT', '1421216246');
INSERT INTO `rnd_history` VALUES ('346', '28', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1421216246,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421216246');
INSERT INTO `rnd_history` VALUES ('347', '15', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421216246');
INSERT INTO `rnd_history` VALUES ('348', '29', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1421216246,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421216246');
INSERT INTO `rnd_history` VALUES ('349', '11', 'rnd_variety_info', '{\"quantity\":4}', 'UI-000001', 'UPDATE', '1421216246');
INSERT INTO `rnd_history` VALUES ('350', '30', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":3,\"created_by\":\"UI-000001\",\"creation_date\":1421216246,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421216246');
INSERT INTO `rnd_history` VALUES ('351', '12', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421216246');
INSERT INTO `rnd_history` VALUES ('352', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"modified_by\":\"UI-0000', 'UI-000001', 'UPDATE', '1421216303');
INSERT INTO `rnd_history` VALUES ('353', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"modified_by\":\"UI-0000', 'UI-000001', 'UPDATE', '1421216357');
INSERT INTO `rnd_history` VALUES ('354', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"modified_by\":\"UI-0000', 'UI-000001', 'UPDATE', '1421216387');
INSERT INTO `rnd_history` VALUES ('355', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"modified_by\":\"UI-0000', 'UI-000001', 'UPDATE', '1421216505');
INSERT INTO `rnd_history` VALUES ('356', '3', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420480800,\"sowing_status\":\"1\",\"remark\":\"sa\",\"delivery_date\":1421258400,\"rnd_received_date\":1422036000,\"sowing_date\":1422295200,\"modified_by\":\"UI-0000', 'UI-000001', 'UPDATE', '1421216523');
INSERT INTO `rnd_history` VALUES ('357', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"created_by\":\"UI-0', 'UI-000001', 'INSERT', '1421216880');
INSERT INTO `rnd_history` VALUES ('358', '31', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1421216880,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421216880');
INSERT INTO `rnd_history` VALUES ('359', '17', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421216880');
INSERT INTO `rnd_history` VALUES ('360', '32', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1421216880,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421216880');
INSERT INTO `rnd_history` VALUES ('361', '18', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421216881');
INSERT INTO `rnd_history` VALUES ('362', '33', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":4,\"created_by\":\"UI-000001\",\"creation_date\":1421216880,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421216881');
INSERT INTO `rnd_history` VALUES ('363', '19', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421216881');
INSERT INTO `rnd_history` VALUES ('364', '17', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421216884');
INSERT INTO `rnd_history` VALUES ('365', '18', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421216884');
INSERT INTO `rnd_history` VALUES ('366', '19', 'rnd_variety_info', '{\"quantity\":14}', 'UI-000001', 'UPDATE', '1421216884');
INSERT INTO `rnd_history` VALUES ('367', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421217630');
INSERT INTO `rnd_history` VALUES ('368', '34', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421217630,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421217630');
INSERT INTO `rnd_history` VALUES ('369', '35', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421217630,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421217630');
INSERT INTO `rnd_history` VALUES ('370', '36', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421217630,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421217630');
INSERT INTO `rnd_history` VALUES ('371', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421217691');
INSERT INTO `rnd_history` VALUES ('372', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421217895');
INSERT INTO `rnd_history` VALUES ('373', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421217895');
INSERT INTO `rnd_history` VALUES ('374', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421217895');
INSERT INTO `rnd_history` VALUES ('375', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421217895');
INSERT INTO `rnd_history` VALUES ('376', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421217932');
INSERT INTO `rnd_history` VALUES ('377', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421217932');
INSERT INTO `rnd_history` VALUES ('378', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421217932');
INSERT INTO `rnd_history` VALUES ('379', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421217932');
INSERT INTO `rnd_history` VALUES ('380', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('381', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('382', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('383', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('384', '37', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218033,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421218033');
INSERT INTO `rnd_history` VALUES ('385', '17', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('386', '38', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218033,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421218033');
INSERT INTO `rnd_history` VALUES ('387', '18', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('388', '39', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218033,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421218033');
INSERT INTO `rnd_history` VALUES ('389', '19', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421218033');
INSERT INTO `rnd_history` VALUES ('390', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218076');
INSERT INTO `rnd_history` VALUES ('391', '11', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('392', '12', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('393', '15', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('394', '17', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('395', '18', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('396', '19', 'rnd_variety_info', '{\"quantity\":14}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('397', '40', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218076,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421218077');
INSERT INTO `rnd_history` VALUES ('398', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('399', '41', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218076,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421218077');
INSERT INTO `rnd_history` VALUES ('400', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('401', '42', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218076,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421218077');
INSERT INTO `rnd_history` VALUES ('402', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421218077');
INSERT INTO `rnd_history` VALUES ('403', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218262');
INSERT INTO `rnd_history` VALUES ('404', '43', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218262,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421218262');
INSERT INTO `rnd_history` VALUES ('405', '17', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421218262');
INSERT INTO `rnd_history` VALUES ('406', '44', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218262,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421218262');
INSERT INTO `rnd_history` VALUES ('407', '18', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421218262');
INSERT INTO `rnd_history` VALUES ('408', '45', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218262,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421218262');
INSERT INTO `rnd_history` VALUES ('409', '19', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421218262');
INSERT INTO `rnd_history` VALUES ('410', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218365');
INSERT INTO `rnd_history` VALUES ('411', '46', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218365,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421218365');
INSERT INTO `rnd_history` VALUES ('412', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421218365');
INSERT INTO `rnd_history` VALUES ('413', '47', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218365,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421218366');
INSERT INTO `rnd_history` VALUES ('414', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218366');
INSERT INTO `rnd_history` VALUES ('415', '48', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218365,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421218366');
INSERT INTO `rnd_history` VALUES ('416', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218366');
INSERT INTO `rnd_history` VALUES ('417', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218534');
INSERT INTO `rnd_history` VALUES ('418', '49', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218534,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421218534');
INSERT INTO `rnd_history` VALUES ('419', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421218534');
INSERT INTO `rnd_history` VALUES ('420', '50', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218534,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421218534');
INSERT INTO `rnd_history` VALUES ('421', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421218534');
INSERT INTO `rnd_history` VALUES ('422', '51', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421218534,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421218534');
INSERT INTO `rnd_history` VALUES ('423', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218534');
INSERT INTO `rnd_history` VALUES ('424', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218879');
INSERT INTO `rnd_history` VALUES ('425', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421218879');
INSERT INTO `rnd_history` VALUES ('426', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218879');
INSERT INTO `rnd_history` VALUES ('427', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218879');
INSERT INTO `rnd_history` VALUES ('428', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421218981');
INSERT INTO `rnd_history` VALUES ('429', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421218981');
INSERT INTO `rnd_history` VALUES ('430', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421218981');
INSERT INTO `rnd_history` VALUES ('431', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421218981');
INSERT INTO `rnd_history` VALUES ('432', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421219329');
INSERT INTO `rnd_history` VALUES ('433', '52', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219329,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421219329');
INSERT INTO `rnd_history` VALUES ('434', '17', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('435', '53', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219329,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421219330');
INSERT INTO `rnd_history` VALUES ('436', '18', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('437', '54', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219329,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421219330');
INSERT INTO `rnd_history` VALUES ('438', '19', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('439', '17', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('440', '18', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('441', '19', 'rnd_variety_info', '{\"quantity\":13}', 'UI-000001', 'UPDATE', '1421219330');
INSERT INTO `rnd_history` VALUES ('442', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421219415');
INSERT INTO `rnd_history` VALUES ('443', '55', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219415,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421219415');
INSERT INTO `rnd_history` VALUES ('444', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421219415');
INSERT INTO `rnd_history` VALUES ('445', '56', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219415,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421219415');
INSERT INTO `rnd_history` VALUES ('446', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421219416');
INSERT INTO `rnd_history` VALUES ('447', '57', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219415,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421219416');
INSERT INTO `rnd_history` VALUES ('448', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421219416');
INSERT INTO `rnd_history` VALUES ('449', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421219416');
INSERT INTO `rnd_history` VALUES ('450', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421219416');
INSERT INTO `rnd_history` VALUES ('451', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421219416');
INSERT INTO `rnd_history` VALUES ('452', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421219697');
INSERT INTO `rnd_history` VALUES ('453', '58', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219697,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421219698');
INSERT INTO `rnd_history` VALUES ('454', '17', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421219698');
INSERT INTO `rnd_history` VALUES ('455', '59', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219697,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421219698');
INSERT INTO `rnd_history` VALUES ('456', '18', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421219698');
INSERT INTO `rnd_history` VALUES ('457', '60', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421219697,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421219698');
INSERT INTO `rnd_history` VALUES ('458', '19', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421219698');
INSERT INTO `rnd_history` VALUES ('459', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421220092');
INSERT INTO `rnd_history` VALUES ('460', '61', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421220092,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421220092');
INSERT INTO `rnd_history` VALUES ('461', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421220092');
INSERT INTO `rnd_history` VALUES ('462', '62', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421220092,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421220092');
INSERT INTO `rnd_history` VALUES ('463', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421220092');
INSERT INTO `rnd_history` VALUES ('464', '63', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421220092,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421220093');
INSERT INTO `rnd_history` VALUES ('465', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421220093');
INSERT INTO `rnd_history` VALUES ('466', '7', 'rnd_product_type_info', '{\"crop_id\":\"3\",\"product_type\":\"Type4\",\"product_type_code\":\"T40001\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421235279}', 'UI-000001', 'INSERT', '1421235279');
INSERT INTO `rnd_history` VALUES ('467', '27', 'rnd_variety_info', '{\"number_of_seeds\":\"13\",\"quantity\":\"11\",\"characteristics\":\"Characteristics\",\"status\":\"1\",\"company_name\":\"\",\"principal_id\":\"\",\"crop_id\":\"3\",\"product_type_id\":\"7\",\"variety_name\":\"V40004\",\"variety_type\":\"1\",\"new_old_status\":\"1\",\"rnd_code\":\"C0001-T40001-3-CKA', 'UI-000001', 'INSERT', '1421235373');
INSERT INTO `rnd_history` VALUES ('468', '89', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"7\",\"variety_id\":27,\"season_id\":\"4\",\"created_by\":\"UI-000001\",\"creation_date\":1421235373}', 'UI-000001', 'INSERT', '1421235373');
INSERT INTO `rnd_history` VALUES ('469', '90', 'rnd_variety_season', '{\"crop_id\":\"3\",\"product_type_id\":\"7\",\"variety_id\":27,\"season_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421235373}', 'UI-000001', 'INSERT', '1421235373');
INSERT INTO `rnd_history` VALUES ('470', '4', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1419962400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"asasas\",\"delivery_date\":1420480800,\"rnd_received_date\":1420740000,\"sowing_date\":1420135200,\"modified_by\":\"UI-', 'UI-000001', 'UPDATE', '1421301102');
INSERT INTO `rnd_history` VALUES ('471', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"created_by\":\"UI-', 'UI-000001', 'INSERT', '1421301380');
INSERT INTO `rnd_history` VALUES ('472', '64', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1421301380,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421301380');
INSERT INTO `rnd_history` VALUES ('473', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421301380');
INSERT INTO `rnd_history` VALUES ('474', '65', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1421301380,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421301380');
INSERT INTO `rnd_history` VALUES ('475', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421301380');
INSERT INTO `rnd_history` VALUES ('476', '66', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":5,\"created_by\":\"UI-000001\",\"creation_date\":1421301380,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421301380');
INSERT INTO `rnd_history` VALUES ('477', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421301380');
INSERT INTO `rnd_history` VALUES ('478', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421303301');
INSERT INTO `rnd_history` VALUES ('479', '67', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303302,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421303302');
INSERT INTO `rnd_history` VALUES ('480', '17', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421303302');
INSERT INTO `rnd_history` VALUES ('481', '68', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303302,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421303302');
INSERT INTO `rnd_history` VALUES ('482', '18', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421303302');
INSERT INTO `rnd_history` VALUES ('483', '69', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303302,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421303302');
INSERT INTO `rnd_history` VALUES ('484', '19', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421303302');
INSERT INTO `rnd_history` VALUES ('485', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421303504');
INSERT INTO `rnd_history` VALUES ('486', '70', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303504,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421303504');
INSERT INTO `rnd_history` VALUES ('487', '11', 'rnd_variety_info', '{\"quantity\":4}', 'UI-000001', 'UPDATE', '1421303504');
INSERT INTO `rnd_history` VALUES ('488', '71', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303504,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421303504');
INSERT INTO `rnd_history` VALUES ('489', '12', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421303504');
INSERT INTO `rnd_history` VALUES ('490', '72', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421303504,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421303505');
INSERT INTO `rnd_history` VALUES ('491', '15', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421303505');
INSERT INTO `rnd_history` VALUES ('492', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421303836');
INSERT INTO `rnd_history` VALUES ('493', '12', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421303836');
INSERT INTO `rnd_history` VALUES ('494', '15', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421303836');
INSERT INTO `rnd_history` VALUES ('495', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('496', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('497', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('498', '73', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":17}', 'UI-000001', 'INSERT', '1421304314');
INSERT INTO `rnd_history` VALUES ('499', '17', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('500', '74', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":18}', 'UI-000001', 'INSERT', '1421304314');
INSERT INTO `rnd_history` VALUES ('501', '18', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('502', '75', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":19}', 'UI-000001', 'INSERT', '1421304314');
INSERT INTO `rnd_history` VALUES ('503', '19', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421304314');
INSERT INTO `rnd_history` VALUES ('504', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421304491');
INSERT INTO `rnd_history` VALUES ('505', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421304492');
INSERT INTO `rnd_history` VALUES ('506', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421304492');
INSERT INTO `rnd_history` VALUES ('507', '76', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":17}', 'UI-000001', 'INSERT', '1421304492');
INSERT INTO `rnd_history` VALUES ('508', '17', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421304492');
INSERT INTO `rnd_history` VALUES ('509', '77', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":18}', 'UI-000001', 'INSERT', '1421304492');
INSERT INTO `rnd_history` VALUES ('510', '18', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421304492');
INSERT INTO `rnd_history` VALUES ('511', '78', 'rnd_sample_delivery_date_crop', '{\"rnd_code_id\":19}', 'UI-000001', 'INSERT', '1421304492');
INSERT INTO `rnd_history` VALUES ('512', '19', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421304492');
INSERT INTO `rnd_history` VALUES ('513', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421305282');
INSERT INTO `rnd_history` VALUES ('514', '79', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421305282,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421305282');
INSERT INTO `rnd_history` VALUES ('515', '17', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421305283');
INSERT INTO `rnd_history` VALUES ('516', '80', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421305282,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421305283');
INSERT INTO `rnd_history` VALUES ('517', '18', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421305283');
INSERT INTO `rnd_history` VALUES ('518', '81', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"5\",\"created_by\":\"UI-000001\",\"creation_date\":1421305282,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421305283');
INSERT INTO `rnd_history` VALUES ('519', '19', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421305283');
INSERT INTO `rnd_history` VALUES ('520', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421307599');
INSERT INTO `rnd_history` VALUES ('521', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421307617');
INSERT INTO `rnd_history` VALUES ('522', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421307638');
INSERT INTO `rnd_history` VALUES ('523', '5', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1421258400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1420653600,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421690400,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421307695');
INSERT INTO `rnd_history` VALUES ('524', '6', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420394400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421863200,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421344800,\"sowing_date\":1421776800,\"created_by\":\"UI-', 'UI-000001', 'INSERT', '1421308832');
INSERT INTO `rnd_history` VALUES ('525', '82', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1421308832,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421308832');
INSERT INTO `rnd_history` VALUES ('526', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421308832');
INSERT INTO `rnd_history` VALUES ('527', '83', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1421308832,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421308832');
INSERT INTO `rnd_history` VALUES ('528', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421308832');
INSERT INTO `rnd_history` VALUES ('529', '84', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":6,\"created_by\":\"UI-000001\",\"creation_date\":1421308832,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421308832');
INSERT INTO `rnd_history` VALUES ('530', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421308832');
INSERT INTO `rnd_history` VALUES ('531', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421308891');
INSERT INTO `rnd_history` VALUES ('532', '11', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('533', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('534', '6', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420394400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421863200,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421344800,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('535', '85', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421308891,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421308892');
INSERT INTO `rnd_history` VALUES ('536', '17', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('537', '86', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421308891,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421308892');
INSERT INTO `rnd_history` VALUES ('538', '18', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('539', '87', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421308891,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421308892');
INSERT INTO `rnd_history` VALUES ('540', '19', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421308892');
INSERT INTO `rnd_history` VALUES ('541', '17', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('542', '18', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('543', '19', 'rnd_variety_info', '{\"quantity\":12}', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('544', '6', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420394400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421863200,\"sowing_status\":\"1\",\"remark\":\"Remarks\",\"delivery_date\":1421863200,\"rnd_received_date\":1421344800,\"sowing_date\":1421776800,\"modified_by\":\"UI', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('545', '88', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421310971,\"rnd_code_id\":\"17\"}', 'UI-000001', 'INSERT', '1421310971');
INSERT INTO `rnd_history` VALUES ('546', '17', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('547', '89', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421310971,\"rnd_code_id\":\"18\"}', 'UI-000001', 'INSERT', '1421310971');
INSERT INTO `rnd_history` VALUES ('548', '18', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421310971');
INSERT INTO `rnd_history` VALUES ('549', '90', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"6\",\"created_by\":\"UI-000001\",\"creation_date\":1421310971,\"rnd_code_id\":\"19\"}', 'UI-000001', 'INSERT', '1421310972');
INSERT INTO `rnd_history` VALUES ('550', '19', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421310972');
INSERT INTO `rnd_history` VALUES ('551', '7', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420480800,\"delivered_status\":\"0\",\"received_status\":\"0\",\"destined_sowing_date\":1420048800,\"sowing_status\":\"0\",\"remark\":\"\",\"delivery_date\":\"\",\"rnd_received_date\":\"\",\"sowing_date\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1421318', 'UI-000001', 'INSERT', '1421318594');
INSERT INTO `rnd_history` VALUES ('552', '91', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":7,\"created_by\":\"UI-000001\",\"creation_date\":1421318594,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421318594');
INSERT INTO `rnd_history` VALUES ('553', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421318594');
INSERT INTO `rnd_history` VALUES ('554', '92', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":7,\"created_by\":\"UI-000001\",\"creation_date\":1421318594,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421318594');
INSERT INTO `rnd_history` VALUES ('555', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421318594');
INSERT INTO `rnd_history` VALUES ('556', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421318606');
INSERT INTO `rnd_history` VALUES ('557', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421318606');
INSERT INTO `rnd_history` VALUES ('558', '7', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420480800,\"delivered_status\":\"0\",\"received_status\":\"0\",\"destined_sowing_date\":1420048800,\"sowing_status\":\"0\",\"remark\":\"\",\"delivery_date\":\"\",\"rnd_received_date\":\"\",\"sowing_date\":\"\",\"modified_by\":\"UI-000001\",\"modification_date\":14', 'UI-000001', 'UPDATE', '1421318606');
INSERT INTO `rnd_history` VALUES ('559', '93', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"7\",\"created_by\":\"UI-000001\",\"creation_date\":1421318605,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421318606');
INSERT INTO `rnd_history` VALUES ('560', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421318606');
INSERT INTO `rnd_history` VALUES ('561', '8', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420653600,\"delivered_status\":\"0\",\"received_status\":\"0\",\"destined_sowing_date\":1420221600,\"sowing_status\":\"0\",\"remark\":\"\",\"delivery_date\":\"\",\"rnd_received_date\":\"\",\"sowing_date\":\"\",\"created_by\":\"UI-000001\",\"creation_date\":1421318', 'UI-000001', 'INSERT', '1421318634');
INSERT INTO `rnd_history` VALUES ('562', '94', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":8,\"created_by\":\"UI-000001\",\"creation_date\":1421318634,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421318634');
INSERT INTO `rnd_history` VALUES ('563', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421318634');
INSERT INTO `rnd_history` VALUES ('564', '9', 'rnd_crop_info', '{\"crop_name\":\"Casasas\",\"crop_code\":\"C000123\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"initial_plants\":\"12\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1421319377}', 'UI-000001', 'UPDATE', '1421319377');
INSERT INTO `rnd_history` VALUES ('565', '9', 'rnd_crop_info', '{\"crop_name\":\"Casasas\",\"crop_code\":\"C000123\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"5\",\"sample_size\":\"1\",\"initial_plants\":\"12\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1421319387}', 'UI-000001', 'UPDATE', '1421319387');
INSERT INTO `rnd_history` VALUES ('566', '8', 'rnd_crop_info', '{\"crop_name\":\"Cucumbers\",\"crop_code\":\"asas\",\"crop_width\":\"12\",\"crop_height\":\"21\",\"fruit_type\":\"1\",\"sample_size\":\"1\",\"initial_plants\":\"11\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1421319426}', 'UI-000001', 'UPDATE', '1421319426');
INSERT INTO `rnd_history` VALUES ('567', '10', 'rnd_crop_info', '{\"crop_name\":\"test\",\"crop_code\":\"T0345\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"3\",\"sample_size\":\"1\",\"initial_plants\":\"13\",\"status\":\"1\",\"created_by\":\"UI-000001\",\"creation_date\":1421320206}', 'UI-000001', 'INSERT', '1421320206');
INSERT INTO `rnd_history` VALUES ('568', '10', 'rnd_crop_info', '{\"crop_name\":\"test\",\"crop_code\":\"T0345\",\"crop_width\":\"23\",\"crop_height\":\"12\",\"fruit_type\":\"3\",\"sample_size\":\"1\",\"initial_plants\":\"11\",\"status\":\"1\",\"modified_by\":\"UI-000001\",\"modification_date\":1421320213}', 'UI-000001', 'UPDATE', '1421320213');
INSERT INTO `rnd_history` VALUES ('569', '12', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('570', '15', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('571', '7', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420480800,\"delivered_status\":\"0\",\"received_status\":\"0\",\"destined_sowing_date\":1420048800,\"sowing_status\":\"0\",\"remark\":\"\",\"delivery_date\":\"\",\"rnd_received_date\":\"\",\"sowing_date\":\"\",\"modified_by\":\"UI-000001\",\"modification_date\":14', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('572', '95', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"7\",\"created_by\":\"UI-000001\",\"creation_date\":1421472572,\"rnd_code_id\":\"10\"}', 'UI-000001', 'INSERT', '1421472572');
INSERT INTO `rnd_history` VALUES ('573', '10', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('574', '96', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"7\",\"created_by\":\"UI-000001\",\"creation_date\":1421472572,\"rnd_code_id\":\"12\"}', 'UI-000001', 'INSERT', '1421472572');
INSERT INTO `rnd_history` VALUES ('575', '12', 'rnd_variety_info', '{\"quantity\":7}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('576', '97', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"7\",\"created_by\":\"UI-000001\",\"creation_date\":1421472572,\"rnd_code_id\":\"15\"}', 'UI-000001', 'INSERT', '1421472572');
INSERT INTO `rnd_history` VALUES ('577', '15', 'rnd_variety_info', '{\"quantity\":8}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('578', '98', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"7\",\"created_by\":\"UI-000001\",\"creation_date\":1421472572,\"rnd_code_id\":\"23\"}', 'UI-000001', 'INSERT', '1421472572');
INSERT INTO `rnd_history` VALUES ('579', '23', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421472572');
INSERT INTO `rnd_history` VALUES ('580', '9', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420048800,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1422468000,\"sowing_status\":\"1\",\"remark\":\"scscscsc\",\"delivery_date\":1420567200,\"rnd_received_date\":1420740000,\"sowing_date\":1421172000,\"created_by\":\"UI', 'UI-000001', 'INSERT', '1421496338');
INSERT INTO `rnd_history` VALUES ('581', '99', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":9,\"created_by\":\"UI-000001\",\"creation_date\":1421496338,\"rnd_code_id\":\"11\"}', 'UI-000001', 'INSERT', '1421496338');
INSERT INTO `rnd_history` VALUES ('582', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421496338');
INSERT INTO `rnd_history` VALUES ('583', '8', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420394400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421085600,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1421949600,\"rnd_received_date\":1421085600,\"sowing_date\":1420567200,\"created_by\":\"U', 'UI-000001', 'INSERT', '1421569232');
INSERT INTO `rnd_history` VALUES ('584', '99', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":8,\"created_by\":\"UI-000001\",\"creation_date\":1421569232,\"rnd_code_id\":\"11\",\"sowing_date\":1420567200}', 'UI-000001', 'INSERT', '1421569232');
INSERT INTO `rnd_history` VALUES ('585', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421569232');
INSERT INTO `rnd_history` VALUES ('586', '100', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":8,\"created_by\":\"UI-000001\",\"creation_date\":1421569232,\"rnd_code_id\":\"21\",\"sowing_date\":1420740000}', 'UI-000001', 'INSERT', '1421569232');
INSERT INTO `rnd_history` VALUES ('587', '21', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421569232');
INSERT INTO `rnd_history` VALUES ('588', '101', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":8,\"created_by\":\"UI-000001\",\"creation_date\":1421569232,\"rnd_code_id\":\"22\",\"sowing_date\":1420826400}', 'UI-000001', 'INSERT', '1421569232');
INSERT INTO `rnd_history` VALUES ('589', '22', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421569232');
INSERT INTO `rnd_history` VALUES ('590', '102', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":8,\"created_by\":\"UI-000001\",\"creation_date\":1421569232,\"rnd_code_id\":\"24\",\"sowing_date\":1420567200}', 'UI-000001', 'INSERT', '1421569232');
INSERT INTO `rnd_history` VALUES ('591', '24', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421569232');
INSERT INTO `rnd_history` VALUES ('592', '11', 'rnd_variety_info', '{\"quantity\":6}', 'UI-000001', 'UPDATE', '1421574067');
INSERT INTO `rnd_history` VALUES ('593', '21', 'rnd_variety_info', '{\"quantity\":11}', 'UI-000001', 'UPDATE', '1421574067');
INSERT INTO `rnd_history` VALUES ('594', '8', 'rnd_sample_delivery_date', '{\"destined_delivery_date\":1420394400,\"delivered_status\":\"1\",\"received_status\":\"1\",\"destined_sowing_date\":1421085600,\"sowing_status\":\"1\",\"remark\":\" Remarks \",\"delivery_date\":1421949600,\"rnd_received_date\":1421085600,\"sowing_date\":1420567200,\"modified_by\":\"', 'UI-000001', 'UPDATE', '1421574067');
INSERT INTO `rnd_history` VALUES ('595', '103', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"8\",\"created_by\":\"UI-000001\",\"creation_date\":1421574067,\"rnd_code_id\":\"11\",\"sowing_date\":1420567200}', 'UI-000001', 'INSERT', '1421574067');
INSERT INTO `rnd_history` VALUES ('596', '11', 'rnd_variety_info', '{\"quantity\":5}', 'UI-000001', 'UPDATE', '1421574067');
INSERT INTO `rnd_history` VALUES ('597', '104', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"8\",\"created_by\":\"UI-000001\",\"creation_date\":1421574067,\"rnd_code_id\":\"21\",\"sowing_date\":1420567200}', 'UI-000001', 'INSERT', '1421574068');
INSERT INTO `rnd_history` VALUES ('598', '21', 'rnd_variety_info', '{\"quantity\":10}', 'UI-000001', 'UPDATE', '1421574068');
INSERT INTO `rnd_history` VALUES ('599', '105', 'rnd_sample_delivery_date_crop', '{\"sample_delivery_date_id\":\"8\",\"created_by\":\"UI-000001\",\"creation_date\":1421574067,\"rnd_code_id\":\"22\",\"sowing_date\":1420567200}', 'UI-000001', 'INSERT', '1421574068');
INSERT INTO `rnd_history` VALUES ('600', '22', 'rnd_variety_info', '{\"quantity\":9}', 'UI-000001', 'UPDATE', '1421574068');

-- ----------------------------
-- Table structure for `rnd_labor_activity_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_labor_activity_info`;
CREATE TABLE `rnd_labor_activity_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crop_id` int(10) DEFAULT NULL,
  `labor_activity_name_id` int(10) DEFAULT NULL,
  `activity_date` int(11) DEFAULT NULL,
  `number_of_labor` int(10) DEFAULT NULL,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `crop_id` (`crop_id`),
  KEY `labor_activity_name_id` (`labor_activity_name_id`),
  CONSTRAINT `rnd_labor_activity_info_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `rnd_crop_info` (`id`),
  CONSTRAINT `rnd_labor_activity_info_ibfk_2` FOREIGN KEY (`labor_activity_name_id`) REFERENCES `rnd_labor_activity_name` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_labor_activity_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_labor_activity_name`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_labor_activity_name`;
CREATE TABLE `rnd_labor_activity_name` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `labor_activity_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_labor_activity_name
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_pesticide_fungicide_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_pesticide_fungicide_info`;
CREATE TABLE `rnd_pesticide_fungicide_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pesticide_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_pesticide_fungicide_info
-- ----------------------------
INSERT INTO `rnd_pesticide_fungicide_info` VALUES ('1', 'Abamectin', '1', 'UI-000001', '1419679767', 'UI-000001', '1419680543');
INSERT INTO `rnd_pesticide_fungicide_info` VALUES ('2', 'Bachmedesh', '1', 'UI-000001', '1419679806', null, null);
INSERT INTO `rnd_pesticide_fungicide_info` VALUES ('3', 'Kadethrin', '1', 'UI-000001', '1419679824', null, null);

-- ----------------------------
-- Table structure for `rnd_pesticide_fungicide_stock_in`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_pesticide_fungicide_stock_in`;
CREATE TABLE `rnd_pesticide_fungicide_stock_in` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pesticide_id` int(10) DEFAULT NULL,
  `pesticide_quantity` double(6,2) NOT NULL,
  `pesticide_price` decimal(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fertilizer_id` (`pesticide_id`),
  CONSTRAINT `rnd_pesticide_fungicide_stock_in_ibfk_1` FOREIGN KEY (`pesticide_id`) REFERENCES `rnd_fertilizer_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_pesticide_fungicide_stock_in
-- ----------------------------
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('1', '1', '50.00', '100.00', '1', 'UI-000001', '1420116208', null, null);
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('2', '2', '30.00', '200.00', '0', 'UI-000001', '1420116228', 'UI-000001', '1420267855');
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('3', '3', '30.00', '250.00', '0', 'UI-000001', '1420116240', null, null);
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('4', '1', '50.00', '600.00', '1', 'UI-000001', '1420266925', null, null);
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('5', '2', '20.00', '200.00', '1', 'UI-000001', '1420267164', null, null);
INSERT INTO `rnd_pesticide_fungicide_stock_in` VALUES ('6', '3', '50.00', '250.00', '0', 'UI-000001', '1420268283', null, null);

-- ----------------------------
-- Table structure for `rnd_plot_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_plot_info`;
CREATE TABLE `rnd_plot_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plot_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_plot_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_plot_row_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_plot_row_info`;
CREATE TABLE `rnd_plot_row_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plot_row` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_plot_row_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_principal_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_principal_info`;
CREATE TABLE `rnd_principal_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `principal_name` varchar(50) DEFAULT NULL,
  `principal_code` varchar(20) DEFAULT NULL,
  `contact_person_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`),
  KEY `created_by_2` (`created_by`),
  KEY `modified_by_2` (`modified_by`),
  KEY `created_by_3` (`created_by`),
  KEY `modified_by_3` (`modified_by`),
  KEY `created_by_4` (`created_by`),
  KEY `modified_by_4` (`modified_by`),
  KEY `created_by_5` (`created_by`),
  KEY `modified_by_5` (`modified_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_principal_info
-- ----------------------------
INSERT INTO `rnd_principal_info` VALUES ('1', 'Principal Name11', 'Code11', 'Person11', 'email1@email.com', '01718564523', 'Address1\r\n', '1', 'UI-000001', '1419414306', 'UI-000001', '1419519456');
INSERT INTO `rnd_principal_info` VALUES ('2', 'Principal Name2', 'Code2', 'Person2', 'email@email.com', '01712345671', ' Address ', '1', 'UI-000001', '1419414437', null, null);
INSERT INTO `rnd_principal_info` VALUES ('3', 'Principal3', 'Code3', 'Person3', 'email@email.com', '01718675641', ' Address ', '1', 'UI-000001', '1419414480', null, null);

-- ----------------------------
-- Table structure for `rnd_product_type_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_product_type_info`;
CREATE TABLE `rnd_product_type_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crop_id` int(10) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `product_type_code` varchar(20) DEFAULT NULL,
  `product_type_height` int(11) DEFAULT NULL,
  `product_type_width` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `crop_id` (`crop_id`),
  CONSTRAINT `rnd_product_type_info_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `rnd_crop_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_product_type_info
-- ----------------------------
INSERT INTO `rnd_product_type_info` VALUES ('1', '4', 'Type11', 'Code11', '231', '451', '1', 'UI-000001', '1419405999', 'UI-000001', '1420698961');
INSERT INTO `rnd_product_type_info` VALUES ('2', '5', 'Type2', 'Code2', '89', '45', '1', 'UI-000001', '1419406090', null, null);
INSERT INTO `rnd_product_type_info` VALUES ('3', '3', 'Type3', 'Code3', '43', '12', '1', 'UI-000001', '1419406111', null, null);
INSERT INTO `rnd_product_type_info` VALUES ('4', '5', 'Type4', 'Code4', '45', '23', '1', 'UI-000001', '1419748051', null, null);
INSERT INTO `rnd_product_type_info` VALUES ('5', '6', 'Early', 'E', '45', '23', '1', 'UI-000001', '1420288180', null, null);
INSERT INTO `rnd_product_type_info` VALUES ('6', '7', 'Type000T', 'T0001', null, null, '1', 'UI-000001', '1420872797', null, null);
INSERT INTO `rnd_product_type_info` VALUES ('7', '3', 'Type4', 'T40001', null, null, '1', 'UI-000001', '1421235279', null, null);

-- ----------------------------
-- Table structure for `rnd_sample_delivery_date`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_sample_delivery_date`;
CREATE TABLE `rnd_sample_delivery_date` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `season_id` int(10) NOT NULL,
  `rnd_year` int(11) NOT NULL,
  `destined_delivery_date` int(11) NOT NULL,
  `delivered_status` int(1) NOT NULL,
  `delivery_date` int(11) DEFAULT NULL,
  `received_status` int(1) NOT NULL,
  `rnd_received_date` int(11) DEFAULT NULL,
  `destined_sowing_date` int(11) DEFAULT NULL,
  `sowing_status` int(1) NOT NULL,
  `sowing_date` int(11) DEFAULT NULL,
  `remark` text,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `season_id` (`season_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_sample_delivery_date
-- ----------------------------
INSERT INTO `rnd_sample_delivery_date` VALUES ('6', '1', '1', '1420394400', '1', '1421863200', '1', '1421344800', '1421863200', '1', '1421776800', 'Remarks', '0', 'UI-000001', '1421308832', 'UI-000001', '1421310971');
INSERT INTO `rnd_sample_delivery_date` VALUES ('7', '3', '1', '1420480800', '0', '0', '0', '0', '1420048800', '0', '0', '', '0', 'UI-000001', '1421318594', 'UI-000001', '1421472572');
INSERT INTO `rnd_sample_delivery_date` VALUES ('8', '2', '1', '1420394400', '1', '1421949600', '1', '1421085600', '1421085600', '1', '1420567200', ' Remarks ', '0', 'UI-000001', '1421569232', 'UI-000001', '1421574067');

-- ----------------------------
-- Table structure for `rnd_sample_delivery_date_crop`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_sample_delivery_date_crop`;
CREATE TABLE `rnd_sample_delivery_date_crop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sample_delivery_date_id` int(11) NOT NULL,
  `rnd_code_id` int(11) NOT NULL,
  `sowing_date` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_sample_delivery_date_crop
-- ----------------------------
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('88', '6', '17', '0', '0', 'UI-000001', '1421310971', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('89', '6', '18', '0', '0', 'UI-000001', '1421310971', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('90', '6', '19', '0', '0', 'UI-000001', '1421310971', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('95', '7', '10', '0', '0', 'UI-000001', '1421472572', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('96', '7', '12', '0', '0', 'UI-000001', '1421472572', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('97', '7', '15', '0', '0', 'UI-000001', '1421472572', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('98', '7', '23', '0', '0', 'UI-000001', '1421472572', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('103', '8', '11', '1420567200', '0', 'UI-000001', '1421574067', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('104', '8', '21', '1420567200', '0', 'UI-000001', '1421574067', null, null);
INSERT INTO `rnd_sample_delivery_date_crop` VALUES ('105', '8', '22', '1420567200', '0', 'UI-000001', '1421574067', null, null);

-- ----------------------------
-- Table structure for `rnd_season_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_season_info`;
CREATE TABLE `rnd_season_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `season_name` varchar(50) DEFAULT NULL,
  `season_start` varchar(20) DEFAULT NULL,
  `season_end` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_season_info
-- ----------------------------
INSERT INTO `rnd_season_info` VALUES ('1', 'Summer', 'January', 'March', '1', null, null, null, null);
INSERT INTO `rnd_season_info` VALUES ('2', 'Rainy Summer', 'March', 'June', '1', null, null, null, null);
INSERT INTO `rnd_season_info` VALUES ('3', 'Early Winter', 'June', 'August', '1', null, null, null, null);
INSERT INTO `rnd_season_info` VALUES ('4', 'Optimum Winter', 'August', 'October', '1', null, null, null, null);
INSERT INTO `rnd_season_info` VALUES ('5', 'Late Winter', 'October', 'January', '1', null, null, null, null);

-- ----------------------------
-- Table structure for `rnd_seed_bed_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_seed_bed_info`;
CREATE TABLE `rnd_seed_bed_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `seed_bed` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_seed_bed_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_trial_setup_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_trial_setup_info`;
CREATE TABLE `rnd_trial_setup_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `season_id` int(10) DEFAULT NULL,
  `rnd_code` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `season_id` (`season_id`),
  KEY `rnd_code` (`rnd_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_trial_setup_info
-- ----------------------------

-- ----------------------------
-- Table structure for `rnd_variety_info`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_variety_info`;
CREATE TABLE `rnd_variety_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `principal_id` int(10) DEFAULT NULL,
  `flowering_type_id` int(10) DEFAULT NULL COMMENT '1=fruit, 2=curt, 3=root, 4=leaf',
  `crop_id` int(10) DEFAULT NULL,
  `product_type_id` int(10) DEFAULT NULL,
  `variety_name` varchar(50) DEFAULT NULL,
  `rnd_code` varchar(30) DEFAULT NULL,
  `variety_type` int(1) NOT NULL COMMENT '1=arm variety, 2=company',
  `company_name` varchar(50) DEFAULT NULL,
  `number_of_seeds` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `characteristics` varchar(255) DEFAULT NULL,
  `new_old_status` int(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `flowering_type_id` (`flowering_type_id`),
  KEY `product_type_id` (`product_type_id`),
  KEY `principal_id` (`principal_id`) USING BTREE,
  KEY `crop_id` (`crop_id`) USING BTREE,
  CONSTRAINT `rnd_variety_info_ibfk_3` FOREIGN KEY (`crop_id`) REFERENCES `rnd_crop_info` (`id`),
  CONSTRAINT `rnd_variety_info_ibfk_4` FOREIGN KEY (`product_type_id`) REFERENCES `rnd_product_type_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rnd_variety_info
-- ----------------------------
INSERT INTO `rnd_variety_info` VALUES ('10', '0', '2', '4', '1', 'V0001', 'P0001-Code2-1-CKA-15', '1', '', '13', '8', 'dff', '1', '1', 'UI-000001', '1419768116', 'UI-000001', '1420877811');
INSERT INTO `rnd_variety_info` VALUES ('11', '2', '3', '4', '1', 'V0002', 'V0002', '3', '', '12', '5', null, '1', '1', 'UI-000001', '1419771710', 'UI-000001', '1420280527');
INSERT INTO `rnd_variety_info` VALUES ('12', '0', '2', '3', '3', 'V0003', 'V0003', '2', 'SoftBD Ltd.', '11', '7', null, '1', '1', 'UI-000001', '1419828140', 'UI-000001', '1420280895');
INSERT INTO `rnd_variety_info` VALUES ('15', '2', '1', '4', '1', 'V0004', 'V0004', '1', '', '11', '8', null, '1', '1', 'UI-000001', '1419943231', null, null);
INSERT INTO `rnd_variety_info` VALUES ('17', '0', '1', '6', '5', 'V0006', 'C0007-E-17-CKA', '1', '', '11', '9', null, '1', '1', 'UI-000001', '1420288217', null, null);
INSERT INTO `rnd_variety_info` VALUES ('18', '0', '1', '6', '5', 'V0007', 'C0007-E-18-CKA', '1', '', '11', '10', null, '1', '1', 'UI-000001', '1420288227', null, null);
INSERT INTO `rnd_variety_info` VALUES ('19', '2', '1', '6', '5', 'V0008', 'C0007-E-19-Code2', '3', '', '11', '11', null, '1', '1', 'UI-000001', '1420288345', null, null);
INSERT INTO `rnd_variety_info` VALUES ('21', '2', null, '4', '1', 'v00012', 'B0001-Code11-3-Code2', '3', '', '12', '10', ' Characteristics ', '1', '1', 'UI-000001', '1420719532', null, null);
INSERT INTO `rnd_variety_info` VALUES ('22', '0', null, '3', '3', 'v00011', 'C0001-Code3-2-CKA-15', '1', '', '12', '9', 'sdsdsscscscs', '1', '1', 'UI-000001', '1420720724', null, null);
INSERT INTO `rnd_variety_info` VALUES ('23', '0', null, '6', '5', 'c00013', 'C0007-E-5-CKA-15', '1', '', '34', '11', 'sdsdsd', '1', '1', 'UI-000001', '1420721880', 'UI-000001', '1420880206');
INSERT INTO `rnd_variety_info` VALUES ('24', '0', null, '6', '5', 'v00014', 'C0007-E-6-CKA-15', '1', '', '34', '11', 'wdwdwdw', '1', '1', 'UI-000001', '1420722016', null, null);
INSERT INTO `rnd_variety_info` VALUES ('25', '0', null, '6', '5', 'v89098', 'C0007-E-7-CKA-15', '1', '', '10', '23', 'efefef', '1', '1', 'UI-000001', '1420864510', null, null);
INSERT INTO `rnd_variety_info` VALUES ('26', '0', null, '7', '6', 'v00098', 'T0001-T0001-1-CKA-15', '1', '', '12', '14', 'dsdsdsds', '1', '1', 'UI-000001', '1420875422', null, null);
INSERT INTO `rnd_variety_info` VALUES ('27', '0', null, '3', '7', 'V40004', 'C0001-T40001-3-CKA-15', '1', '', '13', '11', 'Characteristics', '1', '1', 'UI-000001', '1421235373', null, null);

-- ----------------------------
-- Table structure for `rnd_variety_season`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_variety_season`;
CREATE TABLE `rnd_variety_season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variety_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `modified_by` varchar(11) DEFAULT NULL,
  `modification_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_variety_season
-- ----------------------------
INSERT INTO `rnd_variety_season` VALUES ('46', '15', '4', '1', '1', 'UI-000001', '1419943231', null, null);
INSERT INTO `rnd_variety_season` VALUES ('47', '15', '4', '1', '2', 'UI-000001', '1419943231', null, null);
INSERT INTO `rnd_variety_season` VALUES ('48', '15', '4', '1', '3', 'UI-000001', '1419943231', null, null);
INSERT INTO `rnd_variety_season` VALUES ('49', '16', '5', '2', '1', 'UI-000001', '1420004518', null, null);
INSERT INTO `rnd_variety_season` VALUES ('50', '16', '5', '2', '2', 'UI-000001', '1420004518', null, null);
INSERT INTO `rnd_variety_season` VALUES ('51', '16', '5', '2', '3', 'UI-000001', '1420004518', null, null);
INSERT INTO `rnd_variety_season` VALUES ('52', '11', '4', '1', '1', 'UI-000001', '1420280527', null, null);
INSERT INTO `rnd_variety_season` VALUES ('53', '11', '4', '1', '2', 'UI-000001', '1420280527', null, null);
INSERT INTO `rnd_variety_season` VALUES ('54', '12', '3', '3', '1', 'UI-000001', '1420280896', null, null);
INSERT INTO `rnd_variety_season` VALUES ('55', '12', '3', '3', '2', 'UI-000001', '1420280896', null, null);
INSERT INTO `rnd_variety_season` VALUES ('56', '12', '3', '3', '3', 'UI-000001', '1420280896', null, null);
INSERT INTO `rnd_variety_season` VALUES ('57', '17', '6', '5', '1', 'UI-000001', '1420288217', null, null);
INSERT INTO `rnd_variety_season` VALUES ('58', '17', '6', '5', '2', 'UI-000001', '1420288217', null, null);
INSERT INTO `rnd_variety_season` VALUES ('59', '18', '6', '5', '1', 'UI-000001', '1420288227', null, null);
INSERT INTO `rnd_variety_season` VALUES ('60', '18', '6', '5', '2', 'UI-000001', '1420288227', null, null);
INSERT INTO `rnd_variety_season` VALUES ('61', '19', '6', '5', '1', 'UI-000001', '1420288345', null, null);
INSERT INTO `rnd_variety_season` VALUES ('62', '19', '6', '5', '2', 'UI-000001', '1420288345', null, null);
INSERT INTO `rnd_variety_season` VALUES ('63', '20', '6', '5', '2', 'UI-000001', '1420719295', null, null);
INSERT INTO `rnd_variety_season` VALUES ('64', '20', '6', '5', '3', 'UI-000001', '1420719295', null, null);
INSERT INTO `rnd_variety_season` VALUES ('65', '21', '4', '1', '1', 'UI-000001', '1420719532', null, null);
INSERT INTO `rnd_variety_season` VALUES ('66', '21', '4', '1', '2', 'UI-000001', '1420719532', null, null);
INSERT INTO `rnd_variety_season` VALUES ('67', '22', '3', '3', '2', 'UI-000001', '1420720724', null, null);
INSERT INTO `rnd_variety_season` VALUES ('68', '22', '3', '3', '5', 'UI-000001', '1420720724', null, null);
INSERT INTO `rnd_variety_season` VALUES ('71', '24', '6', '5', '2', 'UI-000001', '1420722016', null, null);
INSERT INTO `rnd_variety_season` VALUES ('72', '24', '6', '5', '5', 'UI-000001', '1420722016', null, null);
INSERT INTO `rnd_variety_season` VALUES ('73', '25', '6', '5', '1', 'UI-000001', '1420864510', null, null);
INSERT INTO `rnd_variety_season` VALUES ('74', '26', '7', '6', '5', 'UI-000001', '1420875422', null, null);
INSERT INTO `rnd_variety_season` VALUES ('83', '10', '4', '1', '1', 'UI-000001', '1420877811', null, null);
INSERT INTO `rnd_variety_season` VALUES ('84', '10', '4', '1', '3', 'UI-000001', '1420877811', null, null);
INSERT INTO `rnd_variety_season` VALUES ('87', '23', '0', '0', '3', 'UI-000001', '1420880206', null, null);
INSERT INTO `rnd_variety_season` VALUES ('88', '23', '0', '0', '5', 'UI-000001', '1420880206', null, null);
INSERT INTO `rnd_variety_season` VALUES ('89', '27', '3', '7', '4', 'UI-000001', '1421235373', null, null);
INSERT INTO `rnd_variety_season` VALUES ('90', '27', '3', '7', '5', 'UI-000001', '1421235373', null, null);

-- ----------------------------
-- Table structure for `rnd_year`
-- ----------------------------
DROP TABLE IF EXISTS `rnd_year`;
CREATE TABLE `rnd_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rnd_year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rnd_year
-- ----------------------------
INSERT INTO `rnd_year` VALUES ('1', '2014');
INSERT INTO `rnd_year` VALUES ('2', '2015');
INSERT INTO `rnd_year` VALUES ('3', '2016');
INSERT INTO `rnd_year` VALUES ('4', '2017');
INSERT INTO `rnd_year` VALUES ('5', '2018');
INSERT INTO `rnd_year` VALUES ('6', '2019');
INSERT INTO `rnd_year` VALUES ('7', '2020');
