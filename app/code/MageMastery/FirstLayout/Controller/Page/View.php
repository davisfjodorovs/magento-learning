<?php

declare(strict_types=1);

namespace MageMastery\FirstLayout\Controller\Page;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class View implements ActionInterface
{
    private PageFactory $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute(): Page
    {
        $page = $this->resultPageFactory->create();

        /** @var Template $block */
        $block = $page->getLayout()->getBlock('magemastery.first.layout');

        $block->setData('heading', 'Heading from Controller');

        return $page;
    }
}
