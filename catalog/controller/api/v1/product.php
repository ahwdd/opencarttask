<?php
class ControllerApiV1Product extends Controller
{
    /**
     * Show latest products with limit 5 product maximum
     */
    // endpoint: index.php?route=api/vi/product/latestProducts
    public function latestProducts()
    {
        $total = $this->request->post["total"] ?? null;

        $json = [];
        // add header as json response
        $this->response->addHeader("Content-Type: application/json");

        // handle exceptions
        if (!isset($total) || $total > 6) {
            $json["error"] = 'The max number for "total" should be 5.';
        }

        if (!empty($json["error"])) {
            return $this->response->setOutput(json_encode($json));
        }

        // loading the model method
        $this->load->model("catalog/product");

        $latestProducts = $this->model_catalog_product->getLatestProducts(
            $total
        );

        foreach ($latestProducts as $product) {
            $json["products"][] = [
                "product_id" => $product["product_id"],
                "name" => $product["name"],
                "prict" => $product["price"],
            ];
        }

        $this->response->setOutput(json_encode($json));
    }
}
