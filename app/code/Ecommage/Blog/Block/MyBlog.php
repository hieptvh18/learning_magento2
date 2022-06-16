<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;


class MyBlog extends Template
{
    protected $_template = 'Ecommage_Blog::my-blog.phtml';
    protected $_blogFactory;
    protected $_customerUrl;
    protected $_authSession;
    protected $userContext;

    public function __construct(Template\Context $context, array $data = [],
    \Ecommage\Blog\Model\BlogFactory $blogFactory,
                                \Magento\Customer\Model\Session $_authSession,
                                \Magento\Customer\Model\Url $customerUrl,
                                \Magento\Authorization\Model\UserContextInterface $userContext,
                                \Magento\Framework\App\Http\Context $httpContext
    )
    {
        $this->httpContext = $httpContext;
        $this->userContext = $userContext;
        $this->_blogFactory = $blogFactory;
        $this->_customerUrl = $customerUrl;
        $this->_authSession = $_authSession;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
//    public function getMyBlogList()
//    {
//        dd($this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH));
//    }

    public function getMyBlogList(){
        $authorId = $this->_authSession->getCustomer()->getId();

        $data = $this->_blogFactory->create()->getCollection()
            ->addFilter('author_id',$authorId);

        return $data;
    }


}
