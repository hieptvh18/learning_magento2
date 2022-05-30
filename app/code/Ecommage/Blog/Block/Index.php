<?php
namespace Ecommage\Blog\Block;
use Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $action;
    public function __construct(Template\Context $context, array $data = [], Action $action)
    {
        // gan class action cho protected action de dung dang glpbal
        $this->action = $action;
        parent::__construct($context, $data);
    }

    /*
     * get list blog-> render to menu sidebar
     * */
    public function getBlogList(){
//        use collection -> get list blog

        return 'day la menu blog';
    }

    /*
     * get post by id
     * */
    public function getPost($id){
        $post = $this->action->_objectManager->create('Ecommage\Blog\Model\Blog');
        $post = $post->load($id)->getData();
        return $post;
    }

}
