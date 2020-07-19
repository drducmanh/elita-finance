/* Hàm xử lý sự kiện Form cho vay 3 bước. */

function validatedate(inputText){
  var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
  // Match the date format through regular expression
  if(inputText.match(dateformat)){
    //Test which seperator is used '/' or '-'
    var opera1 = inputText.split('/');
    var opera2 = inputText.split('-');
    lopera1 = opera1.length;
    lopera2 = opera2.length;
    // Extract the string into month, date and year
    if (lopera1>1){
      var pdate = inputText.split('/');
    }
    else if (lopera2>1){
      var pdate = inputText.split('-');
    }

    var dd = parseInt(pdate[0]);
    var mm  = parseInt(pdate[1]);
    var yy = parseInt(pdate[2]);
    
    // Create list of days of a month [assume there is no leap year by default]
    var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
    if (mm==1 || mm>2){
      if (dd>ListofDays[mm-1]){
        return false;
      }
    }

    if (mm==2){
      var lyear = false;
      if ( (!(yy % 4) && yy % 100) || !(yy % 400)){
        lyear = true;
      }
    
      if ((lyear==false) && (dd>=29)){
        return false;
      }
      
      if ((lyear==true) && (dd>29)){
        return false;
      }
    }

  }
  else{
    return false;
  }
}



function validateMobile(txt){
    var my_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    if(txt !==''){
      if (my_regex.test(txt) == false){
              return false;
          }else{
              return true;
          }
    }
    else{
      return false;
    }
  }


jQuery(document).ready(function (){
    Number.prototype.format = function (n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };

    var slider = document.getElementById("rangePrice");
        var slider2 = document.getElementById("rangeMonth");

        slider.oninput = function () {
            calPrice(slider.value, slider2.value);
            jQuery("#strAmount").text(parseInt(this.value).format());
            jQuery("#amount").val(this.value);
        }
        slider2.oninput = function () {
            calPrice(slider.value, slider2.value);
            jQuery("#strMonth").text(parseInt(this.value).format());
            jQuery("#month").val(this.value);
        }

        function calPrice(amount, month) {
            var data = { 'action': 'CalPrice', 'amount': amount, 'month': month };
            //console.log(data);
            var baseUrl = jQuery('#elita_finance_base_url').val();
            jQuery.ajax({
                cache: false,
                url: baseUrl+'/wp-admin/admin-ajax.php',
                data: data,
                type: 'post',
                success: function (response) {
                    jQuery(".button-vay").text(parseInt(response).format() + " VNĐ");
                    console.log(response);
                },
                complete: this.resetLoadWaiting,
                error: this.ajaxFailure
            });
        }
  });

  function elitaFinanceSend(){
    var your_name     = jQuery('#elita_your_name').val();
    var your_birthday = jQuery('#elita_your_birthday').val();
    var your_phone    = jQuery('#elita_your_phone').val();
    var your_cmnd     = jQuery('#elita_your_cmnd').val();
    var tinh_thanh    = jQuery('#elita_tinh_thanh').val();
    var promocode     = jQuery('#elita_promocode').val();
    var amount        = jQuery('#amount').val();
    var month         = jQuery('#month').val();
    var thank_you_url = jQuery('#thank_you_url').val();
    var giay_to = jQuery("input[name='giay_to\\[\\]']:checked").map(function(){
              return jQuery(this).val();
            }).get(); // return array
    var error_msg     = "";
    if(giay_to ==""){ error_msg += '- Vui lòng chọn ít nhất một giấy tờ bạn có\n';}
    if(amount==0){ error_msg += '- Vui lòng chọn số tiền muốn vay\n'; }
    if(month==0){error_msg += '- Vui lòng chọn số tháng muốn vay\n';}
    if(your_name==""){error_msg += '- Vui lòng nhập họ tên của bạn\n';}
    if(validatedate(your_birthday)==false){error_msg += '- Ngày sinh phải theo định dạng dd/mm/yyyy. Ví dụ 05/03/1987\n';}
    if( validateMobile(your_phone)==false){error_msg += '- Số điện thoại không hợp lệ\n';}
    if(your_cmnd==""){error_msg += '- Vui lòng nhập số CMND/CCCD\n';}
    if(tinh_thanh==""){error_msg += '- Vui lòng chọn nơi bạn đang sinh sống\n';}    
    if(error_msg){alert(error_msg);}
    else{
      jQuery("#button-gui").text('VUI LÒNG ĐỢI...').addClass('disabled').attr("disabled", 'disabled');
      var baseUrl = jQuery('#elita_finance_base_url').val();
      var data = {"action": "financeSend","your_name":your_name,"your_birthday":your_birthday,"your_phone":your_phone,"your_cmnd":your_cmnd,"tinh_thanh":tinh_thanh,"promocode":promocode,"amount":amount,"month":month,"giay_to":giay_to};
          jQuery.post(baseUrl+"/wp-admin/admin-ajax.php", data, function(response) {
            alert(response); clearAllData();
            jQuery("#button-gui").text('GỬI').removeAttr('disabled').removeClass('disabled');
            if(thank_you_url){
              window.location.href= ""+thank_you_url+"";
            }
          });
    }
  }

  function clearAllData(){
    jQuery('#elita_your_name').val('');jQuery('#elita_your_birthday').val('');jQuery('#elita_your_phone').val('');jQuery('#elita_your_cmnd').val('');jQuery('#elita_tinh_thanh').val('');jQuery('#elita_promocode').val('');
  }