<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/18/15
 * Time: 10:50 AM
 */

namespace App\Quotes;


use App\Events\QuoteRequestWasReceived;
use App\Http\Requests\CheckoutFormRequest;

class QuoteRequestRepo {

    /**
     * @var QuoteRequest
     */
    private $model;

    public function __construct(QuoteRequest $model)
    {
        $this->model = $model;
    }

    public function store(CheckoutFormRequest $request, $cartContents)
    {
        $quoteRequest = $this->createQuoteRequestFromRequest($request);

        $this->addCartContentsToQuoteRequest($request, $cartContents, $quoteRequest);

        $this->addUploadedLogoImagesToQuoteRequest($request, $quoteRequest);

        event(new QuoteRequestWasReceived($quoteRequest));
    }

    private function createQuoteRequestFromRequest($request)
    {
        $packagingOptions = [
            'packaging_A' => $request->has('packaging_A') ? 1 : 0,
            'packaging_B' => $request->has('packaging_B') ? 1 : 0
        ];

        $requestFields = $request->only(['name', 'email', 'phone', 'address', 'enquiry']);

        return $this->model->create(array_merge($requestFields, $packagingOptions));
    }

    /**
     * @param CheckoutFormRequest $request
     * @param $cartContents
     * @param $quoteRequest
     */
    private function addCartContentsToQuoteRequest(CheckoutFormRequest $request, $cartContents, $quoteRequest)
    {
        $requestedProducts = $this->getProductsFromRequest($cartContents, $request);
        foreach ($requestedProducts as $productRequest) {
            $quoteRequest->products()->create($productRequest);
        }
    }

    /**
     * @param CheckoutFormRequest $request
     * @param $quoteRequest
     */
    private function addUploadedLogoImagesToQuoteRequest(CheckoutFormRequest $request, $quoteRequest)
    {
        if ($request->has('logo_images')) {
            $images = $request->get('logo_images');
            foreach ($images as $image) {
                $quoteRequest->images()->create(['image_path' => $image]);
            }
        }
    }

    private function getProductsFromRequest($cartContents, $request)
    {
        $productRequests = [];

        foreach($cartContents as $item) {
            $productRequests[] = [
                'product_name' => $item->name,
                'quantity' => $request->get('product_'.$item->id)
            ];
        }
        return $productRequests;
    }

}