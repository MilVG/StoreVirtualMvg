<?php headerAdmin($data); ?>
<?php navadmin($data); ?>
<div class="container-fluid">
    <div class="card">
        <div class="app-title">
            <div class="row ml-3">
                <div class="col-4 mt-2">
                    <h1><i class="far fa-file-alt"></i> Factura</h1>
                </div>
                <div class="col-8 mt-2">
                    <ul class="app-breadcrumb breadcrumb justify-content-end mr-2">
                        <li class="breadcrumb-item"><i class="fas fa-arrow-circle-left"></i></li>
                        <li class="breadcrumb-item "><i class="fa fa-home fa-lg"></i></li>
                        <li class="breadcrumb-item "><a href="#">Pedidos</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="card shadow">
        <main class="app-content">

            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <section class="invoice">
                            <div class="row mb-4 ml-3 mt-2 mr-2">
                                <div class="col-6">
                                    <h2 class="page-header"><i class="fa fa-globe"></i> Vali Inc</h2>
                                </div>
                                <div class="col-6 ">
                                    <h5 class="text-right">Date: 01/01/2016</h5>
                                </div>
                            </div>
                            <div class="row col-md-auto invoice-info ml-3">
                                <div class="col-4">From
                                    <address><strong>Vali Inc.</strong><br>518 Akshar Avenue<br>Gandhi Marg<br>New Delhi<br>Email: hello@vali.com</address>
                                </div>
                                <div class="col-4 text-center ">To
                                    <address><strong>John Doe</strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br>Phone: (555) 539-1037<br>Email: john.doe@example.com</address>
                                </div>
                                <div class="col-4 text-right"><b>Invoice #007612</b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                                <th>Serial #</th>
                                                <th>Description</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>The Hunger Games</td>
                                                <td>455-981-221</td>
                                                <td>El snort testosterone trophy driving gloves handsome</td>
                                                <td>$41.32</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>City of Bones</td>
                                                <td>247-925-726</td>
                                                <td>Wes Anderson umami biodiesel</td>
                                                <td>$75.52</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>The Maze Runner</td>
                                                <td>545-457-47</td>
                                                <td>Terry Richardson helvetica tousled street art master</td>
                                                <td>$15.25</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>The Fault in Our Stars</td>
                                                <td>757-855-857</td>
                                                <td>Tousled lomo letterpress</td>
                                                <td>$03.44</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row d-print-none mt-2 pb-2 mr-2 ">
                                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank" title=""><i class="fa fa-print"></i> Imprimir Factura</a></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php footerAdmin($data); ?>