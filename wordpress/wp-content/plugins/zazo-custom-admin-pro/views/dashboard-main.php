<?php
// Instancia a classe de widgets para acessar os métodos de renderização
$widgets = new Custom_Admin_Pro_Dashboard_Widgets();
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <?php $widgets->render_kpi_card('Total Online Sales', '69,700', 2.2, 'kpi_sales');?>
                <?php $widgets->render_kpi_card('Total Online Visitors', '29,420', 2.6, 'kpi_visitors');?>
                <?php $widgets->render_kpi_card('Total Sales', '1,836', -2.2, 'kpi_total_sales');?>
                <?php $widgets->render_kpi_card('Total New Customers', '6.3k', 0, 'kpi_new_customers');?>
            </div>
            <div class="row g-5 g-xl-10 my-5">
                <div class="col-xl-6 mb-xl-10">
                    <?php $widgets->render_world_sales_map();?>
                </div>
                <div class="col-xl-6 mb-xl-10">
                    <?php $widgets->render_bar_chart_widget();?>
                </div>
            </div>
            <div class="row g-5 g-xl-8">
                 <div class="col-xl-12">
                    <?php $widgets->render_product_list_widget();?>
                 </div>
            </div>
        </div>
    </div>
</div>
