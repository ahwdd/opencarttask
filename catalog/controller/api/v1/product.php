<?php
class ControllerApiV1Product extends Controller
{
    /**
    * Show latest products with limit 5 product maximum
    */
    // endpoint: index.php?route=api/vi/product/latestProducts
    public function latestProducts()
    {
        $json = [];
        // add header as json response
        $this->response->addHeader("Content-Type: application/json");

        $total = $this->request->post["total"];

        // handle exceptions
        if ($total > 5) {
            $json['error'] = 'The mac nuber for "total" should be 5.';
        }

        if (!empty($json['error'])) {
            return $this->response->setOutput(json_encode($json))
        }

        // loading the model method
        $this->load->model("catalog/product");

        $latestProducts = $this->model_catalog_produtct->getLatestProducts(
            $total
        );

        var_dump($latestProducts);
        exit;

        // send output
        $this->response->setOutput(json_encode($json));
    }
}
