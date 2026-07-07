<?php


namespace Ecommerce\Enums;

enum EcommercePermission: string
{
    case Ecommerce = 'ecommerce';
    // Brand
    case Brand = 'ecommerce.brand';
    case BrandView = 'ecommerce.brand.view';
    case BrandCreate = 'ecommerce.brand.create';
    case BrandUpdate = 'ecommerce.brand.update';
    case BrandDelete = 'ecommerce.brand.delete';

    // Product
    case Product = 'ecommerce.product';
    case ProductView = 'ecommerce.product.view';
    case ProductCreate = 'ecommerce.product.create';
    case ProductUpdate = 'ecommerce.product.update';
    case ProductDelete = 'ecommerce.product.delete';

    // Category
    case Category = 'ecommerce.category';
    case CategoryView = 'ecommerce.category.view';
    case CategoryCreate = 'ecommerce.category.create';
    case CategoryUpdate = 'ecommerce.category.update';
    case CategoryDelete = 'ecommerce.category.delete';

    // Discount Code
    case Discount = 'ecommerce.discount';
    case DiscountView = 'ecommerce.discount.view';
    case DiscountCreate = 'ecommerce.discount.create';
    case DiscountUpdate = 'ecommerce.discount.update';
    case DiscountDelete = 'ecommerce.discount.delete';

    // Comment
    case Comment = 'ecommerce.comment';
    case CommentView = 'ecommerce.comment.view';
    case CommentCreate = 'ecommerce.comment.create';
    case CommentUpdate = 'ecommerce.comment.update';
    case CommentDelete = 'ecommerce.comment.delete';

    // Cart
    case Cart = 'ecommerce.cart';
    case CartView = 'ecommerce.cart.view';
    case CartAdd = 'ecommerce.cart.add';
    case CartUpdate = 'ecommerce.cart.update';
    case CartDelete = 'ecommerce.cart.delete';

    // Order
    case Order = 'ecommerce.order';
    case OrderView = 'ecommerce.order.view';
    case OrderCreate = 'ecommerce.order.create';
    case OrderUpdate = 'ecommerce.order.update';
    case OrderDelete = 'ecommerce.order.delete';

    // Order
    case Shipping = 'ecommerce.shipping';
    case ShippingView = 'ecommerce.shipping.view';
    case ShippingCreate = 'ecommerce.shipping.create';
    case ShippingUpdate = 'ecommerce.shipping.update';
    case ShippingDelete = 'ecommerce.shipping.delete';


    public static function getPermissionNames()
    {
        return collect(EcommercePermission::cases())->map(function ($item, $key) {
            return $item->value;
        });
    }


    public function label(): string
    {
        return trans('ecommerce::permissions.'.$this->value);
    }
}
