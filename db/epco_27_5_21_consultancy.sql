

DROP TABLE IF EXISTS `comm_consultancy_firms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comm_consultancy_firms` (
  `consultancy_name` varchar(200) NOT NULL,
  `contact_name` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `exp_year` varchar(60) NOT NULL,
  `specialization` varchar(200) NOT NULL,
  `tournover_year` float NOT NULL,
  `no_of_core_staff` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `pincode` int(11) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `mobile` int(11) NOT NULL,
  `landline` int(11) NOT NULL,
  `profile_attachment` varchar(200) NOT NULL,
  `work_attachment` varchar(200) NOT NULL,
  `taxcertificate_attachment` varchar(200) NOT NULL,
  `staff_attachment` varchar(200) NOT NULL,
  `balencesheet_attachment` varchar(200) NOT NULL,
  `article_attachment` varchar(200) NOT NULL,
  `terms_condition` tinyint(4) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comm_consultancy_project`
--

DROP TABLE IF EXISTS `comm_consultancy_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comm_consultancy_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultancy_id` int(11) NOT NULL,
  `project_title` varchar(250) NOT NULL,
  `area_of_project` varchar(250) NOT NULL,
  `assignment_details` varchar(250) NOT NULL,
  `name_of_client` varchar(250) NOT NULL,
  `project_cost` float NOT NULL,
  `year_of_execution` varchar(11) NOT NULL,
  `duration_of_project` decimal(10,0) NOT NULL,
  `completion_status` varchar(250) NOT NULL,
  `project_4added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comm_consultancy_reg_department`
--

DROP TABLE IF EXISTS `comm_consultancy_reg_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comm_consultancy_reg_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultancy_id` int(11) NOT NULL,
  `department_name` varchar(64) NOT NULL,
  `no_of_project_reg` varchar(100) NOT NULL,
  `registration_year` year(4) NOT NULL,
  `department_added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `comm_consultancy_reg_department_ibfk_1` FOREIGN KEY (`consultancy_id`) REFERENCES `comm_int_project_monitoring` (`id`),
  CONSTRAINT `comm_consultancy_reg_department_ibfk_2` FOREIGN KEY (`consultancy_id`) REFERENCES `comm_int_project_monitoring` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;