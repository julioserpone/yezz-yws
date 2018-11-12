<?php

return [
	'user' => [
		'welcome' => 'Welcome :username to YWS Guarantee Management',
	],
	'orders' => [
		'issued_case' => [
			'subject' => 'Orden Nro #:order_number ha sido creada',
			'message1' => 'Gracias por contactarnos. Hemos registrado una orden de servicio para satisfacer sus necesidades.',
		],
		'abandoned' => [
			'subject' => 'Orden #:order_number se ha abandonado',
		],
		'order_created' => [
			'filename' => 'CASO_NRO_:order_number.pdf',
			'case_number' => 'N° de Caso :order_number',
			'creation_date' => 'Fecha de Creación',
			'authorized_service_center' => 'Centro de Servicio Autorizado',
			'customer' => 'Cliente',
			'address' => 'Dirección',
			'phone_nro1' => 'Teléfono 1',
			'phone_nro2' => 'Teléfono 2',
			'email' => 'Correo Electrónico',
			'brand' => 'Marca',
			'model' => 'Modelo',
			'serial' => 'Serial',
			'part_number' => 'Número de Parte',
			'failure_reported' => 'Falla Reportada',
			'important' => 'Importante',
			'footer_case' => 'Estimado cliente, de no ingresar la unidad al Centro de Servicio en los próximos 15 días contínuos, el N° de Caso será anulado automáticamente.',
			'important_msg' => 
				"<p class='extra_padding'>Envíe el equipo bien envuelto y protegido a fin de evitar daños  a consecuencia del traslado.</p>

				<p class='extra_padding'>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

				<p class='extra_padding'>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

				<p class='extra_padding'>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

				<p class='extra_padding'>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su entrega o envío  para que el Centro de Servicio verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

				<p class='extra_padding'>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>",
		],
		'order_delivered' => [
			'filename' => 'TICKET_NRO_:order_number.pdf',
			'case_number' => 'N° de Caso :order_number',
			'creation_date' => 'Fecha de Creación',
			'authorized_service_center' => 'Centro de Servicio Autorizado',
			'customer' => 'Cliente',
			'address' => 'Dirección',
			'phone_nro1' => 'Teléfono 1',
			'phone_nro2' => 'Teléfono 2',
			'email' => 'Correo Electrónico',
			'brand' => 'Marca',
			'model' => 'Modelo',
			'serial' => 'Serial',
			'failure_reported' => 'Falla Reportada',
			'warranty' => 'Warranty',
			'actions' => 'Actions',
			'signature_customer' => 'Signature Customer',
			'signature_point_of_sales' => 'Signature POS',
		],
		'order_workshop_received' => [
			'subject' => 'Orden Nro #:order_number ha sido asignado a tu taller',
			'message1' => 'Una orden de servicio se ha asignado a su taller. Por favor, tan pronto como sea posible ponerse en contacto con el cliente para la atención de sus necesidades.',
		],
	],
    'dear_customer' => 'Estimado(a) cliente',
    'end_note'      => 'Este correo electrónico es para el usuario de los destinatarios previstos. Si ha recibido este correo electrónico por error, notifique al remitente de inmediato y elimínelo. Si no eres el destinatario, no debes guardar, usar, divulgar, copiar o distribuir este correo electrónico sin el permiso previo de los autores. Hemos tomado precauciones para minimizar el riesgo de transmitir virus de software, pero le aconsejamos que realice sus propias verificaciones de virus en cualquier archivo adjunto a este mensaje. No podemos aceptar ninguna responsabilidad por cualquier pérdida o daño causado por virus de software. La información contenida en esta comunicación puede ser confidencial y puede estar sujeta al privilegio de abogado-cliente. Si usted es el destinatario deseado y no desea recibir mensajes electrónicos similares de nosotros en el futuro, por favor responda al remitente a este efecto.',
    'thanks' => 'Gracias por su confianza.',
    'yezzstore' => 'Visita nuestra tienda YEZZ',
    'sign_now' => 'Ingresa AHORA',
    'help_message_url_button_footer' => "Si tiene problemas al hacer clic en el botón ':actionText', copie y pegue la URL a continuación en su navegador web:",
];
