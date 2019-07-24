<?php
namespace JLNarvaez\SendMail\Controller\Mail;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Area;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\Store;

class Index extends Action
{
    /** @var TransportBuilder $transportBuilder */
    private $transportBuilder;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param TransportBuilder $transportBuilder
     */
    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder
    ) {
        $this->transportBuilder = $transportBuilder;
        return parent::__construct($context);
    }

    /** @inheritdoc */
    public function execute()
    {
        $transport = $this->transportBuilder
            ->setTemplateIdentifier('email_custom_template_jlnarvaez')
            ->setTemplateOptions(
                [
                    'area' => Area::AREA_FRONTEND,
                    'store' => Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars([
                'x' => 220,
                'y' => 251
            ])
            ->addTo(['jlnarvaez@jlnarvaez.com'])
            ->setFrom('general') // Valor "trans_email/ident_general/email" de la tabla "core_config_data"
            ->getTransport();

        $transport->sendMessage();
    }
}