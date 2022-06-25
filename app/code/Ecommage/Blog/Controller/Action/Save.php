<?php

namespace Ecommage\Blog\Controller\Action;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{

    protected $_authSession;
    protected $_blogFactory;

    protected $uploaderFactory;

    protected $adapterFactory;

    protected $filesystem;

    public function __construct(Context $context,
                                \Magento\Customer\Model\Session $_authSession,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory,
                                UploaderFactory $uploaderFactory,
                                AdapterFactory $adapterFactory,
                                Filesystem $filesystem
)
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_blogFactory = $blogFactory;
        $this->_authSession = $_authSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $formData = $this->getRequest()->getParams();
        $formFiles = $this->getRequest()->getFiles();

        /*
             * check id - edit || create*/
        if($this->getRequest()->getParam('id')){
            $blog = $this->_blogFactory->create()->load($this->getRequest()->getParam('id'));
            if($blog){
                $blogModel = $blog;
            }else{
                $blogModel = $this->_blogFactory->create();
            }
        }else{
            $blogModel = $this->_blogFactory->create();
        }

        if(isset($formFiles['featured_image']) && !empty($formFiles['featured_image']['name'])){
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'featured_image']);
                //check upload file type or extension
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'png' ]);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('blog');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                $imagePath = 'blog'.$result['file'];

                //Set file path with name for save into database
                $formData['featured_image'] = $imagePath;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        $authorId = $this->_authSession->getId();

//        set data save
        $blogModel->setData($formData);
        $blogModel->setData('author_id',(int)$authorId);

        try {
            // Save blog && unlink old image
            $blogModel->save();

            $this->messageManager->addSuccess(__('Blog have been saved.'));

        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $this->_redirect('blog/');
    }
}
