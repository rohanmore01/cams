$(document).ready(function() 
{
  $('.data-table').DataTable({
    "order": [[ 0, "desc" ]],
  });

  var value = $("#password").val();

    $.validator.addMethod("checklower", function(value) {
      return /[a-z]/.test(value);
    });
    $.validator.addMethod("checkupper", function(value) {
      return /[A-Z]/.test(value);
    });
    $.validator.addMethod("checkdigit", function(value) {
      return /[0-9]/.test(value);
    });

  $("form[name='myForm']").validate({

      rules: {  
        email: "required",
        password: {
        minlength: 6,
        required: true,
        checklower: true,
        checkupper: true,
        checkdigit: true
        },
        c_password: {
        required: true,
        equalTo: "#password",
        }
      },

      messages: {
        password: {
        checklower: "Need atleast 1 lowercase alphabet",
        checkupper: "Need atleast 1 uppercase alphabet",
        checkdigit: "Need atleast 1 digit"
        },
        c_password: { 
          required: "This field is required.",
          equalTo: "Confirm Password should be same as password"
        }
      },
      submitHandler: function (form) {
      form.submit();
      }
  });

  $(document).on('click', '[name="submit-login-form"]', function(e) {

      var password = $('#password').val();
      
      if(password != '')
      {
      var salt = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
      password = password+salt;
      $('#password').val(password);
      }
      else
      {
      e.preventDefault();
      }
  });

  $(document).on('change', '#type_of_application, #department', function() {

      var appType = $('#type_of_application').val();
      var department = $('#department').val();
    
      var base_url =  window.location.origin;

      if(appType != '' && department != '')
      {
          $.ajax({
            url:'getCamsDueDate',
            method: 'POST',
            data: {
                appType: appType,
                department: department
            },
            error: err => console.log(err),
            success: function(resp) {
                $('#due_date').val(resp);
            }
          });
      }
  })

  setTimeout(function() 
  {
    $(".alert").delay(1000).fadeOut(800);
  }); 

  $(document).on('click', '#searchByAckNo', function() {

    var ackNo = $('#ack_no').val();

    if(ackNo == '')
    {
      alert('Please Enter Ack No.');
    }
    else
    {
      window.location.href = "searchByAckNo?ackNo=" + ackNo;
    }

  });
});