<?php
 /*
 Plugin Name: Elita Finance
 Plugin URI: https://dichthuatphuongdong.com
 Description: Tạo ra Shortcode: <strong>[form_chovay]</strong> chèn vào bài viết để hiển thị ra Form cho vay tài chính 3 bước. 
 Version: 1.4
 Author: Nguyen Duc Manh
 Author URI: https://www.facebook.com/drducmanh
 */

define( 'ELITA_FINANCE_PLUGIN', __FILE__ );
define( 'ELITA_FINANCE_PLUGIN_DIR', untrailingslashit( dirname( ELITA_FINANCE_PLUGIN ) ) );

require_once ELITA_FINANCE_PLUGIN_DIR . '/front.php';


add_action('admin_menu', 'elita_finance_menu');
/* What to do when the plugin is activated? */
register_activation_hook(__FILE__,'elita_finance_install');
/* What to do when the plugin is deactivated? */
register_deactivation_hook( __FILE__, 'elita_finance_uninstall' );


// Khi install thi khoi tao cac gia tri ban dau
function elita_finance_install(){
	if(!get_option('so_tien_max')){
		add_option('so_tien_max',100000000);
	}
	if(!get_option('thoi_gian_max')){
		add_option('thoi_gian_max',36);
	}
	if(!get_option('lai_suat_nam')){
		add_option('lai_suat_nam',12); /* 12%/năm */
	}

	if(!get_option('tieu_de_buoc_1')){
		add_option('tieu_de_buoc_1','BƯỚC 1 - CÁC GIẤY TỜ BẠN CÓ'); /* 12%/năm */
	}
	if(!get_option('tieu_de_buoc_2')){
		add_option('tieu_de_buoc_2','BƯỚC 2 - KHOẢN TIỀN VAY'); /* 12%/năm */
	}
	if(!get_option('tieu_de_buoc_3')){
		add_option('tieu_de_buoc_3','BƯỚC 3 - ĐĂNG KÝ VAY'); /* 12%/năm */
	}

	if(!get_option('so_hotline')){
		add_option('so_hotline','1900 2198'); /* 12%/năm */
	}
	if(!get_option('email_nguoi_nhan')){
		add_option('email_nguoi_nhan',get_option('admin_email')); /* 12%/năm */
	}

	if(!get_option('base_color')){
		add_option('base_color','#f68121'); /* màu của shb */
	}
	if(!get_option('overlay_opacity')){
		add_option('overlay_opacity','0.5'); /* màu của shb */
	}
	if(!get_option('ghi_chu')){
		add_option('ghi_chu','* Ghi chú: Kết quả tính toán này chỉ mang tính chất tham khảo'); /* màu của shb */
	}
	
	if(!get_option('giay_to')){
		add_option('giay_to','Sao kê lương/ xác nhận lương;HĐLĐ;BHYT/BHXH;Hóa đơn điện/nước;Giấy phép ĐKKD/ Hợp đồng thuê sạp;Hợp đồng bảo hiểm nhân thọ;Hóa đơn truyền hình cáp/ internet/ điện thoại cố định/ thuê bao di động trả sau;Sao kê tài khoản ngân hàng;Hộ chiếu;Chứng nhận đăng ký xe');
	}
}

//Khi xoa thi delete...
function elita_finance_uninstall(){
	global $wpdb;
   /* delete_option('so_tien_max');
    delete_option('thoi_gian_max');
	delete_option('giay_to');*/
}

function elita_finance_menu() {
	add_menu_page('Cho Vay 3 Bước', 'Cho Vay 3 Bước', 'edit_pages', 'form_cai_dat',  'form_cai_dat_func','dashicons-index-card' );

	add_submenu_page( 'form_cai_dat', 'Cài đặt tài chính', 'Cài đặt tài chính', 'edit_pages', 'form_cai_dat', 'form_cai_dat_func' );

	add_submenu_page( 'form_cai_dat', 'Giấy tờ bạn có', 'Giấy tờ bạn có', 'edit_pages', 'form_giay_to', 'form_giay_to_func' );
	add_submenu_page( 'form_cai_dat', 'Cài đặt khác', 'Cài đặt khác', 'edit_pages', 'form_cai_dat_khac', 'form_cai_dat_khac_func' );
	add_submenu_page( 'form_cai_dat', 'Hướng dẫn sử dụng', 'Hướng dẫn', 'edit_pages', 'form_huong_dan', 'form_huong_dan_func' );
}

/* Form cài đặt các thông số */
function form_cai_dat_func(){
	global $wpdb,$post;

	if($_POST['submit_setting']){
		if ( get_option('so_tien_max') !== false ) {
			update_option('so_tien_max',(($_POST['so_tien_max'])));
		}	
		else{
			add_option('so_tien_max',(($_POST['so_tien_max'])));
		}

		if ( get_option('thoi_gian_max') !== false ) {
			update_option('thoi_gian_max',(($_POST['thoi_gian_max'])));
		}	
		else{
			add_option('thoi_gian_max',(($_POST['thoi_gian_max'])));
		}	

		if ( get_option('lai_suat_nam') !== false ) {
			update_option('lai_suat_nam',(($_POST['lai_suat_nam'])));
		}	
		else{
			add_option('lai_suat_nam',(($_POST['lai_suat_nam'])));
		}		
		
		?>
		<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong>Đã lưu mọi thông số.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Bỏ qua </span></button></div>
		<?php
	} // setting

	?>
	<h1><span class="dashicons dashicons-index-card"></span> Cài đặt tài chính</h1>
	<p><strong> <span style="color:#c82254;">Lãi suất hàng tháng = Số tiền vay * lãi suất/12(tháng)</span>. <br><span style="color:#28a745;">Số tiền trả hàng tháng = (Số tiền vay/ số tháng vay) + Lãi suất hàng tháng</span></strong></p>
	<form method="post" id="form_cho_vay_3_buoc">	
		<table class="form-table">
			<tbody>
	        	<tr valign="top"> 
					<th  scope="row"><label for="my-text-field">Khoản vay tối đa</label></th>
					<td scope="row">			
						<input type="number" min="0" step="1" name="so_tien_max" id="so_tien_max" class="all-options" value="<?php echo get_option('so_tien_max'); ?>" /> VNĐ
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="my-text-field">Thời gian tối đa</label></th>
					<td scope="row">			
						<input type="number" min="0" step="1" name="thoi_gian_max" id="thoi_gian_max" class="small-text" value="<?php echo get_option('thoi_gian_max'); ?>" /> Tháng
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="my-text-field">Lãi suất theo năm</label></th>
					<td scope="row">			
						<input type="number" min="0" step="0.1" name="lai_suat_nam" id="lai_suat_nam" class="small-text" value="<?php echo get_option('lai_suat_nam'); ?>" /> % <br>
					</td> 
				</tr>
					           
	            <tr valign="top"> 
					<th  scope="row"></th> 
					<td scope="row">			
						<p class="submit"><input type="submit" name="submit_setting" id="submit" class="button button-primary" value="Lưu lại"></p>
					</td> 
				</tr>
			</tbody>
		</table> 

	</form>
	<?php
}

/* Form cài đặt các loại giấy tờ */
function form_giay_to_func(){
	if(isset($_POST['submit_form_giay_to'])){
		$giay_to = $_POST["giay_to"];
		if(!empty($giay_to)){
			$giay_to_str = implode(';', $giay_to);
			//print_r($giay_to_str);
			update_option('giay_to',$giay_to_str);
		}
	}
	?>
	<h1><span class="dashicons dashicons-format-aside"></span> Các loại giấy tờ</h1>
	<form method="post" id="form_giay_to">
		<div id="allrow">
		<?php
			$giay_to = get_option('giay_to');

			$giay_to_arr = explode(";", $giay_to);
			$i = 0; $total_row = 0;
			if(!empty($giay_to_arr)):
				$total_row = count($giay_to_arr);
		 ?>	
			<input type="hidden" id="total_row" value="<?php echo $total_row; ?>">
			<?php foreach ($giay_to_arr as $key => $value):
					$j = $i+1;
			?>
	    	<div  id="row_<?php echo $i; ?>"> 
				<p>			
					<?php if($i<9) echo "0"; ?><?php echo $j; ?>/ <input type="text" name="giay_to[]" id="giay_to_<?php echo $i; ?>" class="regular-text" placeholder="Tên loại giấy tờ" value="<?php echo trim($value); ?>" />  <a href="javascript:void(0);" onclick="javascript:jQuery('#row_<?php echo $i; ?>').remove();">&times;</a>
				</p> 
			</div>
		
		<?php
			$i++;
			endforeach;
		 endif; ?>
	
		</div> <!-- #allrow -->
		<p>&nbsp;</p>
		<p>			
			<input type="button" id="add_giay_to" class="button button-Secondary" onclick="javascript:addGiayTo();" value="Thêm giấy tờ +" />
		</p> 
		<hr size="1">	          	            
		<p><input type="submit" name="submit_form_giay_to" id="submit" class="button button-primary" value="Lưu lại thông tin ngay"></p>
	</form>
	<script>
		function addGiayTo(){
			var total_row = parseInt(jQuery('#total_row').val());
			var stt 	  = total_row+1;
			var i         = total_row;
			var new_row   = '<div id="row_'+i+'"><p>'+stt+'/ <input type="text" name="giay_to[]" id="giay_to_'+i+'" class="regular-text" placeholder="Tên loại giấy tờ" />  <a href="javascript:void(0);" onclick="javascript:jQuery(\'#row_'+i+'\').remove();">&times;</a></p></div>';
			jQuery('#allrow').append(new_row);
			jQuery('#total_row').val(total_row+1);
		}
	</script>
	<?php
}


function elita_enqueue_color_picker( $hook) {
    /*$screen = get_current_screen(); 
	print_r($screen);*/
    if('cho-vay-3-buoc_page_form_cai_dat_khac' === $hook){
	    wp_enqueue_style( 'wp-color-picker' );
	    //wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	    wp_enqueue_script( 'wp-color-picker');
    }
}
add_action( 'admin_enqueue_scripts', 'elita_enqueue_color_picker' );


/* Cài đặt khác */
function form_cai_dat_khac_func(){

	if(isset($_POST['btn_cai_dat_khac'])):
		$tieu_de_buoc_1   = trim($_POST["tieu_de_buoc_1"]);	
		$tieu_de_buoc_2   = trim($_POST["tieu_de_buoc_2"]);	
		$tieu_de_buoc_3   = trim($_POST["tieu_de_buoc_3"]);	
		$so_hotline       = trim($_POST["so_hotline"]);	
		$email_nguoi_nhan = trim($_POST["email_nguoi_nhan"]);	
		$base_color 	  = trim($_POST["base_color"]);	
		$ghi_chu 	  	  = trim($_POST["ghi_chu"]);	
		$thank_you_url 	  = trim($_POST["thank_you_url"]);	
		$overlay_opacity  = floatval($_POST["overlay_opacity"]);	

		if($tieu_de_buoc_1){
			update_option('tieu_de_buoc_1',$tieu_de_buoc_1);
		}
		if($tieu_de_buoc_2){
			update_option('tieu_de_buoc_2',$tieu_de_buoc_2);
		}
		if($tieu_de_buoc_3){
			update_option('tieu_de_buoc_3',$tieu_de_buoc_3);
		}
		if($so_hotline){
			update_option('so_hotline',$so_hotline);
		}
		if($email_nguoi_nhan){
			update_option('email_nguoi_nhan',$email_nguoi_nhan);
		}

		if($base_color){
			update_option('base_color',$base_color);
		}

		update_option('overlay_opacity',$overlay_opacity);
		

		if(isset($_POST["show_promo_code"])){
			$show_promo_code = 1;
		}
		else{
			$show_promo_code = 0;
		}
		update_option('show_promo_code',$show_promo_code);

		if($ghi_chu){
			update_option('ghi_chu',$ghi_chu);
		}

		if($thank_you_url){
			update_option('thank_you_url',$thank_you_url);
		}

		

		
	?>
		<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
		<p><strong>Đã lưu thành công!</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Bỏ qua </span></button></div>
	<?php endif;
	?>
	<style>
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 60px;
		  height: 34px;
		}

		.switch input { 
		  opacity: 0;
		  width: 0;
		  height: 0;
		}

		.toggle {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		  border-radius: 34px;
		}

		.toggle:before {
		  position: absolute;
		  content: "";
		  height: 26px;
		  width: 26px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		  border-radius: 50%;
		}

		input:checked + .toggle {
		  background-color: #2196F3;
		}

		input:focus + .toggle {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .toggle:before {
		  -webkit-transform: translateX(26px);
		  -ms-transform: translateX(26px);
		  transform: translateX(26px);
		}

	</style>
	<h1><span class="dashicons dashicons-admin-generic"></span> Cài đặt khác</h1>
	<form method="post" id="form_cai_dat_khac">
		<table class="form-table">
			<tbody>
				<tr><td colspan="2"><h2><span class="dashicons dashicons-category"></span> 1. Cài đặt Form</h2></td></tr>
	        	<tr valign="top"> 
					<th  scope="row"><label for="tieu_de_buoc_1">Tiêu đề bước 1</label></th>
					<td scope="row">			
						<input type="text" name="tieu_de_buoc_1" id="tieu_de_buoc_1" placeholder="BƯỚC 1 - CÁC GIẤY TỜ BẠN CÓ" class="regular-text" value="<?php echo get_option('tieu_de_buoc_1'); ?>" />
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="tieu_de_buoc_2">Tiêu đề bước 2</label></th>
					<td scope="row">			
						<input type="text" name="tieu_de_buoc_2" id="tieu_de_buoc_2" placeholder="BƯỚC 2 - KHOẢN TIỀN VAY" class="regular-text" value="<?php echo get_option('tieu_de_buoc_2'); ?>" />
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="tieu_de_buoc_3">Tiêu đề bước 3</label></th>
					<td scope="row">			
						<input type="text" name="tieu_de_buoc_3" id="tieu_de_buoc_3" placeholder="BƯỚC 3 - ĐĂNG KÝ VAY" class="regular-text" value="<?php echo get_option('tieu_de_buoc_3'); ?>" />
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="ghi_chu">Ghi chú</label></th>
					<td scope="row">			
						<input type="text" name="ghi_chu" id="ghi_chu" class="regular-text" placeholder="* Ghi chú: Kết quả tính toán này chỉ mang tính chất tham khảo" value="<?php echo get_option('ghi_chu'); ?>" />
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="so_hotline">Số hotline</label></th>
					<td scope="row">			
						<input type="text" name="so_hotline" id="so_hotline" class="regular-text" placeholder="1900 2198" value="<?php echo get_option('so_hotline'); ?>" />
					</td> 
				</tr>
					
				<?php $show_promo_code = get_option('show_promo_code'); ?>
				<tr valign="top"> 
					<th  scope="row">Hiển thị mã giới thiệu?</th>
					<td scope="row">			
						<label class="switch">
						  <input type="checkbox" id="show_promo_code" name="show_promo_code" <?php if($show_promo_code): ?> checked <?php endif;?>>
						  <span class="toggle"></span>
						</label>
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="thank_you_url">Url trang thank you</label></th>
					<td scope="row">			
						<input type="text" name="thank_you_url" id="thank_you_url" class="regular-text" placeholder="<?php echo home_url( '/thank-you/'); ?>" value="<?php echo get_option('thank_you_url'); ?>" />
						<p class="description">Dùng để đo chuyển đổi. Bỏ qua nếu bạn không đo chuyển đổi</p>
					</td> 
				</tr>
				
				<tr><td colspan="2"><h2><span class="dashicons dashicons-email"></span> 2. Cài đặt Email</h2></td></tr>
				<tr valign="top"> 
					<th  scope="row"><label for="email_nguoi_nhan">Email người nhận</label></th>
					<td scope="row">			
						<input type="email" name="email_nguoi_nhan" id="email_nguoi_nhan" class="regular-text" placeholder="ho_ten@gmail.com" value="<?php echo get_option('email_nguoi_nhan')?get_option('email_nguoi_nhan'):get_option( 'admin_email' ); ?>" />
					</td> 
				</tr>

				<tr><td colspan="2"><h2><span class="dashicons dashicons-images-alt2"></span> 3. Cài đặt giao diện</h2></td></tr>

				<tr valign="top"> 
					<th  scope="row"><label for="base_color">Màu chủ đạo</label></th>
					<td scope="row">			
						<input type="text" value="<?php echo get_option('base_color')?get_option('base_color'):"#652c8a"; ?>" class="base_color" id="base_color" name="base_color" data-default-color="#f68121" />
						hoặc chọn theo <select name="ngan_hang" id="ngan_hang" onchange="changeBank(this.value);">
							<option value="#f68121">--- Ngân hàng ---</option>
							<?php 
								$arr_bank = array("#E13C31" => 'Techcombank',
												  "#3A7747" => 'Vietcombank',
												  "#B93027" => 'Vietinbank',
												  '#21409A' => 'BIDV',
												  '#B12F40'	=> 'Agribank',
												  '#4A9343' => 'VPBank',
												  '#642C83' => 'TPbank',
												  '#1966B3' => 'VIB*',
												  '#E93F33' => 'MSB',
												  '#213CD2' => 'MB',
												  '#DA3A2F' => 'HD Bank',
												  '#0D529B' => 'Shinhan Bank',
												  '#f68121' => 'SHB'
												 );

								foreach($arr_bank as $bank_key => $bank_name):
							 ?>
							<option value="<?php echo $bank_key; ?>" <?php if(get_option('base_color') == $bank_key): ?> selected <?php endif; ?> ><?php echo $bank_name; ?></option>
							<?php endforeach; ?>
						</select>
					</td> 
				</tr>

				<tr valign="top"> 
					<th  scope="row"><label for="base_color">Overlay opacity</label></th>
					<td scope="row">
						<input type="number" min="0" max="1" step="0.1" value="<?php echo get_option('overlay_opacity'); ?>" class="small-text" name="overlay_opacity" id="overlay_opacity" >
					</td> 
				</tr>
					           
	            <tr valign="top"> 
					<th  scope="row"></th> 
					<td scope="row">			
						<p class="submit"><input type="submit" name="btn_cai_dat_khac" id="submit" class="button button-primary" value="Lưu lại"></p>
					</td> 
				</tr>
			</tbody>
		</table> 		
	</form>
	<script>
		jQuery(document).ready(function($){
		    jQuery('#base_color').wpColorPicker();
		});

		function changeBank(color_code){
			jQuery("#base_color").val(color_code);
			jQuery(".wp-color-result").css('background-color',color_code);			
		}
	</script>
	<?php
}


function form_huong_dan_func(){
	?>
		<h1>Hướng dẫn sử dụng <span class="dashicons dashicons-editor-help"></span></h1>
		<p>Plugin này sẽ tạo ra Shortcode <strong>[form_chovay]</strong> để hiển thị Form quy trình vay 3 bước. Để sử dụng, bạn hãy chèn shortcode này vào bài viết bạn muốn hiển thị form này. </p>
		<p>Trường hợp bạn muốn hiển thị trong code của themes. Hãy chèn đoạn này vào code:</p>
		<blockquote style="border-left:#c82254 solid 5px;padding:5px 5px 5px 15px;"><prev> <?php echo htmlspecialchars("<?php do_shortcode( '[form_chovay]' ); ?>"); ?> </prev></blockquote>
		<br>
		<hr>
		<p>Cần hướng dẫn thêm? <a href="https://m.me/drducmanh" target="_blank">Liên hệ</a></p>

	<?php
}