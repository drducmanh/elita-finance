<?php
// Tao shortcode: [form_chovay]
global $province_arr;
$province_arr = array("TP Hồ Chí Minh","Hà Nội","An Giang","Bà Rịa – Vũng Tàu","Bắc Giang","Bắc Kạn","Bạc Liêu","Bắc Ninh","Bến Tre","Bình Định","Bình Dương","Bình Phước","Bình Thuận","Cà Mau","Cần Thơ","Cao Bằng","Đà Nẵng","Đắk Lắk","Đắk Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai","Hà Giang","Hà Nam","Hà Tĩnh","Hải Dương","Hải Phòng","Hậu Giang","Hòa Bình","Hưng Yên","Khánh Hòa","Kiên Giang","Kon Tum","Lai Châu","Lâm Đồng","Lạng Sơn","Lào Cai","Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ","Phú Yên","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huế","Tiền Giang","Trà Vinh","Tuyên Quang","Vĩnh Long","Vĩnh Phúc","Yên Bái");

add_shortcode("form_chovay", "form_chovay");
function form_chovay($atts, $content = NULL){
	extract(shortcode_atts(array(
		
	), $atts));
	$randomid = rand();

	ob_start();

	//wp_enqueue_style( 'elita-finance-css');
	add_action( 'wp_footer', 'elita_finance_script' );
	

 		$primary_color = get_option('base_color');
		list($r, $g, $b) = sscanf($primary_color, "#%02x%02x%02x");

		$overlay_opacity = get_option("overlay_opacity");
		$show_promo_code = get_option('show_promo_code');
 	?>
 	<style>
.form-cho-vay{display:grid;grid-template-columns:1fr 1fr 1fr;grid-column-gap:20px;grid-row-gap:20px}.form-cho-vay *{box-sizing:border-box;font-family:Tahoma,serif}.form-cho-vay .form-item{width:100%;padding:15px;border-radius:7px;font-size:16px;line-height:26px}.form-cho-vay .form-item label{font-size:inherit;line-height:inherit}.form-cho-vay .form-item h4{padding:7px 15px;position:relative;text-transform:uppercase;font-size:18px;font-weight:700;box-shadow:1px 2px 8px -1px rgba(0,0,0,.3);margin:0 0 15px;border-radius:5px;text-shadow:2px 2px rgba(0,0,0,.3);background:#652c8a;color:#fff}.form-cho-vay .form-item h4:after{left:100%;top:50%;border:solid transparent;content:" ";height:0;width:0;position:absolute;pointer-events:none;border-color:rgba(136,183,213,0);border-left-color:#652c8a;border-width:7px;margin-top:-7px}.form-cho-vay .form-item.step1{--gradient:linear-gradient(rgba(101,44,138,.5),rgba(101,44,138,.5));background-image:url(<?php echo plugins_url('images/buoc1.png', __FILE__ ); ?>),var(--gradient);background-size:cover;background-blend-mode:overlay;color:#fff}.form-cho-vay .form-item.step1 ul{list-style:none;margin:0 0 0 5px;padding:0}.form-cho-vay .form-item.step1 ul li{margin:0 0 5px}.form-cho-vay .form-item.step2{--gradient:linear-gradient(rgba(101,44,138,.5),rgba(101,44,138,.5));background-image:url(<?php echo plugins_url('images/buoc2.png', __FILE__ ); ?>),var(--gradient);background-size:cover;background-blend-mode:overlay;color:#fff}.form-cho-vay .form-item.step2 .slider-description{display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;margin:0 0 10px;width:100%}.form-cho-vay .form-item.step2 .button-vay{display:block;margin:10px 0;padding:5px;text-align:center;font-size:20px;font-weight:700;border-radius:4px;background:#652c8a;color:#fff}.form-cho-vay .form-item.step2 .note{font-size:14px;font-style:italic}.form-cho-vay .form-item.step3{--gradient:linear-gradient(rgba(101,44,138,.5),rgba(101,44,138,.5));background-image:url(<?php echo plugins_url('images/buoc3.png', __FILE__ ); ?>),var(--gradient);background-size:cover;background-blend-mode:overlay;color:#fff}.form-cho-vay .form-item.step3 .vay-hotline{color:#fff;font-size:20px;font-weight:700;text-align:right}.form-cho-vay .form-item.step3 .form-btn{text-align:right;margin-bottom:20px}.form-cho-vay .form-item.step3 .form-btn .button-gui{color:#fff;padding:5px 25px;transition:all .4s;border:2px solid rgba(255,255,255,.2);text-transform:uppercase;border-radius:5px;background-color:#652c8a}.form-cho-vay .form-item.step3 .form-btn .button-gui:hover{-webkit-filter:brightness(150%);filter:brightness(150%);text-decoration:none}.form-cho-vay .form-item.step3 .form-btn .button-gui.disbaled{background:#eee;color:#666}@media screen and (max-width:991px){.form-cho-vay{grid-template-columns:1fr;grid-column-gap:0;grid-row-gap:20px}.form-cho-vay .form-item{width:100%}}.form-group{margin:0 0 10px;padding-bottom:5px;border-bottom:1px dashed #fff;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap}.form-group input[type=text],.form-group input[type=tel],.form-group select{background:transparent;border:none;color:#fff;margin:0;padding:0 5px;width:100%}.form-group input[type=text]::-webkit-input-placeholder,.form-group input[type=tel]::-webkit-input-placeholder,.form-group select::-webkit-input-placeholder{color:#ddd;opacity:.5}.form-group input[type=text]::-moz-placeholder,.form-group input[type=tel]::-moz-placeholder,.form-group select::-moz-placeholder{color:#ddd;opacity:.5}.form-group input[type=text]:-ms-input-placeholder,.form-group input[type=tel]:-ms-input-placeholder,.form-group select:-ms-input-placeholder{color:#ddd;opacity:.5}.form-group input[type=text]::placeholder,.form-group input[type=tel]::placeholder,.form-group select::placeholder{color:#ddd;opacity:.5}.form-group input:focus,.form-group textarea:focus,.form-group select:focus{outline:none}.form-group label{white-space:nowrap}.form-group.province{-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;position:relative}.form-group.province:before{content:'';display:block;width:16px;height:16px;background:url(<?php echo plugins_url('images/arrow.png', __FILE__ ); ?>) center center no-repeat;color:#fff;position:absolute;right:0;top:50%}.form-group.province select{-webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;-o-appearance:none;appearance:none}input[type=range],.slider{-webkit-appearance:none;-moz-apperance:none;outline:none!important;border-radius:6px!important;height:6px!important;width:100%!important}input[type=range]::-webkit-slider-thumb,.slider::-webkit-slider-thumb{-webkit-appearance:none!important;cursor:pointer;background-color:#652c8a;border:2px solid #652c8a;height:20px!important;width:20px!important;border-radius:50%!important}input[type=range]:hover::-webkit-slider-thumb,.slider:hover::-webkit-slider-thumb{-webkit-appearance:none!important;cursor:pointer;height:20px!important;width:20px!important;border-radius:50%!important}

	.form-cho-vay .form-item h4{background: <?php echo get_option('base_color'); ?> ;}
	.form-cho-vay .form-item h4::after{border-left-color: <?php echo $primary_color; ?>;}
	.form-cho-vay .form-item.step2 .button-vay{background: <?php echo $primary_color; ?>;}
	.form-cho-vay .form-item.step3 .form-btn .button-gui{background-color: <?php echo $primary_color; ?>;}
	.form-cho-vay .form-item.step1, .form-cho-vay .form-item.step2, .form-cho-vay .form-item.step3{--gradient:linear-gradient(rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>,<?php echo $overlay_opacity; ?>),rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>,<?php echo $overlay_opacity; ?>));}
 	input[type='range']::-webkit-slider-thumb {background-color: <?php echo $primary_color; ?>; border: 2px solid <?php echo $primary_color; ?>;}
 	</style>
	<div class="form-cho-vay" id="form-cho-vay-<?php echo $randomid; ?>">
		<input type="hidden" id="elita_finance_base_url" value="<?php echo home_url(); ?>">
		<input type="hidden" id="show_promo_code" value="<?php echo $show_promo_code; ?>">
		<input type="hidden" id="thank_you_url" value="<?php echo get_option('thank_you_url'); ?>">
		<div class="form-item step1">
			<h4><?php echo get_option('tieu_de_buoc_1'); ?></h4>
			<?php
			$giay_to = get_option('giay_to');
			if($giay_to):
				$giay_to_arr = explode(";", $giay_to);
				if(!empty($giay_to_arr)): $i=0; ?>
				<ul>
					<?php foreach ($giay_to_arr as $key => $value):
						?>
					<li><input type="checkbox" id="giay_to_<?php echo $i; ?>" name="giay_to[]" value="<?php echo $value; ?>" > <label for="giay_to_<?php echo $i; ?>"> <?php echo $value; ?></label> </li>
						<?php $i++;
					endforeach;?>
				</ul>
				<?php	
				endif;
			endif;
			?>
		</div>
		<div class="form-item step2">
			<h4><?php echo get_option('tieu_de_buoc_2'); ?></h4>
			<p>Số tiền: <strong id="strAmount">0</strong> <strong>VNĐ</strong>
			   <input type="hidden" id="amount" value="0">
			</p>
			<p><input type="range" min="0" max="<?php echo get_option('so_tien_max'); ?>" step="1000000" value="0" class="slider" id="rangePrice"></p>
			<div class="slider-description">
                <span class="bat-dau">0</span>
                <span class="ket-thuc"><?php echo get_option('so_tien_max'); ?></span>
            </div>

            
            <p>Thời gian vay (tháng): <strong id="strMonth">0</strong> <strong>tháng</strong> <input type="hidden" id="month" value="0"></p>
            <p><input type="range" min="1" max="<?php echo get_option('thoi_gian_max'); ?>" step="1" value="1" class="slider" id="rangeMonth"></p>
            <div class="slider-description">
                <span class="bat-dau">0</span>
                <span class="ket-thuc"><?php echo get_option('thoi_gian_max'); ?></span>
            </div>

            <p>Khoản trả góp hàng tháng:</p>
            <div class="button-vay" id="tra_gop_hang_thang">0 VNĐ</div>
            <p class="note"><?php echo get_option('ghi_chu'); ?></p>	   
		</div>
		<div class="form-item step3">
			<h4><?php echo get_option('tieu_de_buoc_3'); ?></h4>
			<div class="form-dangky">
                <div class="form-group">
                    <label>Họ, tên<span class="required">*</span>:</label>
                    <input type="text" name="elita_your_name" id="elita_your_name">
                </div>
               <div class="form-group">
                    <label> Ngày sinh<span class="required">*</span>:</label>
                    <input type="text" placeholder="dd/mm/yyyy" name="elita_your_birthday" id="elita_your_birthday">
                </div>
                <div class="form-group">
                    <label>Số di động<span class="required">*</span>:</label>
                    <input type="tel" name="elita_your_phone" id="elita_your_phone">
                </div>
                <div class="form-group">
                    <label> Số CMND<span class="required">*</span>:</label>
                    <input type="text" name="elita_your_cmnd" id="elita_your_cmnd">
                </div>
	            
	            <div class="form-group province">
	                <label>Tỉnh/ thành phố đang sinh sống<span class="required">*</span>:</label>
	                <select name="elita_tinh_thanh" id="elita_tinh_thanh">
                	<?php global $province_arr; 
                	foreach ($province_arr as $key => $tinh_thanh):?>
					<option value="<?php echo $tinh_thanh; ?>"><?php echo $tinh_thanh; ?></option>
					<?php endforeach; ?>
					</select>
	            </div>
	            <?php if($show_promo_code): ?>
                <div class="form-group">
                    <label>Mã giới thiệu:</label>
                    <input type="text"  name="elita_promocode"id="elita_promocode">
                </div>
                <?php else: ?>
                	<input type="hidden" name="elita_promocode"id="elita_promocode">
            	<?php endif; ?>
                <label style="color: #ebebeb; font-size: 12px;">(*) Bắt buộc</label>
                <div class="form-btn">
                	<button onclick="javascript:elitaFinanceSend();" id="button-gui" class="button-gui ">Gửi</button>
                </div>
            </div>
            <p class="vay-hotline">
                Hotline: <strong><?php echo get_option("so_hotline"); ?></strong>
            </p>
		</div> <!-- step 3 -->
	</div>
 	<?php
 	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

add_action( 'wp_enqueue_scripts', 'elita_finance_scripts' ); 
function elita_finance_scripts() {
	if(!is_admin()):
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'style', plugin_dir_url( __FILE__ )."style.min.css", null,'1.0.3' );
		//wp_register_style( 'elita-finance-css', plugins_url( '/style.min.css', __FILE__ ), null, '1.0.3' );
	endif;
}

/* Add các script xử lý xuống Footer */
function elita_finance_script(){
?>
<script>
	/* Hàm xử lý sự kiện Form cho vay 3 bước. */
	function validatedate(e){var t=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;if(!e.match(t))return!1;var a=e.split("/"),n=e.split("-");if(lopera1=a.length,lopera2=n.length,lopera1>1)var r=e.split("/");else if(lopera2>1)var r=e.split("-");var i=parseInt(r[0]),l=parseInt(r[1]),o=parseInt(r[2]),u=[31,28,31,30,31,30,31,31,30,31,30,31];if((1==l||l>2)&&i>u[l-1])return!1;if(2==l){var s=!1;if((o%4||!(o%100))&&o%400||(s=!0),0==s&&i>=29)return!1;if(1==s&&i>29)return!1}}function validateMobile(e){var t=/((09|03|07|08|05)+([0-9]{8})\b)/g;return""!==e?0==t.test(e)?!1:!0:!1}function elitaFinanceSend(){var e=jQuery("#elita_your_name").val(),t=jQuery("#elita_your_birthday").val(),a=jQuery("#elita_your_phone").val(),n=jQuery("#elita_your_cmnd").val(),r=jQuery("#elita_tinh_thanh").val(),i=jQuery("#elita_promocode").val(),l=jQuery("#amount").val(),o=jQuery("#month").val(),u=jQuery("#thank_you_url").val(),s=jQuery("input[name='giay_to\\[\\]']:checked").map(function(){return jQuery(this).val()}).get(),d="";if(""==s&&(d+="- Vui lòng chọn ít nhất một giấy tờ bạn có\n"),0==l&&(d+="- Vui lòng chọn số tiền muốn vay\n"),0==o&&(d+="- Vui lòng chọn số tháng muốn vay\n"),""==e&&(d+="- Vui lòng nhập họ tên của bạn\n"),0==validatedate(t)&&(d+="- Ngày sinh phải theo định dạng dd/mm/yyyy. Ví dụ 05/03/1987\n"),0==validateMobile(a)&&(d+="- Số điện thoại không hợp lệ\n"),""==n&&(d+="- Vui lòng nhập số CMND/CCCD\n"),""==r&&(d+="- Vui lòng chọn nơi bạn đang sinh sống\n"),d)alert(d);else{jQuery("#button-gui").text("VUI LÒNG ĐỢI...").addClass("disabled").attr("disabled","disabled");var c=jQuery("#elita_finance_base_url").val(),y={action:"financeSend",your_name:e,your_birthday:t,your_phone:a,your_cmnd:n,tinh_thanh:r,promocode:i,amount:l,month:o,giay_to:s};jQuery.post(c+"/wp-admin/admin-ajax.php",y,function(e){alert(e),clearAllData(),jQuery("#button-gui").text("GỬI").removeAttr("disabled").removeClass("disabled"),u&&(window.location.href=""+u)})}}function clearAllData(){jQuery("#elita_your_name").val(""),jQuery("#elita_your_birthday").val(""),jQuery("#elita_your_phone").val(""),jQuery("#elita_your_cmnd").val(""),jQuery("#elita_tinh_thanh").val(""),jQuery("#elita_promocode").val("")}jQuery(document).ready(function(){function e(e,t){var a={action:"CalPrice",amount:e,month:t},n=jQuery("#elita_finance_base_url").val();jQuery.ajax({cache:!1,url:n+"/wp-admin/admin-ajax.php",data:a,type:"post",success:function(e){jQuery(".button-vay").text(parseInt(e).format()+" VNĐ"),console.log(e)},complete:this.resetLoadWaiting,error:this.ajaxFailure})}Number.prototype.format=function(e,t,a,n){var r="\\d(?=(\\d{"+(t||3)+"})+"+(e>0?"\\D":"$")+")",i=this.toFixed(Math.max(0,~~e));return(n?i.replace(".",n):i).replace(new RegExp(r,"g"),"$&"+(a||","))};var t=document.getElementById("rangePrice"),a=document.getElementById("rangeMonth");t.oninput=function(){e(t.value,a.value),jQuery("#strAmount").text(parseInt(this.value).format()),jQuery("#amount").val(this.value)},a.oninput=function(){e(t.value,a.value),jQuery("#strMonth").text(parseInt(this.value).format()),jQuery("#month").val(this.value)}});	
</script>
<?php
}


// Ajax tính khoản trả hàng tháng
add_action( 'wp_ajax_CalPrice', 'CalPrice' );
add_action( 'wp_ajax_nopriv_CalPrice', 'CalPrice' );

function CalPrice()
{
	$amount = intval($_POST['amount']);
	$month = intval($_POST['month']);	
	$lai_suat_nam = floatval(get_option('lai_suat_nam'));
	/* Công thức:
		1/ Lãi suất hàng tháng = Số tiền vay * lãi suất/12(tháng)
		2/ Số tiền trả hàng tháng = (Số tiền vay/ số tháng vay) + Lãi suất hàng tháng
	*/
	$lai_suat_hang_thang = ($amount * $lai_suat_nam/100)/12;
	$tien_tra_hang_thang = ($amount / $month) + $lai_suat_hang_thang;

	echo $tien_tra_hang_thang;

	?>
	<?php
	wp_die();
}


// Ajax Gửi Email
add_action( 'wp_ajax_financeSend', 'financeSend' );
add_action( 'wp_ajax_nopriv_financeSend', 'financeSend' );
function financeSend(){
	$your_name     = trim($_POST["your_name"]);
	$your_birthday = trim($_POST["your_birthday"]);
	$your_phone    = trim($_POST["your_phone"]);
	$your_cmnd     = trim($_POST["your_cmnd"]);
	$tinh_thanh    = trim($_POST["tinh_thanh"]);
	$promocode     = trim($_POST["promocode"]);
	$amount        = trim($_POST["amount"]);
	$month     	   = trim($_POST["month"]);
	$giay_to       = ($_POST["giay_to"]); //array

	$admin_email   = trim(get_option( 'admin_email' ));
	$email_nguoi_nhan = trim(get_option('email_nguoi_nhan')); 

	if($your_name && $your_birthday && $your_phone && $your_cmnd && $tinh_thanh ):
		$to 	 = $email_nguoi_nhan?$email_nguoi_nhan:$admin_email;
		$subject = $your_name.' - Đăng ký vay '.number_format($amount).' VNĐ trong ['.$month.' tháng] vào ngày '.date("d/m/Y").' lúc '.date("H:s:i");
		 
		$body = '<div style="background:#fafafa;border:#ccc solid 2px;padding:30px;margin:20px;">
					<p>Chào Admin, khách hàng <strong>'.$your_name.'</strong>, vừa thực hiện vay theo Quy trình vay 3 bước trên website của chúng ta. Dưới đây là thông tin vay của khách hàng:</p>';
		$body .= '<p>Họ tên: <strong>'.$your_name.'</strong></p>';
		$body .= '<p>Ngày sinh: <strong>'.$your_birthday.'</strong></p>';
		$body .= '<p>Điện thoại: <strong>'.$your_phone.'</strong></p>';
		$body .= '<p>CMND/CCCD: <strong>'.$your_cmnd.'</strong></p>';
		$body .= '<p>Nơi sống: <strong>'.$tinh_thanh.'</strong></p>';
		$body .= '<p>Mã giới thiệu: <strong>'.$promocode.'</strong></p>';
		$body .= '<p>Số tiền vay: <strong>'.number_format($amount).' VNĐ</strong></p>';
		$body .= '<p>Số tháng vay: <strong>'.$month.' (tháng)</strong></p>';

		$lai_suat_nam = floatval(get_option('lai_suat_nam'));
		$lai_suat_hang_thang = ($amount * $lai_suat_nam/100)/12;
		$tien_tra_hang_thang = ($amount / $month) + $lai_suat_hang_thang; 	 
		$body .= '<p>Lãi phải trả hàng tháng: <strong>'.number_format($tien_tra_hang_thang).' VNĐ</strong></p>';

		$body .= '<p><strong>Giấy tờ có:</strong></p>';

		 if(!empty($giay_to)){
		 	foreach ($giay_to as $key => $value) {
		 		$body .= '<p>- '.$value.'</p>';
		 	}
		 }	
		 
		 $body .= '<br><hr size="1">';
		 $body .= '<p><strong>Lưu ý:</strong> Thông tin này được gửi từ Form đăng ký vay 3 bước trên website '.home_url( '/').'</p>';
		 $body .= '</div>';
		 
		 $headers[] = 'Content-Type: text/html; charset=UTF-8';
		 $headers[] = "From: [CHO VAY 3 BƯỚC] ".$admin_email." ";
		 $headers[] = 'Reply-To: [CHO VAY 3 BƯỚC] '.$admin_email.' ';
		 
		 wp_mail( $to, $subject, $body, $headers );

		 echo "Đã gửi email thành công! Cảm ơn bạn.";
		 wp_die();
	else:
		echo "Vui lòng nhập đầy đủ các trường được yêu cầu.";
	endif;
}
