<?php

/**
 * Akkar Global Services - Email Templates Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(19 Septiembre - 2016)
 */

use App\EmailTemplate;
use App\Country;
use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [
            "issued_case" => [
                "countries" => [
                    "VE" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=pbt5p7vCNMQ",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>De realizar un envío, el equipo debe estar bien envuelto y protegido a fin de evitar daños a consecuencia del traslado. El envío puede hacerlo a través de la compañía de su preferencia. El costo del envío de la unidad al Centro de Servicio Autorizado es responsabilidad del cliente y el envío del Centro de Servicio Autorizado al cliente es responsabilidad de YEZZ/NIU. </p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <p>Será contactado cuando el equipo esté dispuesto a retirar en nuestras instalaciones. <span style="font-weight: 700;">Recuerde que la logística de retorno es responsabilidad del cliente; puede retirar personalmente o tramitar con el Taller la devolución mediante cobro a destino.</span></p>

                            <br><br>',
                    ],
                    "EC" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=q9WfXCdePDs",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <p>Será contactado cuando el equipo esté dispuesto a retirar en nuestras instalaciones. <span style="font-weight: 700;">Recuerde que la logística de retorno es responsabilidad del cliente; puede retirar personalmente o tramitar con el Taller la devolución mediante cobro a destino.</span></p>

                            <br><br>',
                    ],
                    "US" => [
                        "img_header" => "img/content_header_en.jpg",
                        "img_ext_link" => "img/button_vote_en.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=BNJyAD7jRah",
                        "body_message" => 
                            'Dear customer,<br><br>
                            <p>&nbsp;&nbsp;Attached on you will find the Case Number created for your request:
                            The unit (<span style="font-weight: 700;">pplease include battery, headset, charger and the USB cable - only when the failure can be related to the accessories</span>) must be sent to our Authorized Service Center (SERVICE FORCE AMERICA) located on:</p>

                            <ul>
                                <li>Only for USPS shipments: 2335 NW, Ave. 107, Mailbox # 32. Miami, FL 33172</li>
                                <li>For FedEx / UPS / DHL shipments: 2335 NW, Ave. 107. Unit # 2MB32. Miami, FL 33172</li>
                            </ul>

                            <p>Personal deliveries are not allowed in our Authorized Service Center, every unit must be sent through a courier company of your preference. Please send the unit well protected to avoid issues on the delivery. Please make sure you send only the unit, do not send the box the unit came in when you bought it. Keep in mind that the shipment should be either “regular” or “priority mail”, avoid sending the package as “certified mail” since those cannot be left in a mailbox, which would create a delay in the process.</p>

                            <p>If your unit has any kind of lock, it must be removed, because it may prevent our technicians from verifying the failure, otherwise the Authorized Service Center will have to reinstall the software in the unit. Keep in mind that the repair process could still require the software in the unit to be reinstalled, in that case all information stored in the memory will be erased.</p>

                            <p>The cost of sending the unit to the Authorized Service Center is the responsibility of the customer and the sending of the Authorized Service Center to the customer is the responsibility of YEZZ/NIU.</p>

                            <p>The customer is responsible for the shipment of the unit to the Authorized Service Center, YEZZ/NIU will be responsible for the shipment back to the customer.</p>

                            <p>YEZZ/NIU will only take care of units with manufacturing issues, units damaged by the customer are no longer covered by the warranty, in that case the customer has the option of paying for the repairs needed and/or the shipment back.</p>

                            <p>Add the Case Number with the unit, so that it can be identified by our Authorized Service Center. If you notice any mistake in the information in the Case Number or you wish to add any other failure, please, let us know as soon as possible.</p>

                            <p>Keep in mind that after 15 consecutive days, if the unit has not arrived at our Authorized Service Center, the case number created for your request will be automatically cancelled. If you still wish to send the unit afterwards, you will need to contact us in order to process your request once more.</p>

                            <br><br>',
                    ],
                    "CO" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=Fefd9sobsbs",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Envíe el equipo bien envuelto y protegido a fin de evitar daños  a consecuencia del traslado.</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "PE" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=sFzLFFjNT3x",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "UY" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=aKxeS3Pa3KN",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Cuando la unidad se encuentre reparada y lista para retirar, le será informado vía correo electrónico.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "PA" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=mCEmVNKeO8b",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>De realizar un envío, el equipo debe estar bien envuelto y protegido a fin de evitar daños a consecuencia del traslado. El envío puede hacerlo a través de la compañía de su preferencia. El costo del envío de la unidad al Centro de Servicio Autorizado es responsabilidad del cliente y el envío del Centro de Servicio Autorizado al cliente es responsabilidad de YEZZ/NIU.(solo para la Ciudad de Panamá)</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "MX" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=CiMX2OwNCrK",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:</p>
                            
                            <p>Dirigirse a la Tienda DHL seleccionada previamente (proporcionada al momento de generar el N° de Caso) y enviar sus equipos a la siguiente dirección:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Incluya en el envío la batería de manera obligatoria, los accesorios como manos libres, cargador y cable USB sólo cuando la falla pueda estar relacionada con los accesorios. Por favor, envíe el equipo bien envuelto y protegido a fin de evitar daños a consecuencia del traslado</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>El equipo una vez reparado será devuelto a la Tienda DHL que nos indicó al momento de generar el N° de Caso</p>

                            <p>Cuando el equipo esté listo y reparado le será notificado vía telefónica y por correo electrónico para gestionar el retorno del mismo</p>

                            <p>YEZZ/NIU no se hace responsable por los costos de envíos y/o retornos de las unidades hacia nuestro taller autorizado.</p>
                            
                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <p>Con la finalidad de llevar un mejor registro del proceso, le pedimos que por favor al realizar el envío de la unidad nos haga llegar el número de guía (tracking number).</p>

                            <br><br>',
                    ],
                    "GT" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=6q2nrISLEDk",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de entregar o enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Cuando la unidad se encuentre reparada y lista para retirar, le será informado vía correo electrónico.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "HN" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=DC8mqzsUYZl",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo</p>

                            <p>Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo.</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "NI" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "http://yezz.world/encuesta/?token1=Qg2AFXtjcFt",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "CR" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                    "SV" => [
                        "img_header" => "img/content_header_es.jpg",
                        "img_ext_link" => "img/button_vote_es.jpg",
                        "url_ext_link" => "",
                        "body_message" => 
                            'Estimado cliente,<br><br>
                            <p>&nbsp;&nbsp;Adjunto encontrará el Nº de Caso creado para su solicitud, le indico a continuación el procedimiento:
                            El equipo (<span style="font-weight: 700;">por favor incluya la batería, manos libres, cargador y cable USB – sólo cuando la falla pueda estar relacionada con los accesorios</span>) puede llevarlo o enviarlo a la dirección del Centro de Servicio Autorizado ({WORKSHOP_NAME}) indicado a continuación:</p>

                            <p>{WORKSHOP_ADDRESS}<br>
                            {WORKSHOP_CONTACT}<br>
                            {WORKSHOP_PHONE}<br>
                            {WORKSHOP_SCHEDULE}</p>

                            <p>Asegúrese de remover la tarjeta SIM y la tarjeta de memoria SD antes de enviar el equipo, ya que estas no serán necesarias durante el proceso de reparación. Nuestro Centro de Servicio Autorizado no se hará responsable del retorno de las mismas de arribar junto con el equipo.</p>

                            <p>Si su equipo tiene algún tipo de bloqueo, debe quitarlo ya que impedirá comprobar la falla y obligará al Centro de Servicio Autorizado a realizar una actualización de software preventiva. Tenga en cuenta que el proceso de reparación podría generar la pérdida de la información almacenada en el equipo</p>

                            <p>YEZZ/NIU sólo atenderá aquellas unidades que presenten daño de fábrica, de diagnosticarse un daño por mal uso, la reparación y/o el envío de vuelta deberá ser pagado por el cliente.</p>

                            <p>El Nº de Caso adjunto debe ser impreso y anexado al equipo al momento de su envío para que el Centro de Servicio Autorizado verifique su procedencia.  Si considera que el Nº de Caso tiene algún error o si desea agregar una falla más específica, por favor, déjenos saber lo más pronto posible.</p>

                            <p>Tenga en cuenta que luego de transcurridos 15 días naturales el N° de Caso creado para esta solicitud será anulado automáticamente si la unidad aún no ha sido recibida en nuestro Centro de Servicio Autorizado. De ser así, deberá comunicarse nuevamente con nosotros para volver a realizar su solicitud.</p>

                            <br><br>',
                    ],
                ],
            ],
            "out_of_time" => [
                "countries" => [
                    "VE,EC,CO,PE,UY,PA,MX,GT,HN,NI,CR,SV" => [
                        "img_header" => "",
                        "img_ext_link" => "",
                        "url_ext_link" => "",
                        "body_message" => 
                            'En días pasados usted generó una orden de servicio a través de nuestro Centro de Atención al Cliente; sin embargo, debido a que su equipo no ha sido recibido en el Centro de Servicio Técnico en los lapsos establecidos, su orden ha sido anulada.
                            {LF}
                            Si aún está interesado en enviar su equipo a servicio técnico, por favor comuníquese nuevamente con el Centro de Atención al Cliente correspondiente a su país para generar una nueva orden de servicio. Si por el contrario, ya envió su equipo a taller y recibió esta comunicación, le ofrecemos disculpas e invitamos a comunicarse con el Centro de Atención al Cliente de su país para verificar el estatus de su orden.
                            {LF}
                            Gracias por elegir a YEZZ como su marca de dispositivos móviles.
                            {LF}
                            ¡Que tenga un feliz día!',
                    ],
                    "US" => [
                        "img_header" => "",
                        "img_ext_link" => "",
                        "url_ext_link" => "",
                        "body_message" => 
                            'In the previous days you generated a service order through our Customer Service Center; however, since your device has not been received at the Technical Service Center within the established time limits, your order has been canceled.
                            {LF}
                            If you are still interested in sending your unit for technical service, please contact the Customer Service Center of your country to generate a new service order. If you already sent your device for technical service and received this communication, we apologize and invite you to contact the Customer Service Center of your country to verify the status of your order.
                            {LF}
                            Thank you for choosing YEZZ as your mobile device brand.
                            {LF}
                            Have a nice day!',
                    ],
                ],
            ],
            "welcome" => [
                "countries" => [
                    "VE,EC,CO,PE,UY,PA,MX,GT,HN,NI,CR,SV" => [
                        "img_header" => "",
                        "img_ext_link" => "",
                        "url_ext_link" => "",
                        "body_message" => 
                            'Hola, queremos darte la más cordial bienvenida a nuestro sistema para la Gestión de Garantias YWS. Te invitamos a que gestiones tus requerimientos a traves de este sistema
                            {LF}
                            A continuación te indicamos tus datos de acceso
                            {LF}
                            Usuario: {USER}
                            {LF}
                            Contraseña: {PASSWORD}
                            {LF}
                            Gracias por elegir a YEZZ como su marca de dispositivos móviles
                            {LF}
                            ¡Que tenga un feliz día!',
                    ],
                    "US" => [
                        "img_header" => "",
                        "img_ext_link" => "",
                        "url_ext_link" => "",
                        "body_message" => 
                            'Hello, we want to give you the most cordial welcome to our system for YWS Guarantee Management. We invite you to manage your requirements through this system
                            {LF}
                            Here your login information
                            {LF}
                            Usuario: {USER}
                            {LF}
                            Contraseña: {PASSWORD}
                            {LF}
                            Thank you for choosing YEZZ as your mobile device brand
                            {LF}
                            Have a nice day!',
                    ],
                ],
            ],
        ];

        foreach ($templates as $template => $options) {

            foreach ($options['countries'] as $key => $data) {
                $countries = explode(",", $key);
                foreach ($countries as $country_code) {
                    $country = Country::where('iso_code', $country_code)->first();
                    
                    EmailTemplate::create([
                        'country_id' => $country->id,
                        'code' => $template,
                        'img_header' => $data['img_header'],
                        'img_ext_link' => $data['img_ext_link'],
                        'url_ext_link' => $data['url_ext_link'],
                        'body_message' => $data['body_message'],
                    ]);
                }
            }
        }
    }
}
