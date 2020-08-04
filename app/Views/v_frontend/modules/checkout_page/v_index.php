<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>
    <!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
            <div class="section-title mb-4">
				<h4>Checkout </h4>
			</div>
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
                    <h5>Alamat Pengiriman</h5>
                    <hr>
                    <div class="row">
						<div class="form-group col-md-6">
							<small>Provinsi</small>
							<select name="provinsi" id="provinsi" class="form-control form-control-sm required" onchange="getCity()">
							</select>
						</div>
						<div class="form-group col-md-6">
							<small>Kota</small>
							<select name="kota" id="kota" class="form-control form-control-sm required" onchange="cekOngkir()">
								<option value="">--Pilih--</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<small>Kurir</small>
							<select name="kurir" id="kurir" class="form-control form-control-sm required" onchange="cekOngkir()">
								<option value="">--Pilih--</option>
								<option value="jne">JNE</option>
								<option value="tiki">TIKI</option>
								<option value="pos">POS Indonesia</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<small>Tarif</small>
							<select name="tarif" id="tarif" class="form-control form-control-sm required" onchange="pilihTarif()">
								<option value="">--Pilih--</option>
							</select>
						</div>
                        <div class="form-group col-md-12">
                            <small>Alamat Lengkap</small>
							<textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control form-control-sm required" rows="5" style="width:100%" placeholder="Masukkan Alamat Lengkap, Kode POS, beserta Nama Penerima (Untuk Meminimalisir Salah Alamat)">
							</textarea>
                        </div>
                    </div>
                    <hr style="border: 2px solid gray">
                    <h5>Rincian Belanja</h5>
                    <table class="table table-striped table-bordered mt-1">
                        <thead>
                            <tr>
                                <td class="font-weight-bold text-center text-12">Produk</td>
                                <td class="font-weight-bold text-center text-12">Quantity</td>
								<td class="font-weight-bold text-center text-12">Berat (g)</td>
                                <td class="font-weight-bold text-center text-12">Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart as $item){ ?>
                            <tr>
                                <td class="text-12"><?= $item['product_name'].' @ Rp.'.number_format($item['price'],0,',','.'); ?></td>
                                <td class="text-12 text-right"><?= $item['quantity']; ?></td>
								<td class="text-12 text-right"><?= number_format($item['unit_weight'] * $item['quantity'],0,',','.'); ?></td>
                                <td class="text-12 text-right">Rp. <?= number_format($item['price'] * $item['quantity'],0,',','.'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
						<tfoot>
							<tr>
								<td class="font-weight-bold text-center text-12" colspan="2">Total</td>
								<td class="font-weight-bold text-right text-12" id="tfoot-total-weight"></td>
								<td class="font-weight-bold text-right text-12" id="tfoot-total-price"></td>
							</tr>
						</tfoot>
                    </table>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart shadow-sm p-3 mb-5 bg-white rounded">
						<h5>Ringkasan</h5>
						<table width="100%">
                            <tr>
                                <td>Total</td>
                                <td id="total-seen" class="text-right"></td>
                            </tr>
                            <tr>
                                <td>Ongkir</td>
                                <td id="ongkir-seen" class="text-right">Rp.0</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td id="grand-total-seen" class="text-right">Rp.0</td>
                            </tr>
                        </table>
                        <button class="btn btn-sm btn-primary submit-order-btn mt-3 font-weight-bold" id="btnOrder">Order</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->
<?= $this->endSection(); ?>


<?= $this->section('content_js'); ?>
<script>
	var weight_total = 0;
	var price_total = 0;
	var tarif_ongkir = 0;
	var grand_total = 0;

    $(function () {
		//Get Data Provinsi
		getProvince()

		//Get Weight Total
		getWeightTotal()

		//Get Total
		getTotal()

		//Check Status Tarif ongkir / Jika Tarif ongkir == NULL Maka tidak dapat order
		checkStatusTarifOngkir()
        
	});

	$('#btnOrder').click(function(){
		if(checkRequired()){
    		order()
		}
	});
	
	function checkRequired(){
		var status = true
        $(".required").each(function(){
            $(this).removeClass("is-invalid")
            if($(this).val() == "" || $(this).val() == null){
                $(this).addClass("is-invalid")
                status = false
            }
        });
        return status;
	}

	function pilihTarif(){
		tarif_ongkir = $("#tarif :selected").val()
		$("#ongkir-seen").text(formatRupiah(tarif_ongkir,"Rp."))

		countGrandTotal()

		checkStatusTarifOngkir()
	}

	function checkStatusTarifOngkir(){
		var tarif = $("#tarif :selected").val()
		tarif == "" ? $("#btnOrder").attr('disabled',true) : $("#btnOrder").attr('disabled',false)
	}

	function getWeightTotal(){
		$.ajax({
            url : "<?= base_url().'/shoppingcart/getWeightTotal'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            success : function(ajaxData){

				$("#tfoot-total-weight").text(formatRupiah(ajaxData))

				weight_total = ajaxData
            }
		});
	}

    function getTotal(){
		$.ajax({
            url : "<?= base_url().'/shoppingcart/getGrandTotal'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            success : function(ajaxData){
				price_total = ajaxData

				$("#tfoot-total-price").text(formatRupiah(ajaxData,"Rp. "))

				$("#total-seen").text(formatRupiah(ajaxData,"Rp. "))
				
				countGrandTotal()
				
            }
		});
	}

	function countGrandTotal(){
		grand_total = parseInt(price_total) + parseInt(tarif_ongkir)
		$("#grand-total-seen").text(formatRupiah(""+grand_total,"Rp."));
	}

    function formatRupiah(angka, prefix){
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

	function getProvince(){
		$("#preloder").fadeOut("slow",function(){
			var o = new Option("--Pilih--", "");
			$("#provinsi").append(o);

			$.ajax({
				url : "<?= base_url().'/ongkir/province'; ?>",
				headers : {'X-Requested-With': 'XMLHttpRequest'},			
				dataType: "json",
				method : "GET",
				success : function(ajaxData){
					$.each(ajaxData, function(i, item) {
						var o = new Option(item.province, item.province_id);
						$("#provinsi").append(o);
					});
				}
			});
		});
		
	}

	function getCity(){
		var province_id = $("#provinsi :selected").val()

		$("#preloder").fadeOut("slow",function(){
			$("#kota").empty()

			var o = new Option("--Pilih--", "");
			$("#kota").append(o);

			$.ajax({
				url : "<?= base_url().'/ongkir/city/'; ?>"+province_id,
				headers : {'X-Requested-With': 'XMLHttpRequest'},			
				dataType: "json",
				method : "GET",
				success : function(ajaxData){
					console.log(ajaxData)
					$.each(ajaxData, function(i, item) {
						var o = new Option(item.city_name, item.city_id);
						$("#kota").append(o);
					});
				}
			});
		});
	}

	function cekOngkir(){
		var city_destination = $("#kota :selected").val()
		var courier = $("#kurir :selected").val()

		if(city_destination != "" && courier != ""){
			$("#preloder").fadeOut("slow",function(){
				$("#tarif").empty()

				var o = new Option("--Pilih--", "");
				$("#tarif").append(o);

				// console.log(weight_total);
				$.ajax({
					url : "<?= base_url().'/rajaongkirgateway/tarif'; ?>",
					headers : {'X-Requested-With': 'XMLHttpRequest'},			
					dataType: "json",
					method : "POST",
					data : {
						city_destination : city_destination,
						weight_total : weight_total,
						courier : courier
					},
					success : function(ajaxData){
						console.log(ajaxData)
						$.each(ajaxData, function(i, item) {

							for(i in item.costs){
								for (j in item.costs[i].cost) {
									var service = item.costs[i].service
									var etd = item.costs[i].cost[j].etd
									var value = item.costs[i].cost[j].value

									var o = new Option(service+"("+etd+" Hari)"+" - "+ formatRupiah(""+value,""), value);
									$("#tarif").append(o);
								}
							}
							
						});
					}
				});
			});
		}
	}

	function order(){

		var city = $("#kota :selected").val()

		$.ajax({
				url : "<?= base_url().'/checkout/order'; ?>",
				headers : {'X-Requested-With': 'XMLHttpRequest'},			
				dataType: "json",
				method : "POST",
				data : {
					price_total : price_total,
					courier : $("#kurir :selected").val(),
					shipping_price : tarif_ongkir,
					city_code : $("#kota :selected").val(),
					full_address : $("#alamat_pengiriman").val()

				},
				success : function(ajaxData){
					if(ajaxData.messages == "1"){
						var information_link = "<?= base_url().'/checkoutinformation/' ?>"+ajaxData.sales_id
						window.open(information_link,"_self");

					}else if(ajaxData.messages == "0"){
						alert('Gagal Melakukan Order')
					}

				}
			});
	}
</script>

<?= $this->endSection(); ?>