
<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>

    <!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<h3>Daftar Belanja</h3>
                        <h6>Yuk, cari produk lain lagi...</h6>
						<div class="cart-table-warp mt-4">
							<table>
                                <thead>
                                    <tr>
                                        <th class="product-th" width="40%">Product</th>
                                        <th class="quy-th" width="15%">Quantity</th>
                                        <th class="total-th" width="15%">Berat (g)</th>
                                        <th class="total-th"width="20%">Subtotal</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($total_items > 0){
                                        $row_number= 0;
                                        foreach($items as $item){
                                    ?>
                                        <tr id="product<?= $row_number; ?>">
                                            <td class="product-col">
                                                <div class="pc-title">
                                                    <h4><?= $item['product_name']; ?></h4>
                                                    <input type="hidden" name="unit_weight" id="unit_weight<?= $row_number; ?>" value="<?= $item['unit_weight']; ?>">
                                                    <input type="hidden" name="price" id="price<?= $row_number; ?>" value="<?= $item['price']; ?>">
                                                    <p id="price_seen<?= $row_number; ?>"><?= "Rp. ".number_format($item['price'],0,',','.'); ?></p>
                                                </div>
                                            </td>
                                            <td class="quy-col">
                                                <div class="quantity">
                                                    <input type="number" name="quantity" id="quantity<?= $row_number; ?>" class="form-control form-control-sm" value="<?= $item['quantity']; ?>" min="1" onkeyup="changeQuantity(<?= $item['id'].','.$row_number; ?>)">
                                                </div>
                                            </td>
                                            <td class="total-col"><h4 id="weight<?= $row_number; ?>"><?= $item['unit_weight'] * $item['quantity'];?></h4></td>                                        
                                            <td class="total-col"><h4 id="subtotal<?= $row_number; ?>"><?= "Rp. ".number_format($item['price'] * $item['quantity'],0,',','.'); ?></h4></td>                                        
                                            <td class="total-col"><button class="btn btn-sm btn-danger" onclick="remove(<?= $item['id']; ?>,<?= $row_number; ?>)"><i class="fa fa-window-close" aria-hidden="true"></i></td>                                        
                                        </tr>
                                    <?php
                                        $row_number++;
                                        }
                                    }else{                                
                                    ?>
                                        <tr>
                                            <td colspan="4" class="text-center pt-1">Keranjang Kamu Masih Kosong. Yuk Temukan Produk-Produk Terbaik Kami<h6></h6></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
						    </table>
						</div>
						<div class="total-cost">
                            <div class="row">
                                <div class="col-md-6"><h6>Total Berat <span id="grand-total-weight">0</span></h6></div>
                                <div class="col-md-6 text-right"><h6>Total <span id="grand-total">Rp.0</span></h6></div>
                            </div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-12 card-right text-right">
                    <a href="<?= base_url(); ?>" class="site-btn sb-dark">Continue shopping</a>
					<a href="<?= base_url().'/checkout'; ?>" class="site-btn">Proceed to checkout</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

<?= $this->endSection(); ?>

<?= $this->section('content_js'); ?>
<script>
    $(function () {
        //Get Weight Total
        getWeightTotal()

        //Get Grand Total
        getGrandTotal()
	});

    function getWeightTotal(){
        $.ajax({
            url : "<?= base_url().'/shoppingcart/getWeightTotal'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            success : function(ajaxData){
                $("#grand-total-weight").text(formatNumber(ajaxData)+" g")
            }
        });
    }
    function getGrandTotal(){
        $.ajax({
            url : "<?= base_url().'/shoppingcart/getGrandTotal'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            success : function(ajaxData){
                $("#grand-total").text(formatNumber(ajaxData,"Rp. "))
            }
        });
    }

    
    function changeQuantity(id,row_number){
        var quantity = $("#quantity"+row_number).val()
        if(quantity != ""){
            $.ajax({
                url : "<?= base_url().'/shoppingcart/buy'; ?>",
                headers : {'X-Requested-With': 'XMLHttpRequest'},
                method : "POST",
                data : {
                    id : id,
                    quantity : quantity,
                    increment : false
                },
                success : function(ajaxData){
                    //Run Mini Calculator to Calculate new Value
                    miniCalcUpdateQuantity(row_number)

                    //Refresh Weight Total after Change Quantity
                    getWeightTotal();

                    //Refresh Grand Total after Change Quantity
                    getGrandTotal();

                    //Toastr
                    toastr.info('Quantity produk berhasil diubah')
                }
            });
        }
    }

    function miniCalcUpdateQuantity(row_number){
        var quantity = $("#quantity"+row_number).val()

        var unit_weight = $("#unit_weight"+row_number).val()
        var weight = quantity * unit_weight
        $("#weight"+row_number).text(formatNumber(weight.toString(),""))


        var price = $("#price"+row_number).val()
        var new_subtotal = quantity * price
        $("#subtotal"+row_number).text(formatNumber(new_subtotal.toString(),"Rp. "))
    }

    function remove(id,row_number){
        if(confirm("Anda Yakin?")){
            $.ajax({
                url : "<?= base_url().'/shoppingcart/remove/'; ?>"+id,
                headers : {'X-Requested-With': 'XMLHttpRequest'},
                method : "POST",
                success : function(ajaxData){
                    //Remove tr Element
                    $("#product"+row_number).remove()

                    //Refresh Total Item on Navbar
                    getTotalItem()

                    //Refresh Weight Total
                    getWeightTotal();

                    //Refresh Grand Total
                    getGrandTotal();

                    //Toastr
                    toastr.error('Produk dihapus dari keranjang belanja')
                }
            });
        }
	}

    function formatNumber(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?= $this->endSection(); ?>