<?php

namespace Magebit\Learning\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Session;
use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Api\Data\ProductInterface;

class AttributeElement extends Template
{
    /** @var ProductInterface|null */
    protected $_product = null;

    /**
     * @throws NoSuchEntityException
     */
    public function __construct(
        Context $context,
        Session $catalogSession,
        ProductRepositoryInterface $productRepository,
    )
    {
        parent::__construct($context);
        // Get product instance
        $this->_product = $productRepository->getById($catalogSession->getData('last_viewed_product_id'));
    }

    public function getProduct(): ProductInterface
    {
        return $this->_product;
    }

    public function attributeHasValue($code)
    {
        return $this->_product->getAttributeText($code);
    }

    public function getAttributeValue($separator, $code): string
    {
        $values = $this->_product->getAttributeText($code);

        if($values === false)
        {
            return "empty";
        }

        if(is_string($values))
        {
            return $values;
        }

        return implode($separator, $values);
    }

    public function getShortDescription(): string
    {
        $descriptionAttribute = $this->_product->getCustomAttribute('short_description');

        if(!$descriptionAttribute)
        {
            return "";
        }

        return $this->_product->getCustomAttribute('short_description')->getValue();
    }

    public function getAttributes(): array
    {
        $chosenAttributes = [];

        /** @var AbstractAttribute $attributes */
        $attributes = $this->_product->getAttributes();

        if(!$attributes)
        {
            return $chosenAttributes;
        }

        foreach ($attributes as $attribute)
        {
            $code = $attribute->getAttributeCode();

            /** @var $attribute AbstractAttribute */
            if(!$attribute->getIsVisibleOnFront())
            {
                unset($attributes[$code]);
                continue;
            }

            if(!$this->attributeHasValue($code))
            {
                unset($attributes[$code]);
                continue;
            }

            if($code === "dimensions")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(" x ",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }

            if($code === "color")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue("/",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }

            if($code === "material")
            {
                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(", ",$code),
                    'code' => $code
                ];

                unset($attributes[$code]);
            }
        }

        if(count($chosenAttributes) < 3)
        {
            for ($i = 0; $i <= 3 - count($chosenAttributes); $i++)
            {
                if(empty($attributes))
                {
                    break;
                }

                $attribute = array_shift($attributes);
                $code = $attribute->getAttributeCode();

                $chosenAttributes[$code] = [
                    'label' => $attribute->getStoreLabel(),
                    'value' => $this->getAttributeValue(", ", $code),
                    'code' => $code
                ];
            }
        }

        return $chosenAttributes;
    }
}
