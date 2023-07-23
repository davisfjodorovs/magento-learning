<?php

namespace Magebit\Learning\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Session;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\InventoryCatalog\Model\GetStockIdForCurrentWebsite;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

class AddToCartElement extends Template
{
    /** @var ProductInterface|null */
    protected $_product = null;

    /** @var GetProductSalableQtyInterface */
    protected $_getProductStableQtyInterface;

    /** @var GetStockIdForCurrentWebsite  */
    protected $_getStockIdForCurrentWebsite;

    /**
     * @throws NoSuchEntityException
     */
    public function __construct(
        Context $context,
        Session $catalogSession,
        ProductRepositoryInterface $productRepository,
        GetProductSalableQtyInterface $getProductStableQtyInterface,
        GetStockIdForCurrentWebsite $getStockIdForCurrentWebsite,
    )
    {
        parent::__construct($context);
        // Get product instance
        $this->_product = $productRepository->getById($catalogSession->getData('last_viewed_product_id'));
        $this->_getProductStableQtyInterface = $getProductStableQtyInterface;
        $this->_getStockIdForCurrentWebsite = $getStockIdForCurrentWebsite;

    }

    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getProductStock()
    {
        $stockId = $this->_getStockIdForCurrentWebsite->execute();

        return $this->_getProductStableQtyInterface->execute($this->_product->getSku(), $stockId);
    }
}
