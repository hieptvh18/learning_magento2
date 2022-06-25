<?php

namespace Ecommage\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    const XML_PATH_BLOG = 'blog/';
    const PATH_SMTP_CONFIG_OPTION = 'smtp/configuration_option/';
    private $forwardFactory;
    private $manger;

    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;

    public function __construct(\Magento\Framework\App\Helper\Context $context,
                                TransportBuilder $transportBuilder,
                                StoreManagerInterface $storeManager,
                                StateInterface $state)
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        parent::__construct($context);
    }

    /*
    * khai bao method get value config enable module
    */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /*
     * action get value
     * */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_BLOG .'general/'. $code, $storeId);
    }

    /*
     * get config smtp*/
    public function getConfigSmtpOption($code,$storeId = null){
        return $this->getConfigValue(self::PATH_SMTP_CONFIG_OPTION.$code,$storeId);
    }

    /*
     * send email*/
    public function sendEmail($mailTo, $templateId=null , $fromName= null)
    {
        // this is
        $templateId = $templateId ?: 'order_item2'; // template id
        $fromName = $fromName ?: 'admin hiep' ;  // sender Name
        $fromEmail = $this->getConfigSmtpOption('username');  // sender Email id
        try {
            // template variables in file html
            $templateVars = [
                'msg' => 'Welcome to ecommage',
                'msg1' => 'Message 1',
                'msg_content'=>'We are happy to bother you =))'
            ];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($mailTo)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }
}
