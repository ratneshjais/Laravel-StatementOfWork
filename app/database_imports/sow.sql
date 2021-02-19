
--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Onshore', NULL, NULL, NULL),
(2, 'Offshore', NULL, NULL, NULL),
(3, 'Both', NULL, NULL, NULL);

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `type`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'customer', 'Graham Fisher', NULL, NULL, NULL),
(2, 'customer', 'Sim Suri Maun', NULL, NULL, NULL),
(3, 'customer', 'Alison Donelan', NULL, NULL, NULL),
(4, 'customer', 'Tony Simmonds', NULL, NULL, NULL),
(5, 'customer', 'Gary Batten', NULL, NULL, NULL),
(6, 'customer', 'Debbie Goulding', NULL, NULL, NULL),
(7, 'supplier', 'R. Ashok Kumar', NULL, NULL, NULL),
(8, 'supplier', 'Karan Vig', NULL, NULL, NULL),
(9, 'supplier', 'Harish Kohli', NULL, NULL, NULL),
(10, 'supplier', 'Anjali Satam', NULL, NULL, NULL),
(11, 'supplier', 'Manoranjan Das', NULL, NULL, NULL),
(12, 'supplier', 'Santosh Dalvi', NULL, NULL, NULL),
(13, 'supplier', 'Viki Lingeria', NULL, NULL, NULL);

--
-- Dumping data for table `procuring_parties`
--

INSERT INTO `procuring_parties` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Bupa UK - UKMU', NULL, NULL, NULL),
(2, 'Bupa UK - BGMU', NULL, NULL, NULL),
(3, 'Bupa Australia', NULL, NULL, NULL),
(4, 'Bupa PLC', NULL, NULL, NULL);

--
-- Dumping data for table `project_roles`
--

INSERT INTO `project_roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Developer', NULL, NULL, NULL),
(2, 'Sr. Developer', NULL, NULL, NULL),
(3, 'Tester', NULL, NULL, NULL),
(4, 'Sr. Tester', NULL, NULL, NULL),
(5, 'Test Lead', NULL, NULL, NULL),
(6, 'Sr. Test Lead', NULL, NULL, NULL),
(7, 'Technical Lead', NULL, NULL, NULL),
(8, 'Technical Manager', NULL, NULL, NULL),
(9, 'Solution Designer', NULL, NULL, NULL),
(10, 'Business Analyst', NULL, NULL, NULL),
(11, 'Sr. Business Analyst', NULL, NULL, NULL),
(12, 'Scrum Master', NULL, NULL, NULL),
(13, 'Scrum of Scrum Master', NULL, NULL, NULL);

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'T&M', NULL, NULL, NULL),
(2, 'FR', NULL, NULL, NULL),
(3, 'FP', NULL, NULL, NULL),
(4, 'Others', NULL, NULL, NULL);

--
-- Dumping data for table `project_skills`
--

INSERT INTO `project_skills` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '.Net', NULL, NULL, NULL),
(2, 'JAVA', NULL, NULL, NULL),
(3, 'PHP', NULL, NULL, NULL),
(4, 'JavaScript/jQuery', NULL, NULL, NULL),
(5, 'Version Control/Git', NULL, NULL, NULL),
(6, 'HTML/CSS', NULL, NULL, NULL),
(7, 'Responsive Design.', NULL, NULL, NULL),
(8, 'Testing/Debugging', NULL, NULL, NULL),
(9, 'Automation Tools/Web Perf', NULL, NULL, NULL),
(10, 'Manage team ', NULL, NULL, NULL),
(11, 'BRD creation', NULL, NULL, NULL),
(12, 'Facilitate meetings', NULL, NULL, NULL),
(13, 'Conflict resolutions', NULL, NULL, NULL),
(14, 'Facilitate meetings', NULL, NULL, NULL),
(15, 'Communication', NULL, NULL, NULL),
(16, 'Technical Understanding', NULL, NULL, NULL),
(17, 'Client Management', NULL, NULL, NULL),
(18, 'Business Operations', NULL, NULL, NULL),
(19, 'Manual testing ', NULL, NULL, NULL);



--
-- Dumping data for table `role_has_skills`
--

INSERT INTO `role_has_skills` (`role_id`, `skill_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL),
(1, 2, NULL, NULL, NULL),
(1, 3, NULL, NULL, NULL),
(1, 4, NULL, NULL, NULL),
(1, 5, NULL, NULL, NULL),
(1, 6, NULL, NULL, NULL),
(1, 7, NULL, NULL, NULL),
(2, 4, NULL, NULL, NULL),
(2, 5, NULL, NULL, NULL),
(2, 6, NULL, NULL, NULL),
(2, 7, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL),
(3, 5, NULL, NULL, NULL),
(3, 8, NULL, NULL, NULL),
(3, 19, NULL, NULL, NULL),
(4, 2, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL),
(4, 5, NULL, NULL, NULL),
(4, 8, NULL, NULL, NULL),
(4, 9, NULL, NULL, NULL),
(4, 19, NULL, NULL, NULL),
(5, 2, NULL, NULL, NULL),
(5, 4, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL),
(5, 8, NULL, NULL, NULL),
(5, 9, NULL, NULL, NULL),
(5, 19, NULL, NULL, NULL),
(6, 2, NULL, NULL, NULL),
(6, 4, NULL, NULL, NULL),
(6, 5, NULL, NULL, NULL),
(6, 8, NULL, NULL, NULL),
(6, 9, NULL, NULL, NULL),
(6, 19, NULL, NULL, NULL),
(7, 4, NULL, NULL, NULL),
(7, 5, NULL, NULL, NULL),
(7, 6, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL),
(7, 9, NULL, NULL, NULL),
(8, 10, NULL, NULL, NULL),
(11, 15, NULL, NULL, NULL),
(11, 16, NULL, NULL, NULL),
(11, 17, NULL, NULL, NULL),
(11, 18, NULL, NULL, NULL),
(12, 12, NULL, NULL, NULL),
(12, 13, NULL, NULL, NULL),
(12, 14, NULL, NULL, NULL),
(12, 15, NULL, NULL, NULL),
(12, 16, NULL, NULL, NULL),
(13, 12, NULL, NULL, NULL),
(13, 13, NULL, NULL, NULL),
(13, 14, NULL, NULL, NULL),
(13, 15, NULL, NULL, NULL),
(13, 16, NULL, NULL, NULL);


--
-- Dumping data for table `sow_master`
--

INSERT INTO `sow_master` (`id`, `project_type_id`, `name`, `content`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'header_desc', '<p>This Statement of Work (the &ldquo;<strong>SOW</strong>&rdquo;) is entered into as of 4<sup>th</sup> December 2018 (the &ldquo;<strong>Effective Date</strong>&rdquo;), between Datamatics Global Services Limited (&ldquo;<strong>Supplier</strong>&rdquo;), whose registered office is at Knowledge Centre, Plot 58, Street No. 17, MIDC, Andheri (East), Mumbai 400093, and BUPA Insurance Services Limited&nbsp; a company registered in&nbsp; England and Wales under company number 03829851 and whose registered office (effective from 11 December 2017) is 1 Angel Court London EC2R 7HJ (&ldquo;<strong>Customer</strong>&rdquo;) (together the &ldquo;<strong>Parties</strong>&rdquo;).</p>\r\n<p>The SOW is entered into pursuant to and shall be governed by the IT Services Framework Agreement signed on, 24<sup>th</sup> November 2017, effective from 21<sup>st</sup> July 2016, between the Parties (the &ldquo;<strong>Agreement</strong>&rdquo;).</p>\r\n<p>Supplier agrees to the following in respect of the Services to be provided under this SOW:</p>\r\n<ol>\r\n<li>Supplier shall ensure that all Supplier Personnel shall sign and adhere to Customer&rsquo;s confidentiality agreement; and</li>\r\n<li>Supplier shall adhere, and shall procure that all of its resources shall adhere, to applicable Customer IT and security policies and standards including Customer&rsquo;s Corporate Information Security Policy and the Customer Group IS Security Policy &amp; Rules.</li>\r\n</ol>\r\n<p>&nbsp;</p>', NULL, NULL, NULL),
(2, 1, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Test/Development activities.</li>\r\n<li>Customer shall arrange to provide access only to support Development / Test servers</li>\r\n<li>Skype for business</li>\r\n<li>Customer shall arrange to provide the necessary data for Development/Test purposes and these are deemed as Development/Test Data only and not as Live Data.</li>\r\n</ul>', NULL, NULL, NULL),
(4, 1, 'infra_supp', '<p>Following infrastructure requirements for the teams located at offshore -</p>\r\n<ol type=\"a\">\r\n<li>GDSC standard machine with Windows Professional</li>\r\n<li>MS Office 2016 Standard</li>\r\n</ol>', NULL, NULL, NULL),
(6, 1, 'work_days', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>', NULL, NULL, NULL),
(8, 1, 'work_allocation', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>', NULL, NULL, NULL),
(10, 1, 'progress_reporting', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>', NULL, NULL, NULL),
(12, 1, 'acceptance_criteria', '<p>Meeting &ldquo;Done&rdquo; Criteria for every sprint.</p>', NULL, NULL, NULL),
(13, 1, 'slas_agreed', '<p>Not Applicable</p>', NULL, NULL, NULL),
(15, 1, 'change_control', '<p>Not Applicable</p>', NULL, NULL, NULL),
(17, 1, 'risk_mitigation_plans', 'Not Applicable', NULL, NULL, NULL),
(19, 1, 'extension', '<ul>\r\n<li>Customer may extend the SOW Term via the change management process for additional periods of Three (3) months’ with an advance notice of 30-days to the expiry of the SOW term.</li>\r\n<li>If Customer does not extend the SOW term in accordance with above, the SOW term will be extended by rolling periods of Thirty (30) days until such time as Customer requests an extension in accordance with the above or notifies Supplier in writing that the SOW will expire upon the expiry of the then current thirty (30) day rolling period</li>\r\n</ul>', NULL, NULL, NULL),
(21, 1, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance. </p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as an “expended day” on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate.</p>', NULL, NULL, NULL),
(23, 1, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>', NULL, NULL, NULL),
(25, 1, 'overtime_working', '<p>Overtime shall be undertaken with prior approval from CUSTOMER Manager. It will be charged based on factored rate as per below table calculated on the Per Person Day Rate.</p>\r\n<p>Offshore – GBP 25; Onshore – GBP 50</p>\r\n<table style=\"width: 589px;\">\r\n<tbody>\r\n<tr style=\"height: 46px;\">\r\n<td style=\"width: 121px; height: 46px;\">\r\n<p>Detail</p>\r\n</td>\r\n<td style=\"width: 84px; height: 46px;\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td style=\"width: 366px; height: 46px;\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 46px;\">\r\n<td style=\"width: 121px; height: 46px;\">\r\n<p>Weekday</p>\r\n</td>\r\n<td style=\"width: 84px; height: 46px;\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 46px;\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 89px;\">\r\n<td style=\"width: 121px; height: 89px;\">\r\n<p>Saturday</p>\r\n</td>\r\n<td style=\"width: 84px; height: 89px;\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 89px;\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 101px;\">\r\n<td style=\"width: 121px; height: 101px;\">\r\n<p>Sunday, Holiday & any Overnight working</p>\r\n</td>\r\n<td style=\"width: 84px; height: 101px;\">\r\n<p>2 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 101px;\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(27, 1, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears based on the Innate attendance in line with the MSA</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>', NULL, NULL, NULL),
(29, 1, 'out_pocket_travel_exp', '<ul>\r\n<li>Travel expenses for any Local travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any such travel & stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel & stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>', NULL, NULL, NULL),
(31, 1, 'trans_back_arr', '<p>Standard Terms and Conditions apply.</p>', NULL, NULL, NULL),
(33, 1, 'data_protection', '<p>The terms & conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>', NULL, NULL, NULL),
(43, 1, 'party_cntlr', '<p>Bupa Insurance Services Limited</p>', NULL, NULL, NULL),
(44, 1, 'party_proc', '<p>Datamatics Global Services Limited</p>', NULL, NULL, NULL),
(45, 1, 'proc_duration', '<p>Term of Statement of Work</p>', NULL, NULL, NULL),
(46, 1, 'proc_nature', '<p>The supplier does not process any customer data under the SOW’s named in this Annexure</p>', NULL, NULL, NULL),
(47, 2, 'risk_mitigation_plans', 'Not Applicable', NULL, NULL, NULL),
(49, 2, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Testing activities.</li>\r\n<li>Customer shall arrange to provide access only to Development / Test servers</li>\r\n<li>Customer shall arrange to provide the necessary data for test purposes and these are deemed as Test Data only and not as Live Data.</li>\r\n</ul>', NULL, NULL, NULL),
(50, 2, 'infra_supp', '<ul>\r\n<li>Following infrastructure will be provided by SUPPLIER for the Developer located at offshore in SUPPLIER offices-</li>\r\n</ul>\r\n<ol>\r\n<li>GDSC standard machine with Windows 7 Operating System</li>\r\n<li>MS Office 2016 Standard Edition</li>\r\n</ol>\r\n<p>To support the development, SUPPLIER shall provide the following licenses for use:</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"223\">\r\n<p><strong>Role of Team Member</strong></p>\r\n</td>\r\n<td width=\"296\">\r\n<p><strong>License proposed to be provided offshore</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"223\">\r\n<p> </p>\r\n</td>\r\n<td width=\"296\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(51, 2, 'work_days', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>', NULL, NULL, NULL),
(52, 2, 'work_allocation', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>', NULL, NULL, NULL),
(53, 2, 'progress_reporting', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>', NULL, NULL, NULL),
(54, 2, 'slas_agreed', '<p>None</p>', NULL, NULL, NULL),
(55, 2, 'change_control', '<p>All change controls shall be only in writing. No change shall be made in any reduction of the team size. Team composition may be changed, if required, within the same level of resources.</p>', NULL, NULL, NULL),
(57, 2, 'extension', '<p>CUSTOMER may exercise in writing any Change Request, as required, based on mutually agreed price and other Terms and Conditions.</p>', NULL, NULL, NULL),
(58, 2, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance. </p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as a “expended day” on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate. </p>', NULL, NULL, NULL),
(59, 2, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>', NULL, NULL, NULL),
(60, 2, 'overtime_working', '<p>All overtime shall be undertaken with prior approval from Bupa Manager.</p>\r\n<p>Standard Per hour rate to be considered for Overtime –</p>\r\n<p>Offshore – GBP 25; Onshore – GBP 50</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Detail</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Weekday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Saturday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Sunday, Holiday & any Overnight working</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>2 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(61, 2, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>', NULL, NULL, NULL),
(62, 2, 'out_pocket_travel_exp', '<ul>\r\n<li>Travel expenses for any travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any travel & stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel &  stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>', NULL, NULL, NULL),
(63, 2, 'trans_back_arr', '<p>Standard Terms and Conditions apply.</p>', NULL, NULL, NULL),
(64, 2, 'data_protection', '<p>The terms & conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>', NULL, NULL, NULL),
(65, 2, 'party_cntlr', '<p>Bupa Insurance Services Limited</p>', NULL, NULL, NULL),
(66, 2, 'party_proc', '<p>Datamatics Global Services Limited</p>', NULL, NULL, NULL),
(67, 2, 'proc_duration', '<p>Term of Statement of Work</p>', NULL, NULL, NULL),
(68, 2, 'proc_nature', '<p>The supplier does not process any customer data under the SOW’s named in this Annexure</p>', NULL, NULL, NULL),
(71, 2, 'header_desc', '<p>This Statement of Work (the &ldquo;<strong>SOW</strong>&rdquo;) is entered into as of 4<sup>th</sup> December 2018 (the &ldquo;<strong>Effective Date</strong>&rdquo;), between Datamatics Global Services Limited (&ldquo;<strong>Supplier</strong>&rdquo;), whose registered office is at Knowledge Centre, Plot 58, Street No. 17, MIDC, Andheri (East), Mumbai 400093, and BUPA Insurance Services Limited&nbsp; a company registered in&nbsp; England and Wales under company number 03829851 and whose registered office (effective from 11 December 2017) is 1 Angel Court London EC2R 7HJ (&ldquo;<strong>Customer</strong>&rdquo;) (together the &ldquo;<strong>Parties</strong>&rdquo;).</p>\r\n<p>The SOW is entered into pursuant to and shall be governed by the IT Services Framework Agreement signed on, 24<sup>th</sup> November 2017, effective from 21<sup>st</sup> July 2016, between the Parties (the &ldquo;<strong>Agreement</strong>&rdquo;).</p>\r\n<p>Supplier agrees to the following in respect of the Services to be provided under this SOW:</p>\r\n<ol>\r\n<li>Supplier shall ensure that all Supplier Personnel shall sign and adhere to Customer&rsquo;s confidentiality agreement; and</li>\r\n<li>Supplier shall adhere, and shall procure that all of its resources shall adhere, to applicable Customer IT and security policies and standards including Customer&rsquo;s Corporate Information Security Policy and the Customer Group IS Security Policy &amp; Rules.</li>\r\n</ol>\r\n<p>&nbsp;</p>', NULL, NULL, NULL),
(72, 2, 'acceptance_criteria', '', NULL, NULL, NULL),
(3, 3, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Testing activities.</li>\r\n<li>Customer shall arrange to provide access only to Development / Test servers</li>\r\n<li>Customer shall arrange to provide the necessary data for test purposes and these are deemed as Test Data only and not as Live Data.</li>\r\n</ul>', NULL, NULL, NULL),
(5, 3, 'infra_supp', '<ul>\r\n<li>Following infrastructure will be provided by SUPPLIER for the Developer located at offshore in SUPPLIER offices-</li>\r\n</ul>\r\n<ol>\r\n<li>GDSC standard machine with Windows 7 Operating System</li>\r\n<li>MS Office 2016 Standard Edition</li>\r\n</ol>\r\n<p>To support the development, SUPPLIER shall provide the following licenses for use:</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"223\">\r\n<p><strong>Role of Team Member</strong></p>\r\n</td>\r\n<td width=\"296\">\r\n<p><strong>License proposed to be provided offshore</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"223\">\r\n<p> </p>\r\n</td>\r\n<td width=\"296\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(7, 3, 'work_days', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>', NULL, NULL, NULL),
(9, 3, 'work_allocation', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>', NULL, NULL, NULL),
(11, 3, 'progress_reporting', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>', NULL, NULL, NULL),
(14, 3, 'slas_agreed', '<p>None</p>', NULL, NULL, NULL),
(16, 3, 'change_control', '<p>All change controls shall be only in writing. No change shall be made in any reduction of the team size. Team composition may be changed, if required, within the same level of resources.</p>', NULL, NULL, NULL),
(18, 3, 'risk_mitigation_plans', 'NIL', NULL, NULL, NULL),
(20, 3, 'extension', '<p>CUSTOMER may exercise in writing any Change Request, as required, based on mutually agreed price and other Terms and Conditions.</p>', NULL, NULL, NULL),
(22, 3, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance. </p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as a “expended day” on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate. </p>', NULL, NULL, NULL),
(24, 3, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>', NULL, NULL, NULL),
(26, 3, 'overtime_working', '<p>All overtime shall be undertaken with prior approval from Bupa Manager.</p>\r\n<p>Standard Per hour rate to be considered for Overtime –</p>\r\n<p>Offshore – GBP 25; Onshore – GBP 50</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Detail</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Weekday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Saturday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Sunday, Holiday & any Overnight working</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>2 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(28, 3, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>', NULL, NULL, NULL),
(30, 3, 'out_pocket_travel_exp', '<ul>\r\n<li>Travel expenses for any travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any travel & stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel & stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>', NULL, NULL, NULL),
(32, 3, 'trans_back_arr', '<p>Standard Terms and Conditions apply.</p>', NULL, NULL, NULL),
(34, 3, 'data_protection', '<p>The terms & conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>', NULL, NULL, NULL),
(35, 3, 'party_cntlr', '<p>Bupa Insurance Services Limited</p>', NULL, NULL, NULL),
(36, 3, 'party_proc', '<p>Datamatics Global Services Limited</p>', NULL, NULL, NULL),
(37, 3, 'proc_duration', '<p>Term of Statement of Work</p>', NULL, NULL, NULL),
(38, 3, 'proc_nature', '<p>The supplier does not process any customer data under the SOW’s named in this Annexure</p>', NULL, NULL, NULL),
(41, 3, 'header_desc', '<p>This Statement of Work (the &ldquo;<strong>SOW</strong>&rdquo;) is entered into as of 4<sup>th</sup> December 2018 (the &ldquo;<strong>Effective Date</strong>&rdquo;), between Datamatics Global Services Limited (&ldquo;<strong>Supplier</strong>&rdquo;), whose registered office is at Knowledge Centre, Plot 58, Street No. 17, MIDC, Andheri (East), Mumbai 400093, and BUPA Insurance Services Limited&nbsp; a company registered in&nbsp; England and Wales under company number 03829851 and whose registered office (effective from 11 December 2017) is 1 Angel Court London EC2R 7HJ (&ldquo;<strong>Customer</strong>&rdquo;) (together the &ldquo;<strong>Parties</strong>&rdquo;).</p>\r\n<p>The SOW is entered into pursuant to and shall be governed by the IT Services Framework Agreement signed on, 24<sup>th</sup> November 2017, effective from 21<sup>st</sup> July 2016, between the Parties (the &ldquo;<strong>Agreement</strong>&rdquo;).</p>\r\n<p>Supplier agrees to the following in respect of the Services to be provided under this SOW:</p>\r\n<ol>\r\n<li>Supplier shall ensure that all Supplier Personnel shall sign and adhere to Customer&rsquo;s confidentiality agreement; and</li>\r\n<li>Supplier shall adhere, and shall procure that all of its resources shall adhere, to applicable Customer IT and security policies and standards including Customer&rsquo;s Corporate Information Security Policy and the Customer Group IS Security Policy &amp; Rules.</li>\r\n</ol>\r\n<p>&nbsp;</p>', NULL, NULL, NULL),
(42, 3, 'acceptance_criteria', '', NULL, NULL, NULL),
(48, 4, 'risk_mitigation_plans', 'Not Applicable', NULL, NULL, NULL),
(73, 4, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Testing activities.</li>\r\n<li>Customer shall arrange to provide access only to Development / Test servers</li>\r\n<li>Customer shall arrange to provide the necessary data for test purposes and these are deemed as Test Data only and not as Live Data.</li>\r\n</ul>', NULL, NULL, NULL),
(74, 4, 'infra_supp', '<ul>\r\n<li>Following infrastructure will be provided by SUPPLIER for the Developer located at offshore in SUPPLIER offices-</li>\r\n</ul>\r\n<ol>\r\n<li>GDSC standard machine with Windows 7 Operating System</li>\r\n<li>MS Office 2016 Standard Edition</li>\r\n</ol>\r\n<p>To support the development, SUPPLIER shall provide the following licenses for use:</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"223\">\r\n<p><strong>Role of Team Member</strong></p>\r\n</td>\r\n<td width=\"296\">\r\n<p><strong>License proposed to be provided offshore</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"223\">\r\n<p> </p>\r\n</td>\r\n<td width=\"296\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(75, 4, 'work_days', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>', NULL, NULL, NULL),
(76, 4, 'work_allocation', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>', NULL, NULL, NULL),
(77, 4, 'progress_reporting', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>', NULL, NULL, NULL),
(78, 4, 'slas_agreed', '<p>None</p>', NULL, NULL, NULL),
(79, 4, 'change_control', '<p>All change controls shall be only in writing. No change shall be made in any reduction of the team size. Team composition may be changed, if required, within the same level of resources.</p>', NULL, NULL, NULL),
(80, 4, 'extension', '<p>CUSTOMER may exercise in writing any Change Request, as required, based on mutually agreed price and other Terms and Conditions.</p>', NULL, NULL, NULL),
(81, 4, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance. </p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as a “expended day” on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate. </p>', NULL, NULL, NULL),
(82, 4, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>', NULL, NULL, NULL),
(83, 4, 'overtime_working', '<p>All overtime shall be undertaken with prior approval from Bupa Manager.</p>\r\n<p>Standard Per hour rate to be considered for Overtime –</p>\r\n<p>Offshore – GBP 25; Onshore – GBP 50</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Detail</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Weekday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Saturday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Sunday, Holiday & any Overnight working</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>2 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours –</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL),
(84, 4, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>', NULL, NULL, NULL),
(85, 4, 'out_pocket_travel_exp', '<ul>\r\n<li>Travel expenses for any travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any travel & stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel & stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>', NULL, NULL, NULL),
(86, 4, 'trans_back_arr', '<p>Standard Terms and Conditions apply.</p>', NULL, NULL, NULL),
(87, 4, 'data_protection', '<p>The terms & conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>', NULL, NULL, NULL),
(88, 4, 'party_cntlr', '<p>Bupa Insurance Services Limited</p>', NULL, NULL, NULL),
(89, 4, 'party_proc', '<p>Datamatics Global Services Limited</p>', NULL, NULL, NULL),
(90, 4, 'proc_duration', '<p>Term of Statement of Work</p>', NULL, NULL, NULL),
(91, 4, 'proc_nature', '<p>The supplier does not process any customer data under the SOW’s named in this Annexure</p>', NULL, NULL, NULL),
(94, 4, 'header_desc', '<p>This Statement of Work (the &ldquo;<strong>SOW</strong>&rdquo;) is entered into as of 4<sup>th</sup> December 2018 (the &ldquo;<strong>Effective Date</strong>&rdquo;), between Datamatics Global Services Limited (&ldquo;<strong>Supplier</strong>&rdquo;), whose registered office is at Knowledge Centre, Plot 58, Street No. 17, MIDC, Andheri (East), Mumbai 400093, and BUPA Insurance Services Limited&nbsp; a company registered in&nbsp; England and Wales under company number 03829851 and whose registered office (effective from 11 December 2017) is 1 Angel Court London EC2R 7HJ (&ldquo;<strong>Customer</strong>&rdquo;) (together the &ldquo;<strong>Parties</strong>&rdquo;).</p>\r\n<p>The SOW is entered into pursuant to and shall be governed by the IT Services Framework Agreement signed on, 24<sup>th</sup> November 2017, effective from 21<sup>st</sup> July 2016, between the Parties (the &ldquo;<strong>Agreement</strong>&rdquo;).</p>\r\n<p>Supplier agrees to the following in respect of the Services to be provided under this SOW:</p>\r\n<ol>\r\n<li>Supplier shall ensure that all Supplier Personnel shall sign and adhere to Customer&rsquo;s confidentiality agreement; and</li>\r\n<li>Supplier shall adhere, and shall procure that all of its resources shall adhere, to applicable Customer IT and security policies and standards including Customer&rsquo;s Corporate Information Security Policy and the Customer Group IS Security Policy &amp; Rules.</li>\r\n</ol>\r\n<p>&nbsp;</p>', NULL, NULL, NULL),
(95, 4, 'acceptance_criteria', '', NULL, NULL, NULL);

COMMIT;

--
-- Database: `sow`
--

--
-- Dumping data for table `annexure_attributes`
--


INSERT INTO `annexure_attributes` (`id`, `project_type_id`, `type`, `content`, `control_type`, `list_order`, `default_value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'subject categories', 'Our People (Bupa prospective employees, current employees and/or those who have left the business)', 'checkbox', 1, 0, NULL, NULL, NULL),
(2, 1, 'subject categories', 'Insurance Customers (Bupa prospective and current individual and corporate insurance customers, family of customers (including children) and lapsed customers', 'checkbox', 2, 0, NULL, NULL, NULL),
(3, 1, 'subject categories', 'Health, Care and Dental Customers (Bupa prospective and current customers (including children) and/or lapsed)', 'checkbox', 3, 0, NULL, NULL, NULL),
(4, 1, 'subject categories', 'Other (including past, present and prospective advisors, brokers, consultants, correspondents)', 'checkbox', 4, 0, NULL, NULL, NULL),
(5, 1, 'personal data', 'Contact Details (e.g. contact details, name, email address, job titles, work history)', 'checkbox', 1, 0, NULL, NULL, NULL),
(6, 1, 'personal data', 'Financial (e.g. payment card data, bank account details)', 'checkbox', 2, 0, NULL, NULL, NULL),
(7, 1, 'personal data', 'Demographic (e.g. age, date of birth, gender, income brackets)', 'checkbox', 3, 0, NULL, NULL, NULL),
(8, 1, 'personal data', 'Employment and Pension (e.g. employment details, performance, references, disciplinary, pension information)', 'checkbox', 4, 0, NULL, NULL, NULL),
(9, 1, 'personal data', 'Online Identifiers (e.g. IP addresses, cookies, email information, location data)', 'checkbox', 5, 0, NULL, NULL, NULL),
(10, 1, 'personal data', 'Other - please list: ', 'text', 6, 0, NULL, NULL, NULL),
(11, 1, 'special categories', 'Racial or Ethnic Origin ', 'checkbox', 1, 0, NULL, NULL, NULL),
(12, 1, 'special categories', 'Political Opinions, Religious or Philosophical Beliefs', 'checkbox', 2, 0, NULL, NULL, NULL),
(13, 1, 'special categories', 'Trade Union Membership', 'checkbox', 3, 0, NULL, NULL, NULL),
(14, 1, 'special categories', 'Genetic Data, Biometric Data', 'checkbox', 4, 0, NULL, NULL, NULL),
(15, 1, 'special categories', 'Health Data', 'checkbox', 5, 0, NULL, NULL, NULL),
(16, 1, 'special categories', 'Sex Life or Sexual Orientation', 'checkbox', 6, 0, NULL, NULL, NULL),
(17, 1, 'special categories', 'Criminal Convictions and Offences', 'checkbox', 7, 0, NULL, NULL, NULL),
(18, 1, 'other', 'No live & personal data is accessed or processed as part of the projects in this SOW', 'checkbox', 8, 0, NULL, NULL, NULL),
(19, 3, 'subject categories', 'Our People (Bupa prospective employees, current employees and/or those who have left the business)', 'checkbox', 1, 0, NULL, NULL, NULL),
(20, 3, 'subject categories', 'Insurance Customers (Bupa prospective and current individual and corporate insurance customers, family of customers (including children) and lapsed customers', 'checkbox', 2, 0, NULL, NULL, NULL),
(21, 3, 'subject categories', 'Health, Care and Dental Customers (Bupa prospective and current customers (including children) and/or lapsed)', 'checkbox', 3, 0, NULL, NULL, NULL),
(22, 3, 'subject categories', 'Other (including past, present and prospective advisors, brokers, consultants, correspondents)', 'checkbox', 4, 0, NULL, NULL, NULL),
(23, 3, 'personal data', 'Contact Details (e.g. contact details, name, email address, job titles, work history)', 'checkbox', 1, 0, NULL, NULL, NULL),
(24, 3, 'personal data', 'Financial (e.g. payment card data, bank account details)', 'checkbox', 2, 0, NULL, NULL, NULL),
(25, 3, 'personal data', 'Demographic (e.g. age, date of birth, gender, income brackets)', 'checkbox', 3, 0, NULL, NULL, NULL),
(26, 3, 'personal data', 'Employment and Pension (e.g. employment details, performance, references, disciplinary, pension information)', 'checkbox', 4, 0, NULL, NULL, NULL),
(27, 3, 'personal data', 'Online Identifiers (e.g. IP addresses, cookies, email information, location data)', 'checkbox', 5, 0, NULL, NULL, NULL),
(28, 3, 'personal data', 'Other - please list: ', 'text', 6, 0, NULL, NULL, NULL),
(29, 3, 'special categories', 'Racial or Ethnic Origin ', 'checkbox', 1, 0, NULL, NULL, NULL),
(30, 3, 'special categories', 'Political Opinions, Religious or Philosophical Beliefs', 'checkbox', 2, 0, NULL, NULL, NULL),
(31, 3, 'special categories', 'Trade Union Membership', 'checkbox', 3, 0, NULL, NULL, NULL),
(32, 3, 'special categories', 'Genetic Data, Biometric Data', 'checkbox', 4, 0, NULL, NULL, NULL),
(33, 3, 'special categories', 'Health Data', 'checkbox', 5, 0, NULL, NULL, NULL),
(34, 3, 'special categories', 'Sex Life or Sexual Orientation', 'checkbox', 6, 0, NULL, NULL, NULL),
(35, 3, 'special categories', 'Criminal Convictions and Offences', 'checkbox', 7, 0, NULL, NULL, NULL),
(36, 3, 'other', 'No live & personal data is accessed or processed as part of the projects in this SOW', 'checkbox', 8, 0, NULL, NULL, NULL),
(37, 2, 'subject categories', 'Our People (Bupa prospective employees, current employees and/or those who have left the business)', 'checkbox', 1, 0, NULL, NULL, NULL),
(38, 2, 'subject categories', 'Insurance Customers (Bupa prospective and current individual and corporate insurance customers, family of customers (including children) and lapsed customers', 'checkbox', 2, 0, NULL, NULL, NULL),
(39, 2, 'subject categories', 'Health, Care and Dental Customers (Bupa prospective and current customers (including children) and/or lapsed)', 'checkbox', 3, 0, NULL, NULL, NULL),
(40, 2, 'subject categories', 'Other (including past, present and prospective advisors, brokers, consultants, correspondents)', 'checkbox', 4, 0, NULL, NULL, NULL),
(41, 2, 'personal data', 'Contact Details (e.g. contact details, name, email address, job titles, work history)', 'checkbox', 1, 0, NULL, NULL, NULL),
(42, 2, 'personal data', 'Financial (e.g. payment card data, bank account details)', 'checkbox', 2, 0, NULL, NULL, NULL),
(43, 2, 'personal data', 'Demographic (e.g. age, date of birth, gender, income brackets)', 'checkbox', 3, 0, NULL, NULL, NULL),
(44, 2, 'personal data', 'Employment and Pension (e.g. employment details, performance, references, disciplinary, pension information)', 'checkbox', 4, 0, NULL, NULL, NULL),
(45, 2, 'personal data', 'Online Identifiers (e.g. IP addresses, cookies, email information, location data)', 'checkbox', 5, 0, NULL, NULL, NULL),
(46, 2, 'personal data', 'Other - please list: ', 'text', 6, 0, NULL, NULL, NULL),
(47, 2, 'special categories', 'Racial or Ethnic Origin ', 'checkbox', 1, 0, NULL, NULL, NULL),
(48, 2, 'special categories', 'Political Opinions, Religious or Philosophical Beliefs', 'checkbox', 2, 0, NULL, NULL, NULL),
(49, 2, 'special categories', 'Trade Union Membership', 'checkbox', 3, 0, NULL, NULL, NULL),
(50, 2, 'special categories', 'Genetic Data, Biometric Data', 'checkbox', 4, 0, NULL, NULL, NULL),
(51, 2, 'special categories', 'Health Data', 'checkbox', 5, 0, NULL, NULL, NULL),
(52, 2, 'special categories', 'Sex Life or Sexual Orientation', 'checkbox', 6, 0, NULL, NULL, NULL),
(53, 2, 'special categories', 'Criminal Convictions and Offences', 'checkbox', 7, 0, NULL, NULL, NULL),
(54, 2, 'other', 'No live & personal data is accessed or processed as part of the projects in this SOW', 'checkbox', 8, 0, NULL, NULL, NULL),
(55, 4, 'subject categories', 'Our People (Bupa prospective employees, current employees and/or those who have left the business)', 'checkbox', 1, 0, NULL, NULL, NULL),
(56, 4, 'subject categories', 'Insurance Customers (Bupa prospective and current individual and corporate insurance customers, family of customers (including children) and lapsed customers', 'checkbox', 2, 0, NULL, NULL, NULL),
(57, 4, 'subject categories', 'Health, Care and Dental Customers (Bupa prospective and current customers (including children) and/or lapsed)', 'checkbox', 3, 0, NULL, NULL, NULL),
(58, 4, 'subject categories', 'Other (including past, present and prospective advisors, brokers, consultants, correspondents)', 'checkbox', 4, 0, NULL, NULL, NULL),
(59, 4, 'personal data', 'Contact Details (e.g. contact details, name, email address, job titles, work history)', 'checkbox', 1, 0, NULL, NULL, NULL),
(60, 4, 'personal data', 'Financial (e.g. payment card data, bank account details)', 'checkbox', 2, 0, NULL, NULL, NULL),
(61, 4, 'personal data', 'Demographic (e.g. age, date of birth, gender, income brackets)', 'checkbox', 3, 0, NULL, NULL, NULL),
(62, 4, 'personal data', 'Employment and Pension (e.g. employment details, performance, references, disciplinary, pension information)', 'checkbox', 4, 0, NULL, NULL, NULL),
(63, 4, 'personal data', 'Online Identifiers (e.g. IP addresses, cookies, email information, location data)', 'checkbox', 5, 0, NULL, NULL, NULL),
(64, 4, 'personal data', 'Other - please list: ', 'text', 6, 0, NULL, NULL, NULL),
(65, 4, 'special categories', 'Racial or Ethnic Origin ', 'checkbox', 1, 0, NULL, NULL, NULL),
(66, 4, 'special categories', 'Political Opinions, Religious or Philosophical Beliefs', 'checkbox', 2, 0, NULL, NULL, NULL),
(67, 4, 'special categories', 'Trade Union Membership', 'checkbox', 3, 0, NULL, NULL, NULL),
(68, 4, 'special categories', 'Genetic Data, Biometric Data', 'checkbox', 4, 0, NULL, NULL, NULL),
(69, 4, 'special categories', 'Health Data', 'checkbox', 5, 0, NULL, NULL, NULL),
(70, 4, 'special categories', 'Sex Life or Sexual Orientation', 'checkbox', 6, 0, NULL, NULL, NULL),
(71, 4, 'special categories', 'Criminal Convictions and Offences', 'checkbox', 7, 0, NULL, NULL, NULL),
(72, 4, 'other', 'No live & personal data is accessed or processed as part of the projects in this SOW', 'checkbox', 8, 0, NULL, NULL, NULL);


INSERT INTO `workflows` (`id`, `project_type_id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '2019-05-17 07:05:45', '2019-05-17 07:05:45'),
(2, 1, 4, 3, '2019-05-17 07:05:57', '2019-05-17 07:05:57'),
(3, 2, 3, 2, '2019-05-17 07:06:16', '2019-05-17 07:06:16'),
(4, 2, 4, 3, '2019-05-17 07:06:23', '2019-05-17 07:06:23');
