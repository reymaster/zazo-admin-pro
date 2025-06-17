<?php

class Custom_Admin_Pro_Dashboard_Widgets {

    public function setup_dashboard() {
        // Remove todos os widgets padrão
        global $wp_meta_boxes;
        $wp_meta_boxes['dashboard']['normal']['core'] = array();
        $wp_meta_boxes['dashboard']['side']['core'] = array();

        // Adiciona nosso widget de contêiner principal
        wp_add_dashboard_widget(
            'custom_admin_pro_main',
            'Dashboard', // O título será ocultado por CSS
            array($this, 'render_main_dashboard_content')
        );
    }

    public function render_main_dashboard_content() {
        require_once CAP_PLUGIN_DIR. 'views/dashboard-main.php';
    }

    // Funções de renderização de widgets individuais
    public function render_kpi_card($title, $value, $change, $chart_id) {
        $is_positive = $change >= 0;
        $change_class = $is_positive? 'success' : 'danger';
        $change_icon = $is_positive? 'ki-arrow-up' : 'ki-arrow-down';
        $formatted_value = is_numeric($value)? number_format($value) : $value;
       ?>
        <div class="col-xl-3">
            <a href="#" class="card bg-<?php echo $change_class;?> hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="<?php echo $change_icon;?> text-white fs-3x ms-n1"></i>
                    <div class="text-white fw-bold fs-2 mb-2 mt-5"><?php echo esc_html($formatted_value);?></div>
                    <div class="fw-semibold text-white"><?php echo esc_html($title);?></div>
                </div>
            </a>
        </div>
        <?php
    }

    public function render_world_sales_map() {
       ?>
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">World Sales</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Top Selling Countries</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div id="cap_world_map" class="w-100 h-350px"></div>
            </div>
        </div>
        <?php
    }

    public function render_bar_chart_widget() {
       ?>
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Top Selling Categories</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">8k social visitors</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <div id="cap_categories_chart" class="w-100 h-350px"></div>
            </div>
        </div>
        <?php
    }

    public function render_product_list_widget() {
        // Dados de exemplo. Substitua por uma WP_Query real.
        $products = array(
            array('img' => 'assets/media/stock/ecommerce/1.png', 'name' => 'Elephant 1802', 'price' => '72.00'),
            array('img' => 'assets/media/stock/ecommerce/2.png', 'name' => 'Red Laga', 'price' => '45.00'),
            array('img' => 'assets/media/stock/ecommerce/3.png', 'name' => 'RiseUP', 'price' => '168.00'),
            array('img' => 'assets/media/stock/ecommerce/4.png', 'name' => 'Yellow Stone', 'price' => '72.00'),
        );
       ?>
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Top Selling Products</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">8k social visitors</span>
                </h3>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <tbody>
                            <?php foreach ($products as $product):?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="<?php echo CAP_PLUGIN_URL. $product['img'];?>" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?php echo $product['name'];?></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">$<?php echo $product['price'];?></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
}
