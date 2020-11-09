/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});


$(document).ready(function(){
$("#selSize").change(function(){
   var idSize = $(this).val();
   if (idSize == "") {
     return false;
   }
   $.ajax({
     type:'get',
     url:'get-product-price',
     data:{idSize:idSize},
     success:function(resp){
       var arr = resp.split('#');
      $("#getPrice").html("&#2547;" +arr[0]);
        $("#price").val(arr[0]);

      if (arr[1] ==0) {

      $("#cartButton").hide();
      $("#Availability").text("Out of stock");
    }else {
      $("#cartButton").show();
      $("#Availability").text("In stock");
    }
     }
   });
});
});

$().ready(function(){
  //Valid register form
  $("#registerForm").validate({
    rules:{
      name:{
        required:true,
        minlength:2,
        accept: "[a-zA-Z]+"
      },
      password:{
        required:true,
        minlength:6
      },
      email:{
        required:true,
        email:true,
        remote:"check-email"
      }
    },
    messages:{
      name:{
      required:"Please enter your Name",
      minlength:"Your Name must be atleast 2 characters long",
      accept: "Your Name must be contain letter only"

    },
      password:{
        required:"please provide your Password",
        minlength:"Your Password must be atleast 6 character long"
      },
      email:{
        required:"Please enter your Email",
        email:"Please enter valid Email",
        remote:"This email already exists"
      }
    }
  });

  //Account Validtion

  $("#accountForm").validate({
    rules:{
      name:{
        required:true,
        minlength:2,
        accept: "[a-zA-Z]+"
      }
    },
    messages:{
      name:{
      required:"Please enter your name",
      accept: "Your Name must be contain letter only"

    }
    }
  });


//Valid Login Form
  $("#loginForm").validate({
    rules:{
      email:{
        required:true,
        email:true,

      },

      password:{
        required:true,

      }

    },
    messages:{
      email:{
        required:"Please enter your Email",
        email:"Please enter valid Email",
      },
      password:{
        required:"please provide your Password"
      }
    }
  });

  //check CUrrent Password
  $("#current_pwd").keyup(function(){
  var current_pwd = $(this).val();
  $.ajax({
    type:'get',
    url: 'check-user-pwd',
    data:{current_pwd:current_pwd},
    success:function(resp){
      if (resp=="false") {
        $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>")
      }else if(resp=="true"){
          $("#chkPwd").html("<font color='green'>Current Password is correct</font>")
      }
    },error:function(){
      alert("faild");
    }
  });
});

//Password validator
$("#passwordForm").validate({
  rules:{
    current_pwd:{
      required: true,
      minlength:6,
      maxlength:20
    },
    new_pwd:{
      required: true,
      minlength:6,
      maxlength:20
    },
  confirm_pwd:{
      required:true,
      minlength:6,
      maxlength:20,
      equalTo:"#new_pwd"
    }
  },
  errorClass: "help-inline",
  errorElement: "span",
  highlight:function(element, errorClass, validClass) {
    $(element).parents('.control-group').addClass('error');
  },
  unhighlight: function(element, errorClass, validClass) {
    $(element).parents('.control-group').removeClass('error');
    $(element).parents('.control-group').addClass('success');
  }
});



$('#new_pwd').passtrength({
  minChars: 6,
  passwordToggle: true,
  tooltip: true,
  eyeImg :"images/frontend_images/eye.svg"
});


//check password strong
    $('#myPassword').passtrength({
      minChars: 4,
      passwordToggle: true,
      tooltip: true,
      eyeImg :"images/frontend_images/eye.svg"
    });
//Copy Billing Address to Shipping Address Script
$("#copyAddress").click(function(){
  if (this.checked) {
    $("#shipping_name").val($("#billing_name").val());
    $("#shipping_address").val($("#billing_address").val());
    $("#shipping_city").val($("#billing_city").val());
    $("#shipping_state").val($("#billing_state").val());
    $("#shipping_country").val($("#billing_country").val());
    $("#shipping_pincode").val($("#billing_pincode").val());
    $("#shipping_mobile").val($("#billing_mobile").val());

  }else {
    $("#shipping_name").val('');
    $("#shipping_address").val('');
    $("#shipping_city").val('');
    $("#shipping_state").val('');
    $("#shipping_country").val('');
    $("#shipping_pincode").val('');
    $("#shipping_mobile").val('');
  }


});

});

function selectPaymentMethod(){
if ($('#Paypal').is(':checked') || $('#COD').is(':checked') ) {
  // alert("checked");
}else {
  alert("Please Select Payment Method");
  return false;
}

}
