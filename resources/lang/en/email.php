<?php

return [
	'user' => [
		'welcome' => 'Welcome :username to YWS Guarantee Management',
	],
	'orders' => [
		'issued_case' => [
			'subject' => 'Order #:order_number has been created',
			'message1' => 'Thank you for contacting us. We have registered a service order to meet your requirement.',
		],
		'abandoned' => [
			'subject' => 'Order #:order_number has been abandoned',
		],
		'order_created' => [
			'filename' => 'CASE_NO_:order_number.pdf',
			'case_number' => 'Case No :order_number',
			'creation_date' => 'Creation date',
			'authorized_service_center' => 'Authorized Service Center',
			'customer' => 'Customer',
			'address' => 'Address',
			'phone_nro1' => 'Phone No 1',
			'phone_nro2' => 'Phone No 2',
			'email' => 'Email address',
			'brand' => 'Brand',
			'model' => 'Model',
			'serial' => 'Serial No',
			'part_number' => 'Part Number No',
			'failure_reported' => 'Failure reported',
			'important' => 'Importante',
			'footer_case' => 'Dear customer, if the unit does not arrive at our Service Center within the next 15 calendar days, the Case No. will be automatically voided.',
			'important_msg' => 
				'<p>Personal deliveries are not allowed in our Authorized Service Center, every unit must be sent through a courier company of your preference. Please send the unit well protected to avoid issues on the delivery. Please make sure you send only the unit, do not send the box the unit came in when you bought it. Keep in mind that the shipment should be either “regular” or “priority mail”, avoid sending the package as “certified mail” since those cannot be left in a mailbox, which would create a delay in the process.</p>

				<p>Make sure you remove your SIM card and your SD memory card before sending the unit, these will not be needed during the repair process. Our Authorized Service Center will not guarantee the return of those cards if they arrive along with the unit.</p>

				<p>If your unit has any kind of lock, it must be removed, because it may prevent our technicians from verifying the failure, otherwise the Authorized Service Center will have to reinstall the software in the unit. Keep in mind that the repair process could still require the software in the unit to be reinstalled, in that case all information stored in the memory will be erased.</p>

				<p>YEZZ/NIU will only take care of units with manufacturing issues, units damaged by the customer are no longer covered by the warranty, in that case the customer has the option of paying for the repairs needed and/or the shipment back.</p>

				<p>Add the Case Number with the unit, so that it can be identified by our Authorized Service Center. If you notice any mistake in the information in the Case Number or you wish to add any other failure, please, let us know as soon as possible.</p>

				<p>Keep in mind that after 15 consecutive days, if the unit has not arrived at our Authorized Service Center, the case number created for your request will be automatically cancelled. If you still wish to send the unit afterwards, you will need to contact us in order to process your request once more.</p>',
		],
		'order_delivered' => [
			'filename' => 'TICKET_NO_:order_number.pdf',
			'case_number' => 'Case No :order_number',
			'creation_date' => 'Creation date',
			'authorized_service_center' => 'Authorized Service Center',
			'customer' => 'Customer',
			'address' => 'Address',
			'phone_nro1' => 'Phone No 1',
			'phone_nro2' => 'Phone No 2',
			'email' => 'Email address',
			'brand' => 'Brand',
			'model' => 'Model',
			'serial' => 'Serial No',
			'failure_reported' => 'Failure reported',
			'warranty' => 'Warranty',
			'actions' => 'Actions',
			'signature_customer' => 'Signature Customer',
			'signature_point_of_sales' => 'Signature POS',
		],
		'order_workshop_received' => [
			'subject' => 'Order #:order_number has been assigned to your workshop',
			'message1' => 'A service order has been assigned to your workshop. Please as soon as possible to contact the customer to the attention of your requirement.',
		],
	],
    'dear_customer' => 'Dear customer',
    'end_note'      => 'This email is for the user of the intended recipient(s) only. if you have received this email in error, please notify the sender immediately and them delete it. if you are not the intended recipient, you must not keep, use, disclose, copy or distribute this email without the author&#x00b4;s prior permission. We have taken precautions to minimize the risk of transmitting sofware viruses, but we advise you to carry out your own virus checks on any attachment to this message. We cannot accept liability for any loss or damage caused by software viruses. The information contained in this communication may be confidential and may be subject to the attorney-client privilege. if you are the intended recipient and you do not wish to receive similar electronic messages from us in future then please respond to the sender to this effect.',
    'thanks' => 'Thank you for your trust.',
    'yezzstore' => 'Visit our YEZZ Store',
    'sign_now' => 'Enter NOW',
    'help_message_url_button_footer' => "If you’re having trouble clicking the ':actionText' button, copy and paste the URL below into your web browser:",
];
